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
    $newUser = $validation->checkPassword($_POST["floatingPassword"], $_POST["repeatPassword"], $_POST["email"]);
    $DB->UserRegistration($newUser);

}
catch (Exception $ex){
    echo $ex->getMessage();
}
