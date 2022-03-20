<?php

 /**
  * Customer
  */
 class Customer
 {

 	private  $_db,
           $_user,
           $_super;


  function __construct()
  {
    $this->_db = Database::getInstance();
    $this->_user = new User() ;

  }


  //Get gender percentage
public function genderPer(){
  $sql = "SELECT gender, COUNT(*) AS number FROM users WHERE gender != '' GROUP BY gender ";
  $data = $this->_db->query($sql);
	  if ($data->count()) {
	  	return $data->results();
	  }else{
	  	return false;
	  }
}

// verified and unverified percenta
public function verifiedPer(){
  $sql = "SELECT verified, COUNT(*) AS number FROM users  GROUP BY verified ";
   $data = $this->_db->query($sql);
	  if ($data->count()) {
	  	return $data->results();
	  }else{
	  	return false;
	  }
}



 public function getImgSuper($superimgid){
        $data = $this->_db->get('super_profile', array('sudo_id', '=', $superimgid));
     	  if ($this->_db->count()) {
     	  	return $this->_db->first();
     	  }else{
     	  	return false;
     	  }
    }


  public function verified_users($status){
    $count =  $this->_db->get('users', array('verified', '=', $status));
    if ($count->count()) {
      return $count->count();
    }else{
      return '0';
    }
  }


public function fetchUserDetail($id){
    $data = $this->_db->get('users', array('stu_id', '=', $id));
    if ($data->count()) {
      return $data->first();
    }else{
      return false;
    }
}




public function loggedUsers(){
    $sql = "SELECT * FROM users WHERE user_last_login > DATE_SUB(NOW(), INTERVAL 5 SECOND)";
    $data = $this->_db->query($sql);
  	  if ($data->count()) {
  	  	return $data->results();
  	  }else{
  	  	return false;
  	  }
  }


public function updateStudentRecored($student_id, $field, $value)
{
	$this->_db->update('users', 'user_id', $student_id, array(
    	$field => $value

    ));

    return true;
}




public function fetchCustomers(){
  $output = '';
  $imgPath = '../users/profile/';

  $sql = "SELECT * FROM users WHERE deleted = 0 AND suspened = 0";
  $query = $this->_db->query($sql);
  if ($query->count()) {
    $dat = $query->results();
  if ($dat) {
    $output .= '
    <table class="table table-striped table-hover" id="showCustomer">
      <thead>
        <tr>
          <th>#</th>
          <th>Photo</th>
          <th>Full Name</th>
          <th>Email</th>
          <th>Phone Number</th>
          <th>Joined Date</th>
          <th>Last Login</th>
          <th>Action</th>

        </tr>
      </thead>
      <tbody>
    ';
    foreach ($dat as $row) {

        $passport = '<img src="'.$imgPath.$row->passport.'"  alt="User Image" width="70px" height="70px" style="border-radius:50px;">';

      $output .= '
          <tr>
            <td>'.$row->user_id.'</td>
              <td>'.$passport.'</td>
                   <td>'.$row->user_fullname. '</td>
                     <td>'.$row->user_email.'</td>
                       <td>'.$row->user_tel.'</td>
                       <td>'.pretty_dates($row->user_date_joined).'</td>
                       <td>'.timeAgo($row->user_last_login).'</td>

                         <td>
                          <a href="#" id="'.$row->user_id.'" title="Edit Customer"  data-toggle="modal" data-target="#customerEditModal" class="text-info"><i class="fa fa-info-circle fa-lg"></i> </a>&nbsp;

                         <a href="#" id="'.$row->user_id.'" title="View Details"  data-toggle="modal" data-target="#customerDetailModal" class="text-primary"><i class="fa fa-info-circle fa-lg"></i> </a>&nbsp;
                         

                         <a href="#" id="'.$row->user_id.'" title="Trash Customer" class="text-danger deleteCustomerIcon"><i class="fa fa-recycle fa-lg"></i> </a>&nbsp;

                         </td>
          </tr>
          ';
    }



    $output .= '
      </tbody>
    </table>';
  }
  return  $output;

}else{
  echo '<h3 class="text-center text-secondary align-self-center lead">No Users yet</h3>';
}

}

public function fetchNotifactionCount(){
  $sql = "SELECT * FROM users WHERE hod_approval = 0 OR circulation_approval = 0 OR approved = 0 ";
   $this->_db->query($sql);
  if ($this->_db->count()) {
    return $this->_db->count();
  }else{
    return false;
}
}


public function approveAction($field,$val, $user_id)
{
  $data = $this->_db->get('users', array('id', '=', $user_id));
  if ($data->count()) {
    $dat = $data->first();
    $userid = $dat->id;
    if ($dat->updated == 1) {
      $sql = "UPDATE users SET $field = 1, approved = $val WHERE id = '$user_id'";
      $query = $this->_db->query($sql);
      if ($query) {
        return true;
      }else{
        return false;

      }
    }else{
      $show = new Show();
      echo $show->showMessage('danger','The student or staff have not updated his/her details completely!', 'warning');
    }
  }

}

public function giveCard($user_id)
{
  $stamp = 'stamp.jpeg';
  $this->_db->insert('greenCards', array(
    'user_id' => $user_id,
    'stamp' => $stamp
  ));
  return true;
}

public function getStudentDetail($student_id)
  {
    $student = $this->_db->get('users', array('id', '=', $student_id));
    if ($student->count()) {
      return  $student->first();

    }else{
      return false;
    }
}

public function fetchOffenders(){
    $output = '';
    $imgPath = '../studentPortal/avaters/';


    $this->_db->get('offenders', array('pardoned', '=', 0));
    if ($this->_db->count()) {
      $dat = $this->_db->results();
    if ($dat) {
      $output .= '
      <table class="table table-striped table-hover" id="showOffender">
        <thead>
          <tr>
            <th>#</th>
            <th>Photo</th>
            <th>Full Name</th>
            <th>Matric/File No</th>
            <th>Offence</th>
            <th>Punishment</th>
            <th>Details</th>
            <th>Restore Access</th>


          </tr>
        </thead>
        <tbody>
      ';
      foreach ($dat as $row) {
        $student =  $this->_db->get('users', array('id', '=', $row->user_id));
        if ($student->count()) {
          $thatStudent = $student->first();
        }
          $passport = '<img src="'.$imgPath.  $thatStudent->passport.'"  alt="User Image" width="70px" height="70px" style="border-radius:50px;">';

          if ($thatStudent->permission == 'lib_staff') {
            $idno = $thatStudent->fileNo;
          }else{
            $idno = $thatStudent->matric_no;
          }

        $output .= '
            <tr>
              <td>'.$thatStudent->id.'</td>
                <td>'.$passport.'</td>
                     <td>'.$thatStudent->full_name.'</td>
                       <td>'.$idno.'</td>
                         <td>'.$row->offence.'</td>
                         <td>'.$row->punishment.'</td>

                           <td>
                           <a href="detail/student-detail/'.$thatStudent->id.'" id="'.$thatStudent->id.'" title="View Details" class="btn btn-primary btn-sm">Details</a>&nbsp;

                           </td>
                           <td>
                           <a href="#" id="'.$thatStudent->id.'" title="Trash Student" class="btn  btn-sm btn-danger deleteStudentIcon">Restore Access</a>&nbsp;

                           </td>
            </tr>
            ';
      }



      $output .= '
        </tbody>
      </table>';
    }
    return  $output;

  }else{
    echo '<h3 class="text-center text-secondary align-self-center lead">No Offender In database</h3>';
  }

}
//log in error
public function sendToLog($studentId)
{
    $this->_db->insert('offenders', array(
        'user_id'  => $studentId,
        'offence' => 'Failed to return book as at well due!',
        'punishment' => 'Banned from borrowing book from the library, with immediate effect!'
      ));
      return true;
}

public function updateOffended($studentId)
{
  $this->_db->update('users', 'id', $studentId, array(
    'offended' => 1
  ));
  return true;
}


public function updateTimeInBorrowed($studentId)
    {
        $this->_db->update('borrowed_books', 'user_id', $studentId, array(
            'time_before_log' => '00:00:00'
        ));
        return true;
    }

















   }//end of class
