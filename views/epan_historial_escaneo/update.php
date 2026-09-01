<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Epan_historial_escaneo $model */

$this->title = 'Update Epan Historial Escaneo: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Epan Historial Escaneos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="epan-historial-escaneo-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
