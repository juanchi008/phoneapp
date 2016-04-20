<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Paises */

$this->title = 'Create Paises';
$this->params['breadcrumbs'][] = ['label' => 'Paises', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="paises-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
