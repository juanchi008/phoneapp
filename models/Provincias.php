<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "provincias".
 *
 * @property integer $id
 * @property string $nombre_provincia
 *
 * @property Usuarios[] $usuarios
 */
class Provincias extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'provincias';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nombre_provincia'], 'required'],
			[['nombre_provincia'], 'unique'],
            [['nombre_provincia'], 'string', 'max' => 50],
            [['id'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nombre_provincia' => 'Nombre Provincia',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsuarios()
    {
        return $this->hasMany(Usuarios::className(), ['id_provincia' => 'id']);
    }

    public static function findAllForDropDownList() {
    	$models = Provincias::find()->orderBy('nombre_provincia')->all();
    	$listData = [];
    
    	foreach($models as $model) {
    		if(intval($model->id) )
    			$listData[$model->id] = $model->nombre_provincia;
    	}
    	return $listData;
    }
}
