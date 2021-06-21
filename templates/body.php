<?php

require_once 'controller/viewTicketsController.php';


$DBUser = new Dao();
$user = new User();
if (isset($_SESSION['email'])) {
    $user->setEmail($_SESSION['email']);
    $user->setSessionId(session_id());
    $user->setSessionTime(date('Y-m-d H:i:s'));
}
$auto = false;
if ($DBUser->CheckSession($user) && isset($_SESSION['email'])) {
    $auto=true;
}

if($auto){
    require 'mainAuto.php';

}
else{
    require 'main_no_auto.php';
}


