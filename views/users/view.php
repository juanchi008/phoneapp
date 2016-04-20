<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\models\Users;

/* @var $this yii\web\View */
/* @var $model app\models\Users */

$this->title = $model->nombre;
$this->params['breadcrumbs'][] = ['label' => 'Admins', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->nombre, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Info';
?>
<section id="content">
<div class="container">

<div class="users-view">
    <h1>Info: <?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
			'nombre',
			'email:email',
            'nombre_usuario',
            'contrasena',
			'role',
			[
				'label' => $model->getAttributeLabel('is_super_admin'),
				'value' => Yii::$app->fn->GetYesNo($model->is_super_admin),
			],
			'auth_key',
			'password_reset_token',
			[
				'label' => $model->getAttributeLabel('id_estado'),
				'value' => Yii::$app->fn->GetAdminStatus($model->id_estado),
			],
            'fecha_registro',
			[
				'label' => $model->getAttributeLabel('fecha_conexion'),
				'value' => Yii::$app->fn->GetDate($model->fecha_conexion),
			],
			[
				'label' => $model->getAttributeLabel('fecha_modif'),
				'value' => Yii::$app->fn->GetDate($model->fecha_modif),
			],
        ],
    ]) ?>

</div>

</div>
</section>
</div>