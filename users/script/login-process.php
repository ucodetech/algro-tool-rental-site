<?php
require_once '../../core/init.php';

$user = new User();
$validate = new Validate();
$show = new Show();

if (isset($_POST['action']) && $_POST['action'] == 'loginUser') {
    
    $email = $show->test_input($_POST['user_email']);
    $password = $show->test_input($_POST['password']);

    if (empty($_POST['user_email'])) {
        echo $show->showMessage('danger','Email is required', 'warning');
        return false;
    }
    if (empty($_POST['password'])) {
        echo $show->showMessage('danger','Password is required', 'warning');
        return false;
    }


    $login = $user->login($email, $password);
    if ($login) {
        echo 'success';
    }


}
