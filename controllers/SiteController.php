<?php

namespace app\controllers;

use Yii;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\Identity;
use app\components\AccessRule;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use app\controllers\BaseController;
use app\components\ChronoMailer;

class SiteController extends BaseController
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
            	'ruleConfig' => [
            		'class' => AccessRule::className(),
            	],
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => [
                        	Identity::ROLE_CLIENTES,
                        	Identity::ROLE_ADMIN,
                        	Identity::ROLE_SUPERADMIN
                        ],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

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
        return $this->render('index');
    }

    public function actionLogin()
    {
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();
        
        if(Yii::$app->session->has('user.role')) {
    		Yii::$app->session->set('user.role',0);
    	}
        
        if(Yii::$app->getRequest()->getCookies()->has('user_role')) {
            Yii::$app->getResponse()->getCookies()->remove('user_role');
        }

        return $this->goHome();
    }

    public function actionContact()
    {
    	// AJAX : see Validation
        $model = new ContactForm();
        
        return $this->render('contact', [
            'model' => $model,
        ]);
    }
    public function actionContactajax()
    {
    	// FORMAT_HTML , FORMAT_JSON , FORMAT_JSONP , FORMAT_RAW , FORMAT_XML
    	Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
    	
        $model = new ContactForm();
        $isModelLoaded = $model->load(['ContactForm' => Yii::$app->request->post()] );
        
        if ($isModelLoaded && $model->validate() ) {

        	// SET email variables
        	$body = "";
        	$body .= "From: ". $model->name."<br/>";
        	$body .= "E-mail: ". $model->email."<br/>";
        	$body .= "Phone: ". $model->phone."<br/>";
        	$model->body = $body."<br/>". strip_tags($model->body)."<br/>";
        	
        	$model->subject = "[Contact-Form] ".$model->subject;
        	
        	// SET email settings
        	$mail = new ChronoMailer("utf-8");
        	$mail->From(Yii::$app->params['adminEmail']);
        	$mail->To(Yii::$app->params['adminEmail']);
        	$mail->Cc(Yii::$app->params['partnerEmail']);
        	//$mail->Bcc(Yii::$app->params['partnerEmail']);
        	$mail->Subject($model->subject);
        	$mail->Body($model->body,'html');
        	
        	// OPTIONAL SEND-METHOD :: SMTP 
        	//$mail->smtp_on( 'smtp.copaco.com.py', 'gramacchi', 'ybudxrvv', '587');
        	//$mail->smtp_on( 'smtp-mail.outlook.com', 'juanchi_008manuel@hotmail.com', 'password', '587');
        	
        	// SET SMTP TYPE
        	if ( $mail->Send() ) {
        		return 'success';
        	}
        	else {
        		return $mail->status_mail['message'];
        	}
        }
        $msg = "";
        //$msg .= "Yii::app->request->isAjax = ".Yii::$app->request->isAjax.'<br/>';
        //$msg .= "isModelLoaded = ".$isModelLoaded.'<br/>';
        foreach ($model->errors as $errorField => $errorList) {

        	if ( is_string($errorList) ) {
        		$msg .= $errorField. ' : '. $errorList. '<br/>';
        	}
        	elseif ( is_array($errorList) ) {
	        	foreach ($errorList as $errorMsg){
	        		$msg .= $errorField. ' : '. $errorMsg. '<br/>';
	        	}
        	}
        }
        return $msg; 
    }

    public function actionAbout()
    {
        return $this->render('about');
    }

    public function actionCatalogo()
    {
    	$models = Autos::find()->all();
    	
    	return $this->render('catalogo', [
    			'models' => $models,
    	]);
    }
}
