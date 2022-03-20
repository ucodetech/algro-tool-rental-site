<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="utf-8" />
<link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
<link rel="icon" type="image/png" href="../assets/img/favicon.png">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
<?php
$title = basename($_SERVER['PHP_SELF'], '.php');
$title = explode('-', $title);
$title = ucfirst($title[1]);

$user = new User();

$users = 'user';
?>
<title><?php echo $title; ?>-<?php echo SITENAME; ?></title>
<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
<!--     Fonts and icons     -->
<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
<!-- CSS Files -->
<link href="<?=URLROOT?>assets/css/material-dashboard.css?v=2.1.0" rel="stylesheet" />
<!-- CSS Just for demo purpose, don't include it in your project -->
<link href="<?=URLROOT?>assets/demo/demo.css" rel="stylesheet" />
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Fredoka+One&display=swap" rel="stylesheet">
<link rel="stylesheet" href="<?=URLROOT?>assets/master.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/wrick17/calendar-plugin@master/style.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/wrick17/calendar-plugin@master/theme.css">

</head>
<style>
  .userProfile{
    width: 100px !important;
    height: 100px !important;
    border-radius: 50px;
    border: 2px double #9623ad;
  }

</style>
<body class="dark-edition">
<div class="wrapper ">
<div class="sidebar" data-color="purple" data-background-color="black" data-image="<?=URLROOT?>assets/img/sidebar-2.jpg">
  <!--
    Tip 1: You can change the color of the sidebar using: data-color="purple | azure | green | orange | danger"

    Tip 2: you can also add an image using data-image tag
-->
  <div class="logo"><a href="<?=URLROOT?>" class="simple-text logo-normal">
    <img src="<?=URLROOT?>users/profile/<?=$user->data()->passport;?>" class="img img-fluid userProfile" alt="<?=$user->data()->user_fullname?>">
    </a>
    <span class="simple-text logo-normal"><?=$user->data()->user_fullname?></span>
    <hr>
   <h4 class="text-center"> <a href="logout" class="text-danger text-center">Logout</a></h4>
  </div>
  <div class="sidebar-wrapper">
    <ul class="nav">
      <li class="nav-item active  ">
        <a class="nav-link" href="<?=$users?>-dashboard">
          <i class="material-icons">dashboard</i>
          <p>Dashboard</p>
        </a>
      </li>
      <li class="nav-item ">
        <a class="nav-link" href="<?=$users?>-profile">
          <i class="material-icons">person</i>
          <p>User Profile</p>
        </a>
      </li>
      <li class="nav-item ">
        <a class="nav-link" href="<?=$users?>-notifications">
          <i class="material-icons">notifications</i>
          <p>Notifications</p>
        </a>
      </li>
      <li class="nav-item ">
        <a class="nav-link" href="<?=$users?>-settings">
          <i class="material-icons fa fa-gear"></i>
          <p>Settings</p>
        </a>
      </li>
    </ul>
  </div>
</div>
<div class="main-panel">
