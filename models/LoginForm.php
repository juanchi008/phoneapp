<?php

namespace app\models;

use Yii;
use yii\base\Model;
use app\components\Fn;

/**
 * LoginForm is the model behind the login form.
 */
class LoginForm extends Model
{
    public $nombre_usuario;
    public $contrasena;
    public $rememberMe = true;
    private $_user = false;


    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // nombre_usuario and contrasena are both required
            [['nombre_usuario', 'contrasena'], 'required'],
            // rememberMe must be a boolean value
            ['rememberMe', 'boolean'],
            // contrasena is validated by validatePassword()
            ['contrasena', 'validatePassword'],
        ];
    }

    /**
     * Validates the contrasena.
     * This method serves as the inline validation for contrasena.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();

            if (!$user) {
                $this->addError($attribute, 'Nombre de Usuario no encontrado');
            }
            elseif (!$user || !$user->validatePassword($this->contrasena)) {
                $this->addError($attribute, 'Nombre de Usuario o Contraseña Incorrecta');
            }
        }
    }

    /**
     * Logs in a user using the provided nombre_usuario and contrasena.
     * @return boolean whether the user is logged in successfully
     */
    public function login()
    {
    	// ERROR :: HTML FORM 
        if (!$this->validate()) {
        	return false;
        }
        // ERROR :: LOGIN
        elseif (!Yii::$app->user->login($this->getUser(), $this->rememberMe ? 3600*24*30 : 0) ) {
			return false;
        }
        
        // -----------------
        // SUCCESS :: LOGIN
        // -----------------
        
        // SAVE OFFLINE user login
        if($this->rememberMe) {
        	Yii::$app->getResponse()->getCookies()->add(new \yii\web\Cookie([
				'name' => 'user_role',
				'value' => (string)$this->_user->role,
    			'expire' => time() + (3600*24*30),
			]));
        }
        // DELETE OFFLINE user login
        elseif(Yii::$app->getRequest()->getCookies()->has('user_role')) {
            Yii::$app->getResponse()->getCookies()->remove('user_role');
        }
        return true;
    }

    /**
     * Finds user by [[nombre_usuario]]
     *
     * @return User|null
     */
    public function getUser()
    {
    	
        if ($this->_user === false) {

        	// IF user Admin/SuperAdmin
	        Yii::$app->session->set('user.role',Identity::ROLE_ADMIN);
            $this->_user = Identity::findByUsername($this->nombre_usuario);

            // IF user Courtier
            if(!$this->_user) {
		        Yii::$app->session->set('user.role',Identity::ROLE_CLIENTES);
            	$this->_user = Identity::findByUsername($this->nombre_usuario);
            
	            // IF user GUEST
		        if(!$this->_user) {
				    Yii::$app->session->set('user.role',0);
		        }
            }
        }
    	
        return $this->_user;
    }
}
