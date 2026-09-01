<?php

use yii\helpers\Url;
use yii\helpers\Html;

$this->title = 'Detalle del Bien';

/*
 * =========================================================
 * DATOS DEL BIEN
 * =========================================================
 *
 * Estos datos son los mismos que aparecen en la imagen.
 * Más adelante pueden reemplazarse por $bien / SICOPRO.
 */

$bienDemo = [

    'matricula' => 'MAT-2024-000123',

    'descripcion' => 'Notebook Dell Latitude 5420',

    'estado_cabecera' => 'ACTIVO',

    'numero_serie' => 'DLT5420-ABC1234',

    'marca' => 'Dell',

    'modelo' => 'Latitude 5420',

    'categoria' => 'Equipos Informáticos',

    'estado' => 'Bueno',

    'fecha_alta' => '15/03/2024',

    'valor_adquisicion' => '1250000',

    'dependencia_actual' => 'Dirección de Informática',

    'personas' => [

        [
            'iniciales' => 'LG',
            'nombre' => 'Luis Eduardo Garcia',
            'desde' => '15/03/2024',
            'hasta' => '',
            'dependencia' => 'Dirección de Informática',
            'actual' => true,
        ],

        [
            'iniciales' => 'MR',
            'nombre' => 'María Rosa López',
            'desde' => '10/01/2022',
            'hasta' => '14/03/2024',
            'dependencia' => 'Dirección de Sistemas',
            'actual' => false,
        ],

    ],

];


/*
 * =========================================================
 * FORMATEAR IMPORTE
 * =========================================================
 */

$importe = number_format(
    (float)$bienDemo['valor_adquisicion'],
    2,
    ',',
    '.'
);


/*
 * =========================================================
 * ID REAL DEL BIEN
 * =========================================================
 *
 * Si existe $bien usamos su ID.
 * Si estamos probando con datos simulados usamos null.
 */

$bienId = isset($bien) && isset($bien->id)
    ? $bien->id
    : null;

?>

<style>

/* =========================================================
   CONTENEDOR GENERAL
   ========================================================= */

.detail-page {

    width: 100%;
    max-width: 430px;

    margin: 0 auto;

    min-height: 100vh;

    background: #f7f8fa;

    color: #202124;

    font-family:
        -apple-system,
        BlinkMacSystemFont,
        "Segoe UI",
        Roboto,
        Arial,
        sans-serif;

    box-sizing: border-box;

}


/* =========================================================
   HEADER AZUL
   ========================================================= */

.detail-header {

    height: 42px;

    background: #063b9c;

    color: #ffffff;

    display: flex;

    align-items: center;

    justify-content: space-between;

    padding: 0 10px;

    box-sizing: border-box;

}


.detail-header-left,
.detail-header-right {

    width: 34px;

    height: 34px;

    display: flex;

    align-items: center;

    justify-content: center;

}


.detail-header-left {

    cursor: pointer;

}


.detail-header-left i {

    font-size: 18px;

}


.detail-header-title {

    flex: 1;

    text-align: center;

    font-size: 14px;

    font-weight: 600;

    letter-spacing: .1px;

}


.detail-header-right i {

    font-size: 18px;

}


/* =========================================================
   CONTENIDO
   ========================================================= */

.detail-content {

    padding: 10px 12px 14px;

    box-sizing: border-box;

}


/* =========================================================
   BIEN ENCONTRADO
   ========================================================= */

.found-banner {

    height: 25px;

    display: flex;

    align-items: center;

    justify-content: center;

    gap: 5px;

    color: #208b45;

    font-size: 14px!important;

    margin-bottom: 6px !important;
    border-radius: 4px !important;
}


.found-banner i {

    font-size: 12px;

}


.found-banner strong {

    font-weight: 600 !important;
    font-size: 14px !important;
}


/* =========================================================
   TARJETA PRINCIPAL DEL BIEN
   ========================================================= */

.asset-card {

    background: #ffffff;

    border: 1px solid #e7e7e7;

    border-radius: 6px;

    min-height: 72px;

    padding: 10px;

    display: flex;

    align-items: center;

    gap: 10px;

    box-sizing: border-box;

    box-shadow:
        0 1px 3px rgba(0,0,0,.07);

    margin-bottom: 8px;

}


/* =========================================================
   ICONO NOTEBOOK
   ========================================================= */

.asset-icon {

    width: 48px;

    height: 48px;

    min-width: 48px;

    border-radius: 50%;

    background: #eef1f5;

    display: flex;

    align-items: center;

    justify-content: center;

}


