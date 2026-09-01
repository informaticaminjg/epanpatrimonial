<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Relevamientopat_bien $model */

$this->title = 'Update Relevamientopat Bien: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Relevamientopat Biens', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="relevamientopat-bien-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
