<?php 
require_once '../core/init.php';
include  APPROOT . '/includes/head.php';
$general = new General();
$user = new User();
$db = Database::getInstance();
$tool = new Tools();
$validate = new Validate();
$show = new Show();
$notification = new Notification();
$user_uniqueid = $user->data()->user_unique_id;

if (isset($_POST['payNow'])) {
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
			$price  = $price * 10;

			//start payment initailize
			$curl = curl_init();

			$email = $email;
			$amount = $price;  //the amount in kobo. This value is actually NGN 300

			// url to go to after payment
			$callback_url = URLROOT.'processes/verified.php';  
			$ref = 'AF-'.md5(generateKey8());
			curl_setopt_array($curl, array(
			  CURLOPT_URL => "https://api.paystack.co/transaction/initialize",
			  CURLOPT_RETURNTRANSFER => true,
			  CURLOPT_CUSTOMREQUEST => "POST",
			  CURLOPT_POSTFIELDS => json_encode([
			    'amount'=>$amount,
			    'email'=>$email,
			    "reference" => $ref,
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
			}

			$tranx = json_decode($response, true);

			if(!$tranx['status']){
			  // there was an error from the API
			  print_r('API returned error: ' . $tranx['message']);
			}

			// comment out this line if you want to redirect the user to the payment page
			print_r($tranx);
			// redirect to page so User can payment
			// uncomment this line to allow the user redirect to the payment page
			header('Location: ' . $tranx['data']['authorization_url']);

						// end payment
			$tool->create('transactions', array(
				'item_img' => Input::get('item_img'),	
				'item_name' => Input::get('item_name'),
				'item_duration' => Input::get('duration'),
				'item_price' => $price,
				'user_uniqueid' => $user_uniqueid,	
				'user_name' => Input::get('user_fullname'),	
				'user_phoneNo' => Input::get('user_phoneNo'),	
				'user_email' => Input::get('user_email'),	
				'user_city' => Input::get('user_city'),
				'user_lga' => Input::get('user_lga'),	
				'user_state' => Input::get('user_state'),	
				'user_address' => Input::get('user_address'),	
				'user_address2' => Input::get('user_address2'),	
				'transaction_ref' => $ref

			));
				
		}else{
			foreach ($validation->errors() as $error) {
				echo $show->showMessage('danger', $error, 'warning');
			}
		}
	}
}


?>
<!-- contact -->
	<div class="welcome">
		<div class="container">
			<h3 class="agileits_w3layouts_head">Pay<span> Now</span></h3>
			<?php if (isset($_GET['payment']) && !empty(($_GET['payment']))): ?>
				<?php 
				$key = $_GET['payment'];
				$getTool = $db->query("SELECT * FROM farmTools WHERE secret_key = '$key' LIMIT 1 ");
				if ($getTool->count()) {
					$getItem  = $getTool->first();

	?>
	<div class="w3layouts_gallery_grids">
		<div class="col-md-8 w3layouts_gallery_grid">
			<h2 class="text-center">Pay with Card</h2><hr>
				<form action="" method="POST" i style="padding: 10px;">
		<!-- user details -->
		<div class="row">
			<div class="col-md-4 form-group">
				<label for="user_fullname">Full Name:<sup class="text-danger">*</sup></label>
				<input type="text" name="user_fullname" id="user_fullname" class="form-control" value="<?=$user->data()->user_fullname?>">
			</div>
			<div class="col-md-4 form-group">
				<label for="user_phoneNo">Phone No:<sup class="text-danger">*</sup></label>
				<input type="text" name="user_phoneNo" id="user_phoneNo" class="form-control" value="<?=$user->data()->user_tel?>">
			</div>
			<div class="col-md-4 form-group">
				<label for="user_email">Email:<sup class="text-danger">*</sup></label>
				<input type="text" name="user_email" id="user_email" class="form-control" value="<?=$user->data()->user_email?>">
			</div>
		</div>
		<!-- end of user details -->
		<!-- user contact details -->
		<div class="row">
			<div class="col-md-4 form-group">
				<label for="user_city">City:<sup class="text-danger">*</sup></label>
				<input type="text" name="user_city" id="user_city" class="form-control" value="<?=$user->data()->user_city?>">
			</div>
			<div class="col-md-4 form-group">
				<label for="user_lga">LGA:<sup class="text-danger">*</sup></label>
				<input type="text" name="user_lga" id="user_lga" class="form-control" value="<?=$user->data()->user_lga?>">
			</div>
			<div class="col-md-4 form-group">
				<label for="user_state">State: <sup class="text-danger">*</sup></label>
				<input type="text" name="user_state" id="user_state" class="form-control" value="<?=$user->data()->user_state?>">
			</div>
			<div class="col-md-6 form-group">
				<label for="user_address">Address 1: <sup class="text-danger">*</sup></label>
				<textarea name="user_address" id="user_address" cols="10" rows="5" class="form-control"><?=$user->data()->user_address?></textarea>
			</div>
			<div class="col-md-6 form-group">
				<label for="user_address2">Address 2(optional)</label>
				<textarea name="user_address2" id="user_address2" cols="30" rows="5" class="form-control"></textarea>
			</div>
		</div>
		<!-- end of user contact details -->
		<!-- item details -->
		<div class="row">
			<input type="hidden" name="item_img" id="item_img" class="form-control" value="<?=$getItem->tool_img?>">
			<div class="col-md-4 form-group">
				<label for="item_name">Item Name <sup class="text-danger">*</sup></label>
				<input type="text" name="item_name" id="item_name" class="form-control" value="<?=$getItem->tool_name?>" readonly>
			</div>
			<div class="col-md-4 form-group">
				<label for="item_price">Item Price <sup class="text-danger">*</sup></label>
				<input type="text" name="item_price" id="item_price" class="form-control" value="<?=$getItem->tool_price?>" readonly>
			</div>
			<div class="col-md-4 form-group">
				<label for="item_type">Item type <sup class="text-danger">*</sup></label>
				<input type="text" name="item_type" id="item_type" class="form-control" value="<?=$getItem->tool_type?>" readonly>
			</div>
			<div class="col-md-12 form-group">
				<label for="duration">Duration <sup class="text-danger">*</sup></label>
				<select name="duration" id="duration" class="form-control">
					<option value="">Select Duration</option>
					<option value="1">One Week</option>
					<option value="2">Two Weeks</option>
					<option value="3">Three Weeks</option>
					<option value="4">One Month</option>
				</select>
			</div>
			<div class="col-md-12 form-group">

				<div class="row">
					<div class="col-md-3">One Week <?=$getItem->tool_price?></div>
					<div class="col-md-3">
						Two Weeks 
					<?
						$price = $getItem->tool_price * 2;
						echo $price;
					?>
						
					</div>
					<div class="col-md-3">
						Three Weeks
						<?
						$price3 = $getItem->tool_price * 3;
						echo $price3;
					?>
					</div>
					<div class="col-md-3">
					One Month
					<?
						$price4 = $getItem->tool_price * 4;
						echo $price4;
					?>
				</div>
				</div>
				
			</div>
		</div>
		<div class="row">
			<div class="col-md-6 form-group">
				<button class="btn btn-info btn-block btn-rounded" name="payNow" id="payNow" type="submit">Pay Now (With card)</button>
			</div>
			<div class="col-md-6 form-group">
				<a href="../.../../../rentTools" class="btn btn-danger btn-block btn-rounded">Cancel</a>
			</div>
			<div class="col-md-12 form-group" id="showPayError">
			</div>
		</div>
		<!-- end of item details -->
	</form>
		</div>	
		<div class="col-md-4 w3layouts_gallery_grid">
			<h3 class="text-center">Direct Bank Transfer/Deposit</h3><hr>
			<div class="details" style="display: block;">
				<span>Account Name: Angel Farm Tool</span><br>
				<span>Account Number: 2094194865</span><br>
				<span>Account Bank: UBA</span>
			</div>
			<h4 class="text-danger">
				Note: You are to contact the Sales Department immediately after your bank payment. 08107972754/09057985206: (Payment Evidance, Details of the tool to rent as specified on the site, Phone Number, Email, Address, State, City etc.);

			</h4>
		</div>
	</div>

	<?
				}else{
					Redirect::to(URLROOT);
				}


				 ?>
			<?php endif ?>
		</div>
	</div>


<?php 
include APPROOT .  '/includes/footer.php';
?>
<script>

	$(document).ready(function(){
		// $('#payNow').click(function(e){
		// 	e.preventDefault();
		// 	$.ajax({
	 //         url:'../process.php',
	 //         method:'post',
	 //         data:$('#rentPayForm').serialize()+'&action=payment',
	 //         beforeSend:function(){
	 //           $('#payNow').html('<img src="../../gif/tra.gif">Checking...');
	 //         },
	 //         success:function(response){
	 //           if (response==='success') {
	 //               $('#rentPayForm').modal('hide');
	 //               window.location = '../../users/user-dashboard';
	 //           }else{
	 //             $('#showPayError').html(response);
	 //             // setTimeout(function(){
	 //             //     $('#showError').html('');
	 //             // },10000);

	 //           }
	 //         },
	 //         complete:function(){
	 //           $('#payNow').html('payment now (with card)');
	 //         }
	 //       })	
		// });


	})
</script>