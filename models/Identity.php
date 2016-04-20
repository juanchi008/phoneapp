<?php

namespace app\models;

use Yii;
use app\models\Clientes;
use yii\base\NotSupportedException;
use yii\web\IdentityInterface;
use app\components\Fn;

class Identity extends \yii\base\Object implements IdentityInterface
{
	/*
    public $id;
    public $nombre_usuario;
    public $contrasena;
    public $authKey;
    public $accessToken;
	*/
	public $data = [];
	
    const ROLE_USER = 10;
    const ROLE_CLIENTES = 20;
    const ROLE_ADMIN = 30;
    const ROLE_SUPERADMIN = 40;
    
    // Interface methods
    
    /** INCLUDE USER LOGIN VALIDATION FUNCTIONS**/
    
    /**
     * @inheritdoc
     */
    public static function findOneCustom($condition, $checkRole = null)
    {
    	// FIND ROLE
    	$rolePrevious = 0;
    	$roleSession = $rolePrevious;
    	$roleCookie = $rolePrevious;
    	$model = null;
    	
    	// SET Role: by MANUALLY. Default: at user requested time
    	if(!is_null($checkRole)) {
    		$rolePrevious = $checkRole;
    		Yii::$app->session->set('user.role', $rolePrevious);
    	}
    	
    	// Check Role: by PHP session. Default: at every loading page
    	if(Yii::$app->session->has('user.role')) {
    		$rolePrevious = intval(Yii::$app->session->get('user.role'));
    		$roleSession = $rolePrevious;
    	}
    	// Check Role: by BROWSER. Default: at every loading page
    	elseif(Yii::$app->getRequest()->getCookies()->has('user_role')) {
    		$rolePrevious = intval(Yii::$app->getRequest()->getCookies()->getValue('user_role'));
    		$roleCookie = $rolePrevious;
    		Yii::$app->session->set('user.role',$rolePrevious);
    	}

    	// FIND USER BY SELECTED ROLE
    	if($rolePrevious) {
    		$user = null;
    		if( $rolePrevious >= static::ROLE_ADMIN)
    			$user =  Users::findOne($condition);
    		elseif($rolePrevious >= static::ROLE_CLIENTES)
    			$user =  Clientes::findOne($condition);

    		if($user) {
    			$model = new Identity();
    			$model->data = $user->attributes;
    			$model->data['id'] = $user->getPrimaryKey();

    			// IF ALREADY LOGGED - RESTORE current user logged in ROLE
    			if($rolePrevious != $model->role) {
    				
    				// UPDATE: Role: PHP Session: at runtime
	    			if( $roleSession)
	    				Yii::$app->session->set('user.role', $model->role);
    				// UPDATE: Role: COOKIE: at runtime
	    			if( $roleCookie){
			        	Yii::$app->getResponse()->getCookies()->add(new \yii\web\Cookie([
							'name' => 'user_role',
							'value' => (string)$model->role,
			    			'expire' => time() + (3600*24*30),
						]));
			        }
    			}
    		}
    	}
    	
    	// RETURN a searched user found or null if not
    	return $model;
    }
    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
    	return static::findOneCustom($id);
    }
    
    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
    	return static::findOneCustom(['access_token' => $token]);
    }

    /**
     * Finds user by username
     *
     * @param  string      $nombre_usuario
     * @return static|null
     */
    public static function findByUsername($nombre_usuario)
    {
    	return static::findOneCustom(['nombre_usuario' => $nombre_usuario]);
    }

    /**
     * Finds user by email
     *
     * @param  string      $email
     * @return static|null
     */
    public static function findByEmail($email)
    {
    	return static::findOneCustom(['email' => $email]);
    }

    /**
     * Finds user by password reset token
     *
     * @param  string      $token password reset token
     * @return static|null
     */
    public static function findByPasswordResetToken($token)
    {
    	$expire = Yii::$app->params['user.passwordResetTokenExpire'];
    	$parts = explode('_', $token);
    	$timestamp = (int) end($parts);
    	if ($timestamp + $expire < time()) {
    		// token expired
    		return null;
    	}
    
    	return static::findOneCustom(['password_reset_token' => $token]);
    }
    
    /**
     * @inheritdoc
     */
    public function getId()
    {
    	return $this->id;
    }
    
    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
    	return $this->auth_key;
    }
    
    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
    	return $this->getAuthKey() === $authKey;
    }

    /**
     * Validates password
     *
     * @param  string  $password password to validate
     * @return boolean if password provided is valid for current user
     */
    public function validatePassword($password)
    {
    	//return $this->password === sha1($password);//$password;
    	//return Security::validatePassword($password, $this->password_hash);
    	return Yii::$app->getSecurity()->validatePassword($password, $this->contrasena);
    }

    /**
     * @inheritdoc
     */
    public function GetRole( $roleId = -1, $currentUser = true) {
    	$keys = [
    		self::ROLE_CLIENTES => 'Clientes',
    		self::ROLE_ADMIN => 'Admin',
    		self::ROLE_SUPERADMIN => 'Super Admin',
    	];
    	
    	if ($currentUser)
    		$roleId = $this->role;
    
    	if(array_key_exists($roleId, $keys))
    		return $keys[$roleId];
    	elseif($roleId == -1 || is_null($roleId))
    		return $keys;
    	else
    		'N/D';
    }
    
    /**
     * @inheritdoc
     */
    public function isCliente() {
    	if( $this->role == self::ROLE_CLIENTES)
    		return true;
    	else
    		return false;
    }
    
    /**
     * @inheritdoc
     */
    public function isAdmin() {
    	if( $this->role == self::ROLE_ADMIN || $this->role == self::ROLE_SUPERADMIN)
    		return true;
    	else
    		return false;
    }
    
    /**
     * @inheritdoc
     */
    public function isSuperadmin() {
    	if( $this->role == self::ROLE_SUPERADMIN)
    		return true;
    	else
    		return false;
    }

    /**
     * @inheritdoc
     */
    public function __set ( $name , $value ) {
    	$this->data[$name] = $value;
    }

    /**
     * @inheritdoc
     */
    public function __get ( $name ) {
    	if (array_key_exists($name, $this->data)) {
    		return $this->data[$name];
    	}
    	return null;
    }

    /**
     * @inheritdoc
     */
    public function __isset ( $name ) {
    	return isset($this->data[$name]);
    }

    /**
     * @inheritdoc
     */
	public function __unset ( $name ) {
    	if (array_key_exists($name, $this->data)) {
    		unset($this->data[$name]);
    	}
	}
    
}
