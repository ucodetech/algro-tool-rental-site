<?php
require_once  '../../core/init.php';
$user = new User();
$validate = new Validate();
$show = new Show();

if (isset($_POST['action']) && $_POST['action'] == 'register'){

    if (Input::exists()){
        $validation = $validate->check($_POST, array(

            'fullname' => array(
                'required' => true,
                'min' => 3,
                'max' => 100
            ),
            'user_tel' => array(
                'required' => true,
                'unique' => 'users'
            ),
            'user_email' => array(
                'required' => true,
                 'unique' => 'users'
            ),
            'city' => array(
              'required' => true,
            ),
            'lga' => array(
              'required' => true
            ),
            'state' => array(
              'required' => true
            ),
            'address' => array(
              'required' => true,
              'min' => 2,
              'max' => 150
            ),
            'password' => array(
                'required' => true,
                'min' => 10
            ),
            'cpassword' => array(
              'required' => true,
              'matches' => 'password'
            )
        ));
        if ($validation->passed()){
            if (!filter_var(Input::get('user_email'), FILTER_VALIDATE_EMAIL)){
                echo $show->showMessage('danger', 'Invalid Email address!', 'warning');
                return false;
            }

            
            $password = Input::get('password');
            $newPassword = password_hash($password, PASSWORD_DEFAULT);
            $rn = rand(10000000, 99999999);
            $user_unique_id = 'cus-' . $rn;
                              
            try {
                $user->create(array(
                    'user_fullname' => Input::get('fullname'),
                    'user_tel' => Input::get('user_tel'),
                    'user_email' => Input::get('user_email'),
                    'user_address' => Input::get('address'),
                    'user_state' => Input::get('state'),
                    'user_city' => Input::get('city'),
                    'user_lga' => Input::get('lga'),
                    'user_password' =>  $newPassword,
                    'user_unique_id' => $user_unique_id
                ));
                  $rndno=rand(10000000, 99999999);//OTP generate
                $token = "TOKEN: "."<h2>".$rndno."</h2>";
                $fname = Input::get('fullname');
                $email = Input::get('user_email');
       
                // _____________________________________________________
            
                $messageBody = "<div style='width:80%; height:auto; padding:10px; margin:10px'>

                        <p style='color: #fff; font-size: 20px; text-align: center; text-transform: uppercase;margin-top:0px'>Email Verification<br></p>
                        <p>Hey $fname! <br><br>
                        Welcome to Angel Farm. <br>
                        Please verify your email address using the code below.
                       <br><hr>
                        $token 
                      </p>
                

                       </div>";
              $sendmail =  MyMail::sendMailMine('Angel Farm',$email,'Email Verification', $messageBody);
                // update token table
              Database::getInstance()->query("INSERT INTO verifyEmail (user_uniqueid, token) VALUES 
                    ('$user_unique_id','$rndno')");
              echo 'success';
               
               

        }catch( Exception $e){
            echo $show->showMessage('danger', $e->getMessage(), 'warning');
            echo $show->showMessage('danger', $e->getLine(), 'warning');
            echo $show->showMessage('danger', $e->getCode(), 'warning');
            return false;

        }

        }else{
            foreach($validation->errors() as $error){
                echo $show->showMessage('danger', $error, 'warning');
                return false;
            }
        }
    }
}
