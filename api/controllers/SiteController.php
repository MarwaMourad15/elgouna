<?php
namespace api\controllers;

use backend\models\HomeSlider;
use backend\models\Newsletter;
use backend\models\Patient;
use backend\models\Sport;
use Yii;
use common\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;


/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function actionIndex()
    {
        echo date("y-m-d H:i:s");
        return  "Testing Domain............";
    }


    public function actionSendNotification()
    {
        echo phpinfo();die;
       // $push_tokens='ckcCl0C1I0U:APA91bGGuWod7gVt8FEZBTA8vQq3DjxH1y33VxGqgvLaup0odFtnlZaqTKwht8mnNYOdXN3LU8YtmnB_UvtftO8lvfwO7Cxeh41lxNa1MOTd3PJshYhod0k__cqZjvkCa5CfMo9Vyf0v';
        //$push_tokens='cfrmvXyzmNQ:APA91bHTGJXLF9k1golAWTS0soadQPgTuWutTookDQRHDIiQiTm_Q6YH48IiTZXg1DQ1QFYQhDC__swdbEspNc2AP7gD6oqMF_KjNcTkBvdI2Pi0Sxlwz0Qk1W4GC5eSxJm5YMVPzSR8';
        $push_tokens='b5bbfe5b46f0813b710ba532a762e350565d3f7b122ff9c747a4e23e09135379';
        $message = 'testing push notification from app';
        /* @var $apnsGcm \bryglen\apnsgcm\ApnsGcm */
        $apnsGcm = Yii::$app->apnsGcm;
        $out = $apnsGcm->send(\bryglen\apnsgcm\ApnsGcm::TYPE_APNS, $push_tokens, $message,
            [
                'customerProperty' => 1
            ],
            [
               // 'timeToLive' => 3
            ]);

        print_r($out);
    }

    public function actionLogin()
    {
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionContact()
    {
        $model = new ContactForm();
        if(isset($_GET['action'])) {
            if ($_GET['action'] == 'contact') {
                $url = $_GET['url'];
                $email = $_GET['email'];
                $name = $_GET['name'];
                $body = $_GET['body'];

                $emailToSend = Helper::getSettingObj('email_scs');
                if($emailToSend=='') {
                    $emailToSend = Yii::$app->params['adminEmail'];
                }

                $model->email = $email;
                $model->name = $name;
                $model->body = $body;
                if ($model->validate()) {
                    if ($model->sendEmail($emailToSend)) {
                        Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
                    } else {
                        Yii::$app->session->setFlash('error', 'There was an error sending email.');
                    }
                    return $this->redirect($url . '#contact');
                } else {
                    Yii::$app->session->setFlash('error', 'There was an error sending email.');
                    return $this->redirect($url . '#contact');
                }
            }
        }
        return $this->refresh();
    }
    public function actionSubscribe()
    {
        if(isset($_GET['action'])) {
            $model = new Newsletter();
            if ($_GET['action'] == 'subscribe') {
                $url = $_GET['url'];
                $email = $_GET['email'];
                $model->email = $email;
                if(!$model->save())
                {
                    Yii::$app->session->setFlash('error', $model->getFirstError('email'));
                    return $this->redirect($url.'#subscribe');
                }
                else {
                    Yii::$app->session->setFlash('success', 'Thank you for subscribe');
                    return $this->redirect($url.'#subscribe');
                }
            }
        }
        return $this->refresh();

        /*if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
                Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
            } else {
                Yii::$app->session->setFlash('error', 'There was an error sending email.');
            }

            return $this->refresh();
        } else {
            return $this->render('contact', [
                'model' => $model,
            ]);
        }*/
    }

    public function actionAbout()
    {
        return $this->render('about');
    }

    public function actionSignup()
    {
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->signup()) {
                if (Yii::$app->getUser()->login($user)) {
                    return $this->goHome();
                }
            }
        }

        return $this->render('signup', [
            'model' => $model,
        ]);
    }

    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->getSession()->setFlash('success', 'Check your email for further instructions.');

                return $this->goHome();
            } else {
                Yii::$app->getSession()->setFlash('error', 'Sorry, we are unable to reset password for email provided.');
            }
        }

        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }

    public function actionResetPassword($token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->getSession()->setFlash('success', 'New password was saved.');

            return $this->goHome();
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }
    public function actionKhalenatNtestKhalena (){
        if(Yii::$app->request->isPost){
            $action = $_POST['action'];
            $data = $_POST['params'];
            //echo $action;
            //echo $data;
            $url = '';
            if ($action == 0)
                $url='http://www.hitechawy.com/yadoctory/yadoctory/api/web/patient/register';
            if ($action == 1)
                $url='http://www.hitechawy.com/yadoctory/yadoctory/api/web/patient/activate-account';
            if ($action == 2)
                $url='http://www.hitechawy.com/yadoctory/yadoctory/api/web/patient/forgot';
            if ($action == 3)
                $url='http://www.hitechawy.com/yadoctory/yadoctory/api/web/patient/login';
            $handle = curl_init($url);
            curl_setopt($handle, CURLOPT_CUSTOMREQUEST, "POST");
            curl_setopt($handle,CURLOPT_HEADER,array('Content-Type:application/json'));
            curl_setopt($handle, CURLOPT_POSTFIELDS, $data);
            curl_exec($handle);
        }
        else {
            return $this->render('testForm', []);
        }
    }

    public function actionSendEmail()
    {
        $user = new Patient();
        $user->email = 'marwa_mourad_2011@yahoo.com';
        $user->fullName = 'Marwa Mourad';
        $user->activation_code = '2345676543';

        $message = '
<div class="container" style="width: 90%; background-color: #f2f2f2; margin: 0 auto;">
    <div class="content" style="padding-bottom: 30px;padding-top: 30px;padding-left: 2%">

        <h2 style="color: #2d2d2d; font-weight: 600;">Welcome To Ya doctory!</h2>
        <p style="color: #545151;">
            Hello <span>Marwa Mourad Static</span>,
            <br>
            Thank You For Joining! We\'re Glad To Have You As A Community Member,And We\'re Stoked For You To Start
            Exploring Our Services.
            <br>
            All We Need To Do Is Activate Your Account By Coping This Code
            <br>
            activation code:
            <br>
            <span style="background-color: #1b6997; border: 1px solid #1b6997; width: 120px; height: 30px; color: white;
            font-weight: bolder; display: block; text-align: center; line-height: 30px; margin-top: 10px">1234565432</span>
            <br>
        <h4>
            With All Regards,
            <br>
            Ya Doctory Team
        </h4>
        </p>
    </div>
</div>';
        /* @var $user User */


        $fromMail = 'marwa@fumestudio.com';
        $tomail = "marwa_mourad_2011@yahoo.com";

        $headers  = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
//$headers .= 'To: <' .$tomail .'>' . "\r\n";
        $headers .= 'From:'. $fromMail  . "\r\n";

        if (mail($tomail,'Activation code for ' . Yii::$app->name ,$message,$headers)){
            echo 'Done';
        }
        else{
            echo 'error';
        }

        /*echo Yii::$app->mailer->compose()
            ->setFrom('marwa.mourad.15@gmail.com')
            ->setTo($user->email)
            ->setHtmlBody($message)
            ->setSubject('Activation code for ' . Yii::$app->name)
            ->send();*/

    }
}
