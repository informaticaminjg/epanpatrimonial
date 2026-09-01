<?php

use yii\helpers\Html;
use yii\helpers\Url;
use app\models\HistorialEscaneo;

/** @var yii\web\View $this */
/** @var app\models\HistorialEscaneo[] $historial */

$this->title = 'Escaneos';


/*
 * ============================================================
 * DATOS DEMO
 * ============================================================
 *
 * Mientras no tengamos registros reales, mostramos estos datos.
 *
 * Cuando existan registros reales en epan_historial_escaneo,
 * el listado utilizará esos registros.
 *
 */

$datosDemo = [
    [
        'id' => 1,
        'codigo' => '1234567890123',
        'tipo' => 'Código de barras',
        'resultado' => 'Encontrado',
        'fecha_hora' => '2024-05-26 10:15:00',
    ],
    [
        'id' => 2,
        'codigo' => 'MAT-2024-000123',
        'tipo' => 'Matrícula manual',
        'resultado' => 'Encontrado',
        'fecha_hora' => '2024-05-26 10:14:00',
    ],
    [
        'id' => 3,
        'codigo' => 'MAT-2024-000122',
        'tipo' => 'Matrícula manual',
        'resultado' => 'No encontrado',
        'fecha_hora' => '2024-05-26 10:13:00',
    ],
    [
        'id' => 4,
        'codigo' => '9876543210987',
        'tipo' => 'Código de barras',
        'resultado' => 'Encontrado',
        'fecha_hora' => '2024-05-26 10:12:00',
    ],
    [
        'id' => 5,
        'codigo' => 'MAT-2024-000121',
        'tipo' => 'Matrícula manual',
        'resultado' => 'Encontrado',
        'fecha_hora' => '2024-05-26 10:11:00',
    ],
    [
        'id' => 6,
        'codigo' => 'MAT-2024-000120',
        'tipo' => 'Matrícula manual',
        'resultado' => 'No encontrado',
        'fecha_hora' => '2024-05-26 10:10:00',
    ],
    [
        'id' => 7,
        'codigo' => '1234509876543',
        'tipo' => 'Código de barras',
        'resultado' => 'Encontrado',
        'fecha_hora' => '2024-05-26 10:08:00',
    ],
    [
        'id' => 8,
        'codigo' => 'MAT-2024-000119',
        'tipo' => 'Matrícula manual',
        'resultado' => 'Encontrado',
        'fecha_hora' => '2024-05-26 10:06:00',
    ],
    [
        'id' => 9,
        'codigo' => 'MAT-2024-000118',
        'tipo' => 'Matrícula manual',
        'resultado' => 'No encontrado',
        'fecha_hora' => '2024-05-26 10:04:00',
    ],
    [
        'id' => 10,
        'codigo' => '9876501234567',
        'tipo' => 'Código de barras',
        'resultado' => 'Encontrado',
        'fecha_hora' => '2024-05-26 10:02:00',
    ],
];


/*
 * ============================================================
 * PREPARAR DATOS
 * ============================================================
 */

$usarDemo = empty($historial);

$items = [];


if ($usarDemo) {

    $items = $datosDemo;

} else {

    foreach ($historial as $registro) {

        /*
         * El tipo actualmente se guarda dentro de descripcion:
         *
         * "Consulta por barcode"
         * "Consulta por matricula"
         */

        $descripcion =
            strtolower(
                trim(
                    (string) $registro->descripcion
                )
            );


        if (
            strpos($descripcion, 'barcode') !== false ||
            strpos($descripcion, 'código') !== false ||
            strpos($descripcion, 'codigo') !== false
        ) {

            $tipo = 'Código de barras';

        } else {

            $tipo = 'Matrícula manual';

        }


        /*
         * Si patrimonio_id tiene valor,
         * significa que SICOPRO encontró el bien.
         *
         * Esto coincide con el flujo actual donde el historial
         * se guarda después de encontrar el bien. 
         */

        $resultado =
            !empty($registro->patrimonio_id)
                ? 'Encontrado'
                : 'No encontrado';


        $items[] = [
            'id' => $registro->id,
            'codigo' => $registro->codigo,
            'tipo' => $tipo,
            'resultado' => $resultado,
            'fecha_hora' => $registro->fecha_hora,
        ];
    }
}

