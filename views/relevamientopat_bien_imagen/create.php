<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Relevamientopat_bien_imagen $model */

$this->title = 'Create Relevamientopat Bien Imagen';
$this->params['breadcrumbs'][] = ['label' => 'Relevamientopat Bien Imagens', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="relevamientopat-bien-imagen-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
