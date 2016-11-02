<?php
include("db_conn.php");
include("ehgizly_service.php");
$rawPostData = file_get_contents('php://input');
$obj = json_decode($rawPostData);
$var = '{"PageSize": 5, "PageNumber": ' . $obj->PageNumber . ', '
        . '"OrderBy": "EventStartDate"}';
$response = \Httpful\Request
        ::post("http://e7gezly.cloudapp.net/api/event/GetAllEvents")
        ->body($var)->addHeaders(array(
            'Content-Type' => 'application/json',
            'appToken' => getAppToken(),))->send();
$array = array();
for ($i = 0; $i < sizeof($response->body) ; $i++) {
    $categories = [];
    $links = [];
    $event = new stdClass();
    $event->id = "{$response->body[$i]->EventId}";
    $event->title = "{$response->body[$i]->EventTitle}";
    $event->description = "{$response->body[$i]->EventDescreption}";
    $event->phone = "{$response->body[$i]->EventPhoneNumber}";
    $event->longitude = "{$response->body[$i]->Eventlongtiude}";
    $event->latitude = "{$response->body[$i]->EventLatitude}";
    $event->startdate = "{$response->body[$i]->EventStartDate}";
    $event->enddate = "{$response->body[$i]->EventEndDate}";
    $event->eventLocation = "{$response->body[$i]->EventLocation}";
    $event->mainPhotoUrl = "{$response->body[$i]->EventImageUrl}";
    $event->siteUrl = "{$response->body[$i]->SiteUrl}";
    $event->facebookLink = "{$response->body[$i]->OtherLinks[0]}";
    $event->twitterLink = "{$response->body[$i]->OtherLinks[1]}";
    $event->instagramLink = "{$response->body[$i]->OtherLinks[2]}";
    if (sizeof($response->body[$i]->EventCategory) != 0) {
        $event->isFree = false;
    }
    else {
        $event->isFree = true;
    }
    // $event->PageSize = 5;
    // $event->PageNumber = $obj->PageNumber;
    // $event->OrderBy = "EventTitle";
    for ($j = 0; $j < sizeof($response->body[$i]->EventCategory); $j++) { 
        $category = new stdClass();
        $category->id = "{$response->body[$i]->EventCategory[$j]->CategoryId}";
        $category->name = "{$response->body[$i]->EventCategory[$j]->CategoryName}";
        $category->price = $response->body[$i]->EventCategory[$j]->CategoryPrice;
        $category->numberOfTickets = $response->body[$i]->EventCategory[$j]->NumberOfTickets;
        $categories[$j]= $category;
    }
    $event->categories = $categories;
    $array[$i] = $event;
}
echo json_encode($array);
?>	
