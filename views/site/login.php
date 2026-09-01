<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var app\models\LoginForm $model */

use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;

$this->title = 'Acceso al sistema';

$logo = Yii::getAlias('@web/images/yii3_full_white_for_dark.svg');
?>

<style>
  .login-page {
        width: 100%;
        min-height: 100dvh;

        display: flex;
        align-items: flex-start;
        justify-content: center;

        padding: 25px 20px;

        box-sizing: border-box;

        background:
            radial-gradient(
                circle at 0% 0%,
                rgba(37, 99, 235, .18),
                transparent 40%
            ),
            radial-gradient(
                circle at 100% 100%,
                rgba(14, 165, 233, .16),
                transparent 40%
            ),
            linear-gradient(
                135deg,
                #f8fbff,
                #eef4fa
            );
    }
    .login-card {
        width: 100%;
        max-width: 460px;

        height: auto;
        min-height: 0;

        display: block;

        background: #fff;
        border-radius: 24px;
        overflow: hidden;

        box-shadow: 0 25px 70px rgba(15, 23, 42, .14);
    }

    /* =====================================================
       PANEL IZQUIERDO
       ===================================================== */
    .login-left {
        display: none !important;
    }
    .login-right {
        width: 100%;
        display: flex;
        align-items: center;
        justify-content: center;

        padding: 35px 40px;

        box-sizing: border-box;
    }
    

.login-logo {
    width: 100%;
    text-align: center;
    margin: 0 0 8px 0;
}

.login-logo img {
    display: block;
    width: 100px;
    max-width: 100%;
    height: auto;
    margin: 0 auto;
}


.login-logo {
    display: flex;
    flex-direction: column;
    align-items: center;
}

.login-logo img {
    display: block;
}

.logo-text {
    margin-top: 5px;
    font-size: 12px;
    font-weight: 600;
    line-height: 1;
    color: #868686;
}



    .login-left-content {
        position: relative;
        z-index: 2;
    }

    .login-icon {
        width: 70px;
        height: 70px;
        border-radius: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 28px;

        background: rgba(255,255,255,.14);
        border: 1px solid rgba(255,255,255,.18);
        backdrop-filter: blur(10px);

        font-size: 30px;
    }

    .login-left h2 {
        font-size: 38px;
        line-height: 1.12;
        font-weight: 700;
        margin-bottom: 18px;
        letter-spacing: -.7px;
    }

    .login-left p {
        max-width: 340px;
        margin: 0;
        font-size: 15px;
        line-height: 1.7;
        color: rgba(255,255,255,.78);
    }

    .login-version {
        position: relative;
        z-index: 2;
        font-size: 12px;
        color: rgba(255,255,255,.55);
    }

    /* =====================================================
       PANEL DERECHO
       ===================================================== */



    .login-form-container {
        width: 100%;
        max-width: 390px;
    }

    .login-header {
        margin-bottom: 32px;
    }

    .login-header h1 {
        margin: 0 0 8px;
        font-size: 30px;
        font-weight: 700;
        color: #172033;
        letter-spacing: -.5px;
    }

    .login-header p {
        margin: 0;
        font-size: 14px;
        color: #7a8495;
    }

    /* =====================================================
       CAMPOS
       ===================================================== */

    .login-field {
        margin-bottom: 20px;
    }

    .login-field label {
        display: block;
        margin-bottom: 8px;
        font-size: 13px;
        font-weight: 600;
        color: #344054;
    }

    .login-input-group {
        position: relative;
    }

    .login-input-icon {
        position: absolute;
        z-index: 5;
        left: 15px;
        top: 50%;
        transform: translateY(-50%);
        color: #98a2b3;
        font-size: 16px;
        pointer-events: none;
    }

    .login-input {
        width: 100%;
        height: 52px;
        padding: 0 16px 0 45px !important;
        border: 1px solid #d9dee8 !important;
        border-radius: 12px !important;
        background: #f9fafc !important;
        color: #172033 !important;
        font-size: 14px;
        box-shadow: none !important;
        transition: all .2s ease;
    }

    .login-input:focus {
        border-color: #2475d8 !important;
        background: #fff !important;
        box-shadow: 0 0 0 4px rgba(36,117,216,.10) !important;
    }

    .login-input::placeholder {
        color: #a4acb9;
    }

    /* =====================================================
       RECORDAR
       ===================================================== */

    .login-remember {
        margin-top: 2px;
        margin-bottom: 25px;
    }

    .login-remember label {
        font-size: 13px;
        color: #667085;
        cursor: pointer;
    }

    .login-remember input {
        margin-right: 7px;
    }

    /* =====================================================
       BOTÓN
       ===================================================== */

    .login-button {
        width: 100%;
        height: 53px;
        border: 0;
        border-radius: 12px !important;

        background: linear-gradient(
            135deg,
            #1769c2,
            #2487df
        );

        color: #fff !important;
        font-size: 15px;
        font-weight: 600;

        box-shadow: 0 8px 20px rgba(23,105,194,.22);

        transition:
            transform .15s ease,
            box-shadow .15s ease,
            filter .15s ease;
    }

    .login-button:hover {
        filter: brightness(1.05);
        transform: translateY(-1px);
        box-shadow: 0 12px 25px rgba(23,105,194,.28);
    }

    .login-button:active {
        transform: translateY(0);
    }

    /* =====================================================
       ERROR
       ===================================================== */

    .login-field .help-block {
        margin-top: 6px;
        font-size: 12px;
        color: #d92d20;
    }

    /* =====================================================
       PIE
       ===================================================== */

    .login-footer {
        margin-top: 30px;
        text-align: center;
        font-size: 12px;
        color: #98a2b3;
    }

    /* =====================================================
       MOBILE
       ===================================================== */
