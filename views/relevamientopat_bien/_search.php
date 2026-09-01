<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Relevamientopat_bienSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="relevamientopat-bien-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'idrelevamiento') ?>

    <?= $form->field($model, 'matricula') ?>

    <?= $form->field($model, 'persona_cargo') ?>

    <?= $form->field($model, 'lugar_pertenece') ?>

    <?php // echo $form->field($model, 'estado_bien') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
