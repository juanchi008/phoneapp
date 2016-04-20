<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\models\Users;

/* @var $this yii\web\View */
/* @var $model app\models\Users */

$this->title = $model->nombre;
$this->params['breadcrumbs'][] = ['label' => 'Admins', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->nombre, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<section id="content">
<div class="container">

<div class="users-update">

    <h1><?= 'Update: '.Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

</div>
</section>
</div>