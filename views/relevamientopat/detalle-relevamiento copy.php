<?php

use yii\helpers\Html;

$this->title = 'Detalle del Relevamiento';
?>

<div class="construction-page">

    <div class="construction-card">

        <div class="construction-icon">
            <i class="fa-solid fa-person-digging"></i>
        </div>

        <h1>Estamos trabajando en esta sección</h1>

        <p class="construction-text">
            El detalle del relevamiento se encuentra actualmente
            <strong>en construcción</strong>.
        </p>

        <p class="construction-subtext">
            Próximamente podrás consultar toda la información
            del relevamiento, los bienes registrados y sus detalles.
        </p>

        <?= Html::a(
            '<i class="fa-solid fa-arrow-left"></i> Volver',
            ['patrimonial/index'],
            ['class' => 'btn-back']
        ) ?>

    </div>

</div>

<style>
.construction-page {
    min-height: calc(100vh - 100px);
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 40px 20px;
}

.construction-card {
    width: 100%;
    max-width: 600px;
    text-align: center;
    background: #fff;
    border-radius: 22px;
    padding: 55px 40px;
    box-shadow: 0 8px 30px rgba(0, 0, 0, 0.08);
}

.construction-icon {
    width: 90px;
    height: 90px;
    margin: 0 auto 25px;
    border-radius: 50%;
    background: #f1f5f9;
    display: flex;
    align-items: center;
    justify-content: center;
}

.construction-icon i {
    font-size: 42px;
    color: #64748b;
}

.construction-card h1 {
    margin: 0 0 18px;
    font-size: 28px;
    font-weight: 700;
    color: #1e293b;
}

.construction-text {
    margin: 0 auto 12px;
    font-size: 18px;
    color: #475569;
}

.construction-subtext {
    margin: 0 auto 30px;
    max-width: 480px;
    font-size: 15px;
    line-height: 1.6;
    color: #94a3b8;
}

.btn-back {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 11px 22px;
    border-radius: 10px;
    background: #1e293b;
    color: #fff !important;
    text-decoration: none;
    font-size: 15px;
    font-weight: 600;
    transition: .2s;
}

.btn-back:hover {
    background: #0f172a;
    color: #fff !important;
}
</style>