<?php 
require_once '../core/init.php';
include  APPROOT . '/includes/head.php';
$general = new General();
$tool = new Tools();
$user = new User();
$validate = new Validate();
$show = new Show();
$notification = new Notification();
$db = Database::getInstance();
?>
<style>
  .imgs{
    width: 400px;
    height: 400px;
    border-radius: 10px;
  }
</style>
<!-- contact -->
  <div class="welcome">
    <div class="container">
      <h3 class="agileits_w3layouts_head">Succ<span>ess</span></h3>
      
     <?php 

            $curl = curl_init();
            $reference = isset($_GET['reference']) ? $_GET['reference'] : '';
            if(!$reference){
              Redirect::to('../../rentTools');
            }

            curl_setopt_array($curl, array(
              CURLOPT_URL => "https://api.paystack.co/transaction/verify/".rawurlencode($reference),
              CURLOPT_RETURNTRANSFER => true,
              CURLOPT_HTTPHEADER => [
                "accept: application/json",
                "authorization: Bearer sk_test_1e28cc2fada408ec4b2ad693f88625f5e76da9f3",
                "cache-control: no-cache"
              ],
            ));

            $response = curl_exec($curl);
            $err = curl_error($curl);

            if($err){
                // there was an error contacting the Paystack API
              die('Curl returned error: ' . $err);
            }

            $tranx = json_decode($response);

            if(!$tranx->status){
              // there was an error from the API
              die('API returned error: ' . $tranx->message);
            }

            if('success' == $tranx->data->status){
                  $check = $db->query("SELECT * FROM transactions WEHRE transaction_ref = '$reference'");
                  if ($check->count()) {
                    $got = $check->first();
                  $db->query("UPDATE transactions SET paid = 1 WHERE transaction_ref = '$reference' "); 

                    $notification->notifi(array(
                     'customer' => $user_uniqueid,
                     'type' => 'admin',  
                     'title' => 'payment',
                     'message' => 'Customer paid for a tool!'
                    ));
                  }
               ?>
                <h3 class="agileits_w3layouts_head">Your Payment was successful!</h3>
               <hr> <h4 class="text-center"><a href="../users/user-dashboard" class="btn btn-info btn-rounded text-center">Go dashboard</a></h4>
                
               <?
            }

         ?>
      
      <div class="clearfix"> </div>
    </div>
  </div>

<?php 
include APPROOT .  '/includes/footer.php';
?>
