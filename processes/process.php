<?php 
require_once '../core/init.php';

$tool = new Tools();
$user = new User();
$validate = new Validate();
$show = new Show();
$notification = new Notification();

$user_uniqueid = $user->data()->user_unique_id;

if (isset($_POST['action']) && $_POST['action'] == 'payment') {

	if (Input::exists()) {
		$validation = $validate->check($_POST, array(
			'user_fullname' => array(
				'required' => true,
			),
			'user_phoneNo' => array(
				'required' => true,
			),
			'user_email' => array(
				'required' => true,
			),
			'user_city' => array(
				'required' => true,
			),
			'user_lga' => array(
				'required' => true,
			),
			'user_state' => array(
				'required' => true,
			),
			'user_address' => array(
				'required' => true,
			),
			'item_name' => array(
				'required' => true,
			),
			'item_price' => array(
				'required' => true,
			),
			'item_type' => array(
				'required' => true,
			),
			'duration' => array(
				'required' => true,
			),
		));

		if ($validation->passed()) {
			
			$duration = Input::get('duration');
			$price = Input::get('item_price');
			$email = Input::get('user_email');
			switch ($duration) {
				case 1:
					$price = $price * $duration;
					break;
				case 2:
					$price = $price * $duration;
					break;
				case 3:
					$price = $price * $duration;
					break;
				case 4:
					$price = $price * $duration;
					break;
				
				default:
					$price = $price;
					break;

			}
			
			if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
				echo $show->showMessage('danger', 'Invalid email supplied', 'warning');
				return false;
			}


			//start payment initailize
			$curl = curl_init();

			$email = $email;
			$amount = $price;  //the amount in kobo. This value is actually NGN 300

			// url to go to after payment
			$callback_url = '../verify.php';  

			curl_setopt_array($curl, array(
			  CURLOPT_URL => "https://api.paystack.co/transaction/initialize",
			  CURLOPT_RETURNTRANSFER => true,
			  CURLOPT_CUSTOMREQUEST => "POST",
			  CURLOPT_POSTFIELDS => json_encode([
			    'amount'=>$amount,
			    'email'=>$email,
			    'callback_url' => $callback_url
			  ]),
			  CURLOPT_HTTPHEADER => [
			    "authorization: Bearer sk_test_1e28cc2fada408ec4b2ad693f88625f5e76da9f3", //replace this with your own test key
			    "content-type: application/json",
			    "cache-control: no-cache"
			  ],
			));

			$response = curl_exec($curl);
			$err = curl_error($curl);

			if($err){
			  // there was an error contacting the Paystack API
			  echo $show->showMessage('danger','Curl returned error: ' . $err, 'warning');
			  return false;
			}

			$tranx = json_decode($response, true);

			if(!$tranx['status']){
			  // there was an error from the API
			  print_r('API returned error: ' . $tranx['message']);
			}

			// comment out this line if you want to redirect the user to the payment page
			// print_r($tranx);
			// redirect to page so User can payment
			// uncomment this line to allow the user redirect to the payment page
			header('Location: ' . $tranx['data']['authorization_url']);
						// end payment
			// $tool->create('transactions', array(
			// 	'item_img' => Input::get('item_img'),	
			// 	'item_name' => Input::get('item_name'),
			// 	'item_duration' => Input::get('duration'),
			// 	'item_price' => $price,
			// 	'user_uniqueid' => $user_uniqueid,	
			// 	'user_name' => Input::get('user_fullname'),	
			// 	'user_phoneNo' => Input::get('user_phoneNo'),	
			// 	'user_email' => Input::get('user_email'),	
			// 	'user_city' => Input::get('user_city'),
			// 	'user_lga' => Input::get('user_lga'),	
			// 	'user_state' => Input::get('user_state'),	
			// 	'user_address' => Input::get('user_address'),	
			// 	'user_address2' => Input::get('user_address2'),	

			// ));
			// $notification->notifi(array(
			// 	'customer' => $user_uniqueid,
			// 	'type' => 'admin',	
			// 	'title' => 'payment',
			// 	'message' => 'Customer paid for an tool renting!'
			// ));

			// echo 'success';
		}else{
			foreach ($validation->errors() as $error) {
				echo $show->showMessage('danger', $error, 'warning');
				return false;
			}
		}
	}
	
}
