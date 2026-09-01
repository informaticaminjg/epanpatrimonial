<?php

use yii\helpers\Html;
use yii\helpers\Url;

/** @var app\models\Relevamientopat $relevamiento */
/** @var app\models\RelevamientopatBien[] $bienes */
/** @var app\models\RelevamientopatBien $bien */

$this->title = 'Relevar bienes';

?>

<div class="relevamiento-bienes">

    <!-- ENCABEZADO -->

    <div class="relevamiento-top">

        <a
            href="<?= Url::to(['relevamientopat/index']) ?>"
            class="back-button"
        >
            <i class="fa-solid fa-arrow-left"></i>
        </a>

        <div>
            <h1>Relevar bienes</h1>

            <span>
                <?= Html::encode($relevamiento->lugar_relevamiento) ?>
            </span>
        </div>

    </div>


    <!-- INFORMACIÓN DEL RELEVAMIENTO -->

    <div class="relevamiento-summary">

        <div class="summary-icon">
            <i class="fa-solid fa-building"></i>
        </div>

        <div class="summary-content">

            <strong>
                <?= Html::encode(
                    $relevamiento->lugar_relevamiento
                ) ?>
            </strong>

            <small>
                <?= date(
                    'd/m/Y H:i',
                    strtotime($relevamiento->fecha_creacion)
                ) ?>
            </small>

        </div>

    </div>


    <!-- CONTADOR -->

    <div class="bienes-header">

        <div>
            <strong>Bienes relevados</strong>

            <span>
                <?= count($bienes) ?>
            </span>
        </div>

    </div>


    <!-- BIENES YA AGREGADOS -->

    <?php if (!empty($bienes)): ?>

        <div class="bienes-list">

            <?php foreach ($bienes as $item): ?>

                <div class="bien-card">

                    <div class="bien-icon">
                        <i class="fa-solid fa-box"></i>
                    </div>

                    <div class="bien-info">

                        <strong>
                            Matrícula
                            <?= Html::encode($item->matricula) ?>
                        </strong>

                        <span>
                            <?= Html::encode(
                                $item->persona_cargo ?: 'Sin persona a cargo'
                            ) ?>
                        </span>

                        <small>
                            <?= Html::encode(
                                $item->lugar_pertenece ?: 'Sin lugar'
                            ) ?>
                            ·
                            <?= Html::encode(
                                $item->estado_bien
                            ) ?>
                        </small>

                    </div>

                    <a
                        href="<?= Url::to([
                            'eliminar-bien',
                            'id' => $item->id
                        ]) ?>"
                        class="delete-bien"
                        data-method="post"
                        data-confirm="¿Querés eliminar este bien del relevamiento?"
                    >
                        <i class="fa-solid fa-trash"></i>
                    </a>

                </div>

            <?php endforeach; ?>

        </div>

    <?php else: ?>

        <div class="empty-bienes">

            <i class="fa-solid fa-box-open"></i>

            <strong>
                Todavía no agregaste bienes
            </strong>

            <span>
                Agregá las matrículas de los bienes encontrados.
            </span>

        </div>

    <?php endif; ?>


    <!-- AGREGAR BIEN -->

    <div class="agregar-bien-card">

        <div class="agregar-bien-title">

            <div class="agregar-bien-icon">
                <i class="fa-solid fa-plus"></i>
            </div>

            <div>
                <strong>Agregar bien</strong>

                <span>
                    Ingresá la información del bien relevado.
                </span>
            </div>

        </div>


        <form
            method="post"
            action="<?= Url::to([
                'agregar-bien',
                'id' => $relevamiento->id
            ]) ?>"
        >

            <?= Html::hiddenInput(
                Yii::$app->request->csrfParam,
                Yii::$app->request->csrfToken
            ) ?>


            <div class="campo">

                <label>
                    <i class="fa-solid fa-barcode"></i>
                    Matrícula
                </label>

                <div class="matricula-input">

                    <input
                        type="text"
                        name="RelevamientopatBien[matricula]"
                        placeholder="Ingresá la matrícula"
                        autocomplete="off"
                        required
                    >

                    <button
                        type="button"
                        class="scan-matricula"
                        onclick="alert('Acá conectamos el escáner de matrícula')"
                    >
                        <i class="fa-solid fa-camera"></i>
                    </button>

                </div>

            </div>


            <div class="campo">

                <label>
                    <i class="fa-solid fa-user"></i>
                    Persona a cargo
                </label>

                <input
                    type="text"
                    name="RelevamientopatBien[persona_cargo]"
                    placeholder="Nombre y apellido"
                >

            </div>


            <div class="campo">

                <label>
                    <i class="fa-solid fa-building"></i>
                    Lugar al que pertenece
                </label>

                <input
                    type="text"
                    name="RelevamientopatBien[lugar_pertenece]"
                    placeholder="Ej. Oficina de Patrimonio"
                >

            </div>


            <div class="campo">

                <label>
                    <i class="fa-solid fa-circle-check"></i>
                    Estado del bien
                </label>

                <select
                    name="RelevamientopatBien[estado_bien]"
                    required
                >

                    <option value="">
                        Seleccioná el estado
                    </option>

                    <option value="Bueno">
                        Bueno
                    </option>

                    <option value="Regular">
                        Regular
                    </option>

                    <option value="Malo">
                        Malo
                    </option>

                    <option value="Fuera de servicio">
                        Fuera de servicio
                    </option>

                </select>

            </div>


            <button
                type="submit"
                class="btn-agregar-bien"
            >
                <i class="fa-solid fa-plus"></i>
                Agregar bien
            </button>

        </form>

    </div>


    <!-- FINALIZAR -->

    <div class="finalizar-container">

        <?= Html::a(
            '<i class="fa-solid fa-check"></i> Finalizar relevamiento',
            [
                'finalizar',
                'id' => $relevamiento->id
            ],
            [
                'class' => 'btn-finalizar',
                'data-method' => 'post',
                'data-confirm' =>
                    '¿Querés finalizar este relevamiento?'
            ]
        ) ?>

    </div>

