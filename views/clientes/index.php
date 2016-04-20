<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ClientesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Clientes';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="clientes-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Clientes', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            //'nombre_usuario',
            //'contrasena',
            'nombre',
            'email:email',
            // 'estado_civil',
            // 'direccion',
            // 'numero_oficina',
            // 'ciudad',
            // 'provincia',
            // 'id_provincia',
            // 'codigo_postal',
            // 'id_pais',
            // 'numero_casa',
             'numero_trabajo',
            // 'numero_movil',
            // 'cargo_trabajo',
			[
				'attribute' => 'fecha_registro',
				'value' => function ($data) {
					return Yii::$app->fn->GetDateFromDateTime($data->fecha_registro);
				}
			],
            // 'fecha_conexion',
            // 'fecha_modif',
			[
				'attribute' => 'id_estado',
				'value' => function ($data) {
					return Yii::$app->fn->GetClienteStatus($data->id_estado);
				}
			],
            // 'password_reset_token',
            // 'role',
            // 'auth_key',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
