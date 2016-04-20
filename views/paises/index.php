<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PaisesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Paises';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="paises-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Paises', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'nombre_pais',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
