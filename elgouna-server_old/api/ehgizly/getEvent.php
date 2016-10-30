<?php

$event_id = $_GET['eventId'];
include("db_conn.php");
include ("ehgizly_service.php");
$rawPostData = file_get_contents('php://input');
$obj = json_decode($rawPostData);
$var = '{"eventId": "' . $obj->eventId . '"}';
$response = \Httpful\Request
        ::post("http://e7gezly.cloudapp.net/api/event/GetEventDetails/")
        ->body($var)->addHeaders(array(
            'Content-Type' => 'application/json',
            'appToken' => getAppToken(),))->send();
$categories = [];
$event = new stdClass();
for ($i = 0; $i < sizeof($response->body->event_category); $i++) { 
    $category = new stdClass();
    $category->eventCategory = $response->body->event_category[$i]->Event_Category1;
    $category->numberOfTickets = $response->body->event_category[$i]->NumberOfTickets;
    $category->name = "category1";
    $category->price = 550.0;
    $categories[$i]= $category;
}
$event->category = $categories; 
$event->id = "{$response->body->EventId}";
$event->title = "{$response->body->EventTitle}";
$event->description = "{$response->body->EventDescreption}";
$event->phone = "{$response->body->EventPhoneNumber}";
$event->longtiude = "{$response->body->Eventlongtiude}";
$event->latitiude = "{$response->body->EventLatitude}";
$event->startdate = "{$response->body->EventStartDate}";			
$event->enddate = "{$response->body->EventEndDate}";
$event->eventLocation = "{$response->body->EventLocation}";
$event->venueVenueId = "{$response->body->Venue_VenueId}";
$event->eventTypeEventTypeId = "{$response->body->EventType_EventTypeId}";
$event->consumerConsumerId = "{$response->body->Consumer_ConsumerId}";
$event->mainPhotoUrl = "{$response->body->EventImageUrl}";
$event->siteUrl = "{$response->body->SiteUrl}";
$event->isFree = false;
echo json_encode($event);

?>