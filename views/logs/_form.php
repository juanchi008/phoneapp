<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Users;
use app\components\Fn;

/* @var $this yii\web\View */
/* @var $model app\models\Logs */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="logs-form">

    <?php $form = ActiveForm::begin(); ?>

		<?php echo $form->errorSummary($model); ?>
		
	    <?= $form->field($model, 'nombre')->textInput() ?>
	
	    <?= $form->field($model, 'role')->textInput() ?>
	
    	<?php /*echo $form->field($model, 'id_role')->dropdownList(
	    		Users::findAllForDropDownList(),
	    		['prompt'=>'--- Select ---']
    		);*/ ?>
    		
	    <?= $form->field($model, 'module')->textInput(['maxlength' => true]) ?>
	
	    <?= $form->field($model, 'submodule')->textInput(['maxlength' => true]) ?>
	    
	    <?= $form->field($model, 'result')->textInput(['maxlength' => true]) ?>
	    
	    <?= $form->field($model, 'info')->textInput(['maxlength' => true]) ?>
	
	    <?= $form->field($model, 'ip_address')->textInput(['maxlength' => true]) ?>
	
	    <?= $form->field($model, 'fecha_registro')->textInput() ?>
	    
	    <?= $form->field($model, 'hora_registro')->textInput() ?>
	
	    <div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>

    <?php ActiveForm::end(); ?>

</div>
