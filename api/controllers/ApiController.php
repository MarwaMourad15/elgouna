<?php

namespace api\controllers;

use Yii;
use yii\filters\VerbFilter;
use yii\web\Controller;

class ApiController extends Controller
{
    public function init()
    {
        parent::init();
    }

    public function beforeAction($event)
    {
        $action = $event->id;
        if (isset($this->actions[$action])) {
            $verbs = $this->actions[$action];
        } elseif (isset($this->actions['*'])) {
            $verbs = $this->actions['*'];
        } else {
            return $event->isValid;
        }
        $verb = Yii::$app->getRequest()->getMethod();
        $allowed = array_map('strtoupper', $verbs);

        if (!in_array($verb, $allowed)) {
            $this->setHeader(400);
            echo json_encode(array('status' => 0, 'error_code' => 400, 'message' => 'Method not allowed'), JSON_PRETTY_PRINT);
            exit;
        }
        return true;
    }

    public function parseRequest() {
        //$post = file_get_contents("php://input");
        $post = Yii::$app->request->rawBody;
        try {
            if (isset($post) && count($post) > 0) {
                $request = json_decode($post, true);
                if ($request) {
                    return $request;
                } else {
                    $this->sendFailedResponse(0, 400, 'Invalid_parameters');
                }
            } else {
                $this->sendFailedResponse(0 , 400 , 'Invalid_parameters');
            }
        } catch (Exception $ex) {
            $this->sendFailedResponse(0 , 400 , 'Invalid_parameters');
            // return false;
        }
        die();
        // return false;
    }

    protected function setHeader($status)
    {
        $status_header = 'HTTP/1.1 ' . $status . ' ' . $this->_getStatusCodeMessage($status);
        $content_type = "application/json; charset=utf-8";

        header($status_header);
        header('Content-type: ' . $content_type);
        header('X-Powered-By: ' . "fumeStudio <fumestudio.com>");
    }

    protected function _getStatusCodeMessage($status)
    {
        // these could be stored in a .ini file and loaded
        // via parse_ini_file()... however, this will suffice
        // for an example
        $codes = Array(
            // Informational 1xx
            100 => 'Continue',
            101 => 'Switching Protocols',

            // Success 2xx
            200 => 'OK',
            201 => 'Created',
            202 => 'Accepted',
            203 => 'Non-Authoritative Information',
            204 => 'No Content',
            205 => 'Reset Content',
            206 => 'Partial Content',

            // Redirection 3xx
            300 => 'Multiple Choices',
            301 => 'Moved Permanently',
            302 => 'Found',  // 1.1
            303 => 'See Other',
            304 => 'Not Modified',
            305 => 'Use Proxy',
            // 306 is deprecated but reserved
            307 => 'Temporary Redirect',

            // Client Error 4xx
            400 => 'Bad Request',
            401 => 'Unauthorized',
            402 => 'Payment Required',
            403 => 'Forbidden',
            404 => 'Not Found',
            405 => 'Method Not Allowed',
            406 => 'Not Acceptable',
            407 => 'Proxy Authentication Required',
            408 => 'Request Timeout',
            409 => 'Conflict',
            410 => 'Gone',
            411 => 'Length Required',
            412 => 'Precondition Failed',
            413 => 'Request Entity Too Large',
            414 => 'Request-URI Too Long',
            415 => 'Unsupported Media Type',
            416 => 'Requested Range Not Satisfiable',
            417 => 'Expectation Failed',

            // Server Error 5xx
            500 => 'Internal Server Error',
            501 => 'Not Implemented',
            502 => 'Bad Gateway',
            503 => 'Service Unavailable',
            504 => 'Gateway Timeout',
            505 => 'HTTP Version Not Supported',
            509 => 'Bandwidth Limit Exceeded'
        );
        return (isset($codes[$status])) ? $codes[$status] : '';
    }

    protected function _getStatusMessage($status)
    {
        // these could be stored in a .ini file and loaded
        // via parse_ini_file()... however, this will suffice
        // for an example
        $codes = Array(
            'Invalid_Token' => Yii::t('yii','Invalid_Token'),
            'Expired_Token' => Yii::t('yii','Expired_Token'),
            'User_is_not_exist' => Yii::t('yii','User_is_not_exist'),
            'Invalid_parameters'=> Yii::t('yii','Invalid_parameters'),
            'Invalid_Parameters'=> Yii::t('yii','Invalid_parameters'),
            'Unverified_Number'=> Yii::t('yii','Unverified_Number'),
            'Invalid_data'=> Yii::t('yii','Invalid_data'),
            'Non_Authoritative_Information'=> Yii::t('yii','Non_Authoritative_Information'),
            'Not_Found'=> Yii::t('yii','Not_Found')
        );
        return (isset($codes[$status])) ? $codes[$status] : $status;
    }

