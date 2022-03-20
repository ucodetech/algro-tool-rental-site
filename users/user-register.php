<?php
  require_once '../core/init.php';
  require APPROOT . '/includes/head1.php';

  $general = new General();
  $states = $general->getState();
  $lga = $general->getLGA();


 ?>
<style media="screen">
  .form-control{
    color: #029eb1;
  }
</style>


<div class="content">
  <div class="container-fluid">
    <div class="row mt-5">
      <!-- table -->
        <div class="col-lg-2 col-md-12"></div>
      <div class="col-lg-8 col-md-12">
        <div class="card">
          <div class="card-header card-header-tabs card-header-warning">
            <div class="nav-tabs-navigation">
              <div class="nav-tabs-wrapper">
                <span class="nav-tabs-title">Form:</span>
                <ul class="nav nav-tabs" data-tabs="tabs">
                  <li class="nav-item">
                    <a class="nav-link active" href="#" data-toggle="tab">
                      <i class="material-icons fa fa-sign-in fa-lg"></i> Register
                      <div class="ripple-container"></div>
                    </a>
                  </li>
                </ul>
              </div>
            </div>
          </div>
          <div class="card-body">
            <div class="tab-content">
              <div class="tab-pane active">
                <hr>
                <form class="form" action="#" method="post" enctype="multipart/form-data" id="registerUserForm">
                  <!-- personal details -->
                  <div class="row p-4">
                  <div class="col-lg-4 form-group">
                    <label for="fullname">Full Name: <sup class="text-danger">*</sup></label>
                      <input type="text" name="fullname" id="fullname" class="form-control">
                  </div>
                   <div class="col-lg-4 form-group">
                    <label for="user_email">Email: <sup class="text-danger">*</sup></label>
                      <input type="email" name="user_email" id="user_email" class="form-control">
                  </div>
                  <div class="col-lg-4 form-group">
                    <label for="user_tel">Phone No: <sup class="text-danger">*</sup></label>
                      <input type="tel" name="user_tel" id="user_tel" class="form-control">
                  </div>
                </div>
                  <!-- school detail -->
                  <div class="row p-4">
                    <div class="form-group col-lg-4">
                     <label for="city">City<sup class="text-danger">*</sup></label>
                      <input type="text" name="city" id="city" class="form-control">
                  </div>
                  <div class="form-group col-lg-4">
                  <label for="lga">L.G.A<sup class="text-danger">*</sup></label>
                  <select name="lga" id="lga" class="form-control text-info">
                    
                       <option value="" <?= (($lga == ''))? ' selected' : '' ;?>>Select lga</option>
                     <?php foreach ($lga as $lg): ?>

                        <option value="<?=$lg->lga;?>" <?= (($lga == $lg->lga))? ' selected' : '' ;?>><?=$lg->lga ?></option>
                     <?php endforeach; ?>



                  </select>
                </div>
                 <div class="form-group col-lg-4">
                  <label for="state">State<sup class="text-danger">*</sup></label>
                  <select name="state" id="state" class="form-control text-info">
                    
                       <option value="" <?= (($states == ''))? ' selected' : '' ;?>>Select state</option>
                     <?php foreach ($states as $st): ?>

                        <option value="<?=$st->state;?>" <?= (($st == $st->state))? ' selected' : '' ;?>><?=$st->state ?></option>
                     <?php endforeach; ?>



                  </select>
                </div>
                 
                 </div>
                  
                 <!-- login details -->
                 <div class="row p-4">
                  <div class="col-lg-4 form-group">
                    <label for="address">Address: <sup class="text-danger">*</sup></label>
                    <textarea name="address" id="address" class="form-control" rows="5"></textarea>
                  </div>
                  <div class="col-lg-4 form-group">
                    <label for="password">Password: <sup class="text-danger
                      ">*</sup></label>
                      <input type="password" name="password" id="password" class="form-control">
                  </div>
                   <div class="col-lg-4 form-group">
                    <label for="cpassword">Comfirm Password: <sup class="text-danger
                      ">*</sup></label>
                      <input type="password" name="cpassword" id="cpassword" class="form-control">
                  </div>
                  
                 </div>
                 <div class="row">
                   <div class="col-lg-4 form-group">
                    <button type="button" name="register" id="registerBtn" class="btn btn-info btn-block">Register</button>
                  </div>
                   <div class="col-lg-4 form-group">
                    <a href="user-login" class="float-right">Already have account? Login</a>
                  </div>
                 </div>
                 <div class="clearfix"></div>
                 <span id="showMessage"></span>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-2 col-md-12">

      </div>

    </div>
  </div>
</div>






<?php
  require APPROOT . '/includes/footer1.php';
 ?>

<script>
   $(document).ready(function(){
      var gifPath = '../gif/tra.gif';
    //register process
    
    $('#registerBtn').click(function(e){
      e.preventDefault();

      $.ajax({
        url:'script/register-process.php',
        method:'post',
        data:$('#registerUserForm').serialize()+'&action=register',
        beforeSend:function(){
          $('#registerBtn').html('<img src="'+gifPath+'" alt="gif">a moment...');
        },
        success:function(response){
          console.log(response);
          if ($.trim(response)==='success') {
            $('#showMessage').html('<div id="" class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert"> &times; </button><i class="fa fa-check"></i>&nbsp;<span>Success! Redirecting...</span></div>');

            setTimeout(function(){
              window.location = 'user-verify';
            }, 3000);
            
          }else{
            $('#showMessage').html(response);
          
          }
        },
        complete:function(){
          $('#registerBtn').html('Register');
        }
      });
    });

});
</script>