.asset-icon i {

    font-size: 25px;

    color: #20252b;

}


/* =========================================================
   INFORMACIÓN CABECERA
   ========================================================= */

.asset-info {

    min-width: 0;

    flex: 1;

}


.asset-matricula {

    font-size: 14px;

    font-weight: 700;

    color: #202124;

    margin-bottom: 2px;

}


.asset-description {

    font-size: 14px;

    font-weight: 500;

    color: #333;

    white-space: nowrap;

    overflow: hidden;

    text-overflow: ellipsis;

    margin-bottom: 4px;

}


/* =========================================================
   BADGE ACTIVO
   ========================================================= */

.status-badge {

    display: inline-block;

    background: #155bc5;

    color: #ffffff;

    font-size: 8px;

    font-weight: 700;

    line-height: 16px;

    height: 16px;

    padding: 0 5px;

    border-radius: 2px;

    text-transform: uppercase;

}


/* =========================================================
   TARJETAS DE INFORMACIÓN
   ========================================================= */

.detail-card {

    background: #ffffff;

    border: 1px solid #e7e7e7;

    border-radius: 6px;

    box-shadow:
        0 1px 3px rgba(0,0,0,.06);

    margin-bottom: 8px;

    overflow: hidden;

}


/* =========================================================
   TITULO
   ========================================================= */

.detail-title {

    font-size: 14px !important;

    font-weight: 700 !important;

    color: #252525 !important;

    padding: 6px 9px 6px 0 !important;

}


/*
 * En la imagen "Información del Bien"
 * no lleva icono.
 */

.detail-title i {

    display: none;

}


/* =========================================================
   GRID INFORMACIÓN
   ========================================================= */

.detail-grid {

    display: flex !important;

    flex-direction: column !important;

    width: 100% !important;

}

.detail-row {

    display: flex !important;

    flex-direction: row !important;

    justify-content: space-between !important;

    align-items: center !important;

    width: 100% !important;

    padding: 4px 0px 2px 0px !important;

    border-bottom: 1px solid #e5e7eb !important;

}

.detail-row span {

    flex: 1 !important;

    text-align: left !important;

    font-size: 14px !important;

    color: #6b7280 !important;

}

.detail-row strong {

    flex: 1 !important;

    text-align: right !important;

    font-size: 13px !important;

    color: #111827 !important;

}


/* =========================================================
   PERSONAS A CARGO
   ========================================================= */

.personas-card {

    margin-top: 0;

}
 
   
.personas-title {

    font-size: 14px !important;

    font-weight: 700 !important;

    padding: 6px 9px 6px 0 !important;

}


.persona {

    display: flex;

    align-items: flex-start;

    gap: 8px;

    padding: 5px 9px 7px;

}


.persona + .persona {

    padding-top: 4px;

}


.persona-avatar {

    width: 28px;

    height: 28px;

    min-width: 28px;

    border-radius: 50%;

    background: #dfe3e9;

    color: #7a8088;

    display: flex;

    align-items: center;

    justify-content: center;

    font-size: 10px;

    font-weight: 500;

}


.persona-info {

    flex: 1;

    min-width: 0;

}


.persona-name-line {

    display: flex;

    align-items: center;

    justify-content: space-between;

    gap: 5px;

}


.persona-name {

    font-size: 14px;

    font-weight: 700;

    color: #292929;

}


.persona-status {

    border: 1px solid #55b878;

    color: #32965b;

    border-radius: 2px;

    font-size: 10px;

    line-height: 13px;

    height: 14px;

    padding: 0 4px;

    white-space: nowrap;

}


.persona-dates {

    font-size: 12px;

    color: #555;

    margin-top: 1px;

    line-height: 12px;

}


.persona-dependencia {

    font-size: 10px;

    color: #555;

    line-height: 12px;

}


/* =========================================================
   SEPARADOR
   ========================================================= */

.personas-separator {

    height: 1px;

    background: #eeeeee;

    margin: 0 9px;

}


/* =========================================================
   ACCIONES
   ========================================================= */

.action-card {

    background: #ffffff;

    border: 1px solid #e7e7e7;

    border-radius: 6px;

    box-shadow:
        0 1px 3px rgba(0,0,0,.06);

    height: 58px;

    display: grid;

    grid-template-columns: repeat(3, 1fr);

    align-items: center;

    margin-top: 7px;

    overflow: hidden;

}


