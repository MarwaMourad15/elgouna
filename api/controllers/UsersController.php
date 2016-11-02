<?php
/**
 * Created by PhpStorm.
 * User: Muhammed
 * Date: 11/1/2016
 * Time: 11:55 AM
 */

namespace api\controllers;


use backend\models\Payments;
use backend\models\UserCard;
use backend\models\Users;
use yii\filters\VerbFilter;
use yii\web\User;

class UsersController extends ApiController
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'add-new-card' => ['post'],
                    'delete-card'=>['post'],
                    'signup'=>['post'],
                    'facebook-login'=>['post'],
                    'facebook-signup'=>['post'],
                    'login'=>['post'],
                    'forget-password'=>['post'],
                    'edit-profile'=>['post'],
                    'get-user-payments'=>['post'],
                    'get-user-orders'=>['post'],
                    'upload-images'=>['post'],
                ],

            ]
        ];
    }
    
    public function actionAddNewCard(){
        
        $params = $this->parseRequest();
        if(isset($params['user_id']) && isset($params['card_ending']) && isset($params['card_token'])){
            $user = Users::find()->where(['id'=>$params['user_id']])->one();
            if($user){
                $newCard = new UserCard();
                $newCard->user_id = $user->id;
                $newCard->card_ending_with = $params['card_ending'];
                $newCard->adding_date = date('Y-m-d');
                $newCard->paymob_token = $params['card_token'];
                if($newCard->save()){
                    $this->sendSuccessResponse2(1,200,['status'=>'Success','card'=>[
                        'id'=>$newCard->id,
                        'paymob_token'=>$newCard->paymob_token,
                        'card_ending_with'=>$newCard->card_ending_with,
                        'adding_date'=>$newCard->adding_date
                    ]]);
                }
                else{
                    $this->sendSuccessResponse2(1,200,['status'=>'Failure','mysql_message'=>'Insertion Error']);
                }
            }
            else{
                $this->sendSuccessResponse2(1,200,['status'=>'Failure','mysql_message'=>'Error']);
            }
        }
        else{
            $this->sendSuccessResponse2(1,200,['status'=>'Failure','message'=>'Card data is not set/complete.']);
        }
        
    }

    public function actionDeleteCard(){

        $params = $this->parseRequest();
        if(isset($params['card_id'])){
            $cardToBeDeleted = UserCard::find()->where(['id'=>$params['card_id']])->one();
            if($cardToBeDeleted){
                $cardEnding = $cardToBeDeleted->card_ending_with;
                if($cardToBeDeleted->delete()){
                    $msg = 'Card **** **** **** ' . $cardEnding 
                        .  ' has been deleted.';
                    $this->sendSuccessResponse2(1,200,['status'=>'Success','message'=>$msg]);
                }
                else{
                    $msg = 'Card **** **** **** ' . $cardEnding 
                        . ' could not be deleted. Please try again.';
                    $this->sendSuccessResponse2(1,200,['status'=>'Failure','message'=>$msg]);
                }
            }
            else{
                $this->sendSuccessResponse2(1,200,['status'=>'Failure','mysql_message'=>'Error']);
            }
        }
        else{
            $this->sendSuccessResponse2(1,200,['status'=>'Failure','message'=>'Card data is not set/complete.']);
        }
    }


    public function actionFacebookLogin(){
        
        $params = $this->parseRequest();
        if(isset($params['fbId'])) {
            $facebookID = $params['fbId'];
            $user = Users::find()->where(['fbId' => $facebookID])->one();
            if($user){
                // $returnUser = $user;
                $imgUrl = "https://graph.facebook.com/" . $user['fbId']
                    . "/picture?type=large";
                $returnUser['imageURL'] = $imgUrl;
                $returnUser['ehgzly_user_token'] = null;
                $returnUser['ehgzly_user_id'] = null;
                $userCards = array();
                $registeredUserCards = UserCard::find()->where(['user_id'=>$user->id])->all();
                foreach ($registeredUserCards as $registeredUserCard){
                    array_push($userCards,$registeredUserCard);
                }
                //$returnUser['cards'] = $userCards;
                $returnUser = [
                    'userId'=>$user->id,
                    'userAuth'=>'',
                    "name"=>$user->name,
                    "imageURL"=>$user->imageURL,
                    "phoneNumber"=>$user->phoneNumber,
                    "gender"=>$user->gender,
                    "birthDate"=>$user->birthDate,
                    "address"=>$user->address,
                    "email"=>$user->email,
                    "zipCode"=>$user->zipCode,
                    "facebookId"=>$user->fbId,
                    "notificationsEnabled"=>$user->notificationsEnabled,
                    "mapsEnabled"=>$user->mapsEnabled,
                    "elgounaPhone"=>$user->elgounaPhone,
                    "elgounaSMS"=>$user->elgounaSMS,
                    "elgounaemail"=>$user->elgounaemail,
                    'ehgzly_user_id'=>null,
                    'ehgzly_user_token'=>null,
                    'cards'=>$userCards

                ];
                $this->sendSuccessResponse2(1,200,['status'=>'0','userExists'=>'1','user'=>$returnUser]);
            }
            else{
                $this->sendSuccessResponse2(1,200,['status'=>'0','userExists'=>'0','user'=>'']);
            }
        }
        else{
            $this->sendSuccessResponse2(1,200,['status'=>'1','userExists'=>'0','user'=>'']);
        }

    }
    
    public function actionLogin(){
        $params = $this->parseRequest();
        if(isset($params['userAuth']) && isset($params['email'])) {
            $email = $params['email'];
            $user = Users::find()->where(['email' => $email])->one();
            if($user){
                if($user->validatePassword($params['userAuth'])) {
                   // $returnUser = $user;
                    $imgUrl = "https://graph.facebook.com/" . $user['fbId']
                        . "/picture?type=large";
                    $returnUser['imageURL'] = $imgUrl;
                    $returnUser['ehgzly_user_token'] = null;
                    $returnUser['ehgzly_user_id'] = null;
                    $userCards = array();
                    $registeredUserCards = UserCard::find()->where(['user_id'=>$user->id])->all();
                    foreach ($registeredUserCards as $registeredUserCard){
                        array_push($userCards,$registeredUserCard);
                    }
                    //$returnUser['cards'] = $userCards;
                    $returnUser = [
                        'userId'=>$user->id,
                        'userAuth'=>'',
                        "name"=>$user->name,
                        "imageURL"=>$user->imageURL,
                        "phoneNumber"=>$user->phoneNumber,
                        "gender"=>$user->gender,
                        "birthDate"=>$user->birthDate,
                        "address"=>$user->address,
                        "email"=>$user->email,
                        "zipCode"=>$user->zipCode,
                        "facebookId"=>$user->fbId,
                        "notificationsEnabled"=>$user->notificationsEnabled,
                        "mapsEnabled"=>$user->mapsEnabled,
                        "elgounaPhone"=>$user->elgounaPhone,
                        "elgounaSMS"=>$user->elgounaSMS,
                        "elgounaemail"=>$user->elgounaemail,
                        'ehgzly_user_id'=>null,
                        'ehgzly_user_token'=>null,
                        'cards'=>$userCards

                    ];
                    $this->sendSuccessResponse2(1, 200, ['status' => '1', 'userExists' => 1, 'user' => $returnUser]);
                }
                else{
                    $this->sendSuccessResponse2(1,200,['status'=>'0','msg'=>'Email and password do not match.','user'=>'']);
                }

            }
            else{
                $this->sendSuccessResponse2(1,200,['status'=>'0','msg'=>'There is no such user.','user'=>'']);
            }
        }
        else{
            $this->sendSuccessResponse2(1,200,['status'=>'0','userExists'=>'0','user'=>'']);
        }
    }

    public function actionSignup(){

        $params = $this->parseRequest();
        $user = Users::find()->where(['email'=>$params['email']])->one();
        if($user){
            $this->sendSuccessResponse2(1,200,['status'=>0,'user'=>'','msg'=>'This email is already taken.']);
        }
        else{
            $user = new Users();
            $user->name = $params['name'];
            $user->phoneNumber = $params['phone'];
            $user->gender = $params['gender'];
            $user->birthDate = $params['birthday'];
            $user->email = $params['email'];
            $user->userAuth = $params['userAuth'];
            $user->fbId = '';
            if($user->save()){
                $returnUser = [
                    'userId'=>$user->id,
                    'userAuth'=>$params['userAuth'],
                    "name"=>$user->name,
                    "imageURL"=>$user->imageURL,
                    "phoneNumber"=>$user->phoneNumber,
                    "gender"=>$user->gender,
                    "birthDate"=>$user->birthDate,
                    "address"=>$user->address,
                    "email"=>$user->email,
                    "zipCode"=>$user->zipCode,
                    "facebookId"=>$user->fbId,
                    "notificationsEnabled"=>$user->notificationsEnabled,
                    "mapsEnabled"=>$user->mapsEnabled,
                    "elgounaPhone"=>$user->elgounaPhone,
                    "elgounaSMS"=>$user->elgounaSMS,
                    "elgounaemail"=>$user->elgounaemail,
                    'ehgzly_user_id'=>null,
                    'ehgzly_user_token'=>null];
                $this->sendSuccessResponse2(1,200,['user'=>$returnUser,'status'=>'1']);
            }
            else{
                $this->sendSuccessResponse2(1,200,['status'=>0,'user'=>'','mysql_msg'=>'Insertion Error']);
            }
        }
    }

    public function actionFacebookSignup(){

        $params = $this->parseRequest();
        $user = Users::find()->where(['email'=>$params['email']])->one();
        if($user){
            $user->fbId = $params['fbId'];
            $user->save();
            $this->sendSuccessResponse2(1,200,['user'=>$user,'status'=>'1']);
        }
        else{
            $user = new Users();
            $user->name = $params['name'];
            $user->phoneNumber = $params['phone'];
            $user->gender = $params['gender'];
            $user->birthDate = $params['birthday'];
            $user->email = $params['email'];
            $user->userAuth = '';
            $user->fbId = $params['fbId'];
            if($user->save()){
                $returnUser = [
                    'userId'=>$user->id,
                    'userAuth'=>'',
                    "name"=>$user->name,
                    "imageURL"=>$user->imageURL,
                    "phoneNumber"=>$user->phoneNumber,
                    "gender"=>$user->gender,
                    "birthDate"=>$user->birthDate,
                    "address"=>$user->address,
                    "email"=>$user->email,
                    "zipCode"=>$user->zipCode,
                    "facebookId"=>$params['fbId'],
                    "notificationsEnabled"=>$user->notificationsEnabled,
                    "mapsEnabled"=>$user->mapsEnabled,
                    "elgounaPhone"=>$user->elgounaPhone,
                    "elgounaSMS"=>$user->elgounaSMS,
                    "elgounaemail"=>$user->elgounaemail,
                    'ehgzly_user_id'=>null,
                    'ehgzly_user_token'=>null];
                $this->sendSuccessResponse2(1,200,['user'=>$returnUser,'status'=>'1']);
            }
            else{
                $this->sendSuccessResponse2(1,200,['user'=>'','mysql_msg'=>'Insertion Error']);
            }
        }

    }
    
    public function actionForgetPassword(){
        
        $params = $this->parseRequest();
        $user = Users::find()->where(['email'=>$params['email']])->andWhere(['fbId'=>''])->one();
        if($user){
            $passwordResetToken = crypt($user->id . $user->email);
            $user->auth_reset_token = $passwordResetToken;
            $user->save();
            if($user->sendResetPassowrd()){
                $this->sendSuccessResponse2(1,200,['status'=>1,'mysql_message'=>'','msg'=>'Mail is delivered and saved.']);
            }
            else{
                $this->sendSuccessResponse2(1,200,['status'=>0,'mysql_message'=>'','msg'=>'Mail is not delivered.']);
            }
        }
        else{
         
            $this->sendSuccessResponse2(1,200,['status'=>0,'msg'=>'','mysql_message'=>'Error']);
        }
    }

    public function actionEditProfile(){

        $params = $this->parseRequest();
        $user = Users::find()->where(['id'=>$params['userId']])->one();
        if($user){
            if($user->email == $params['email']){
                $user->userAuth = $params['userAuth'];
                $user->name = $params['name'];
                $user->email = $params['email'];
                $user->phoneNumber = $params['phoneNumber'];
                $user->gender = $params['gender'];
                $user->birthDate = $params['birthday'];
                $user->address = $params['address'];
                $user->zipCode = $params['zipCode'];
                $user->notificationsEnabled = $params['notificationEnabled'];
                $user->mapsEnabled = $params['mapsEnabled'];
                $user->save();
                $returnUser = [
                    'userId'=>$user->id,
                    'name'=>$user->name,
                    'imageURL'=>$user->imageURL,
                    'phoneNumber'=>$user->phoneNumber,
                    'gender'=>$user->gender,
                    'birthDate'=>$user->birthDate,
                    'address'=>$user->address,
                    'email'=>$user->email,
                    'zipCode'=>$user->zipCode,
                    'facebookId'=>$user->fbId,
                    'notificationsEnabled'=>$user->notificationsEnabled,
                    'mapsEnabled'=>$user->mapsEnabled,
                    'elgounaPhone'=>$user->elgounaPhone,
                    'elgounaSMS'=>$user->elgounaSMS,
                    'elgounaemail'=>$user->elgounaemail
                ];
                $this->sendSuccessResponse2(1,200,['status'=>'1','user'=>$returnUser]);

            }
            else{
                $this->sendSuccessResponse2(1,200,['status'=>'0','user'=>'','msg'=>'This email is already registered to another user.']);
            }
        }
        else{
            $this->sendSuccessResponse2(1,200,['status'=>'0','msg'=>'This email does not exist.','user'=>'']);
        }
    }

    public function actionGetUsersOrders(){

        $params = $this->parseRequest();
    }

    public function actionGetUserPayments(){

        $params = $this->parseRequest();
        $returnPayments = array();
        if(isset($params['user_id'])){
            $user = Users::find()->where(['id'=>$params['user_id']])->one();
            if($user){
                $payments = Payments::findBySql('select `payments`.*, `orders`.`order_code` from `payments` join `orders` on
`payments`.`order_id` = `orders`.`id` where `payments`.`user_id` = \''.$user->id.'\' order by `payments`.`payment_date` desc '
                )->all();
                if($payments){
                    if(count($payments)>0){
                        foreach ($payments as $payment){
                            array_push($returnPayments,$payment);
                        }
                        $this->sendSuccessResponse2(1,200,$returnPayments);
                    }
                    else{
                        $returnPayments['message'] = 'No payments for this user.';
                        $this->sendSuccessResponse2(1,200,$returnPayments);
                    }
                }
                else{
                    $returnPayments['message'] = 'No payments for this user.';
                    $this->sendSuccessResponse2(1,200,$returnPayments);
                }
            }
            else{
                $returnPayments['mysql_message'] = 'Error';
                $this->sendSuccessResponse2(1,200,$returnPayments);
            }
        }
        else{
            $returnPayments['message'] = 'User id is not set.';
            $this->sendSuccessResponse2(1,200,$returnPayments);
        }
    }

    public function actionUploadImages(){

        $params = $this->parseRequest();
        $user = Users::find()->where(['id'=>$params['userId']])->one();
        if($user){
            $img = $params['file'];
            $img = str_replace(' ', '+', (str_replace('data:image/png;base64,', '', $img)));
            $data = base64_decode($img);
            $dir = __DIR__ .'\\images\\users\\';
            $dir = preg_replace('/\\\\/', '/', $dir);
            //print_r();
            $dir = str_replace('/api/controllers','',$dir);
            //exit;
            //Relative path to the directory
            $path = 'http://'
                . $_SERVER['HTTP_HOST']
                . 'images/users/';
            $file = $dir . $params['userId'] . '.png';
            $upload_attempt = file_put_contents($file, $data);
            if(!$upload_attempt) {
                $this->sendSuccessResponse2(1,200,['msg' => 'Image upload failure.']);
            }
            else {
                $image = $path . $params['userId'] . '.png';
                $user->imageURL = $image;
                if($user->save()) {
                    $this->sendSuccessResponse2(1,200,['img_name' => $image]);
                }
                else {
                    print_r($user->errors);
                    exit;
                    $this->sendSuccessResponse2(1,200,['mysql_msg'=>'Error']);
                }
            }

        }
        else{
            $this->sendSuccessResponse2(1,200,['status'=>'0','mysql_msg'=>'Error']);
        }
    }

}