<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\LogsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Logs';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="logs-index">

    <h2 class="header_2 indent_4"><?= Html::encode($this->title) ?></h2>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Logs', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'nombre',
            'role',
            'module',
			'submodule',
            //'result',
			//'info',
            // 'ip_address',
			[
				'attribute' => 'fecha_registro',
				'value' => function ($data) {
					return $data->fecha_registro .' '.$data->hora_registro;
				}
			],
			//'hora_registro',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