.action-button {

    height: 100%;

    border: 0;

    background: transparent;

    color: #1045a0;

    text-decoration: none;

    display: flex;

    flex-direction: column;

    align-items: center;

    justify-content: center;

    gap: 3px;

    cursor: pointer;

    font-family: inherit;

    padding: 0;

}


.action-button i {

    font-size: 18px;

}


.action-button span {

    font-size: 8px;

    font-weight: 600;

}


/* =========================================================
   HOVER
   ========================================================= */

.action-button:hover {

    background: #f5f7fb;

    color: #063b9c;

}


/* =========================================================
   AJUSTE PARA CELULARES MUY CHICOS
   ========================================================= */

@media (max-width: 350px) {

    .detail-content {

        padding-left: 9px;

        padding-right: 9px;

    }

    .detail-row span,
    .detail-row strong {

        font-size: 9px;

    }

}

</style>


<div class="detail-page">


    <!-- =====================================================
         ENCABEZADO
         ===================================================== -->

    <div class="history-header">

      

        <div class="history-header-title">
            Detalle del Bien
        </div>

    </div>


    <!-- =====================================================
         CONTENIDO
         ===================================================== -->

    <main class="detail-content">


        <!-- =================================================
             BIEN ENCONTRADO
             ================================================= -->

        <div class="found-banner">

            <i class="fa-solid fa-circle-check"></i>

            <strong>
                Bien encontrado
            </strong>

        </div>


        <!-- =================================================
             CABECERA DEL BIEN
             ================================================= -->

        <section class="asset-card">


            <div class="asset-icon">

                <i class="fa-solid fa-laptop"></i>

            </div>


            <div class="asset-info">

                <div class="asset-matricula">

                    <?= Html::encode(
                        $bienDemo['matricula']
                    ) ?>

                </div>


                <div class="asset-description">

                    <?= Html::encode(
                        $bienDemo['descripcion']
                    ) ?>

                </div>


                <span class="status-badge">

                    <?= Html::encode(
                        $bienDemo['estado_cabecera']
                    ) ?>

                </span>

            </div>

        </section>


        <!-- =================================================
             INFORMACIÓN DEL BIEN
             ================================================= -->

        <section class="detail-card">


            <div class="detail-title">

                Información del Bien

            </div>


            <div class="detail-grid">


                <div class="detail-row">

                    <span>
                        Número de Serie
                    </span>

                    <strong>
                        <?= Html::encode(
                            $bienDemo['numero_serie']
                        ) ?>
                    </strong>

                </div>


                <div class="detail-row">

                    <span>
                        Marca
                    </span>

                    <strong>
                        <?= Html::encode(
                            $bienDemo['marca']
                        ) ?>
                    </strong>

                </div>


                <div class="detail-row">

                    <span>
                        Modelo
                    </span>

                    <strong>
                        <?= Html::encode(
                            $bienDemo['modelo']
                        ) ?>
                    </strong>

                </div>


                <div class="detail-row">

                    <span>
                        Categoría
                    </span>

                    <strong>
                        <?= Html::encode(
                            $bienDemo['categoria']
                        ) ?>
                    </strong>

                </div>


                <div class="detail-row">

                    <span>
                        Estado
                    </span>

                    <strong>
                        <?= Html::encode(
                            $bienDemo['estado']
                        ) ?>
                    </strong>

                </div>


                <div class="detail-row">

                    <span>
                        Fecha de Alta
                    </span>

                    <strong>
                        <?= Html::encode(
                            $bienDemo['fecha_alta']
                        ) ?>
                    </strong>

                </div>


                <div class="detail-row">

                    <span>
                        Valor de Adquisición
                    </span>

                    <strong>

                        $ <?= Html::encode($importe) ?>

                    </strong>

                </div>


                <div class="detail-row">

                    <span>
                        Dependencia Actual
                    </span>

                    <strong>
                        <?= Html::encode(
                            $bienDemo['dependencia_actual']
                        ) ?>
                    </strong>

                </div>

            </div>

        </section>


        <!-- =================================================
             PERSONAS A CARGO
             ================================================= -->

        <section class="detail-card personas-card">


            <div class="personas-title">

                Personas a Cargo

            </div>


            <?php foreach ($bienDemo['personas'] as $index => $persona): ?>


                <?php if ($index > 0): ?>

                    <div class="personas-separator"></div>

                <?php endif; ?>


                <div class="persona">


                    <!-- AVATAR -->

                    <div class="persona-avatar">

                        <?= Html::encode(
                            $persona['iniciales']
                        ) ?>

                    </div>


                    <!-- INFORMACIÓN -->

                    <div class="persona-info">


                        <div class="persona-name-line">


                            <span class="persona-name">

                                <?= Html::encode(
                                    $persona['nombre']
                                ) ?>

                            </span>


                            <?php if ($persona['actual']): ?>

                                <span class="persona-status">

                                    Actual

                                </span>

                            <?php endif; ?>


                        </div>


                        <div class="persona-dates">

                            Desde:
                            <?= Html::encode(
                                $persona['desde']
                            ) ?>


                            <?php if (!empty($persona['hasta'])): ?>

                                <span>

                                    &nbsp;&nbsp;Hasta:
                                    <?= Html::encode(
                                        $persona['hasta']
                                    ) ?>

                                </span>

                            <?php endif; ?>

                        </div>


                        <div class="persona-dependencia">

                            <?= Html::encode(
                                $persona['dependencia']
                            ) ?>

                        </div>


                    </div>

                </div>


            <?php endforeach; ?>


        </section>


        <!-- =================================================
             ACCIONES
             ================================================= -->

        <section class="action-card">


            <!-- IMPRIMIR -->

            <a
                class="action-button"
                href="<?= $bienId !== null
                    ? Url::to([
                        'patrimonial/imprimir',
                        'id' => $bienId
                    ])
                    : '#'
                ?>"
                <?= $bienId === null
                    ? 'onclick="return false;"'
                    : ''
                ?>
            >

                <i class="fa-solid fa-print"></i>

                <span>
                    Imprimir
                </span>

            </a>


            <!-- COMPARTIR -->

            <button
                type="button"
                class="action-button"
                onclick="compartirBien()"
            >

                <i class="fa-solid fa-share-nodes"></i>

                <span>
                    Compartir
                </span>

            </button>


            <!-- QR -->

            <a
                class="action-button"
                href="<?= $bienId !== null
                    ? Url::to([
                        'patrimonial/qr',
                        'id' => $bienId
                    ])
                    : '#'
                ?>"
                <?= $bienId === null
                    ? 'onclick="return false;"'
                    : ''
                ?>
            >

                <i class="fa-solid fa-qrcode"></i>

                <span>
                    Generar QR
                </span>

            </a>


        </section>


    </main>

