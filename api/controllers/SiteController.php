<?php
namespace api\controllers;

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
   
}
