<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Users;

/* @var $this yii\web\View */
/* @var $model app\models\Users */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="users-form">
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
	
	    <?php if (Yii::$app->user->identity->isSuperadmin()) : ?>
	    	<?php echo $form->field($model, 'is_super_admin')->checkbox(); ?>
	    	
	    	<?php if (!$model->isNewRecord) : ?>
			    <?php echo $form->field($model, 'fecha_conexion')->textInput(); ?>
			    
			    <?php echo $form->field($model, 'fecha_modif')->textInput(); ?>
			
			    <?php echo $form->field($model, 'fecha_registro')->textInput(); ?>
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