</div>


<script>

/* =========================================================
   COMPARTIR
   ========================================================= */

function compartirBien() {

    const texto = <?= json_encode(

        "ePan Patrimonial\n\n" .

        "Matrícula: " .
        $bienDemo['matricula'] . "\n" .

        "Descripción: " .
        $bienDemo['descripcion'] . "\n\n" .

        "INFORMACIÓN DEL BIEN\n\n" .

        "Número de Serie: " .
        $bienDemo['numero_serie'] . "\n" .

        "Marca: " .
        $bienDemo['marca'] . "\n" .

        "Modelo: " .
        $bienDemo['modelo'] . "\n" .

        "Categoría: " .
        $bienDemo['categoria'] . "\n" .

        "Estado: " .
        $bienDemo['estado'] . "\n" .

        "Fecha de Alta: " .
        $bienDemo['fecha_alta'] . "\n" .

        "Valor de Adquisición: $" .
        $importe . "\n" .

        "Dependencia Actual: " .
        $bienDemo['dependencia_actual'] . "\n\n" .

        "PERSONAS A CARGO\n\n" .

        "Luis Eduardo Garcia\n" .
        "Desde: 15/03/2024\n" .
        "Dirección de Informática\n\n" .

        "María Rosa López\n" .
        "Desde: 10/01/2022\n" .
        "Hasta: 14/03/2024\n" .
        "Dirección de Sistemas",

        JSON_UNESCAPED_UNICODE |
        JSON_UNESCAPED_SLASHES

    ) ?>;


    /*
     * Web Share API
     */

    if (
        navigator.share &&
        /Android|iPhone|iPad|iPod/i.test(navigator.userAgent)
    ) {

        navigator.share({

            title: 'Detalle del Bien',

            text: texto

        }).catch(function(error) {

            console.log(
                'Compartir cancelado:',
                error
            );

        });

        return;

    }


    /*
     * Fallback: WhatsApp
     */

    window.open(

        'https://wa.me/?text=' +
        encodeURIComponent(texto),

        '_blank'

    );

}

</script>