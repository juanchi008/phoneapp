<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\models\Paises;

/* @var $this yii\web\View */
/* @var $model app\models\Clientes */

$this->title = $model->nombre;
$this->params['breadcrumbs'][] = ['label' => 'Clientes', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->nombre, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Info';
?>
<section id="content">
<div class="container">

<div class="clientes-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
    	<?php if( Yii::$app->user->Identity->isAdmin()) {?>
	        <?= Html::a('PDF', ['viewpdf', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
	        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
	            'class' => 'btn btn-danger',
	            'data' => [
	                'confirm' => 'Are you sure you want to delete this item?',
	                'method' => 'post',
	            ],
	        ]) ?>
    	<?php }?>
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
            'auth_key',
            'password_reset_token',
			[
				'label' => $model->getAttributeLabel('id_estado'),
				'value' => Yii::$app->fn->GetClienteStatus($model->id_estado),
			],
            'estado_civil',
			'numero_oficina',
            'direccion',
            'ciudad',
            'provincia',
			[
				'label' => $model->getAttributeLabel('id_pais'),
				'value' =>$model->getPais(),
			],
            'codigo_postal',
            'numero_casa',
            'numero_movil',
            'cargo_trabajo',
			'numero_trabajo',
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