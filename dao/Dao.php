<?php

class Dao
{
    public $dbh;


    public function __construct()
    {
        try {
            $this->dbh = new PDO('mysql:host=localhost;dbname=systemticket;charset=utf8', 'mysql', 'mysql');
        } catch (PDOException $e) {
            print "Has errors: " . $e->getMessage(); die();
        }
    }


    public function UserRegistration(User $user){
        if($this->CheckUser($user)){
            throw new InsertException('Пользователь с таким email уже существует!');
        }
        $sql = "INSERT INTO `users` (`email`, `password`) VALUES (?, ?)";
        $stmt = $this->dbh->prepare($sql);
        $stmt->execute([
            $user->getEmail(),
            md5($user->getPassword())
        ]);
        $this->SaveSessionBD($user);
        $_SESSION['email'] = $user->getEmail();
        mkdir("../img/".$_SESSION['email'], 0700);
    }

    public function LoginUser(User $user){
        if($this->CheckUserAndPassword($user)){
            $this->SaveSessionBD($user);
            $_SESSION['email'] = $user->getEmail();
            return true;
        }
        return false;
    }



    public function CheckUser(User $user){
        $sql = "SELECT * FROM users WHERE `email`=?";
        $stmt = $this->dbh->prepare($sql);
        $stmt->execute([
                $user->getEmail()
            ]);
        $count = count($stmt->fetchAll(PDO::FETCH_OBJ));
        if($count==0){
            return false;
        }
        return  true;
    }



    public function CheckUserAndPassword(User $user){
        $sql = "SELECT * FROM users WHERE `email`=? and `password`=?";
        $stmt = $this->dbh->prepare($sql);
        $stmt->execute([
            $user->getEmail(),
            md5($user->getPassword())
        ]);
        $count = count($stmt->fetchAll(PDO::FETCH_OBJ));
        if($count==0){
            return false;
        }
        return true;
    }


    public function SaveSessionBD(User $user){
        $sql = "UPDATE `users` SET `session_id`=?, `session_time`=? WHERE `email`=?";
        $stmt = $this->dbh->prepare($sql);
        $stmt->execute([
            htmlspecialchars(session_id()),
            date("Y-m-d H:i:s"),
            $user->getEmail()
        ]);

    }

    public function CheckSession(User $user){
        $sql = "SELECT * FROM users WHERE `email`=?";
        $stmt = $this->dbh->prepare($sql);
        $stmt->execute([
            $user->getEmail()
        ]);
        foreach ($stmt as $returnedUser){
            $diffHours = date_diff(new DateTime(date('Y-m-d H:i:s')), new DateTime($returnedUser['session_time']))->h;
            if($diffHours<10 && $returnedUser['session_id'] == $user->getSessionId()){
                return  true;
            }
        }
        return false;
    }

    public function AddTicket(Ticket $ticket, $email){
        $sql = "SELECT user_id FROM users WHERE `email`=?";
        $stmt = $this->dbh->prepare($sql);
        $stmt->execute([
            $email
        ]);
        $user_id = null;
        foreach ($stmt as $returnedUser){
            $user_id = $returnedUser['user_id'];
        }
        $sql = "INSERT INTO `tickets` (`subject`, `description`, `img`, user_id) VALUES (?, ?, ?, ?)";
        $stmt = $this->dbh->prepare($sql);
        $stmt->execute([
            $ticket->getSubject(),
            $ticket->getDescription(),
            $ticket->getImg(),
            $user_id
        ]);
    }

    public function searchTicket($tickedId, $email){
        $sql = "SELECT user_id FROM users WHERE `email`=?";
        $stmt = $this->dbh->prepare($sql);
        $stmt->execute([
            $email
        ]);
        $user_id = null;
        foreach ($stmt as $returnedUser){
            $user_id = $returnedUser['user_id'];
        }
        $sql = "SELECT * FROM tickets WHERE `id`=? AND `user_id`=?";
        $stmt = $this->dbh->prepare($sql);
        $stmt->execute([
            $tickedId,
            $user_id
        ]);
        return $stmt;
    }

    public function receiveTicket($email){
        $sql = "SELECT user_id FROM users WHERE `email`=?";
        $stmt = $this->dbh->prepare($sql);
        $stmt->execute([
            $email
        ]);
        $user_id = null;
        foreach ($stmt as $returnedUser){
            $user_id = $returnedUser['user_id'];
        }
        $sql = "SELECT * FROM tickets WHERE `user_id`=?";
        $stmt = $this->dbh->prepare($sql);
        $stmt->execute([
            $user_id
        ]);
        return $stmt;
    }

}