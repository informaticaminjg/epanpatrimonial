<?php

use app\models\Relevamientopat_bien_imagen;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\Relevamientopat_bien_imagenSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Relevamientopat Bien Imagens';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="relevamientopat-bien-imagen-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Relevamientopat Bien Imagen', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'idrelevamientobien',
            'imagen',
            'fecha_creacion',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Relevamientopat_bien_imagen $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>
