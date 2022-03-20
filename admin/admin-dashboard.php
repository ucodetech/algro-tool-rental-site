<?php
  require_once '../core/init.php';
  if (!isIsLoggedIn()){
      Session::flash('warning', 'You need to login to access that page!');
      Redirect::to('admin-login');
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
    $student = new Student();
  require APPROOT . '/includes/adminhead.php';
  require APPROOT . '/includes/adminnav.php';

 ?>
<style media="screen">
.activeImg,.profileSF{
  width: 70px;
  height: 70px;
  border-radius: 50%;
}
.card-title{
  color:#fff !important;
}
.form-control{
  color: #fff;
}
option{
  color: #fff;
  background: #000;
}
</style>
<div class="content">
  <div class="container-fluid">
    <!-- first role monitor users -->
    <?php if (hasPermissionSuper()): ?>
    <div class="row">
      <!-- <div class="col-xl-4 col-lg-12">
        <div class="card card-chart">
          <div class="card-header card-header-success">
            <div class="ct-chart" id="dailySalesChart"></div>
          </div>
          <div class="card-body">
            <h4 class="card-title">Daily Sales</h4>
            <p class="card-category">
              <span class="text-success"><i class="fa fa-long-arrow-up"></i> 55% </span> increase in today sales.</p>
          </div>
          <div class="card-footer">
            <div class="stats">
              <i class="material-icons">access_time</i> updated 4 minutes ago
            </div>
          </div>
        </div>
      </div> -->
      <div class="col-xl-6 col-lg-12">
        <div class="card card-chart">
          <div class="card-header card-header-warning">
            <div class="ct-chart">
              <div class="row"  id="loggedInAdmin">  </div>
            </div>
          </div>
          <div class="card-body">
            <h4 class="card-title">Logged Admins</h4>
            <p class="card-category">Current Logged In Superuser, Industrial Base Supervisor and Swies Coordinator
            </p>
          </div>
          <div class="card-footer">
            <div class="stats">
              <i class="material-icons">access_time</i>Update comes every 2 seconds
            </div>
          </div>
        </div>
      </div>
      <div class="col-xl-6 col-lg-12">
        <div class="card card-chart">
          <div class="card-header card-header-danger">
            <div class="ct-chart">
              <div class="row" id="showCurrentLoggedCus">

              </div>
            </div>
          </div>
          <div class="card-body">
            <h4 class="card-title">Logged Customer</h4>
            <p class="card-category">Current Logged in customer</p>
          </div>
          <div class="card-footer">
            <div class="stats">
              <i class="material-icons">access_time</i> Update comes every 2 seconds
            </div>
          </div>
        </div>
      </div>
    </div>
      <?php endif; ?>
    <div class="row">
      <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6">
        <div class="card card-stats">
          <div class="card-header card-header-warning card-header-icon">
            <div class="card-icon">
              <i class="material-icons fa fa-users"></i>
            </div>
            <p class="card-category">Total Users</p>
            <h3 class="card-title" id="totUsers">
            </h3>
          </div>
          <div class="card-footer">
            <div class="stats">
              <i class="material-icons text-warning">person</i>
              <a href="#pablo" class="warning-link">Total Users</a>
            </div>
          </div>
        </div>
      </div>
      <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6">
        <div class="card card-stats">
          <div class="card-header card-header-success card-header-icon">
            <div class="card-icon">
              <i class="material-icons fa fa-user-circle-o"></i>
            </div>
            <p class="card-category">Total Payment</p>
            <h3 class="card-title" id="totPayment"></h3>
          </div>
          <div class="card-footer">
            <div class="stats">
              <i class="material-icons">date_range</i> Total Payment
            </div>
          </div>
        </div>
      </div>
      <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6">
        <div class="card card-stats">
          <div class="card-header card-header-danger card-header-icon">
            <div class="card-icon">
              <i class="material-icons fa fa-comment"></i>
            </div>
            <p class="card-category">Total Feedback</p>
            <h3 class="card-title" id="totFeedback"></h3>
          </div>
          <div class="card-footer">
            <div class="stats">
              <i class="material-icons">local_offer</i> Total feedback
            </div>
          </div>
        </div>
      </div>
      <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6">
        <div class="card card-stats">
          <div class="card-header card-header-info card-header-icon">
            <div class="card-icon">
              <i class="fa fa-bell"></i>
            </div>
            <p class="card-category">Total Notification</p>
            <h3 class="card-title" id="totNoti"></h3>
          </div>
          <div class="card-footer">
            <div class="stats">
              <i class="material-icons">update</i>  Total notifications
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>
</div>
<!-- 
<div class="modal fade" id="assignStudentsInd" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Assign Students</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
     
      </div>
      <div class="modal-body text-primary table-responsive" id="grabIndStudents">
        
      </div>
      <div class="modal-footer">
           <hr class="invisible">
        <div id="eor"></div>
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
 -->
<?php
  require APPROOT . '/includes/adminfooter.php';
 ?>
 <script>
     $(document).ready(function(){
      $('#ToggleBtn').click(function(){
        $('#studentUnderSupervisor').toggle();
      })
      $('#ToggleBtn2').click(function(){
        $('#indSupervisors').toggle();
      })

       
     fetchLoggedInAdmins();

         function fetchLoggedInAdmins(){
             action = 'fetch_super';
             $.ajax({
                 url:'scripts/initate.php',
                 method:'post',
                 data:{action:action},
                 success:function(response){
                   console.log(response);

                     $('#loggedInAdmin').html(response);
                 }
             });
         }
         setTimeout(function () {
             fetchLoggedInAdmins();
         },1000);



         $('#search').click(function(e){
            e.preventDefault();
            $.ajax({
              url:'scripts/admin-process.php',
              method:'POST',
              data:$('#viewLogbookForm').serialize()+'&action=searchLogbook',
              beforeSend:function(){
                $('#search').html('Searching...');
              },
              success:function(data){
                // console.log(data);
                $('#err').html(data);
              },
              complete:function(){
                $('#search').html('Search');
              }
            })  
           
         })















     });
 </script>
 <script type="text/javascript" src="scripts.js"></script>
 <script type="text/javascript" src="activity.js"></script>
 <script type="text/javascript" src="notify.js"></script>
