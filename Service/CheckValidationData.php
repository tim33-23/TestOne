<?php
require_once ("../Exceptions/ValidationException.php");
require_once ("../dto/User.php");
require_once ("../dto/Ticket.php");


class CheckValidationData
{
    function checkPassword($firstPassword, $secondPassword, $email){
        $newUser = null;
        if($firstPassword===$secondPassword){
            $newUser = new User();
            $newUser->setEmail($email);
            $newUser->setPassword($firstPassword);
        }
        if($newUser==null)
            throw new ValidationException("Пароли не совпадают!");
        return $newUser;
    }

    function checkTicket($subject, $description){
        $newTicket = null;
        if($subject!=='' && $description!==''){
            $newTicket = new Ticket();
            $newTicket->setSubject($subject);
            $newTicket->setDescription($description);
        }
        else {
            throw new ValidationException("Проверьте правельность введенных данных.");
        }
        if($newTicket==null)
            throw new ValidationException("Проверьте правельность введенных данных");
        $imgName = basename(basename($_FILES['img']['name']));
        if(is_uploaded_file($_FILES['img']['tmp_name'])){
            move_uploaded_file($_FILES['img']['tmp_name'], '../img/'.$_SESSION['email'].basename($_FILES['img']['name']));
        }
        $newTicket->setImg($imgName);
        return $newTicket;
    }

}