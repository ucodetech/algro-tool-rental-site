<?php
  require_once '../core/init.php';
  if (!isLoggedInUser()) {
      Session::flash('warning', 'You must login to access that page');
     Redirect::to('user-login');
    }

    $user = new User();
    $uniqueid = $user->data()->user_unique_id;

  if (verifyCheck()) {
    Session::flash('emailVerify', 'Please verify your email address!', 'warning');
    Redirect::to('user-verify');
  }elseif(isOTPsetUser($uniqueid)){
      Redirect::to('user-otp');
    }
 
   
  require APPROOT . '/includes/sthead.php';
  require APPROOT . '/includes/stnav.php';


  $tool = new Tools();
  $show = new Show();
  $db = Database::getInstance();
  
  $rente = $tool->getRented($uniqueid);

 ?>
<style media="screen">
.activeImg{
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
.name, .duration{
    display: inline;
    font-size: 2em;
    padding: 3px;
    margin: 2px;
}
.imgT{
    border-radius: 20px;
    border: 2px double #84359a;
}
</style>
<div class="content">
  <div class="container-fluid">
   <h2 class="text-center text-info">Tool Rented</h2>
   <hr>
   <?php if ($rente===false): ?>
    <h2 class="text-center text-primary">The Tool you Rented will appear here, once its been delivered to you!
    </h2>
       <?php else: ?>
<?php foreach ($rente as $rented): ?>
       <div class="row">
       <div class="col-md-6 shadow-lg">
          <span class="text-center text-info name"><?=$rented->item_name?></span><br>
          <img src="<?=URLROOT?>uploads/farmtools/<?=$rented->item_img?>" alt="<?=$rented->item_name?>" width="406" class="img-fluid img-rounded border-4 imgT">
       </div>
       <div class="col-md-6">
              <div class="col-md-12 shadow-lg">
                <h3 class="name text-info">Duration</h3><br>
                <span class="duration text-warning">
                   <?
                   if($rented->item_duration == '1'){
                    echo 'One Week';
                   }elseif($rented->item_duration == '2'){
                     echo 'Two Weeks';
                   }elseif($rented->item_duration == '3'){
                         echo 'Three Weeks';
                   }elseif($rented->item_duration == '4'){
                     echo 'One Month';
                   }
                   ?>
                </span><br><hr>
                    <span class="duration text-warning">
                    Price: <?=money($rented->item_price)?>
                </span>
              </div><hr>
              
      </div>
       
   </div>
   <?php endforeach ?>
 <?php endif ?>

<hr>

<hr>
   <div class="row">
       <div class="col-md-12">
   <main>
      <div class="calendar-wrapper" id="calendar-wrapper"></div>
      <div id="editor"></div>
    </main>
    <div id="content"></div>
     </div>
   </div>
  </div>
</div>

<?php
  require APPROOT . '/includes/stfooter.php';
 ?>

 <script>
 function getURL(input){

    if (input.files && input.files[0]) {
       var reader = new FileReader();
      reader.onload = function(e){
        $('#showErrorUpload').html('<img src="'+e.target.result+'" alt="preview" class="img-fluid sketchPreview">');
      }
      reader.readAsDataURL(input.files[0]);
    }
  }
     $(document).ready(function(){


$('#uploadSketchesFile').change(function(){
    getURL(this);
  });


         $('#uploadSketchesForm').submit(function (e){
             e.preventDefault();
             $.ajax({
                 url:'script/uploadDraw-process.php',
                 method:'post',
                 processData: false,
                 contentType:false,
                 cache:false,
                 data: new FormData(this),
                 success:function (response){
                     if (response==='success'){
                         $('#uploadSketchesForm')[0].reset();
                         alert('Success');
                         location.reload();
                     }else{
                         alert(response);
                     }
                 }
             })
         });

         //fetch logs
         fetch_log();
         function fetch_log(){
             action = 'fetchLogs';
             $.ajax({
                 url:'script/log-process.php',
                 method:'post',
                 data:{action:action},
                 success:function (response){
                     console.log(response);
                     $('#showLogEntry').html(response);
                    
                 }
             });
         }

     $('#saveLogBtn').click(function(e){
         e.preventDefault();
         Swal.fire({
             title: 'Are you sure?',
             text: "You are about to save this activity! there won\'t be room for editing!",
             type: 'warning',
             showCancelButton: true,
             confirmButtonColor: '#3085d6',
             cancelButtonColor: '#d33',
             confirmButtonText: 'Yes, Save it!'
         }).then((result) => {
             if (result.value) {
                 $.ajax({
                     url:'script/log-process.php',
                     method: 'POST',
                     data:$('#fillLogBook').serialize()+'&action=addActivity',
                     success:function(response){
                        if (response==='success') {
                            $('#fillLogBook')[0].reset();
                            Swal.fire(
                             'Today\'s Activity have been saved',
                             'Activity Saved Successfully',
                             'success'
                         );
                         fetch_log();
                        }else{
                            $('#showLogError').html(response);
                        }
                         
                     }
                 });

             }
         });
     })


   

         // // add supervisor
         // $('#saveLogBtn').click(function(e){
         //   e.preventDefault();
         //   $.ajax({
         //     url:'script/log-process.php',
         //     method:'post',
         //     data:$('#fillLogBook').serialize()+'&action=addActivity',
         //     beforeSend:function(){
         //       $('#saveBtn').html('Saving...');
         //     },
         //     success:function(response){
         //       if (response==='success') {
         //           $('#fillLogBook')[0].reset();
         //           $('#showError').html('<div id="" class="alert alert-success alert-dismissible"> <button type="button" class="close" data-dismiss="alert"> &times;</button><i class="fa fa-check"></i>&nbsp; <span>Your form have been submitted successfully</span></div>');
         //          setTimeout(function(){
         //            location.reload();
         //         },3000);
         //       }else{
         //         $('#showError').html(response);
         //         // setTimeout(function(){
         //         //     $('#showError').html('');
         //         // },10000);

         //       }
         //     },
         //     complete:function(){
         //       $('#saveBtn').html('SAVE');
         //     }
         //   })
         // });

     });
 </script>
 <!-- <script type="text/javascript" src="activity.js"></script> -->
 <script type="text/javascript" src="notify.js"></script>