</div>


<style>

/* ================================
   GENERAL
================================ */

.relevamiento-bienes {
    max-width: 520px;
    margin: auto;
    padding: 16px;
    padding-bottom: 40px;
}


/* ================================
   HEADER
================================ */

.relevamiento-top {
    display: flex;
    align-items: center;
    gap: 12px;
    margin-bottom: 18px;
}

.back-button {
    width: 40px;
    height: 40px;
    border-radius: 11px;
    background: #f5f5f5;
    color: #333;
    display: flex;
    align-items: center;
    justify-content: center;
    text-decoration: none;
}

.relevamiento-top h1 {
    margin: 0;
    font-size: 21px;
    font-weight: 700;
    color: #222;
}

.relevamiento-top span {
    display: block;
    margin-top: 3px;
    font-size: 12px;
    color: #777;
}


/* ================================
   SUMMARY
================================ */

.relevamiento-summary {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 14px;
    border-radius: 14px;
    background: #fff6ed;
    margin-bottom: 20px;
}

.summary-icon {
    width: 44px;
    height: 44px;
    border-radius: 12px;
    background: #fff;
    color: #f28c28;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 19px;
}

.summary-content {
    display: flex;
    flex-direction: column;
    gap: 3px;
}

.summary-content strong {
    font-size: 14px;
    color: #333;
}

.summary-content small {
    font-size: 11px;
    color: #888;
}


/* ================================
   HEADER BIENES
================================ */

.bienes-header {
    margin-bottom: 10px;
}

.bienes-header > div {
    display: flex;
    align-items: center;
    justify-content: space-between;
}

.bienes-header strong {
    font-size: 15px;
    color: #333;
}

.bienes-header span {
    min-width: 26px;
    height: 26px;
    border-radius: 50%;
    background: #f28c28;
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 12px;
    font-weight: 700;
}


