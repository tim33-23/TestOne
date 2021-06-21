<?php


class viewTicketsController
{

private $DB;

    public function __construct(){
    $this->DB = new Dao();
    }


public function viewAllTickets(){
    $result="";
    try{
        $tickets = $this->DB->receiveTicket($_SESSION['email']);
        foreach ($tickets as $ticket){
            $result.$this->viewTicket($ticket['img'], $ticket['subject'], $ticket['description'], $ticket['id']);
        }
    }
    catch (Exception $ex){
        echo $ex->getMessage();
    }
}


public function viewTicket($urlImg, $subject, $description, $ticketId)
   {
       session_start();
       echo '
               <div class="col">
                   <div class="card shadow-sm">
                       <svg class="bd-placeholder-img card-img-top" width="100%" height="225" xmlns="http://www.w3.org/2000/svg" role="img"
                            aria-label="Placeholder: Thumbnail" preserveAspectRatio="xMidYMid slice" focusable="false">
                           <title>Placeholder</title>
                           <image href="img/'.$_SESSION['email']."/".$urlImg.'" width="100%" height="100%"></image>
                   </svg>
                       <div class="card-body">
                       <p class="card-text"><strong>'.$subject.'</strong></p>
                           <p class="card-text">'.$description.'</p>
                           <div class="d-flex justify-content-between align-items-center">
                               <div class="btn-group">
                                   <button type="button" onclick="location.href = \'templates/viewTicket.php?ticketId='.$ticketId.'\';" class="btn btn-sm btn-outline-secondary">View</button>
                                   <button type="button" class="btn btn-sm btn-outline-secondary">Edit</button>
                               </div>
                               <small class="text-muted">'.$ticketId.'</small>
                           </div>
                       </div>
                   </div>
               </div>';
   }


}



?>


