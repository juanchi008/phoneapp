<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Users;

/**
 * UsersSearch represents the model behind the search form about `app\models\Users`.
 */
class UsersSearch extends Users
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'id_estado', 'role', 'is_super_admin'], 'integer'],
            [['id', 'nombre_usuario', 'contrasena', 'nombre', 'email', 'fecha_registro', 'fecha_conexion', 'fecha_modif', 'auth_key', 'password_reset_token'], 'safe'],
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
        $query = Users::find();

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
//            'fecha_conexion' => $this->fecha_conexion,
//            'fecha_modif' => $this->fecha_modif,
            'id_estado' => $this->id_estado,
            'role' => $this->role,
            'is_super_admin' => $this->is_super_admin,
        ]);

        $query->andFilterWhere(['like', 'nombre_usuario', $this->nombre_usuario])
            ->andFilterWhere(['like', 'contrasena', $this->contrasena])
            ->andFilterWhere(['like', 'nombre', $this->nombre])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'auth_key', $this->auth_key])
            ->andFilterWhere(['like', 'password_reset_token', $this->password_reset_token]);

        return $dataProvider;
    }
}