/* ================================
   BIENES
================================ */

.bienes-list {
    display: flex;
    flex-direction: column;
    gap: 8px;
    margin-bottom: 16px;
}

.bien-card {
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 12px;
    background: white;
    border: 1px solid #e5e5e5;
    border-radius: 12px;
}

.bien-icon {
    width: 40px;
    height: 40px;
    min-width: 40px;
    border-radius: 10px;
    background: #f5f5f5;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #777;
}

.bien-info {
    flex: 1;
    min-width: 0;
}

.bien-info strong {
    display: block;
    font-size: 13px;
    color: #333;
}

.bien-info span,
.bien-info small {
    display: block;
    margin-top: 3px;
    font-size: 11px;
    color: #777;
}

.delete-bien {
    width: 34px;
    height: 34px;
    border-radius: 9px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #dc3545;
    background: #fff1f1;
}


/* ================================
   SIN BIENES
================================ */

.empty-bienes {
    padding: 25px 15px;
    text-align: center;
    border: 1px dashed #ddd;
    border-radius: 13px;
    margin-bottom: 16px;
}

.empty-bienes i {
    font-size: 30px;
    color: #bbb;
    margin-bottom: 8px;
}

.empty-bienes strong {
    display: block;
    font-size: 13px;
    color: #555;
}

.empty-bienes span {
    display: block;
    margin-top: 4px;
    font-size: 11px;
    color: #999;
}


/* ================================
   AGREGAR BIEN
================================ */

.agregar-bien-card {
    background: white;
    border: 1px solid #e5e5e5;
    border-radius: 15px;
    padding: 16px;
}

.agregar-bien-title {
    display: flex;
    gap: 10px;
    align-items: center;
    margin-bottom: 18px;
}

.agregar-bien-icon {
    width: 40px;
    height: 40px;
    border-radius: 10px;
    background: #fff3e8;
    color: #f28c28;
    display: flex;
    align-items: center;
    justify-content: center;
}

.agregar-bien-title strong {
    display: block;
    font-size: 14px;
}

.agregar-bien-title span {
    display: block;
    margin-top: 3px;
    font-size: 11px;
    color: #888;
}


/* ================================
   CAMPOS
================================ */

.campo {
    margin-bottom: 14px;
}

.campo label {
    display: block;
    margin-bottom: 6px;
    font-size: 12px;
    font-weight: 700;
    color: #444;
}

.campo label i {
    color: #f28c28;
    margin-right: 4px;
}

.campo input,
.campo select {
    width: 100%;
    height: 45px;
    box-sizing: border-box;
    border: 1px solid #ddd;
    border-radius: 10px;
    padding: 0 12px;
    background: #fff;
    font-size: 13px;
    outline: none;
}

.campo input:focus,
.campo select:focus {
    border-color: #f28c28;
    box-shadow: 0 0 0 3px rgba(242, 140, 40, .10);
}


/* ================================
   MATRÍCULA + SCANNER
================================ */

.matricula-input {
    display: flex;
    gap: 7px;
}

.matricula-input input {
    flex: 1;
}

.scan-matricula {
    width: 45px;
    height: 45px;
    border: 0;
    border-radius: 10px;
    background: #f28c28;
    color: white;
    font-size: 17px;
}


/* ================================
   AGREGAR
================================ */

.btn-agregar-bien {
    width: 100%;
    height: 47px;
    border: 0;
    border-radius: 11px;
    background: #f28c28;
    color: white;
    font-size: 14px;
    font-weight: 700;
}

.btn-agregar-bien i {
    margin-right: 5px;
}


/* ================================
   FINALIZAR
================================ */

.finalizar-container {
    margin-top: 18px;
}

.btn-finalizar {
    width: 100%;
    height: 49px;
    border-radius: 11px;
    background: #333;
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    text-decoration: none;
    font-size: 14px;
    font-weight: 700;
}

.btn-finalizar i {
    margin-right: 6px;
}

</style>