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
.imgTool{
  width: 70px;
  height: 70px;
  border-radius: 50%;
}
</style>
<div class="content">
  <div class="container-fluid">
    <h3 class="text-center text-info">Inventory</h3>
    <div class="row">
      <!-- table -->
      <div class="col-lg-12 col-md-12">
        <div class="row">
          <div class="col-lg-8">
          <div class="card">
          <div class="card-header card-header-primary">
            <h4 class="card-title">Total Tools Avaliable</h4>
            <p class="card-category">List of available tools</p>
          </div>
          <div class="card-body table-responsive"  id="tools">

          </div>
        </div>
        </div>
        <div class="col-lg-4">
          <?php include 'superForm.php'; ?>
        </div>
        </div>
      </div>
      <hr class="hr2">
      <!-- table -->
      <div class="col-lg-12 col-md-12">
        <div class="card">
          <div class="card-header card-header-primary">
            <h4 class="card-title">Total Tools Not Avaliable</h4>
            <p class="card-category">List of tools not available</p>
          </div>
          <div class="card-body table-responsive"  id="natools">

          </div>
        </div>
      </div>
      <hr class="hr2">
       <div class="col-lg-12 col-md-12">
        <div class="card">
          <div class="card-header card-header-warning">
            <h4 class="card-title">Transactions</h4>
            <p class="card-category">List of transactions paid and unpaid</p>
          </div>
          <div class="card-body table-responsive"  id="paidT">

          </div>
        </div>
      </div>
      <hr class="hr2">
       <div class="col-lg-12 col-md-12">
        <div class="card">
          <div class="card-header card-header-info">
            <h4 class="card-title">Tools not Delivered</h4>
            <p class="card-category">List of tools rented but not delivered</p>
          </div>
          <div class="card-body table-responsive"  id="toolsNotDe">

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
  function readURL(input){

  if (input.files && input.files[0]) {
     var reader = new FileReader();
    reader.onload = function(e){
      $('#showError').html('<img src="'+e.target.result+'" alt="item pic" class="imgTo" width="208">');
    }
    reader.readAsDataURL(input.files[0]);
  }
}
  $(document).ready(function(){
      var gifPath = '../gif/tra.gif';

$('#tool_img').change(function(){
    readURL(this);
  });

    // fetch bboks
    fetch_tools();

    function fetch_tools(){
      action = 'fetch_tool';
      $.ajax({
        url:'scripts/inventory-process.php',
        method:'post',
        data:{action:action},
        success:function(response){
          console.log(response);
        $('#tools').html(response);
        $('#showTools').DataTable({
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



     // fetch bboks
    fetch_toolsnot();

    function fetch_toolsnot(){
      action = 'fetch_toolnota';
      $.ajax({
        url:'scripts/inventory-process.php',
        method:'post',
        data:{action:action},
        success:function(response){
          console.log(response);
        $('#natools').html(response);
        $('#showToolsnot').DataTable({
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



     // fetch bboks
    fetch_paidTran();

    function fetch_paidTran(){
      action = 'paidTransactions';
      $.ajax({
        url:'scripts/inventory-process.php',
        method:'post',
        data:{action:action},
        success:function(response){
        $('#paidT').html(response);
        $('#showPaidT').DataTable({
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



     // fetch bboks
    fetch_delivery_status();

    function fetch_delivery_status(){
      action = 'fetch_delivery_statu';
      $.ajax({
        url:'scripts/inventory-process.php',
        method:'post',
        data:{action:action},
        success:function(response){
        $('#toolsNotDe').html(response);
        $('#showtoolsNotDe').DataTable({
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




  $(document).on('click', '.returned', function(e){
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

$('#addToolform').submit(function(e){
    e.preventDefault();
  $.ajax({
        url: "scripts/inventory-process.php",
        method: "post",
        processData: false,
        contentType: false,
        cache: false,
        // data: {file: $("#profile_file").val()},
        data: new FormData(this),
        beforeSend:function(){
          $('#saveBtn').html('Upload...');
        },
        success: function(response) {
          // console.log(response);
          if($.trim(response)==="success") {
            $('#addToolform')[0].reset();
              $('#showError').html('<span class="text-success">Tool Uploaded Successfully!</span>');
              fetch_tools();
          }else{
            $('#showError').html(response);
          }
       }


  });

  })

 // delete note
    $("body").on("click", ".delivered", function(e){
        e.preventDefault();
        d_id = $(this).attr('id');
        Swal.fire({
            title: 'Are you sure?',
            text: "You can not revert this action!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, go on!'
          }).then((result) => {
            if (result.value) {
              $.ajax({
                url: 'scripts/inventory-process.php',
                method: 'POST',
                data: {d_id: d_id},
                success:function(response){
                  Swal.fire(
                    'Tool Delivered!',
                    'Tool Delivered Successfully',
                    'success'
                  );
                  fetch_delivery_status();
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