$(document).ready(function(){
  //FEtch notification



  setInterval(function(){
    fetchNotifaction();
  }, 1000);

  fetchNotifaction();

  function fetchNotifaction(){
    $.ajax({
      url: 'scripts/inits.php',
      method: 'post',
      data: {action: 'fetchNotifaction'},
      success:function(response){
        $('#showNotification').html(response);
      }
    });
  }


  //CHECK NOTIFACATION
  checkNotifacations();

  // setInterval(function(){
  //     checkNotifacations();
  // }, 1000);
    function checkNotifacations(){
      $.ajax({
        url: 'scripts/inits.php',
        method: 'post',
        data: {action: 'getNotify'},
        success:function(response){
          // console.log(response);
          $('#getNotifys').html(response);
        }
      });
    }

 checkNotifacationsTitle();

  // setInterval(function(){
  //     checkNotifacations();
  // }, 1000);
    function checkNotifacationsTitle(){
      $.ajax({
        url: 'scripts/inits.php',
        method: 'post',
        data: {action: 'getNotifTitle'},
        success:function(response){
          // console.log(response);
          $('#getNotifyTitle').html(response);
        }
      });
    }





  // remove notifiaction
  $('body').on('click', '.read', function(e){
    e.preventDefault();

    notifacation_id = $(this).attr('id');
    $.ajax({
      url: 'scripts/inits.php',
      method: 'post',
      data: {notifacation_id: notifacation_id},
      success:function(response){
        // checkNotifacations();
          fetchNotifaction();

      }
    });
  })



});
