<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
?>
<!--========================================================
                              CONTENT
=========================================================-->
	<section id="content">

        <div class="container">
             <div class="row wrap_11">
                <div class="col-lg-12">
                    <h2 class="header_2 indent_4"><?= Html::encode($this->title) ?></h2>

                    <div style="border: 1px solid #cccccc; padding: 20px;">
                    
                    	<legend><p class="text_7 color_6">Ingrese su datos</p></legend>
                    	<br/>&nbsp;<br/>
                    	
					    <?php 
					    $form = ActiveForm::begin([
					        'id' => 'login-form',
					        'options' => ['class' => 'form-horizontal'],
							'method' => 'post',
					        'fieldConfig' => [
					            'template' => "{label}\n<div class=\"col-lg-3\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
					            'labelOptions' => ['class' => 'col-lg-1 control-label'],
					        ],
					    ]); ?>
	                            	
							<?= $form->field($model, 'nombre_usuario') ?>
								
						    <?= $form->field($model, 'contrasena')->passwordInput() ?>
						    
					        <?= $form->field($model, 'rememberMe')->checkbox([
					            'template' => "<div class=\"col-lg-offset-1 col-lg-3\">{input} {label}</div>\n<div class=\"col-lg-8\">{error}</div>",
					        ]) ?>

					        <div class="form-group">
					            <div class="col-lg-offset-1 col-lg-11">
									<?= Html::submitButton('Login', ['class' => 'btn_3', 'name' => 'login-button']) ?>
					            </div>
					        </div>
					        
					    <?php ActiveForm::end(); ?>
				    
			    	</div>
    			</div>
    		</div>
    	</div>
	</section>