    protected function sendFailedResponse($status = 0 , $status_header = 400 , $message_error = '')
    {
        if($message_error=='')
        {
            $message_error= $this->_getStatusCodeMessage($status_header);
        }
        else
        {
            $message_error= $this->_getStatusMessage($message_error);
        }
        $this->setHeader($status_header);
        echo json_encode(array('status'=>intval($status),'error_code'=>intval($status_header),'errors'=>$message_error),JSON_PRETTY_PRINT);
        exit;
    }

    protected function sendSuccessResponse($status = 1 , $status_header = 200 , $data = [])
    {
        /*if(empty($data))
        {
            echo json_encode(array('status'=>intval($status)),JSON_PRETTY_PRINT);
            exit;
        }*/
        $this->setHeader($status_header);
        //print_r($data);die;
        echo json_encode(array('status'=>intval($status) ,'data'=>($data)),JSON_PRETTY_PRINT);
        exit;
    }

    protected function sendSuccessResponse2($status = 1 , $status_header = 200 , $data = [])
    {
        if(empty($data))
        {
            echo json_encode(array('status'=>intval($status)),JSON_PRETTY_PRINT);
            exit;
        }
        $this->setHeader($status_header);
        //print_r($data);die;
        echo json_encode((($data)),JSON_PRETTY_PRINT);
        exit;
    }

    protected function stringVal($string="")
    {
        if($string!='')
        {
            return $string;
        }
        else
            return "";
    }

    protected function DateTimeVal($time="")
    {
        if($time!='')
        {
            return Yii::$app->formatter->asDatetime($time ,  "php:g:iA . d F Y");//2:54PM . 14 March 2016
        }
        else
            return "";
    }

    protected function CheckTokenAuth($params)
    {
        if(isset($params['token'])) {
            $token = $params['token'];

            $checkToken = Authusers::CheckToken($token);
            if ($checkToken == 0) {
                $this->sendFailedResponse(0, 401, 'Invalid_Token');
            } elseif ($checkToken == -1) {
                $this->sendFailedResponse(0, 203, 'Expired_Token');
            } else {
                /*
                 * before send the user id need to check if this user is blocked or not
                 */
                $user_id = $checkToken;
                if (($model = User::findOne($user_id)) !== null) {
                    if($model->status == User::STATUS_ACTIVE)
                    {
                        return $user_id;
                    }
                    else //in case of user are pending or blocked
                    {
                        $this->sendFailedResponse(0, 410); // Unauthorized user
                    }
                } else {
                    $this->sendFailedResponse(0, 400, 'User_is_not_exist');
                }
            }
        }
        else
        {
            $this->sendFailedResponse(0 , 401 , 'Invalid_parameters');
        }
    }

    protected function convertStringArray($string_to_array)
    {
        ///print_r(json_decode($string_to_array));
        return json_decode($string_to_array);
    }

    protected function checkImageExtension($ext){
        $extension = strtolower($ext);
        if($extension=="png"||$extension=="jpg"||$extension=="jpeg")
            return true;
        else
            return false;
    }

    protected function uploadPhoto($ext,$img,$save){
        $response = array();
        // decode binary data
        $decoded = base64_decode($img);

        // make the pathparameter
        $file_name = uniqid() . "." . strtolower($ext);

        $path = __DIR__ . '/../..' . $save;

        // if the folder not found it will make the directory
        if (!file_exists($path)) {
            mkdir($path);
        }

        $upload_path = $path . "/" . $file_name;
        // write data
        header('Content-Type: bitmap; charset=utf-8');
        try {
            $fp = @fopen($upload_path, 'wb');
        }
        catch (Exception $ex) {
            $error_str = $ex->getMessage();
            $response['code']=400;
            $response['message']=$error_str;
            return $response;
        }
        //$fp = @fopen($upload_path, "wb") or die(print_r(error_get_last(),true));
        if (!fwrite($fp, $decoded)) {
            $response['code']=400;
            $response['message']= 'Uploading_image_Failed';
            return $response;
            // die();
        }
        else{
            $path = $save;
            $upload_path = $path . "/" .$file_name;
            fclose($fp);
            $response['code']=200;
            $response['message']=$upload_path;
            return $response;
        }
    }

}
