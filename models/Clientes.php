<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "clientes".
 *
 * @property integer $id
 * @property string $nombre_usuario
 * @property string $contrasena
 * @property string $nombre
 * @property string $email
 * @property string $estado_civil
 * @property string $direccion
 * @property string $numero_oficina
 * @property string $ciudad
 * @property string $provincia
 * @property integer $id_provincia
 * @property string $codigo_postal
 * @property integer $id_pais
 * @property string $numero_casa
 * @property string $numero_trabajo
 * @property string $numero_movil
 * @property string $cargo_trabajo
 * @property string $fecha_registro
 * @property string $fecha_conexion
 * @property string $fecha_modif
 * @property integer $id_estado
 * @property string $password_reset_token
 * @property integer $role
 * @property string $auth_key
 *
 * @property Estados $idEstado
 * @property Paises $idPais
 * @property Provincias $idProvincia
 * @property Contratos[] $contratos
 * @property Ventas[] $ventas
 */
class Clientes extends ActiveRecord
{
	// Temporary variables
	public $passwordConfirm = '';
	
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'clientes';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
			// required
			[['nombre_usuario', 'nombre', 'email', 'estado_civil', 'direccion', 'ciudad', 'codigo_postal', 'id_pais', 'numero_casa', 'fecha_registro', 'fecha_conexion', 'fecha_modif', 'id_estado', 'role'], 'required'],
			[['provincia'], 'safe'],
			//default value
			
			// Validation: PHP
			[['contrasena', 'passwordConfirm'], 'required', 'on' => 'register'],
			[['passwordConfirm'], 'compare', 'compareAttribute' => 'contrasena', 'skipOnEmpty' => false],
			[['contrasena'], 'string','min' => 8, 'max' => 75],
			[['auth_key'], 'string','min' => 8, 'max' => 32],
			[['password_reset_token'], 'string','min' => 1, 'max' => 255],
			
            [['nombre_usuario', 'nombre', 'email', 'estado_civil', 'direccion', 'numero_oficina', 'ciudad', 'provincia', 'codigo_postal', 'cargo_trabajo'], 'string','min' => 3, 'max' => 50],
            [['numero_casa', 'numero_trabajo', 'numero_movil'], 'string', 'max' => 20],
			[['role','id_provincia', 'id_pais', 'id_estado'], 'integer'],
			[['fecha_registro', 'fecha_conexion', 'fecha_modif'], 'string','min' => 10, 'max' => 20],
			[['fecha_registro', 'fecha_conexion', 'fecha_modif'],'date', 'format'=>'yyyy-MM-dd'],
			[['nombre_usuario','email','contrasena','nombre'], 'filter', 'filter' => 'trim'],
			[['email'], 'email'],
				
			// Validation : MySQL
			[['nombre_usuario','email'], 'unique']
        		
        ];
        // ---------------------------------------------
        /*
        return [
            [['nombre_usuario', 'contrasena', 'nombre', 'email', 'estado_civil', 'direccion', 'ciudad', 'id_provincia', 'codigo_postal', 'id_pais', 'numero_casa', 'fecha_registro', 'fecha_conexion', 'fecha_modif', 'id_estado'], 'required'],
            [['id_provincia', 'id_pais', 'id_estado', 'role'], 'integer'],
            [['fecha_registro', 'fecha_conexion', 'fecha_modif'], 'safe'],
            [['nombre_usuario', 'nombre', 'email', 'estado_civil', 'direccion', 'numero_oficina', 'ciudad', 'provincia', 'codigo_postal', 'cargo_trabajo'], 'string', 'max' => 50],
            [['contrasena'], 'string', 'max' => 75],
            [['numero_casa', 'numero_trabajo', 'numero_movil'], 'string', 'max' => 20],
            [['password_reset_token'], 'string', 'max' => 255],
            [['auth_key'], 'string', 'max' => 32]
        ];
        */
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
            'passwordConfirm' => 'Contrasena comparacion',
            'nombre' => 'Nombre',
            'email' => 'Email',
            'estado_civil' => 'Estado Civil',
            'direccion' => 'Direccion',
            'numero_oficina' => 'Numero Oficina',
            'ciudad' => 'Ciudad',
            'id_provincia' => 'Provincias (lista)',
            'provincia' => 'Provincia',
            'codigo_postal' => 'Codigo Postal',
            'id_pais' => 'Pais',
            'numero_casa' => 'Numero Casa',
            'numero_trabajo' => 'Numero Trabajo',
            'numero_movil' => 'Numero Movil',
            'cargo_trabajo' => 'Cargo Trabajo',
            'fecha_registro' => 'Registro',
            'fecha_conexion' => 'Conexion',
            'fecha_modif' => 'Modif',
            'id_estado' => 'Estado',
            'password_reset_token' => 'Password Reset Token',
            'role' => 'Role',
            'auth_key' => 'Auth Key',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdEstado()
    {
        return $this->hasOne(Estados::className(), ['id' => 'id_estado']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdPais()
    {
        return $this->hasOne(Paises::className(), ['id' => $this->id_pais]);
    }
    public function getPais()
    {
        return Paises::findOne( ['id' => $this->id_pais])->nombre_pais;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdProvincia()
    {
        return $this->hasOne(Provincias::className(), ['id' => 'id_provincia']);
    }
    public function getProvincia()
    {
        return Provincias::findOne( ['id' => $this->id_provincia])->nombre_provincia;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getContratos()
    {
        return $this->hasMany(Contratos::className(), ['id_usuario' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVentas()
    {
        return $this->hasMany(Ventas::className(), ['id_usuario' => 'id']);
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