?>

<style>
    .relevamientos-header {
    height: 76px;
    background: linear-gradient(135deg, #0645c7, #145bd8);
    color: white;

    display: flex;
    align-items: center;
    justify-content: space-between;

    padding: 0 18px;

    box-shadow: 0 2px 8px rgba(0,0,0,.12);
}

.header-left {
    display: flex;
    align-items: center;
    gap: 13px;
}

.header-left h1 {
    margin: 0;
    font-size: 20px;
    font-weight: 700;
}

.header-left span {
    display: block;
    margin-top: 2px;
    font-size: 12px;
    opacity: .82;
}

.header-back,
.header-filter-btn {
    border: 0;
    background: transparent;
    color: white;

    width: 38px;
    height: 38px;

    border-radius: 50%;

    display: flex;
    align-items: center;
    justify-content: center;

    font-size: 18px;

    cursor: pointer;
}

.header-back:active,
.header-filter-btn:active {
    background: rgba(255,255,255,.15);
}


    .brand {
    display: flex  !important;
    align-items: center  !important;
    gap: 5px  !important;
    white-space: nowrap  !important;
    font-size: 18px  !important;
}
.brand span {
    font-weight: 500 !important;
    font-size: 18px !important;
}
.relevamientos-header,
.relevamientos-header .header-back,
.relevamientos-header .header-filter-btn {
    background: transparent !important;
    color: #000 !important;
    border: none;
}


    /* =========================================================
   OVERLAY FILTROS
========================================================= */

.filtros-overlay {

    position: fixed;

    inset: 0;

    background:
        rgba(0, 0, 0, .35);

    opacity: 0;

    visibility: hidden;

    transition:
        .25s ease;

    z-index: 2000;
}

.filtros-overlay.open {

    opacity: 1;

    visibility: visible;
}


/* =========================================================
   PANEL FILTROS
========================================================= */

.filtros-panel {

    position: fixed;

    left: 50%;

    bottom: 0;

    transform:
        translate(
            -50%,
            100%
        );

    width:
        min(
            100%,
            420px
        );

    background: #ffffff;

    border-radius:
        18px
        18px
        0
        0;

    box-shadow:
        0 -5px 25px
        rgba(0,0,0,.15);

    z-index: 2001;

    transition:
        transform
        .3s
        ease;

    overflow: hidden;
}

.filtros-panel.open {

    transform:
        translate(
            -50%,
            0
        );
}


/* =========================================================
   HEADER PANEL
========================================================= */

.filtros-panel-header {

    display: flex;

    align-items: center;

    justify-content: space-between;

    padding:
        18px
        18px
        14px;

    border-bottom:
        1px solid
        #edf0f4;
}

.filtros-panel-header h3 {

    margin: 0 0 3px;

    font-size: 17px;

    font-weight: 700;

    color: #172033;
}

.filtros-panel-header span {

    font-size: 11px;

    color: #7a8495;
}

.filtros-cerrar {

    width: 34px;

    height: 34px;

    border: none;

    border-radius: 50%;

    background: #f1f3f6;

    color: #4d596b;

    display: flex;

    align-items: center;

    justify-content: center;

    font-size: 16px;

    cursor: pointer;
}


/* =========================================================
   BODY
========================================================= */

.filtros-panel-body {

    padding:
        18px;

    max-height:
        70vh;

    overflow-y: auto;
}


/* =========================================================
   GRUPO
========================================================= */

.filtro-grupo {

    margin-bottom: 18px;
}

.filtro-grupo > label {

    display: block;

    margin-bottom: 8px;

    font-size: 12px;

    font-weight: 600;

    color: #26354b;
}


/* =========================================================
   FECHAS
========================================================= */

.filtro-fechas {

    display: flex;

    gap: 8px;
}

.filtro-input {

    flex: 1;
}

.filtro-input span {

    display: block;

    font-size: 10px;

    color: #7a8495;

    margin-bottom: 4px;
}

.filtro-input input {

    width: 100%;

    height: 38px;

    box-sizing: border-box;

    border:
        1px solid
        #e0e5ec;

    border-radius: 8px;

    padding:
        0
        9px;

    font-size: 11px;

    color: #26354b;

    outline: none;

    background: #ffffff;
}

.filtro-input input:focus {

    border-color:
        #0751c8;
}


/* =========================================================
   SELECT
========================================================= */

.filtro-grupo select {

    width: 100%;

    height: 40px;

    border:
        1px solid
        #e0e5ec;

    border-radius: 8px;

    padding:
        0
        10px;

    background: #ffffff;

    color: #26354b;

    font-size: 11px;

    outline: none;
}

.filtro-grupo select:focus {

    border-color:
        #0751c8;
}


/* =========================================================
   ACCIONES
========================================================= */

.filtros-acciones {

    display: flex;

    gap: 9px;

    padding-top: 5px;
}

.btn-limpiar-filtros {

    flex: 1;

    height: 42px;

    border:
        1px solid
        #dfe4eb;

    border-radius: 9px;

    background: #ffffff;

    color: #455268;

    font-size: 12px;

    font-weight: 600;

    cursor: pointer;
}

.btn-aplicar-filtros {

    flex: 1.5;

    height: 42px;

    border: none;

    border-radius: 9px;

    background: #0751c8;

    color: #ffffff;

    font-size: 12px;

    font-weight: 600;

    cursor: pointer;

    box-shadow:
        0 4px 10px
        rgba(7,81,200,.20);
}


/* =========================================================
   BODY BLOQUEADO
========================================================= */

body.filtros-abiertos {

    overflow: hidden;
}
/* =========================================================
   HEADER
========================================================= */


.relevamientos-header {
    height: 76px;
    background: linear-gradient(135deg, #0645c7, #145bd8);
    color: white;

    display: flex;
    align-items: center;
    justify-content: space-between;

    padding: 0 18px;

    box-shadow: 0 2px 8px rgba(0,0,0,.12);
}

.header-left {
    display: flex;
    align-items: center;
    gap: 13px;
}

.header-left h1 {
    margin: 0;
    font-size: 20px;
    font-weight: 700;
}

.header-left span {
    display: block;
    margin-top: 2px;
    font-size: 12px;
    opacity: .82;
}

.header-back,
.header-filter-btn {
    border: 0;
    background: transparent;
    color: white;

    width: 38px;
    height: 38px;

    border-radius: 50%;

    display: flex;
    align-items: center;
    justify-content: center;

    font-size: 18px;

    cursor: pointer;
}

.header-back:active,
.header-filter-btn:active {
    background: rgba(255,255,255,.15);
    }
/* =========================================================
   CONTENEDOR GENERAL
========================================================= */

.escaneos-page {
    min-height: 100vh;

    background: #ffffff;

    color: #172033;

    font-family:
        -apple-system,
        BlinkMacSystemFont,
        "Segoe UI",
        Roboto,
        Helvetica,
        Arial,
        sans-serif;

    padding-bottom: 82px;
}


/* =========================================================
   HEADER
========================================================= */

.escaneos-header {

   
    background:
       transparent;

    color: #172033;

    display: flex;
    align-items: flex-end;

    padding:
        12px
        22px
        18px;

    position: relative;
}

.escaneos-menu {

    width: 34px;
    height: 34px;

    border: none;

    background: transparent;

    color: #ffffff;

    display: flex;
    align-items: center;
    justify-content: center;

    font-size: 22px;

    cursor: pointer;

    padding: 0;
}

.escaneos-title {

    position: absolute;

    left: 50%;
    bottom: 19px;

    transform:
        translateX(-50%);

    margin: 0;

    font-size: 16px;

    font-weight: 700;

    color: #ffffff;
}

.escaneos-notificacion {

    margin-left: auto;

    width: 34px;
    height: 34px;

    border: none;

    background: transparent;

    color: #ffffff;

    font-size: 22px;

    position: relative;

    cursor: pointer;

    padding: 0;
}

.notificacion-dot {

    position: absolute;

    width: 8px;
    height: 8px;

    top: 3px;
    right: 2px;

    background: #ff3838;

    border-radius: 50%;

    border:
        1.5px solid
        #ffffff;
}


/* =========================================================
   TABS
========================================================= */

.escaneos-tabs {

    display: flex;

    align-items: center;

    gap: 0;

    padding:
        10px
        14px
        8px;

    background: #ffffff;

    border-bottom:
        1px solid
        #e8ebef;
}


.escaneos-tab {

    flex: 1;

    height: 37px;

    border: none;

    background: transparent;

    color: #1c2a40;

    font-size: 12px;

    font-weight: 500;

    padding:
        0
        5px;

    border-radius: 9px;

    cursor: pointer;

    white-space: nowrap;

    display: flex;

    align-items: center;

    justify-content: center;

    transition:
        .15s ease;
}


.escaneos-tab.activo {

    background: #0751c8;

    color: #ffffff;

    font-weight: 600;

    box-shadow:
        0 3px 7px
        rgba(7, 81, 200, .18);
}
/* =========================================================
   BUSCADOR
========================================================= */

.escaneos-busqueda {

    padding:
        8px
        15px
        10px;
}

.busqueda-contenedor {

    height: 40px;

    border:
        1px solid
        #e1e6ed;

    border-radius: 9px;

    display: flex;

    align-items: center;

    padding:
        0
        12px;

    background: #ffffff;
}

.busqueda-contenedor > i {

    color: #68758a;

    font-size: 14px;

    margin-right: 10px;
}

.busqueda-contenedor input {

    border: none;

    outline: none;

    width: 100%;

    font-size: 12px;

    color: #273449;

    background: transparent;
}

.busqueda-contenedor input::placeholder {

    color: #718096;
}

.boton-filtros {

    border: none;

    background: transparent;

    color: #273449;

    font-size: 16px;

    cursor: pointer;

    padding: 0;
}


/* =========================================================
   FILTROS
========================================================= */

.escaneos-filtros {

    display: flex;

    gap: 7px;

    padding:
        2px
        15px
        13px;

    overflow-x: auto;

    scrollbar-width: none;
}

.escaneos-filtros::-webkit-scrollbar {
    display: none;
}

.filtro {

    height: 30px;

    padding:
        0
        9px;

    border:
        1px solid
        #e0e5ec;

    background: #ffffff;

    border-radius: 7px;

    display: flex;

    align-items: center;

    gap: 7px;

    color: #26354b;

    font-size: 10px;

    white-space: nowrap;

    cursor: pointer;
}

.filtro i {

    font-size: 10px;

    color: #617087;
}


/* =========================================================
   LISTADO
========================================================= */

.escaneos-lista {

    padding:
        3px
        15px
        0;
}

.escaneo-card {

    min-height: 84px;

    border:
        1px solid
        #e6eaf0;

    border-radius: 9px;

    margin-bottom: 7px;

    display: flex;

    align-items: center;

    padding:
        9px
        10px;

    background: #ffffff;

    box-shadow:
        0 1px 5px
        rgba(30, 45, 65, .025);

    cursor: pointer;

    transition:
        .15s ease;
}

.escaneo-card:hover {

    border-color:
        #d2d9e3;

    transform:
        translateY(-1px);
}


/* =========================================================
   ICONO
========================================================= */

.escaneo-icono {

    width: 44px;
    height: 44px;

    border-radius: 8px;

    background:
        linear-gradient(
            145deg,
            #f1f3f5,
            #e7e9eb
        );

    display: flex;

    align-items: center;
    justify-content: center;

    margin-right: 11px;

    flex-shrink: 0;

    color: #151515;
}

.escaneo-icono i {

    font-size: 24px;
}


/* =========================================================
   INFORMACION
========================================================= */

.escaneo-info {

    min-width: 0;

    flex: 1;
}

.escaneo-valor {

    font-size: 13px;

    font-weight: 700;

    color: #182237;

    margin-bottom: 3px;

    white-space: nowrap;

    overflow: hidden;

    text-overflow: ellipsis;
}

.escaneo-tipo {

    font-size: 11px;

    color: #26354a;

    margin-bottom: 4px;
}

.escaneo-fecha {

    font-size: 10px;

    color: #536075;
}


/* =========================================================
   RESULTADO
========================================================= */

.escaneo-resultado {

    display: flex;

    align-items: center;

    gap: 9px;

    margin-left: 8px;
}

.resultado-texto {

    font-size: 10px;

    font-weight: 500;

    white-space: nowrap;
}

.resultado-texto.encontrado {

    color: #159447;
}

.resultado-texto.no-encontrado {

    color: #ef2d2d;
}

.escaneo-flecha {

    color: #6d7580;

    font-size: 13px;
}

.resultado-no-encontrado
.escaneo-flecha {

    color: #ef4545;
}


/* =========================================================
   SIN RESULTADOS
========================================================= */

.sin-resultados {

    display: none;

    text-align: center;

    padding:
        45px
        20px;

    color: #778397;

    font-size: 12px;
}

.sin-resultados i {

    font-size: 30px;

    margin-bottom: 10px;

    display: block;
}


/* =========================================================
   NAVEGACION INFERIOR
========================================================= */

.escaneos-bottom-nav {

    position: fixed;

    left: 50%;
    bottom: 0;

    transform:
        translateX(-50%);

    width:
        min(100%, 420px);

    height: 61px;

    background:
        rgba(
            255,
            255,
            255,
            .97
        );

    border-top:
        1px solid
        #e8ebef;

    display: flex;

    justify-content: space-around;

    align-items: center;

    z-index: 1000;
}

.bottom-item {

    flex: 1;

    height: 100%;

    display: flex;

    flex-direction: column;

    align-items: center;

    justify-content: center;

    color: #667184;

    text-decoration: none;

    font-size: 9px;

    position: relative;
}

.bottom-item i {

    font-size: 17px;

    margin-bottom: 3px;
}

.bottom-item.activo {

    color: #0751c8;

    font-weight: 600;
}

.bottom-item.escanear {

    margin-top: -20px;
}

.icono-escanear {

    width: 38px;
    height: 38px;

    border-radius: 50%;

    background: #0751c8;

    color: #ffffff;

    display: flex;

    align-items: center;
    justify-content: center;

    box-shadow:
        0 4px 12px
        rgba(7,81,200,.28);

    border:
        3px solid
        #ffffff;

    margin-bottom: 3px;
}

.icono-escanear i {

    font-size: 18px;

    margin: 0;
}


/* =========================================================
   RESPONSIVE
========================================================= */

@media (min-width: 600px) {

    .escaneos-page {

        max-width: 420px;

        margin: 0 auto;

        border-left:
            1px solid
            #edf0f4;

        border-right:
            1px solid
            #edf0f4;
    }

    .escaneos-bottom-nav {

        border-left:
            1px solid
            #e8ebef;

        border-right:
            1px solid
            #e8ebef;
    }
}

</style>


<div class="escaneos-page">

        <!-- =====================================================
         HEADER
    ====================================================== -->
    
    <div class="escaneos-header">       
       <div class="header-left">           
            <div>
                <h1>Escaneos</h1>
                <span>Gestión de escaneos patrimoniales</span>
            </div>
        </div>
    </div>


    <!-- =====================================================
         TABS
    ====================================================== -->

    <div class="escaneos-tabs">

        <button
            type="button"
            class="escaneos-tab activo"
            data-tab="ultimas">

            Últimas 10

        </button>

        <button
            type="button"
            class="escaneos-tab"
            data-tab="todas">

            Todas

        </button>

        <button
            type="button"
            class="escaneos-tab"
            data-tab="mias">

            Mis escaneos

        </button>

    </div>


    <!-- =====================================================
         BUSCADOR
    ====================================================== -->

    <div class="escaneos-busqueda">

        <div class="busqueda-contenedor">

            <i class="fa-solid fa-magnifying-glass"></i>

            <input
                type="text"
                id="buscarEscaneos"
                placeholder="Buscar escaneos..."
                autocomplete="off">

            <button
                type="button"
                class="boton-filtros"
                id="abrirFiltros">

                <i class="fa-solid fa-sliders"></i>

            </button>

        </div>

    </div>


    <!-- =====================================================
         FILTROS
    ====================================================== -->

    <div class="escaneos-filtros">

        <button
            type="button"
            class="filtro">

            Fecha

            <i class="fa-regular fa-calendar"></i>

        </button>


        <button
            type="button"
            class="filtro"
            data-filter="tipo">

            Tipo

            <i class="fa-solid fa-chevron-down"></i>

        </button>


        <button
            type="button"
            class="filtro"
            data-filter="resultado">

            Resultado

            <i class="fa-solid fa-chevron-down"></i>

        </button>


        <button
            type="button"
            class="filtro">

            Más filtros

        </button>

    </div>


    <!-- =====================================================
         LISTADO
    ====================================================== -->

    <div
        class="escaneos-lista"
        id="listaEscaneos">


        <?php foreach ($items as $item): ?>

            <?php

            $codigo =
                (string) $item['codigo'];

            $tipo =
                (string) $item['tipo'];

            $resultado =
                (string) $item['resultado'];

            $fecha =
                date(
                    'd/m/Y H:i',
                    strtotime(
                        $item['fecha_hora']
                    )
                );

            $encontrado =
                $resultado === 'Encontrado';

            $esBarcode =
                $tipo === 'Código de barras';

            ?>


            <div
                class="escaneo-card"

                data-id="<?= Html::encode($item['id']) ?>"

                data-codigo="<?= Html::encode(strtolower($codigo)) ?>"

                data-tipo="<?= Html::encode(strtolower($tipo)) ?>"

                data-resultado="<?= Html::encode(strtolower($resultado)) ?>">


                <!-- ICONO -->

                <div class="escaneo-icono">

                    <?php if ($esBarcode): ?>

                        <i class="fa-solid fa-barcode"></i>

                    <?php else: ?>

                        <i class="fa-solid fa-pen"></i>

                    <?php endif; ?>

                </div>


                <!-- INFORMACION -->

                <div class="escaneo-info">

                    <div class="escaneo-valor">

                        <?= Html::encode($codigo) ?>

                    </div>


                    <div class="escaneo-tipo">

                        <?= Html::encode($tipo) ?>

                    </div>


                    <div class="escaneo-fecha">

                        <?= Html::encode($fecha) ?>

                    </div>

                </div>


                <!-- RESULTADO -->

                <div
                    class="
                        escaneo-resultado
                        <?= !$encontrado
                            ? 'resultado-no-encontrado'
                            : ''
                        ?>
                    ">


                    <span
                        class="
                            resultado-texto
                            <?= $encontrado
                                ? 'encontrado'
                                : 'no-encontrado'
                            ?>
                        ">

                        <?= Html::encode($resultado) ?>

                    </span>


                    <i
                        class="
                            fa-solid
                            fa-chevron-right
                            escaneo-flecha
                        ">
                    </i>

                </div>

            </div>

        <?php endforeach; ?>


        <div
            class="sin-resultados"
            id="sinResultados">

            <i
                class="fa-solid fa-magnifying-glass">
            </i>

            No se encontraron escaneos.

        </div>


<!-- =====================================================
     OVERLAY FILTROS
====================================================== -->

<div
    class="filtros-overlay"
    id="filtrosOverlay">
</div>


<!-- =====================================================
     PANEL DE FILTROS
====================================================== -->

<div
    class="filtros-panel"
    id="filtrosPanel">


    <!-- HEADER -->

    <div class="filtros-panel-header">

        <div>

            <h3>
                Filtros
            </h3>

            <span>
                Filtrá tus escaneos
            </span>

        </div>


        <button
            type="button"
            class="filtros-cerrar"
            id="cerrarFiltros">

            <i class="fa-solid fa-xmark"></i>

        </button>

    </div>


    <!-- CONTENIDO -->

    <div class="filtros-panel-body">


        <!-- FECHA -->

        <div class="filtro-grupo">

            <label>
                Fecha
            </label>

            <div class="filtro-fechas">

                <div class="filtro-input">

                    <span>
                        Desde
                    </span>

                    <input
                        type="date"
                        id="fechaDesde">

                </div>


                <div class="filtro-input">

                    <span>
                        Hasta
                    </span>

                    <input
                        type="date"
                        id="fechaHasta">

                </div>

            </div>

        </div>


        <!-- TIPO -->

        <div class="filtro-grupo">

            <label>
                Tipo de escaneo
            </label>

            <select id="filtroTipo">

                <option value="">
                    Todos
                </option>

                <option value="Código de barras">
                    Código de barras
                </option>

                <option value="Matrícula manual">
                    Matrícula manual
                </option>

            </select>

        </div>


        <!-- RESULTADO -->

        <div class="filtro-grupo">

            <label>
                Resultado
            </label>

            <select id="filtroResultado">

                <option value="">
                    Todos
                </option>

                <option value="Encontrado">
                    Encontrado
                </option>

                <option value="No encontrado">
                    No encontrado
                </option>

            </select>

        </div>


        <!-- ACCIONES -->

        <div class="filtros-acciones">

            <button
                type="button"
                class="btn-limpiar-filtros"
                id="limpiarFiltros">

                Limpiar

            </button>


            <button
                type="button"
                class="btn-aplicar-filtros"
                id="aplicarFiltros">

                Aplicar filtros

            </button>

        </div>

    </div>

</div>




    </div>


    

<script>

document.addEventListener(
    'DOMContentLoaded',
    function () {


        const buscador =
            document.getElementById(
                'buscarEscaneos'
            );


        const tarjetas =
            document.querySelectorAll(
                '.escaneo-card'
            );


        const sinResultados =
            document.getElementById(
                'sinResultados'
            );


        const tabs =
            document.querySelectorAll(
                '.escaneos-tab'
            );


        /*
         * =====================================================
         * FILTRAR LISTADO
         * =====================================================
         */

        function filtrar() {

            const texto =
                buscador.value
                    .toLowerCase()
                    .trim();


            let visibles = 0;


            tarjetas.forEach(
                function (card) {


                    const codigo =
                        card.dataset.codigo || '';


                    const tipo =
                        card.dataset.tipo || '';


                    const resultado =
                        card.dataset.resultado || '';


                    const coincide =
                        codigo.includes(texto) ||
                        tipo.includes(texto) ||
                        resultado.includes(texto);


                    if (coincide) {

                        card.style.display =
                            'flex';

                        visibles++;

                    } else {

                        card.style.display =
                            'none';

                    }

                }
            );


            sinResultados.style.display =
                visibles === 0
                    ? 'block'
                    : 'none';

        }


        /*
         * =====================================================
         * BUSQUEDA
         * =====================================================
         */

        buscador.addEventListener(
            'input',
            filtrar
        );


        /*
         * =====================================================
         * TABS
         * =====================================================
         */

        tabs.forEach(
            function (tab) {

                tab.addEventListener(
                    'click',
                    function () {


                        tabs.forEach(
                            function (item) {

                                item.classList
                                    .remove(
                                        'activo'
                                    );

                            }
                        );


                        this.classList.add(
                            'activo'
                        );


                        /*
                         * Por ahora las tres pestañas
                         * trabajan sobre los datos demo.
                         *
                         * Más adelante:
                         *
                         * Últimas 10
                         * Todas
                         * Mis escaneos
                         *
                         * serán consultas distintas.
                         */

                    }
                );

            }
        );


        /*
         * =====================================================
         * CLICK EN UN ESCANEO
         * =====================================================
         */

        tarjetas.forEach(
            function (card) {

                card.addEventListener(
                    'click',
                    function () {


                        const id =
                            this.dataset.id;


                        /*
                         * Cuando tengamos el actionView
                         * del HistorialEscaneoController,
                         * vamos directamente al detalle.
                         */

                        <?php if (!$usarDemo): ?>

                        window.location.href =
                            '<?= Url::to(['view']) ?>'
                            + '?id='
                            + encodeURIComponent(id);

                        <?php else: ?>

                        console.log(
                            'Escaneo DEMO:',
                            id
                        );

                        <?php endif; ?>

                    }
                );

            }
        );


        /*
         * =====================================================
         * BOTON FILTROS
         * =====================================================
         */

        /* =====================================================
   FILTROS
===================================================== */

const botonFiltros =
    document.getElementById(
        'abrirFiltros'
    );

const filtrosPanel =
    document.getElementById(
        'filtrosPanel'
    );

const filtrosOverlay =
    document.getElementById(
        'filtrosOverlay'
    );

const cerrarFiltros =
    document.getElementById(
        'cerrarFiltros'
    );


function abrirPanelFiltros() {

    filtrosPanel.classList.add(
        'open'
    );

    filtrosOverlay.classList.add(
        'open'
    );

    document.body.classList.add(
        'filtros-abiertos'
    );
}


function cerrarPanelFiltros() {

    filtrosPanel.classList.remove(
        'open'
    );

    filtrosOverlay.classList.remove(
        'open'
    );

    document.body.classList.remove(
        'filtros-abiertos'
    );
}


/* ABRIR */

botonFiltros.addEventListener(
    'click',
    abrirPanelFiltros
);


/* CERRAR */

cerrarFiltros.addEventListener(
    'click',
    cerrarPanelFiltros
);


/* CERRAR TOCANDO AFUERA */

filtrosOverlay.addEventListener(
    'click',
    cerrarPanelFiltros
);


/* =====================================================
   LIMPIAR
===================================================== */

document
    .getElementById('limpiarFiltros')
    .addEventListener(
        'click',
        function () {

            document.getElementById(
                'fechaDesde'
            ).value = '';

            document.getElementById(
                'fechaHasta'
            ).value = '';

            document.getElementById(
                'filtroTipo'
            ).value = '';

            document.getElementById(
                'filtroResultado'
            ).value = '';

        }
    );


/* =====================================================
   APLICAR
===================================================== */

document
    .getElementById('aplicarFiltros')
    .addEventListener(
        'click',
        function () {

            /*
             * Por ahora es DEMO.
             *
             * Cerramos el panel.
             *
             * En el próximo paso podemos hacer que
             * estos filtros realmente filtren las
             * tarjetas del listado.
             */

            cerrarPanelFiltros();

        }
    );
    }
);

</script>