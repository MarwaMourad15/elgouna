<?php
$Ticket = new stdClass();
$Ticket->id = "c24eb42f-1c7b-4c09-b312-dcc4fdfd3707";
$Order = new stdClass();
$Order->referenceCode = "123456";
$Ticket->Order =$Order;
echo json_encode($Ticket);
//include("errorsCodes.php");
?>