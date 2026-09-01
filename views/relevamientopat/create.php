<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Relevamientopat $model */

$this->title = 'Nuevo Relevamiento';
$this->params['breadcrumbs'][] = ['label' => 'Relevamientopats', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="relevamientopat-create">   

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
