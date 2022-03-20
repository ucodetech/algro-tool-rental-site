
fetch_totNotification();

setInterval(function(){
   fetch_totNotification();
}, 5000);

function fetch_totNotification()
{
    var action = 'totNotification';
    $.ajax({
       url:"script/inits.php",
       method:"POST",
       data:{action:action},
       success:function(data)
       {
         $('#totNoti').html(data);

       }

    });
}
