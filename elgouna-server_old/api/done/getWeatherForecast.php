<?php 

include("db_conn.php");
date_default_timezone_set('Africa/Cairo');
$currentDate = date("Y-m-d H:i:s");
$json = array();
$sql = "select date,"
        . "id "
        . "from weather "
        . "order by id desc "
        . "limit 1";
$r = mysql_query($sql);
$row = mysql_fetch_array($r);
$timeFirst  = strtotime($row['date']);
$timeSecond = strtotime($currentDate);
$differenceInSeconds = $timeSecond - $timeFirst;
$count = 0;
if($differenceInSeconds > 14400) {
    
    $weather = file_get_contents(
            'http://api.worldweatheronline.com/free/v2/weather.ashx?'
            . 'q=El%20Gouna&format=json&num_of_days=5&key=3a1ac9278f03f70d65739d22f8777');
    $weather =json_decode($weather);
    $rr = 0;
    foreach($weather->data->current_condition as $s => $x) {
        
        foreach($x->weatherDesc as $d => $o) {
            $weatherDesc=$o->value;
            break;
        }
        $sql = "insert into weather "
                . "values('','$currentDate', '". $x -> cloudcover. "', '" 
                . $x -> FeelsLikeC. "', '" . $x -> humidity . "', '" . $x->pressure . "'"
                . ", '" . $x -> temp_C . "', '', '', '', '', '" 
                . $weatherDesc . "','','','','','')";
        $r = mysql_query($sql);
        $insertedID = mysql_insert_id();
    }
    foreach($weather->data->weather as $k => $v) {
        $rr++;
        if ($rr == 1) {
            
            $sql_x = "update weather set `high` = '" . $v->maxtempC . "',`low`='" 
                    . $v->mintempC . "' where id = '$insertedID'";
            $_x = mysql_query($sql_x);
            foreach ($v->astronomy as $h => $i) {
                $sql_x = "update weather set sunrise='" . $i->sunrise . "',sunset='" 
                        . $i->sunset . "' where id='$insertedID'";
                $_x = mysql_query($sql_x);
                break;
            }
            foreach ($v->hourly as $m => $n) {
                $sql_x = "update weather set windDirection='" . $n->winddir16Point . "', "
                        . "windSpeed='" . $n -> windspeedKmph . "',chanceOfRain='" 
                        . $n -> chanceofrain . "',chanceOfSnow='" . $n->chanceofsnow . "' "
                        . ",chanceofFog='" . $n -> chanceoffog 
                        . "' where id = '$insertedID'";
                $_x = mysql_query($sql_x);
                break;
            }
        } 
        else {
            
            $count++;
            $cday = date('D', strtotime('+' . $count . ' days'));
            $sql_xx = "insert into "
                    . "weather_days "
                    . "values ('','$insertedID','$cday','" . $v->maxtempC . "','')";
            $r_xx = mysql_query($sql_xx);
            $idxx = mysql_insert_id();
            foreach ($v->hourly as $m => $n) {
                foreach ($n->weatherDesc as $d => $o) {
                    $sql_xx = "update weather_days "
                            . "set w_descr='" . $o->value . "' "
                            . "where id='$idxx'";
                    $r_xx = mysql_query($sql_xx);
                    break;
                }
                break;
            }
        }
    }
} else {
    $insertedID = $row['id'];
}

$sql = "select cloudCover,"
        . "feelsLike,"
        . "humidity,"
        . "pressure,"
        . "temperature,"
        . "windDirection,"
        . "windSpeed,`"
        . "high`,`"
        . "low`,"
        . "weatherDesc,"
        . "chanceofFog,"
        . "chanceOfRain,"
        . "chanceOfSnow,"
        . "sunrise,"
        . "sunset "
        . "from weather "
        . "where id='$insertedID'";
$r = mysql_query($sql);
$row = mysql_fetch_assoc($r);
$json['todaysWeather'] = $row;
$sql = "select dayName,"
        . "w_temp as temp,"
        . "w_descr as weatherDesc "
        . "from weather_days "
        . "where w_id = '$insertedID'";
$r = mysql_query($sql);
while ($row = mysql_fetch_assoc($r)) {
    $json['wholeWeekWeatherForcast'][] = $row;
}
echo json_encode($json);

?>
