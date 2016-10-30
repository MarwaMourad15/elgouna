<?php

namespace api\models;

use backend\models\Setting;
use Yii;
use \yii\db\ActiveRecord;

class Helper extends ActiveRecord
{
    public static function getSettingObj($field='')
    {
        $setting = Setting::findOne(1);

        if($field!='')
        {
            return $setting[$field];
        }
        return $setting;
    }


    public static function generateRandomString($length = 20 , $flag_str=0) {
        if($flag_str==0)
            $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        else
            $characters = '0123456789';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }


    public static function getErrorString($error_array)
    {
        foreach($error_array as $key=>$value)
        {
            $error_arr[] = $value[0];
        }
        return $error_str = (implode(',',$error_arr));
    }

    public static function getLanguage($lang='0')
    {
        if($lang=='1')
            return 'ar';
        return 'en';
    }

    /**
     * Helper::diff_date()
     *
     * @param datetime $start
     * @param datetime $end
     * @return
     */
    public static function diff_date($start, $end) {//////return array of differant date with total days & diffrant hours, minutes and second
        $start_ts = strtotime($start);

        $end_ts = strtotime($end);

        $diff = $end_ts - $start_ts;

        $days = floor($diff / (60 * 60 * 24));

        $hh = floor(($diff - $days * 60 * 60 * 24) / (60 * 60));

        $mm = floor(($diff - $days * 60 * 60 * 24 - $hh * 60 * 60) / (60));

        $ss = floor(($diff - $days * 60 * 60 * 24 - $hh * 60 * 60 - $mm * 60));

        $date[0] = $days;
        $date[1] = $hh;
        $date[2] = $mm;
        $date[3] = $ss;

        return $date;
    }

}
