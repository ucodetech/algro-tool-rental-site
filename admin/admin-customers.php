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

</style>
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <!-- table -->
      <div class="col-lg-12 col-md-12">
        <div class="card">
          <div class="card-header card-header-primary">
            <h4 class="card-title">Customers</h4>
            <p class="card-category">List of Customers</p>
          </div>
          <div class="card-body table-responsive"  id="customers">

          </div>
        </div>
      </div>
      
    </div>
  </div>
</div>



<?php
  require APPROOT . '/includes/adminfooter.php';
 ?>
<script type="text/javascript">
  $(document).ready(function(){
      var gifPath = '../gif/tra.gif';

    // fetch bboks
    fetch_customers();

    function fetch_customers(){
      action = 'fetch_Custom';
      $.ajax({
        url:'scripts/customer-process.php',
        method:'post',
        data:{action:action},
        success:function(response){
        $('#customers').html(response);
        $('#showCustomer').DataTable({
           "paging": true,
              "lengthChange": false,
              "searching": true,
              "ordering": true,
              "order": [0,'desc'],
              "info": true,
              "autoWidth": false,
              "responsive": true,
               "lengthMenu": [[10,10, 25, 50, -1], [10, 25, 50, "All"]]
          });

        }
      })
    }


  $(document).on('click', '.CustomerDetailsIcon', function(e){
      e.preventDefault();
      customer_id =  $(this).attr('id');
      $.ajax({
        url:'scripts/customer-process.php',
        method:'post',
        data: {customer_id : customer_id},
        success:function(response){
          $('#showCustomerDetail').html(response);
        }
      });
    });


 // delete note
    $("body").on("click", ".deleteCustomerIcon", function(e){
        e.preventDefault();
        delstudent_id = $(this).attr('id');
        Swal.fire({
            title: 'Are you sure?',
            text: "You can view the student in trash and restore or delete permenatly!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, Move it!'
          }).then((result) => {
            if (result.value) {
              $.ajax({
                url: 'scripts/student-process.php',
                method: 'POST',
                data: {delstudent_id: delstudent_id},
                success:function(response){
                  Swal.fire(
                    'Customer Recored Trashed!',
                    'Customer Recored Sent to Trash Can! <a href="admin-trash">Trash Can</a>',
                    'success'
                  );
                  fetch_customers();
                }
              });

            }
          });

    });







  });
</script>
<script type="text/javascript" src="scripts.js"></script>
<script type="text/javascript" src="activity.js"></script>
<script type="text/javascript" src="notify.js"></script>