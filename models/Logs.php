<?php

namespace app\models;

use Yii;
use app\components\Fn;

/**
 * This is the model class for table "logs".
 *
 * @property integer $id
 * @property integer $nombre
 * @property integer $role
 * @property string $module
 * @property string $submodule
 * @property string $result
 * @property string $info
 * @property string $ip_address
 * @property string $fecha_registro
 * @property string $hora_registro
 */
class Logs extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'logs';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nombre', 'role', 'module', 'submodule', 'result', 'info'], 'required'],
            [['id'], 'safe', 'on' => 'register'],
            [['nombre', 'role', 'module', 'submodule', 'result', 'info'], 'string', 'max' => 100],
            [['ip_address'], 'string', 'max' => 20],
            [['fecha_registro', 'hora_registro'], 'string','min' => 5, 'max' => 20],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nombre' => 'Usuario',
            'role' => 'Role',
            'module' => 'Modulo',
            'submodule' => 'Sub Modulo',
            'result' => 'Resultado',
            'info' => 'Info',
            'ip_address' => 'Ip Address',
            'fecha_registro' => 'Fecha',
            'hora_registro' => 'Hora',
        ];
    }

    /**
     * @inheritdoc
     */
    public static function Add($nombre = null, $role = null, $module = null, $submodule = null, $result = null, $info = null )
    {
    	$model = new Logs();
    	$model->load( [
    		'Logs' => [

    			//'id' => 'ID',
    			'nombre' 			=> $nombre,
    			'role' 				=> $role,
    			'module' 			=> $module,
    			'submodule' 		=> $submodule,
    			'result' 			=> $result,
    			'info' 				=> $info,
    			'ip_address' 		=> $_SERVER['REMOTE_ADDR'],
    			'fecha_registro' 	=> Yii::$app->fn->GetDate('none'),
    			'hora_registro' 	=> date("h:m"),
    		]
    	]);
    	//Fn::PrintVar($model);
    	//exit;
    	$model->save();
    }
}
