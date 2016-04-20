<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
//use yii\helpers\ArrayHelper;
//use app\models\Clientes;
use app\models\Provincias;
use app\models\Paises;

/* @var $this yii\web\View */
/* @var $model app\models\Clientes */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="clientes-form">

	<?php 
		if ($model->isNewRecord) {
			$hintPwd = 'Password should be at least 8 characters.';
		}
		else {
			$hintPwd = 'If no password change, leave it blank.';
		}
	?>
	
    <?php $form = ActiveForm::begin(); ?>

		<?php echo $form->errorSummary($model); ?>
	  	
	    <?php //echo $form->field($model, 'id')->textInput(['maxlength' => true]); ?>
	    
	    <?= $form->field($model, 'nombre')->textInput(['maxlength' => true]) ?>
	
	    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
	    
	    <?= $form->field($model, 'nombre_usuario')->textInput(['maxlength' => true]) ?>
	
	    <?= $form->field($model, 'contrasena')->passwordInput(['maxlength' => true])->hint($hintPwd); ?>
	
	    <?php echo $form->field($model, 'passwordConfirm')->passwordInput(['maxlength' => true]); ?>
	
	    <?= $form->field($model, 'estado_civil')->textInput(['maxlength' => true]) ?>
	
	    <?= $form->field($model, 'direccion')->textInput(['maxlength' => true]) ?>
	
	    <?= $form->field($model, 'numero_oficina')->textInput(['maxlength' => true]) ?>
	
	    <?= $form->field($model, 'ciudad')->textInput(['maxlength' => true]) ?>
	
    	<?php echo $form->field($model, 'id_provincia')->dropdownList(
	    		Provincias::findAllForDropDownList(),
	    		['prompt'=>'--- Otras ---']
    		); ?>
	    
	    <?= $form->field($model, 'provincia')->textInput(['maxlength' => true]) ?>
	    
    	<?php echo $form->field($model, 'id_pais')->dropdownList(
	    		Paises::findAllForDropDownList(),
	    		['prompt'=>'--- Select Status ---']
    		); ?>
	
	    <?= $form->field($model, 'codigo_postal')->textInput(['maxlength' => true]) ?>
	
	    <?= $form->field($model, 'numero_casa')->textInput(['maxlength' => true]) ?>
	    
	    <?= $form->field($model, 'numero_movil')->textInput(['maxlength' => true]) ?>
	
	    <?= $form->field($model, 'cargo_trabajo')->textInput(['maxlength' => true]) ?>
	
	    <?= $form->field($model, 'numero_trabajo')->textInput(['maxlength' => true]) ?>
	
	    <?php if (Yii::$app->user->identity->isAdmin()) : ?>
	    	
	    	<?php if (!$model->isNewRecord) : ?>
	    	
			    <?php echo $form->field($model, 'fecha_registro')->textInput(); ?>
			    
			    <?php echo $form->field($model, 'fecha_conexion')->textInput(); ?>
			    
			    <?php echo $form->field($model, 'fecha_modif')->textInput(); ?>
			    
			    <?= $form->field($model, 'password_reset_token')->textInput(['maxlength' => true]) ?>
			
			    <?= $form->field($model, 'role')->textInput() ?>
			
			    <?= $form->field($model, 'auth_key')->textInput(['maxlength' => true]) ?>
			    
	    	<?php endif; ?>
	    	
	    	<?php echo $form->field($model, 'id_estado')->dropdownList(
		    		Yii::$app->fn->GetAdminStatus(),
		    		['prompt'=>'--- Select Status ---']
	    		); ?>
	    		
	    <?php endif; ?>
	
	
	    <div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>

    <?php ActiveForm::end(); ?>

</div>
