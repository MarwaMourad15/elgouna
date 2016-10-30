<?php 
$weather= file_get_contents('http://api.worldweatheronline.com/free/v2/weather.ashx?q=El%20Gouna&format=json&num_of_days=5&key=3a1ac9278f03f70d65739d22f8777');
$weather=json_decode($weather);
//print_r($weather);
$json=$weather->data->current_condition;
$rr=0;
foreach($weather->data->current_condition as $s=>$x){
echo $x->cloudcover.'<br>';
echo $x->FeelsLikeC.'<br>';
echo $x->humidity.'<br>';
echo $x->pressure.'<br>';
echo $x->temp_C.'<br>';
	foreach($x->weatherDesc as $d=>$o){

echo $o->value.'<br>';
break;
}

}
foreach($weather->data->weather as $k=>$v){
	$rr++;
	if($rr==1){
	foreach($v->astronomy as $h=>$i){
echo $i->sunrise.'<br>';
echo $i->sunset.'<br>';
	echo "-------------------------------------------------------------------------------------------------------------------";
break;
	}
	foreach($v->hourly as $m=>$n){ 
echo $n->winddir16Point.'<br>';
echo $n->windspeedKmph.'<br>';
echo $n->chanceofrain.'<br>';
echo $n->chanceofsnow.'<br>';
	echo "-------------------------------------------------------------------------------------------------------------------<br />";
break;
}
}else{
echo $v->maxtempC.'<br>';

	foreach($v->hourly as $m=>$n){ 
	foreach($n->weatherDesc as $d=>$o){

echo $o->value.'<br>';
break;
}
	echo "-------------------------------------------------------------------------------------------------------------------<br />";
break;
}

}
}

?>