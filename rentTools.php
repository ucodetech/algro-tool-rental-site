<?php 
require_once 'core/init.php';
include  APPROOT . '/includes/head.php';
$general = new General();
$user = new User();
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
			<h3 class="agileits_w3layouts_head">Rent<span> Tools</span></h3>
			<div class="w3_agile_image">
				<img src="images/1.png" alt=" " class="img-responsive" />
			</div>
			<p class="agile_para">You are to select the tools you want to proceed</p>
<!---728x90--->
			<?php 
				// echo generateKey8();
			 ?>
			<div class="w3layouts_gallery_grids">	
			<?php 
				$getTools = $general->getTool();
			?>
			<?php foreach ($getTools as $tool): ?>
				<div class="col-md-4 w3layouts_gallery_grid">
               
                    <div class="w3layouts_news_grid">
                        <img src="<?=URLROOT?>uploads/farmtools/<?=$tool->tool_img?>" alt="<?=$tool->tool_name?>" class="img-responsive imgs">
                        <div class="w3layouts_news_grid_pos">
                            <div class="wthree_text"><h3><?=$tool->tool_name;?></h3></div>

                        </div>
                    </div>
                    <hr>
                    <?php if (!isLoggedInUser()): ?>
                    <div class="text-center">
                    	 <a href="#" data-toggle="modal" data-target="#loginModal" class="btn btn-success btn-rounded text-center">Login</a>
                    </div>
                    	<?php else: ?>
                    <div class="text-center">
                    	<span><?=money($tool->tool_price);?></span>
                    	 <a href="processes/paynow/<?=$tool->secret_key;?>" class="btn btn-success btn-rounded text-center">Rent</a>
                    </div>
                    <?php endif ?>
                    
               

          	  </div>
			<?php endforeach ?>
			
			<div class="clearfix"> </div>
		</div>
		</div>
	</div>




<!-- //bootstrap-pop-up -->
<!-- bootstrap-pop-up -->
<div class="modal video-modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="loginModal">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				Login
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>						
			</div>
			<section>
				<div class="modal-body py-auto">
					<form action="#" method="POST" id="loginFormHome" style="padding: 10px;">
						<!-- user details -->
						<div class="row">
							<div class="col-md-6 form-group">
								<label for="user_email">Email:<sup class="text-danger">*</sup></label>
								<input type="email" name="user_email" id="user_email" class="form-control">
							</div>
							<div class="col-md-6 form-group">
								<label for="password">Password:<sup class="text-danger">*</sup></label>
								<input type="password" name="password" id="password" class="form-control">
							</div>
							
						</div>
						<!-- end of user details -->
						
						<div class="row">
							<div class="col-md-6 form-group">
								<button class="btn btn-success btn-block btn-rounded loginBtn" id="loginBtn" type="button">Login</button>
							</div>
							<div class="col-md-6 form-group">
								<a href="users/user-login" class="btn btn-warning btn-block btn-rounded">Register</a>
							</div>
							<div class="col-md-12" id="showMessage"></div>
						</div>
						<!-- end of item details -->
					</form>
				</div>
			</section>
		</div>
	</div>
</div>
<!-- //bootstrap-pop-up -->

<?php 
include APPROOT .  '/includes/footer.php';
?>
<script>

	$(document).ready(function(){
		$('#loginBtn').click(function(e){
			e.preventDefault();
			$.ajax({
	         url:'users/script/login-process.php',
	         method:'post',
	         data:$('#loginFormHome').serialize()+'&action=loginUser',
	         beforeSend:function(){
	           $('#loginBtn').html('<img src="gif/tra.gif">Checking...');
	         },
	         success:function(response){
	           if (response==='success') {
	               $('#loginFormHome')[0].reset();
	               $('#loginModal').modal('hide');
	               location.reload();
	           }else{
	             $('#showMessage').html(response);
	             // setTimeout(function(){
	             //     $('#showError').html('');
	             // },10000);

	           }
	         },
	         complete:function(){
	           $('#loginBtn').html('Done');
	         }
	       })	
		});


	})
</script>