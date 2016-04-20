<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Admins;

/**
 * AdminsSearch represents the model behind the search form about `app\models\Admins`.
 */
class AdminsSearch extends Admins
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'id_estado'], 'integer'],
            [['nombre_admin', 'contrasena', 'nombre', 'email', 'fecha_registro', 'fecha_conexion', 'fecha_modif'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Admins::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'fecha_registro' => $this->fecha_registro,
            'fecha_conexion' => $this->fecha_conexion,
            'fecha_modif' => $this->fecha_modif,
            'id_estado' => $this->id_estado,
        ]);

        $query->andFilterWhere(['like', 'nombre_admin', $this->nombre_admin])
            ->andFilterWhere(['like', 'contrasena', $this->contrasena])
            ->andFilterWhere(['like', 'nombre', $this->nombre])
            ->andFilterWhere(['like', 'email', $this->email]);

        return $dataProvider;
    }
}