@media (max-width: 767px) {

    .login-page {
        padding: 15px;
    }

    .login-card {
        max-width: 460px;
        border-radius: 20px;
    }

    .login-right {
        padding: 40px 25px;
    }

    .login-header {
        text-align: center;
        margin-bottom: 30px;
    }

    .login-header h1 {
        font-size: 27px;
    }

    .login-form-container {
        width: 100%;
        max-width: 390px;
    }
}
    
</style>

<div class="login-page">

    <div class="login-card">

        <!-- =================================================
             PANEL IZQUIERDO
             ================================================= -->

        <div class="login-left">           

            <div class="login-left-content">

                <div class="login-icon">
                    <i class="fa-solid fa-building-columns"></i>
                </div>

                <h3>
                    Sistema<br>
                    Patrimonial
                </h3>

                <p>
                    Gestión y seguimiento de bienes patrimoniales,
                    relevamientos y consultas de inventario.
                </p>

            </div>

            <div class="login-version">
                Acceso seguro al sistema
            </div>

        </div>


        <!-- =================================================
             PANEL DERECHO
             ================================================= -->

        <div class="login-right">

            <div class="login-form-container">
                <div class="login-logo">
                    <img src="<?= Yii::getAlias('@web') ?>/images/logo.png" alt="ePan">
                    <div class="logo-text">PATRIMONIAL</div>
                </div>

                <div class="login-header">

                    <h1>
                        Iniciar sesión
                    </h1>

                    <p>
                        Ingresá tus credenciales para continuar.
                    </p>

                </div>


                <?php $form = ActiveForm::begin([
                    'id' => 'login-form',
                    'options' => [
                        'autocomplete' => 'on',
                    ],
                ]); ?>


                <!-- USUARIO -->

                <div class="login-field">

                    <?= $form->field(
                        $model,
                        'username',
                        [
                            'template' =>
                                '{label}
                                <div class="login-input-group">
                                    <i class="fa-solid fa-user login-input-icon"></i>
                                    {input}
                                </div>
                                {error}',
                        ]
                    )
                    ->textInput([
                        'class' => 'form-control login-input',
                        'placeholder' => 'Ingresá tu usuario',
                        'autofocus' => true,
                        'autocomplete' => 'username',
                    ])
                    ->label('Usuario') ?>

                </div>


                <!-- CONTRASEÑA -->

                <div class="login-field">

                    <?= $form->field(
                        $model,
                        'password',
                        [
                            'template' =>
                                '{label}
                                <div class="login-input-group">
                                    <i class="fa-solid fa-lock login-input-icon"></i>
                                    {input}
                                </div>
                                {error}',
                        ]
                    )
                    ->passwordInput([
                        'class' => 'form-control login-input',
                        'placeholder' => 'Ingresá tu contraseña',
                        'autocomplete' => 'current-password',
                    ])
                    ->label('Contraseña') ?>

                </div>


                <!-- RECORDAR -->

                <div class="login-remember">

                    <?= $form->field(
                        $model,
                        'rememberMe'
                    )->checkbox([
                        'label' => 'Recordar mi sesión',
                    ]) ?>

                </div>


                <!-- BOTÓN -->

                <div>

                    <?= Html::submitButton(
                        '<i class="fa-solid fa-right-to-bracket me-2"></i> Iniciar sesión',
                        [
                            'class' => 'btn login-button',
                            'name' => 'login-button',
                        ]
                    ) ?>

                </div>


                <?php ActiveForm::end(); ?>


                <div class="login-footer">
                    Sistema de gestión patrimonial
                </div>

            </div>

        </div>

    </div>

</div>