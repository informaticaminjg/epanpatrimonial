<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Relevamientopat_bien_imagen $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="relevamientopat-bien-imagen-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'idrelevamientobien')->textInput() ?>

    <?= $form->field($model, 'imagen')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'fecha_creacion')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
