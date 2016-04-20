<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\UsersSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Admins';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="users-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Users', ['create'], ['class' => 'btn btn-success']) ?>
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
			[
				'attribute' => 'fecha_registro',
				'value' => function ($data) {
					return Yii::$app->fn->GetDateFromDateTime($data->fecha_registro);
				}
			],
            // 'fecha_conexion',
            // 'fecha_modif',
            // 'auth_key',
            // 'password_reset_token',
            // 'role',
			[
				'attribute' => 'is_super_admin',
				'value' => function ($data) {
					return Yii::$app->fn->GetYesNo($data->is_super_admin);
				}
			],
			[
				'attribute' => 'id_estado',
				'value' => function ($data) {
					return Yii::$app->fn->GetAdminStatus($data->id_estado);
				}
			],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
