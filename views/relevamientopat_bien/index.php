<?php

use app\models\Relevamientopat_bien;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\Relevamientopat_bienSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Relevamientopat Biens';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="relevamientopat-bien-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Relevamientopat Bien', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'idrelevamiento',
            'matricula',
            'persona_cargo',
            'lugar_pertenece',
            //'estado_bien',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Relevamientopat_bien $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>
