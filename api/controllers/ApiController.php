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
        $post = file_get_contents("php://input");
        //$post = Yii::$app->request->rawBody;
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
            'Not_Found'=> Yii::t('yii','Not_Found'),

            'This phone number is already exist'=> Yii::t('yii','This phone number is already exist'),
            'Blocked User'=> Yii::t('yii','Blocked User'),

            'This_phone_number_is_not_registered_yet'=> Yii::t('yii','This_phone_number_is_not_registered_yet'),
            'Wrong Activation code'=> Yii::t('yii','Wrong Activation code'),
            'Unauthorized user'=> Yii::t('yii','Unauthorized user'),
            'This user is already active'=> Yii::t('yii','This user is already active'),
            'No_Doctors_Available'=>Yii::t('yii','No_Doctors_Available'),
            'Invalid_Entries_Please_Check_Data_Types'=>Yii::t('yii','Invalid_Entries_Please_Check_Data_Types'),
            'Doctor_Not_Found'=>Yii::t('yii','Doctor_Not_Found'),
            'Unauthorized_User'=>Yii::t('yii','Unauthorized_User'),
            'No_Such_Request'=>Yii::t('yii','No_Such_Request'),
            'You_have_no_visits'=>Yii::t('yii','You_have_no_visits'),
            'Invalid_Enteries'=>Yii::t('yii','Invalid_Enteries'),
            'Invalid_Entries'=>Yii::t('yii','Invalid_Entries'),
            'Invalid_Date'=>Yii::t('yii','Invalid_Date'),
            'You_Have_No_Appointments'=>Yii::t('yii','You_Have_No_Appointments'),
            'Something_Went_Wrong_Please_Try_Again_Later'=>Yii::t('yii','Something_Went_Wrong_Please_Try_Again_Later'),
            'User_Is_Not_Activated'=>Yii::t('yii','User_Is_Not_Activated'),
            'User_Is_Blocked'=>Yii::t('yii','User_Is_Blocked'),
            'User_name_and_password_don\'t_match'=>Yii::t('yii','User_name_and_password_don\'t_match'),
            'User_not_found'=>Yii::t('yii','User_not_found'),
            'Something_Went_Wrong'=>Yii::t('yii','Something_Went_Wrong'),
            'You_Dont_Have_Sub_Accounts'=>Yii::t('yii','You_Dont_Have_Sub_Accounts'),
            'Switched'=>Yii::t('yii','Switched'),
            'The_Account_Passed_Is_Not_In_You_Group'=>Yii::t('yii','The_Account_Passed_Is_Not_In_You_Group'),
            'All_Notifications_Deleted'=>Yii::t('yii','All_Notifications_Deleted'),
            'Notification_Deleted'=>Yii::t('yii','Notification_Deleted'),
            'success'=>Yii::t('yii','success'),
            'Password_Reset_Email_Sent_Please_Check_Your_Mail'=>Yii::t('yii','Password_Reset_Email_Sent_Please_Check_Your_Mail'),
            'Your_Message_Has_Been_Delivered'=>Yii::t('yii','Your_Message_Has_Been_Delivered'),
            'New_Profile_added'=>Yii::t('yii','New_Profile_added'),
            'Profile_Updated'=>Yii::t('yii','Profile_Updated'),
            'Language_Updated'=>Yii::t('yii','Language_Updated'),
            'Updated_Token'=>Yii::t('yii','Updated_Token'),
            'Review_Added'=>Yii::t('yii','Review_Added'),
            'Your_Complain_has_been_sent'=>Yii::t('yii','Your_Complain_has_been_sent'),
            'Request_Cancelled'=>Yii::t('yii','Request_Cancelled'),
            'Appointment_Cancelled'=>Yii::t('yii','Appointment_Cancelled'),
            'Appointment_Updated'=>Yii::t('yii','Appointment_Updated'),
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
        if(empty($data))
        {
            echo json_encode(array('status'=>intval($status)),JSON_PRETTY_PRINT);
            exit;
        }
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

    protected function checkPatientToken($id,$token){
        $patient = Patient::findOne($id);
        $token = strtolower($token);
        if ($patient) {
            $parent = $patient->patient;
            if($parent){
                //
                $tokenDB = strtolower(md5($patient->id . $parent->mobile . $parent->password));
            }else {
                $tokenDB = strtolower(md5($patient->id . $patient->mobile . $patient->password));
            }
            if ($tokenDB == $token) {
                if ($patient->status==Patient::STATUS_CURRENT||$patient->status==Patient::STATUS_ACTIVE)
                    return true;
                elseif ($patient->status == Patient::STATUS_PENDING) {
                    $this->sendFailedResponse(0, 701, 'User_Is_Not_Activated');
                    return false;
                } elseif ($patient->status == Patient::STATUS_BLOCKED) {
                    $this->sendFailedResponse(0, 700, 'User_Is_Blocked');
                    return false;
                }
            } else {
                $this->sendFailedResponse(0, 400, 'Invalid_Token');
            }
        }
        else{
            $this->sendFailedResponse(0,404,'User_Not_Found');
        }
    }

    protected function checkDoctorToken ($id,$token) {
        $doctor = User::findOne($id);
        if($doctor){
            $tokenDB = LogHistory::find()->where('user_id=:user',[':user'=>$doctor->id])->orderBy(['id'=>SORT_DESC])->one();
            if($token == $tokenDB->token){
                /**
                 * check on token expiration time
                 */
                if($doctor->status == User::STATUS_ACTIVE)
                    return true;
                else if ($doctor->status == User::STATUS_PENDING){
                    $this->sendFailedResponse(0,701,'User_Is_Not_Activated');
                    return false;
                }
                else if ($doctor->status == User::STATUS_BLOCKED){
                    $this->sendFailedResponse(0,700,'User_Is_Blocked');
                    return false;
                }
            }
            else{
                return false;
            }
        }
        else{
            $this->sendFailedResponse(0,404,'User_Not_Found');
        }
    }

    protected function createLogRequest($requestId,$user_id,$requestType,$requestStatus=0,$cancelReason=""){
        LogRequest::addNewLogToDB($requestId,$user_id,$requestType,$requestStatus,$cancelReason);
    }

    protected function checkImageExtension($ext){
        $extension = strtolower($ext);
        if($extension=="png"||$extension=="jpg"||$extension=="jpeg")
            return true;
        else
            return false;
    }

    protected function getAddedAccounts ($id){
        return Patient::getAddedAccount($id);
    }

    protected function prepareObjectPatient($patient,$is_parent=1,$fields_arr=null)
    {

        $patientProfile = PatientProfile::find()->where('patient_id=:patient',[':patient'=>$patient['id']])->one();
        $insurance_code = Patient::get_insurance_code($patient);

        $returnProfileTemp = [
            'user_id' => intval($patient->id),
            'language' => intval($patient->language),
            'first_name' => $this->stringVal($patient->first_name),
            'last_name' => $this->stringVal($patient->last_name),
            'email' => $this->stringVal($patient->email),
            'mobile_number' => $this->stringVal($patient->mobile),
            'phone_number' =>$this->stringVal($patient->phone_number),
            'gender' => intval($patient->gender),
            'date_of_birth' => $this->stringVal($patient->date_of_birth),
            'image' => $this->stringVal($patient->image),
            'is_child' => intval(0),
            'allergies' => $this->stringVal($patientProfile->allergies),
            'previous_operations' => $this->stringVal($patientProfile->previous_operation),
            'medical_info' => $this->stringVal($patientProfile->medical_info),
            'promotion_code'=>$this->stringVal($patient->generated_promotion_code),
            'insurance_code'=>$this->stringVal($insurance_code)
        ];
        $parent = $patient->patient;
        if($parent){
            $returnPatient['parent_mobile']=$this->stringVal($parent->mobile);
        }
        else{
            $returnPatient['parent_mobile']=$this->stringVal($patient->mobile);
        }
        if($is_parent==0){
            $returnProfileTemp['is_child'] = intval(1);
        }
        if($fields_arr!==null) {
            foreach ($returnProfileTemp as $key => $value) {
                if (in_array($key, $fields_arr))
                    $returnPatient[$key] = $value;
            }
        }
        else
        {
            $returnPatient = $returnProfileTemp;
        }
        return $returnPatient;

    }

    protected function preperObjectNotification($notification_obj)
    {
        /*
         *
        const NOTIFCIATIN_TYPE_GENERAL = 0;
        const NOTIFCIATIN_TYPE_ADMIN = 1;
        const NOTIFICATION_DOCTOR_REQUESTED = 2;
        const NOTIFICATION_PATIENT_COMPLAIN =3;
        const NOTIFICATION_PATIENT_CANCELLED =4;
        const NOTIFICATION_DOCTOR_CANCELLED_REQUEST=5;
        const NOTIFICATION_DOCTOR_CANCELLED_AFTER = 6;
        const NOTIFICATION_DOCTOR_CONFIRM = 7;
        const PATIENT_REQUEST_APPOINTMENT = 8; // for super doc.
        const PATIENT_MODIFIED_APPOINTMENT = 9;
        const PATIENT_CONFIRMED_APPOINTMENT = 10;
        const PATIENT_CANCELED_APPOINTMENT = 11;
        const NOTIFICATION_DOCTOR_ARRIVED = 12;
        const NOTIFICATION_DOCTOR_END_VISIT = 13;

         */
        $params = $this->convertStringArray($notification_obj->param);
        //var_dump($params);die;
        $img = '';
        $full_name = '';
        if(isset($params->sender_id))
        {
            if($notification_obj->type!=PushNotification::NOTIFCIATIN_TYPE_GENERAL
                && $notification_obj->type!=PushNotification::NOTIFCIATIN_TYPE_TASKAPPROVED
                && $notification_obj->type!=PushNotification::NOTIFCIATIN_TYPE_ADMIN
                && $notification_obj->type!=PushNotification::NOTIFCIATIN_TYPE_TASKREJECTED
                && $notification_obj->type!=PushNotification::NOTIFCIATIN_TYPE_RATE_WARNING
            )
            {
                $profile = Profile::findOne(['user_id' => $params->sender_id]);
                $full_name = $profile['fullName'];

                $dirPath = '';
                if(isset($profile['avatar'])) {
                    $img = Yii::$app->params['IMAGE_PATH'] . '/' . $profile['avatar'];
                    $dirPath = __DIR__. "/../../backend/".$profile['avatar'];
                }
                if (!file_exists($dirPath)) {
                    $img = '';
                }



            }
        }
        $notification_title='';
        if($notification_obj->type==PushNotification::NOTIFCIATIN_TYPE_MATCHED_PREFERED)
        {
            $task = Tasks::findOne(['id'=>$notification_obj->model_id]);
            $notification_title = $task->type0['name'];
        }
        else
        {
            $notification_title = PushNotification::getNotificationTitle()[$notification_obj->type];
        }

        $notification_arr = [
            'id'=>intval($notification_obj->id),
            //'type'=>intval($notification_obj->type),
            'status'=>intval($notification_obj->status),
            'opened'=>intval($notification_obj->opened),
            'title'=>$this->stringVal($notification_title),
            'message'=>$this->stringVal($notification_obj->message),
            'created'=>$this->stringVal($notification_obj->created),
            'img' => $this->stringVal($img),
            'full_name'=>$this->stringVal($full_name),

            'param'=>$this->convertStringArray($notification_obj->param)
        ];
        return $notification_arr;
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

    protected function checkInsuranceCode($serial){

        $promo = PromoSerial::find()->where(['serial'=>$serial])->one();
        if($promo){
            $assigned = PatientPromo::find()->where(['promo_serial_id'=>$promo['id']])->all();
            if(count($assigned)>0){
                 $this->sendFailedResponse(0,706,'Promo_Code_Not_Available');
            }
            else {
                $promoDate = $promo['promo']['end_date'];
                $currentDate = date('Y-m-d');
                if((strtotime($promoDate)-strtotime($currentDate))/(60*60*24)>0){
                    return $promo;
                }
                else{
                    $this->sendFailedResponse(0.707,'Promo_Code_Expired');
                }
            }
        }
        else {
             $this->sendFailedResponse(0,705,'Promo_Code_Don\'t_Exist');
        }
    }

    protected function checkInvitationCode($serial){

        $patient = Patient::find()->where(['generated_promotion_code'=>$serial])->one();
        if($patient){
            if($patient->status == Patient::STATUS_ACTIVE || $patient->status == Patient::STATUS_CURRENT){
                return $patient;
            }
            else {
                $this->sendFailedResponse(0,707,'Promo_Code_Owner_Is_Not_Valid');
            }
        }
        else {
            $this->sendFailedResponse(0,705,'Promo_Code_Don\'t_Exist');
        }
    }

    protected function checkGiftCode($serial){

        $promo = PromoSerial::find()->where(['serial'=>$serial])->one();
        if($promo){
            $assigned = PatientPromo::find()->where(['promo_serial_id'=>$promo['id']])->all();
            if(count($assigned)>0){
                $this->sendFailedResponse(0,706,'Promo_Code_Not_Available');
            }
            else {
                $promoDate = $promo['promo']['end_date'];
                $currentDate = date('Y-m-d');
                if((strtotime($promoDate)-strtotime($currentDate))/(60*60*24)>0){
                    return $promo;
                }
                else{
                    $this->sendFailedResponse(0.707,'Promo_Code_Expired');
                }
            }
        }
        else {
            $this->sendFailedResponse(0,705,'Promo_Code_Don\'t_Exist');
        }
    }
    
    protected function calculateTotal($total,$request){
        //return -1;
        $patient = Patient::findOne($request['patient_id']);
        $insurance = PatientPromo::find()->where(['patient_id'=>$patient['id']])
            ->andWhere(['category'=>PatientPromo::CATEGORY_INSURANCE])
            ->one();
        if($insurance){
            $insuranceDate = $insurance['serial']['promo']['end_date'];
            $currentDate = date('Y-m-d');
            if((strtotime($insuranceDate)-strtotime($currentDate))/(60*60*24)>0){
                $vstPrmo = new VisitPromo();
                $vstPrmo->visit_id = $request['id'];
                $vstPrmo->patient_id = $request['patient']['id'];
                $vstPrmo->promo_code_id = $insurance['serial']['promo']['id'];
                $vstPrmo->promo_serial_id = $insurance['serial']['id'];
                $vstPrmo->company_id = $insurance['serial']['promo']['company']['id'];
                $vstPrmo->promo_percentage = $insurance['serial']['promo']['percentage'];
                $vstPrmo->actual_cost = $total;
                if($insurance->type == PatientPromo::TYPE_PERCENTAGE) {
                    $vstPrmo->discount = (($total * $insurance['serial']['promo']['percentage']) / 100);
                    $vstPrmo->total = ($total - (($total * $insurance['serial']['promo']['percentage']) / 100));
                    $insurance->is_used = (intval($insurance->is_used)+1);
                    $insurance->save();
                    $vstPrmo->patient_promo_id = $insurance['id'];
                }
                else if($insurance->type == PatientPromo::TYPE_AMOUNT){
                    $vstPrmo->discount = $insurance['serial']['promo']['percentage'];
                    $vstPrmo->total = ($total - $insurance['serial']['promo']['percentage']);
                    $vstPrmo->patient_promo_id = $insurance['id'];
                    $insurance->is_used =(intval($insurance->is_used)+1);
                    $insurance->save();
                }
                else{
                    $vstPrmo->discount = $total;
                    $vstPrmo->total = 0;
                    $vstPrmo->patient_promo_id = $insurance['id'];
                    $insurance->is_used = (intval($insurance->is_used)+1);
                    $insurance->save();
                }
                $vstPrmo->save();
                return $vstPrmo->total;
            }
            else{

            }
        }
        else{
            $invitation = PatientPromo::find()->where(['patient_id'=>$request['patient']['id']])
                ->andWhere(['category'=>PatientPromo::CATEGORY_INVITATION])
                ->andWhere(['is_used'=>0])
                ->one();
            if($invitation){
                $settings = Setting::findOne(1);
                $discontPercentage = $settings->promotion_discount;
                $vstPrmo = new VisitPromo();
                $vstPrmo->visit_id = $request['id'];
                $vstPrmo->patient_id = $request['patient']['id'];
                $vstPrmo->promo_code_id = $insurance['serial']['promo']['id'];
                $vstPrmo->promo_serial_id = $insurance['serial']['id'];
                $vstPrmo->company_id = $insurance['serial']['promo']['company']['id'];
                $vstPrmo->promo_percentage = $discontPercentage;
                $vstPrmo->actual_cost = $total;
                $vstPrmo->discount = (($total * $discontPercentage) / 100);
                $vstPrmo->total = ($total - (($total * $discontPercentage) / 100));
                $vstPrmo->patient_promo_id = $invitation['id'];
                $vstPrmo->save();
                $invitation->is_used =(intval($invitation->is_used)+1);
                $invitation->save();
                return $vstPrmo->total;

            }
            else{
                $gift = PatientPromo::find()->where(['patient_id'=>$request['patient']['id']])
                    ->andWhere(['category'=>PatientPromo::CATEGORY_GIFT_CARD])
                    ->andWhere(['is_used'=>0])
                    ->one();
                if($gift){
                    $giftDate = $gift['serial']['promo']['end_date'];
                    $currentDate = date('Y-m-d');
                    if((strtotime($giftDate)-strtotime($currentDate))/(60*60*24)>0){
                        $vstPrmo = new VisitPromo();
                        $vstPrmo->visit_id = $request['id'];
                        $vstPrmo->patient_id = $request['patient']['id'];
                        $vstPrmo->promo_code_id = $gift['serial']['promo']['id'];
                        $vstPrmo->promo_serial_id = $gift['serial']['id'];
                        $vstPrmo->company_id = $gift['serial']['promo']['company']['id'];
                        $vstPrmo->promo_percentage = $gift['serial']['promo']['percentage'];
                        $vstPrmo->actual_cost = $total;
                        if($gift->type == PatientPromo::TYPE_PERCENTAGE) {
                            $vstPrmo->discount = (($total * $gift['serial']['promo']['percentage']) / 100);
                            $vstPrmo->total = ($total - (($total * $gift['serial']['promo']['percentage']) / 100));
                            $vstPrmo->patient_promo_id = $gift['id'];
                            $gift->is_used =(intval($gift->is_used)+1);
                            $gift->save();
                        }
                        else if($gift->type == PatientPromo::TYPE_AMOUNT){
                            $vstPrmo->discount = $gift['serial']['promo']['percentage'];
                            $vstPrmo->total = ($total - $gift['serial']['promo']['percentage']);
                            $gift->is_used = (intval($gift->is_used)+1);
                            $gift->save();
                        }
                        else{
                            $vstPrmo->discount = $total;
                            $vstPrmo->total = 0;
                            $gift->is_used = (intval($gift->is_used)+1);
                            $gift->save();
                        }
                        $vstPrmo->save();
                        return $vstPrmo->total;
                    }
                    else{

                    }
                }
                else{
                    return -1;
                }
            }
        }
        /*$patientPromo = PatientPromo::find()->where(['patient_id'=>$request['patient']['id']])->one();
        $promo = PromoSerial::find()->where(['serial'=>$patientPromo['serial']['serial']])->one();
        if($promo){
            $assigned = PatientPromo::find()->where(['promo_serial_id'=>$promo->id])->all();
            if(count($assigned)>0){
                $this->sendFailedResponse(0,706,'Promo_Code_Not_Availabe');
            }
            else {
                $promoDate = $promo['promo']['end_date'];
                $currentDate = date('Y-m-d');
                if((strtotime($currentDate)-strtotime($promoDate))/(60*60*24)>0){
                    $vstPrmo = new VisitPromo();
                    $vstPrmo->visit_id = $request['id'];
                    $vstPrmo->patient_id = $request['patient']['id'];
                    $vstPrmo->promo_code_id = $promo['promo']['id'];
                    $vstPrmo->promo_serial_id = $promo['id'];
                    $vstPrmo->company_id = $promo['promo']['company']['id'];
                    $vstPrmo->promo_percentage = $promo['promo']['percentage'];
                    $vstPrmo->actual_cost = $total;
                    $vstPrmo->discount = (($total*$promo['promo']['percentage'])/100);
                    $vstPrmo->total = ($total-(($total*$promo['promo']['percentage'])/100));
                    $vstPrmo->save();
                    return $vstPrmo->total;
                }
                else{
                    return $total;
                }
            }
        }
        else {
            return $total;
        }*/
    }






}
