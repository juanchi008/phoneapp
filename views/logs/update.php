<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Logs */

$this->title = 'Update Logs: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Logs', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<section id="content">
<div class="container">

<div class="logs-update">

    <h2 class="header_2 indent_4"><?= Html::encode($this->title) ?></h2>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

</div>
</section>
</div>
