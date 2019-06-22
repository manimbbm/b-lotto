<?php

$nLines = $_POST["n_lines"];
$ticketId = $_POST["ticket_id"];

$numbersPerLine = 3;

function new_ticket($nLines, $numbersPerLine){
    if(file_exists("tickets.json")){
        $ticketsJSON = file_get_contents('tickets.json');
    }else{
        $ticketsJSON = fopen('tickets.json', 'w');
    }
    $tickets = json_decode($ticketsJSON, true);

    $newTicket = array(
        "id"        => sizeof($tickets),
        "n_lines"   => $nLines,
        "lines"     => array(),
    );

    for($i = 0; $i < $nLines; $i++){
        $line = "";
        for($j = 0; $j < $numbersPerLine; $j++){
            $rand_n = mt_rand(0, 2);
            $line .= $rand_n;
        }    
        $newLine = $line;
        array_push($newTicket["lines"], $newLine);
        // print_r($newTicket);
    }

    $tickets[] = $newTicket;
    file_put_contents('tickets.json', json_encode($tickets, JSON_PRETTY_PRINT));

}

new_ticket($nLines, $numbersPerLine);

header("refresh: .1; url= index.php"); 

?>


