<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "admins".
 *
 * @property integer $id
 * @property string $nombre_admin
 * @property string $contrasena
 * @property string $nombre
 * @property string $email
 * @property string $fecha_registro
 * @property string $fecha_conexion
 * @property string $fecha_modif
 * @property integer $id_estado
 *
 * @property Contratos[] $contratos
 * @property Ventas[] $ventas
 */
class Admins extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'admins';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'nombre_admin', 'contrasena', 'nombre', 'email', 'fecha_registro', 'fecha_conexion', 'fecha_modif', 'id_estado'], 'required'],
            [['id', 'id_estado'], 'integer'],
            [['fecha_registro', 'fecha_conexion', 'fecha_modif'], 'safe'],
            [['nombre_admin', 'nombre', 'email'], 'string', 'max' => 50],
            [['contrasena'], 'string', 'max' => 75]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nombre_admin' => 'Nombre Admin',
            'contrasena' => 'Contrasena',
            'nombre' => 'Nombre',
            'email' => 'Email',
            'fecha_registro' => 'Fecha Registro',
            'fecha_conexion' => 'Fecha Conexion',
            'fecha_modif' => 'Fecha Modif',
            'id_estado' => 'Id Estado',
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
}
