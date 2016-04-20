<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Clientes;

/**
 * ClientesSearch represents the model behind the search form about `app\models\Clientes`.
 */
class ClientesSearch extends Clientes
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'id_provincia', 'id_pais', 'id_estado', 'role'], 'integer'],
            [['nombre_usuario', 'contrasena', 'nombre', 'email', 'estado_civil', 'direccion', 'numero_oficina', 'ciudad', 'provincia', 'codigo_postal', 'numero_casa', 'numero_trabajo', 'numero_movil', 'cargo_trabajo', 'fecha_registro', 'fecha_conexion', 'fecha_modif', 'password_reset_token', 'auth_key'], 'safe'],
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
        $query = Clientes::find();

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
            'id_provincia' => $this->id_provincia,
            'id_pais' => $this->id_pais,
            'fecha_registro' => $this->fecha_registro,
            'fecha_conexion' => $this->fecha_conexion,
            'fecha_modif' => $this->fecha_modif,
            'id_estado' => $this->id_estado,
            'role' => $this->role,
        ]);

        $query->andFilterWhere(['like', 'nombre_usuario', $this->nombre_usuario])
            ->andFilterWhere(['like', 'contrasena', $this->contrasena])
            ->andFilterWhere(['like', 'nombre', $this->nombre])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'estado_civil', $this->estado_civil])
            ->andFilterWhere(['like', 'direccion', $this->direccion])
            ->andFilterWhere(['like', 'numero_oficina', $this->numero_oficina])
            ->andFilterWhere(['like', 'ciudad', $this->ciudad])
            ->andFilterWhere(['like', 'provincia', $this->provincia])
            ->andFilterWhere(['like', 'codigo_postal', $this->codigo_postal])
            ->andFilterWhere(['like', 'numero_casa', $this->numero_casa])
            ->andFilterWhere(['like', 'numero_trabajo', $this->numero_trabajo])
            ->andFilterWhere(['like', 'numero_movil', $this->numero_movil])
            ->andFilterWhere(['like', 'cargo_trabajo', $this->cargo_trabajo])
            ->andFilterWhere(['like', 'password_reset_token', $this->password_reset_token])
            ->andFilterWhere(['like', 'auth_key', $this->auth_key]);

        return $dataProvider;
    }
}
