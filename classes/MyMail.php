<?php 
/**
 * my mail
 */
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class MyMail{
	
public function sendMailMine($fromHeader,$recevieremail,$subject, $messageBody)
    {
        $show = new Show();
    
	 // ---------------------------------------------------------
                // Load Composer's autoloader
          require APPROOT. '/vendor/autoload.php';
          $mail =  new PHPMailer(true);

            try{
              $mail->isSMTP();
              $mail->Host = "smtp.gmail.com";
              $mail->SMTPAuth = true;
              $mail->Username = "youremail";
              $mail->Password =  "yourpassword";
              $mail->SMTPSecure = "ssl";
              $mail->Port = 465; // for tls

               //email settings
               $mail->isHTML(true);
               $mail->setFrom("youremail", $fromHeader);
               $mail->addAddress($recevieremail);
               // $mail->addReplyTo("youremail", "Library Offence Doc.");
               $mail->Subject = $subject;
               $mail->Body = $messageBody;
               $mail->send();
             

        } catch (\Exception $e) {
            echo $show->showMessage('danger', 'Message could not be sent. Mailer Error:' .$mail->ErrorInfo, 'warning');
            return false;
          

    }

}


}