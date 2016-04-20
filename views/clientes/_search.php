<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ClientesSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="clientes-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'nombre_usuario') ?>

    <?= $form->field($model, 'contrasena') ?>

    <?= $form->field($model, 'nombre') ?>

    <?= $form->field($model, 'email') ?>

    <?php // echo $form->field($model, 'estado_civil') ?>

    <?php // echo $form->field($model, 'direccion') ?>

    <?php // echo $form->field($model, 'numero_oficina') ?>

    <?php // echo $form->field($model, 'ciudad') ?>

    <?php // echo $form->field($model, 'provincia') ?>

    <?php // echo $form->field($model, 'id_provincia') ?>

    <?php // echo $form->field($model, 'codigo_postal') ?>

    <?php // echo $form->field($model, 'id_pais') ?>

    <?php // echo $form->field($model, 'numero_casa') ?>

    <?php // echo $form->field($model, 'numero_trabajo') ?>

    <?php // echo $form->field($model, 'numero_movil') ?>

    <?php // echo $form->field($model, 'cargo_trabajo') ?>

    <?php // echo $form->field($model, 'fecha_registro') ?>

    <?php // echo $form->field($model, 'fecha_conexion') ?>

    <?php // echo $form->field($model, 'fecha_modif') ?>

    <?php // echo $form->field($model, 'id_estado') ?>

    <?php // echo $form->field($model, 'password_reset_token') ?>

    <?php // echo $form->field($model, 'role') ?>

    <?php // echo $form->field($model, 'auth_key') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
