<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "paises".
 *
 * @property integer $id
 * @property string $nombre_pais
 *
 * @property Usuarios[] $usuarios
 */
class Paises extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'paises';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'nombre_pais'], 'required'],
            [['id'], 'integer'],
            [['nombre_pais'], 'string', 'max' => 50]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nombre_pais' => 'Nombre Pais',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsuarios()
    {
        return $this->hasMany(Usuarios::className(), ['id_pais' => 'id']);
    }

    public static function findAllForDropDownList() {
    	$models = Paises::find()->orderBy('nombre_pais')->all();
    	$listData = [];
    
    	foreach($models as $model) {
    		if(intval($model->id) )
    			$listData[$model->id] = $model->nombre_pais;
    	}
    	return $listData;
    }
}
