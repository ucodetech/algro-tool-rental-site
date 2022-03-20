<?php
/**
 * user class
 */
class User
{
  private  $_db,
           $_userData,
           $_sessionName,
           $_cookieName,
           $_isLoggedIn;

public function __construct($user = null)
  {
    $this->_db = Database::getInstance();
    $this->_sessionName = Config::get('session/session_user');
    $this->_cookieName = Config::get('cookie/cookie_name');

    if (!$user) {
      if (Session::exists($this->_sessionName)) {
        $user = Session::get($this->_sessionName);

        if ($this->findUser($user)) {
          $this->_isLoggedIn = true;
        }else{
          //process logout
        }
      }
    }else{
     return  $this->findUser($user);
    }

  }

public function create($fields =  array())
{
    if (!$this->_db->insert('users', $fields)) {
      throw new Exception("Error Processing Request create account", 1);

    }
}
//find user details for login
public function findUser($user = null)
    {
      if ($user) {
       $field = (is_numeric($user)) ? 'user_id' : 'user_email';
       $data = $this->_db->get('users', array($field, '=', $user));
       if ($data->count()) {
         $this->_userData = $data->first();
         return true;
       }
      }
      return false;
    }

//login
    public function login($user_email = null, $password = null)
{
    $show = new Show();
  $user = $this->findUser($user_email);

  if ($user) {
      if ($this->data()->suspened == 0){
        $uniqueid = $this->data()->user_unique_id;

        if (password_verify($password, $this->data()->user_password)) {
           $ch = "SELECT * FROM secureOtp WHERE user_uniqueid = '$uniqueid'";
          $query = $this->_db->query($ch);
        if ($query->count()) {
          $sql2 = "UPDATE secureOtp SET secure_token = NULL WHERE user_uniqueid = '$uniqueid'";
         $this->_db->query($sql2);
        }else{
          // $sql56 = "INSERT INTO secureOtp (user_uniqueid) VALUES ('$uniqueid')";
          //  $this->_db->query($sql56);
           $this->_db->insert('secureOtp', array(
             'user_uniqueid' => $uniqueid
           ));
       }
        $rndno=rand(10000000, 99999999);//OTP generate
        $token = "TOKEN: "."<h2>".$rndno."</h2>";
        $fullname = $this->data()->user_fullname;

          $messageBody = "<div style='width:80%; height:auto; padding:10px; margin:10px'>

                <p style='color: #fff; font-size: 20px; text-align: center; text-transform: uppercase;margin-top:0px'>One Time Password Verification<br></p>
                  <p>Hey $fullname! <br><br>

              A sign in attempt requires further verification because we did not recognize your device. To complete the sign in, enter the verification code on the unrecognized device.

             <br><hr>
              $token <br><hr>

              If you did not attempt to sign in to your account, your password may be compromised. Contact Administrator to create a new, strong password for your AF account.</p>
                      <hr>

             </div>";
          $email = $this->data()->user_email;

          $sendmail =  MyMail::sendMailMine('Angel Farm',$email,'Device Verification', $messageBody);
        //  $date = date('M d, Y h:i A');
        //  $this->_db->update('adminOtp', 'admin_unique', $uniqueid, array(
        //  'secure_token' => $rndno,
        //  'status' => 'unused',
        //  'dateSent' => $date
        // ));
             
             $sql23 = "UPDATE secureOtp SET secure_token = '$rndno', status = 'unused', dateSent = NOW() WHERE user_uniqueid = '$uniqueid'";
              $this->_db->query($sql23);

             Session::put($this->_sessionName, $this->data()->user_id);
             $sql = "UPDATE users SET user_last_login = NOW() WHERE user_email = '$email' ";
              $this->_db->query($sql);
              return true;
         
        }else{
          echo $show->showMessage('danger','Password Incorrect', 'warning');
          return false;
        }
      }else{
          echo $show->showMessage('danger','You have been suspended! please contact the Administrator', 'warning');
          return false;
      }
  }else{
      echo $show->showMessage('danger','user not found', 'warning');
      return false;
  }



}


public function data()
{
  return $this->_userData;
}


public function isLoggedIn(){
  return $this->_isLoggedIn;
}

public function logout()
{
  Session::delete($this->_sessionName);
}

public function createVerification($fields =  array())
{
    if (!$this->_db->insert('otp_table', $fields)) {
      throw new Exception("Error Processing Request email verify", 1);

    }
}
//find email
public function findEmail($email)
{
  $data = $this->_db->get('users', array('user_email', '=', $email));
  if ($data->count()) {
    return   $data->first();
      }else{
    return false;
  }

}

//find phone number
public function findPhone($phoneNo)
{
  $data = $this->_db->get('users', array('phone_number', '=', $phoneNo));
  if ($data->count()) {
     return $data->first();
    
  }else{
    return false;
  }

}

//find matric no
public function findMatricNo($matricNo)
{
  $data = $this->_db->get('users', array('matric_no', '=', $matricNo));
  if ($data->count()) {
      return  $data->first();
  }else{
    return false;
  }

}


// find username
public function findUsername($username){
  $data = $this->_db->get('users', array('user_username', '=', $username));
  if ($data->count()) {
    return $data->first();
    
  }else{
    return false;
  }

}

public function updateProfile($userid,  $field = array())
    {
      $this->_db->update('users','user_id', $userid,  $field);
     return true;
    }
//password reset
   // delete token
public function deleteToken($email, $field = array())
    {
      $this->_db->delete('pwdReset', array('email', '=', $email));
    }









public function updateRecoreds($user_id, $field = array())
{
	if(!$this->_db->update('users', 'id', $user_id, $field)){
         throw new Exception("Error Processing Request", 1);
         return false;

  }
}




public function updateuserentRecored($userent_id, $field, $value)
{
	$this->_db->update('users', 'id', $userent_id, array(
    	$field => $value

    ));

    return true;
}

public function change_password($id, $hashNewPass)
{
	$this->_db->update('users', 'user_id', $id, array(
    	'user_password' => $hashNewPass,

    ));

    return true;


}


public function deleteVkey($id){
	if($this->_db->delete('verifyEmail', array('user_id', '=', $id))){
		  return true;

		}else{
			return false;
		}
}

public function updateVkey($token, $id){
	$this->_db->insert('verifyEmail', array(
		'token' => $token,
		'user_id' => $id
	));
	return true;

}

public function updateProfileDelete($uid){
	$this->_db->update('userprofile', 'user_id', $uid, array(
		'status' => 1
	));
  return true;
}
public function getGreenCard($id)
{
  $userent = $this->_db->get('greenCards', array('user_id', '=', $id));
  if ($userent->count()) {
    return  $userent->first();
  }else{
    return false;
  }
}



public function selectToken($token, $userid){

  $sql = "SELECT * FROM verifyEmail WHERE token = '$token' AND user_id = '$userid'";
 $this->_db->query($sql);
 if ($this->_db->count()) {
 	return $this->_db->first();
 }else{
 	return false;
 }
}

public function verify_email($uniqueid){
	$this->_db->update('users', 'user_unique_id', $uniqueid, array(
		'verified' => 1
	));
  return true;
}

public function selectSelector($selector){

  $sql = "SELECT * FROM pwdReset WHERE pwdResetSelector = '$selector' AND pwdResetExpires > NOW()";
  $this->_db->query($sql);
 if ($this->_db->count()) {
   return $this->_db->first();
 }else{
  return false;
 }
}

// public function selectUser($email){
//   $sql = "SELECT * FROM users WHERE email = ? AND deleted = 0";
//   $stmt = $this->_pdo->prepare($sql);
//   $stmt->execute([$email]);
//   $user = $stmt->fetch(PDO::FETCH_OBJ);
// return $user;
// }


public function updateUser($password,$email){
  $this->_db->update('users', 'email', $email, array(
    'password' => $password
  ));
  return true;
}

public function updateHits()
{
  $id = 0;
  $hits = $hits+1;
  $this->_db->update('visitors', 'id', $id, array(
    'hits' => $hits
  ));
  return true;

}


public function subNews($email){
  $this->_db->insert('update_subscribers', array(
    'user_email' => $email
  ));
  return true;
}


public function getUser($cu)
{
  $this->_db->get('users', array('id', '=', $cu));
  if ($this->_db->count()) {
    return $this->_db->first();
  }else{
    return false;
  }
}

public function activity($id){
    $sql = "UPDATE users SET user_last_login = NOW() WHERE user_id = '$id'";
    $this->_db->query($sql);
    return true;
}

public function checkUploaded($user_id, $week)

{
  $sql = "SELECT * FROM logbookOthers WHERE stu_unqiue_id = '$user_id' AND week_number = '$week' AND uploaded = 0 ";
  $df = $this->_db->query($sql);
if ($df->count()) {
   return true;
  }else{
    return false;
  }

}


//end of class
}
