<?php

namespace api\controllers;

use backend\models\Weather;
use backend\models\WeatherDays;
use Yii;
use yii\filters\VerbFilter;

/**
 * Class WeatherController
 *
 * @package api\controllers
 */
class WeatherController extends ApiController {
	public function behaviors() {
		return [ 
				'verbs' => [ 
						'class' => VerbFilter::className (),
						'actions' => [ 
								'get-weather-forecast' => [ 
										'get' 
								] 
						] 
				] 
		];
	}
	public function actionGetWeatherForecast() {
		date_default_timezone_set ( 'Africa/Cairo' );
		$currentDate = date ( "Y-m-d H:i:s" );
		$todayWeather = null;
		$lastWeather = Weather::find ()->orderBy ( 'id desc' )->limit ( 1 )->one ();
		$timeFirst = strtotime ( $lastWeather->date );
		$timeSecond = strtotime ( $currentDate );
		$differenceInSeconds = $timeSecond - $timeFirst;
		$count = 0;
		$json = [ ];
		if ($differenceInSeconds > 14400) {
			$weather = file_get_contents ( 'http://api.worldweatheronline.com/free/v2/weather.ashx?' . 'q=El%20Gouna&format=json&num_of_days=5&key=3a1ac9278f03f70d65739d22f8777' );
			$weather = json_decode ( $weather );
			$rr = 0;
			$newWeather = new Weather ();
			foreach ( $weather->data->current_condition as $s => $x ) {
				foreach ( $x->weatherDesc as $d => $o ) {
					$weatherDesc = $o->value;
					break;
				}
				$newWeather->date = $currentDate;
				$newWeather->cloudCover = $x->cloudcover;
				$newWeather->feelsLike = $x->FeelsLikeC;
				$newWeather->humidity = $x->humidity;
				$newWeather->pressure = $x->pressure;
				$newWeather->temperature = $x->temp_C;
				$newWeather->weatherDesc = $weatherDesc;
				$newWeather->save();
			}
			foreach ( $weather->data->weather as $k => $v ) {
				$rr ++;
				if ($rr == 1) {
					$newWeather->high = $v->maxtempC;
					$newWeather->low = $v->mintempC;
					
					foreach ( $v->astronomy as $h => $i ) {
						$newWeather->sunrise = $i->sunrise;
						$newWeather->sunset = $i->sunset;
						break;
					}
					foreach ( $v->hourly as $m => $n ) {
						$newWeather->windDirection = $n->winddir16Point;
						$newWeather->windSpeed = $n->windspeedKmph;
						$newWeather->chanceOfRain = $n->chanceofrain;
						$newWeather->chanceOfSnow = $n->chanceofsnow;
						$newWeather->chanceofFog = $n->chanceoffog;
						break;
					}
					$newWeather->update();
				} else {
					
					$count ++;
					$cday = date ( 'D', strtotime ( '+' . $count . ' days' ) );
					$newWeatherDay = new WeatherDays ();
					$newWeatherDay->w_id = $newWeather->id;
					$newWeatherDay->dayName = $cday;
					$newWeatherDay->w_temp = $v->maxtempC;
					foreach ( $v->hourly as $m => $n ) {
						foreach ( $n->weatherDesc as $d => $o ) {
							$newWeatherDay->w_descr = $o->value;
							break;
						}
						break;
					}
					$newWeatherDay->save ();
				}
			}
			$todayWeather = $newWeather;
		} else {
			$todayWeather = $lastWeather;
		}
		
		$json ['todaysWeather'] = $todayWeather;
		$weatherDays = WeatherDays::find ()->where ( [ 
				'w_id' => $todayWeather->id 
		] )->all ();
		foreach ( $weatherDays as $weatherDay ) {
			$day = new \stdClass ();
			$day->dayName = $weatherDay->dayName;
			$day->temp = $weatherDay->w_temp;
			$day->weatherDesc = $weatherDay->w_descr;
			$json ['wholeWeekWeatherForcast'] [] = $day;
		}
		$this->sendSuccessResponse2 ( 1, 200, $json );
	}
}
