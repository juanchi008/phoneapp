<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "users".
 *
 * @property integer $id
 * @property string $nombre_usuario
 * @property string $contrasena
 * @property string $nombre
 * @property string $email
 * @property string $fecha_registro
 * @property string $fecha_conexion
 * @property string $fecha_modif
 * @property integer $id_estado
 * @property string $auth_key
 * @property string $password_reset_token
 * @property integer $role
 * @property integer $is_super_admin
 *
 * @property Contratos[] $contratos
 * @property Ventas[] $ventas
 */
class Users extends ActiveRecord
{
	// Temporary variables
	public $passwordConfirm = '';
	
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'users';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
			// required
			[['nombre_usuario', 'nombre', 'email', 'fecha_registro', 'fecha_conexion', 'fecha_modif', 'id_estado', 'role', 'is_super_admin'], 'required'],
			
			//default value
			
			// Validation: PHP
			[['contrasena', 'passwordConfirm'], 'required', 'on' => 'register'],
			[['passwordConfirm'], 'compare', 'compareAttribute' => 'contrasena', 'skipOnEmpty' => false],
			[['contrasena'], 'string','min' => 8, 'max' => 75],
			[['auth_key'], 'string','min' => 8, 'max' => 32],
			[['password_reset_token'], 'string','min' => 1, 'max' => 255],
			
			[['nombre_usuario','nombre'], 'string','min' => 8, 'max' => 50],
			[['role','is_super_admin', 'id_estado'], 'integer'],
			[['fecha_conexion', 'fecha_modif'], 'string','min' => 10, 'max' => 20],
			[['fecha_registro'],'date', 'format'=>'yyyy-MM-dd'],
			[['nombre_usuario','email','contrasena','nombre'], 'filter', 'filter' => 'trim'],
			[['email'], 'email'],
				
			// Validation : MySQL
			[['nombre_usuario','email'], 'unique']
        		
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nombre_usuario' => 'Nombre Usuario',
            'contrasena' => 'Contrasena',
            'nombre' => 'Nombre',
            'email' => 'Email',
            'fecha_registro' => 'Registro',
            'fecha_conexion' => 'Conexion',
            'fecha_modif' => 'Modif',
            'id_estado' => 'Estado',
            'auth_key' => 'Auth Key',
            'password_reset_token' => 'Password Reset Token',
            'role' => 'Role',
            'is_super_admin' => 'Super Admin',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getContratos()
    {
        return $this->hasMany(Contratos::className(), ['id_admin' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVentas()
    {
        return $this->hasMany(Ventas::className(), ['id_admin' => 'id']);
    }

    public static function findAllForDropDownList() {
    	$models = Users::find()->orderBy('nombre')->all();
    	$listData = [];
    
    	foreach($models as $model) {
    		if(intval($model->id) )
    			$listData[$model->id] = $model->nombre;
    	}
    	return $listData;
    }

    // Interface methods
    
    /** INCLUDE USER LOGIN VALIDATION FUNCTIONS**/
    
    /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     */
    public function setPassword($contrasena = null)
    {
    	$contrasena = (is_null($contrasena)) ? $this->contrasena : $contrasena;
    	$this->contrasena = Yii::$app->getSecurity()->generatePasswordHash($contrasena); //Security::generatePasswordHash($password);//$password;
    }
    
    /**
     * Generates "remember me" authentication key
     */
    public function generateAuthKey()
    {
    	$this->auth_key = Yii::$app->getSecurity()->generateRandomString(); //Security::generateRandomKey();
    }
    
    /**
     * Generates new password reset token
     */
    public function generatePasswordResetToken()
    {
    	$this->password_reset_token = Yii::$app->getSecurity()->generateRandomString() . '_' . time(); //Security::generateRandomKey() . '_' . time();
    }
    
    
    /**
     * Removes password reset token
     */
    public function removePasswordResetToken()
    {
    	$this->password_reset_token = '0';
    }
    
    /**
     * @inheritdoc
     */
    public function save($runValidation = false, $attributeNames = null)
    {
    	if($this->isNewRecord) {
    		//$this->fecha_conexion = '0000-00-00 00:00:00';
    		//$this->fecha_modif = '0000-00-00 00:00:00';
    		$this->fecha_registro = Yii::$app->fn->GetDate();
    	}
    	else {
    		//$this->fecha_conexion = Yii::$app->fn->GetDateTime();
    		$this->fecha_modif = Yii::$app->fn->GetDate();
    	}
    	return parent::save($runValidation, $attributeNames);
    	//return false;
    }
}
