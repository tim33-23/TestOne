<?php

require_once '../dao/Dao.php';

session_start();
$DB = new Dao();

try{
    $tickets=$DB->searchTicket($_GET['ticketId'], $_SESSION['email']);
    $ticket = null;
    foreach ($tickets as $t){
        $ticket = $t;
    }
}
catch (Exception $ex){
    echo $ex->getMessage();
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.82.0">
    <title>Signin Template · Bootstrap v5.0</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">


    <!-- Bootstrap core CSS -->
    <link href="../assets/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }
    </style>


    <!-- Custom styles for this template -->
    <link href="css/signin.css" rel="stylesheet">
</head>
<body style="padding-left: 35%">

<main style="text-align: center;">
    <form method="get" action="../index.php">
        <img src="../img/<?php echo ($_SESSION['email'].'/'.$ticket['img']); ?> " alt="" width="550">
        <h1 class="h3 mb-3 fw-normal">Информация по тикету</h1>
        <div class="form-floating">
            <p><?php echo $ticket['subject']?></p>
            <p><?php echo $ticket['description']?></p>
        </div>
        <button class="w-100 btn btn-lg btn-primary" type="submit">Вернутся</button>
        <p class="mt-5 mb-3 text-muted">&copy; 2017–2021</p>
    </form>
</main>



</body>
</html>

