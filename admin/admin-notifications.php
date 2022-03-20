<?php
  require_once '../core/init.php';
  if (!isIsLoggedIn()){
      Session::flash('warning', 'You need to login to access that page!');
      Redirect::to('admin-login');
  }
  if (!hasPermissionSuper()){
      Session::flash('denied', 'You do not have permission to access that page!');
      Redirect::to('admin-dashboard');
  }
  $admin = new Admin();
  $useremail = $admin->data()->admin_email;
  $uniqueid = $admin->data()->admin_uniqueid;
  if (otpCheck()) {
    Session::flash('emailVerify', 'Please verify your email!', 'warning');
    Redirect::to('admin-verify');
  }elseif(isOTPset($uniqueid)){
    Redirect::to('admin-otp');
  }
  require APPROOT . '/includes/adminhead.php';
  require APPROOT . '/includes/adminnav.php';

  $general = new General();
 ?>
<style media="screen">
  .form-control{
    color: #fff;
  }
  option{
    color: #fff;
    background: #000;
  }
  .imgNot{
    width: 100px;
    height: 100px;
    border-radius: 50%;
  }
</style>
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <!-- table -->
      <div class="col-lg-12 col-md-12">
        <div class="card">
          <div class="card-header card-header-primary">
            <h4 class="card-title">Notifactions</h4>
            <p class="card-category">List of notification</p>
          </div>
          <div class="card-body table-responsive" >
            <div class="row p-3" id="showNotification">
              
            </div>
          </div>
        </div>
      </div>
      
    </div>
  </div>
</div>



<?php
  require APPROOT . '/includes/adminfooter.php';
 ?>
<script type="text/javascript" src="scripts.js"></script>
 <script type="text/javascript" src="activity.js"></script>
 <script type="text/javascript" src="notify.js"></script>
