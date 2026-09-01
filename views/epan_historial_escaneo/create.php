<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Epan_historial_escaneo $model */

$this->title = 'Create Epan Historial Escaneo';
$this->params['breadcrumbs'][] = ['label' => 'Epan Historial Escaneos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="epan-historial-escaneo-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
