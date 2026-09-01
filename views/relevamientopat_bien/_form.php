<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Relevamientopat_bien $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="relevamientopat-bien-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'idrelevamiento')->textInput() ?>

    <?= $form->field($model, 'matricula')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'persona_cargo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'lugar_pertenece')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'estado_bien')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
