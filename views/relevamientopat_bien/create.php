<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Relevamientopat_bien $model */

$this->title = 'Create Relevamientopat Bien';
$this->params['breadcrumbs'][] = ['label' => 'Relevamientopat Biens', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="relevamientopat-bien-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
