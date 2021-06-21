<?php
require_once ("..\dao\Dao.php");
require_once ("..\dto\User.php");
require_once ("..\Service\CheckValidationData.php");
require_once ("..\Exceptions\InsertException.php");
require_once ("..\Exceptions\ValidationException.php");

session_start();
$DB = new Dao();
$validation = new CheckValidationData();

try{
    $newTicket = $validation->checkTicket($_POST["subject"], $_POST["description"]);
    $DB->AddTicket($newTicket, $_SESSION['email']);
    header("Location: ../index.php");
 }
catch (Exception $ex){
    echo $ex->getMessage();
}
