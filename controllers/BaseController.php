<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;

class BaseController extends Controller
{
	
    public $noteMsg = array();
    public $noticeMsg = array();
    public $errorMsg = array();
    public $exitMsg = array();
    public $successMsg	= array();
    public $jsAlert	= array();

    public function beforeAction($action)
    {
    	//if ($action->id == 'my-method') {
    	Yii::$app->controller->enableCsrfValidation = false;

    	/*
    	$csrfActionList = [
    		'delete' => false,
    	];
    		
    	if ( array_key_exists($action->id, $csrfActionList)) {
    		Yii::$app->controller->enableCsrfValidation = $csrfActionList[$action->id];
    	}
    	*/
    	return parent::beforeAction($action);
    }
    
    public function init() {
    	parent::init();

    	if( Yii::$app->user->isGuest && $this->id != 'site' ) {
    
    		if( isset($this->actionParams['r']) && !strstr($this->actionParams['r'], 'pdf') && !strstr($this->actionParams['r'], 'activerAuto')) {
    			Yii::$app->session['errorMsg'] = array('Accès refusé ou session expirée. Veuillez vous connecter afin de poursuivre vos opérations.');
    			$this->redirect(array('/site/index'));
    			//print_r($this->id);
    			//print_r($this->getAction());
    		}
    	}
    	if(isset(Yii::$app->session['noteMsg']) ) {
    		$this->noticeMsg = Yii::$app->session['noteMsg'];
    		unset(Yii::$app->session['noteMsg']);
    	}
    	if(isset(Yii::$app->session['noticeMsg']) ) {
    		$this->noticeMsg = Yii::$app->session['noticeMsg'];
    		unset(Yii::$app->session['noticeMsg']);
    	}
    	if(isset(Yii::$app->session['errorMsg']) ) {
    		$this->errorMsg = Yii::$app->session['errorMsg'];
    		unset(Yii::$app->session['errorMsg']);
    	}
    	if(isset(Yii::$app->session['exitMsg']) ) {
    		$this->exitMsg = Yii::$app->session['exitMsg'];
    		unset(Yii::$app->session['exitMsg']);
    	}
    	if(isset(Yii::$app->session['successMsg']) ) {
    		$this->successMsg = Yii::$app->session['successMsg'];
    		unset(Yii::$app->session['successMsg']);
    	}
    	if(isset(Yii::$app->session['jsAlert']) ) {
    		$this->jsAlert = Yii::$app->session['jsAlert'];
    		unset(Yii::$app->session['jsAlert']);
    	}
    }

    /*
    public function actionEmail($params = array()) {
        $email = Yii::$app->email;
        $email->to = $params['to'];
        $email->from = $params['from'];
        $email->subject = utf8_decode($params['subject']);
        
        if( isset($params['cc']))
            $email->cc = $params['cc'];
        if( isset($params['bcc']))
            $email->bcc = $params['bcc'];
        if( isset($params['view']))
            $email->view = $params['view'];
        elseif( isset($params['message']))
            $email->message = $params['message'];

        if( isset($params['viewVars']))
            $email->viewVars = $params['viewVars'];
            
        $email->send();
    }
    */
    
    // ------------------------------
    // | OUTPUT	: Msg Manipulation  |
    // ------------------------------
    public function ShowMsgError($var)
    {
        echo '<div class="systemmsg"><div class="errormsg">';
    
        if(is_array($var))
        {
    	    foreach($var as $key => $value)
    	        echo '<p>'.$value.'</p>';
        }
        else
        	echo '<p>'.$value.'</p>';
    
        echo '</div></div>';
    }
    
    public function ShowMsgSuccess($var)
    {
        echo '<div class="systemmsg"><div class="successmsg">';
    
        if(is_array($var))
        {
    	    foreach($var as $key => $value)
    	        echo '<p>'.$value.'</p>';
        }
        else
        	echo '<p>'.$value.'</p>';
    
        echo '</div></div>';
    }
    
    public function ShowMsgNotice($var)
    {
        echo '<div class="systemmsg"><div class="noticemsg">';
    
        if(is_array($var))
        {
    	    foreach($var as $key => $value)
    	        echo '<p>'.$value.'</p>';
        }
        else
        	echo '<p>'.$value.'</p>';
    
        echo '</div></div>';
    }
    
    public function ShowMsgNote($var)
    {
        echo '<div class="systemmsg"><div class="notemsg">';
    
        if(is_array($var))
        {
    	    foreach($var as $key => $value)
    	        echo '<p>'.$value.'</p>';
        }
        else
        	echo '<p>'.$value.'</p>';
    
        echo '</div></div>';
    }

    public function ShowJsAlert($var)
    {
        echo '<script type="text/javascript">'.
             'alert( "Avertissement\n\n" ';
    
        if(is_array($var))
        {
    	    foreach($var as $key => $value)
    	        echo '+ '.
    	        	 '\''.strip_tags($value).'\''. " + \"\\n\"";
        }
        else
        	echo '+ '.strip_tags($value);
    
        echo ');'.
             '</script>';
    }
}
