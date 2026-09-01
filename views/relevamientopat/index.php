<?php

use yii\helpers\Html;
use yii\helpers\Url;

/** @var yii\web\View $this */
/** @var array $relevamientos */

$this->title = 'Relevamientos';
?>

<div class="relevamientos-page">

    <!-- =====================================================
         HEADER
    ====================================================== -->
    <div class="relevamientos-header">

        <div class="header-left">           
            <div>
                <h1>Relevamientos</h1>
                <span>Gestión de relevamientos patrimoniales</span>
            </div>
        </div>

        <button
            type="button"
            class="header-filter-btn"
            id="btnAbrirFiltros">
            <i class="fa-solid fa-sliders"></i>
        </button>

    </div>


    <!-- =====================================================
         TABS
    ====================================================== -->
    <div class="relevamientos-tabs">

        <button
            type="button"
            class="relevamiento-tab active"
            data-tab="ultimos">
            Últimas 10
        </button>

        <button
            type="button"
            class="relevamiento-tab"
            data-tab="todos">
            Todos
        </button>

        <button
            type="button"
            class="relevamiento-tab"
            data-tab="mios">
            Mis relevamientos
        </button>

    </div>


    <!-- =====================================================
         BUSCADOR
    ====================================================== -->
    <div class="relevamientos-search">

        <div class="search-box">

            <i class="fa-solid fa-magnifying-glass"></i>

            <input
                type="text"
                id="buscarRelevamientos"
                placeholder="Buscar relevamientos...">

            <button
                type="button"
                id="btnLimpiarBusqueda"
                class="search-clear">
                <i class="fa-solid fa-xmark"></i>
            </button>

        </div>

    </div>


    <!-- =====================================================
         FILTROS RÁPIDOS
    ====================================================== -->
    <div class="filtros-rapidos">

        <button class="filtro-chip">
            <i class="fa-regular fa-calendar"></i>
            Fecha
            <i class="fa-solid fa-chevron-down"></i>
        </button>

        <button class="filtro-chip">
            Lugar
            <i class="fa-solid fa-chevron-down"></i>
        </button>

        <button class="filtro-chip">
            Estado
            <i class="fa-solid fa-chevron-down"></i>
        </button>

        <button class="filtro-chip filtro-mas" id="btnFiltrosAvanzados">
            <i class="fa-solid fa-sliders"></i>
            Más filtros
        </button>

    </div>


    <!-- =====================================================
         CONTADOR
    ====================================================== -->
    <div class="relevamientos-info">

        <div>
            <strong id="contadorRelevamientos">10</strong>
            <span>relevamientos</span>
        </div>

        <button
            type="button"
            class="btn-ordenar"
            id="btnOrdenar">

            <i class="fa-solid fa-arrow-down-wide-short"></i>
            Más recientes

        </button>

    </div>


    <!-- =====================================================
         LISTADO
    ====================================================== -->
    <div
        class="relevamientos-list"
        id="listaRelevamientos">


        <!-- =================================================
             RELEVAMIENTO 1
        ================================================== -->
       <div
            class="relevamiento-card"
            data-search="R-2024-000123 depósito central completado"
            data-owner="mio"            
            style="cursor: pointer;"
        >

            <div class="relevamiento-card-top">

                <div class="relevamiento-icon">
                    <i class="fa-solid fa-clipboard-check"></i>
                </div>

                <div class="relevamiento-main">

                    <div class="relevamiento-title-row">

                        <strong>
                            R-2024-000123
                        </strong>

                        <span class="estado estado-completado">
                            Completado
                        </span>

                    </div>

                    <div class="relevamiento-lugar">

                        <i class="fa-solid fa-location-dot"></i>

                        Depósito Central

                    </div>

                </div>

                <i class="fa-solid fa-chevron-right card-arrow"></i>

            </div>


            <div class="relevamiento-card-info">

                <div>
                    <i class="fa-regular fa-calendar"></i>
                    26/05/2024
                </div>

                <div>
                    <i class="fa-regular fa-clock"></i>
                    10:15
                </div>

                <div>
                    <i class="fa-solid fa-box"></i>
                    5 bienes
                </div>

            </div>


            <div class="relevamiento-card-footer">

                <span>
                    <i class="fa-regular fa-user"></i>
                    Luis Eduardo García
                </span>

                <span>
                    Hace 2 horas
                </span>

            </div>

        </div>


        <!-- =================================================
             RELEVAMIENTO 2
        ================================================== -->
        <div
            class="relevamiento-card"
            data-search="R-2024-000122 oficina neuquén en progreso"
            data-owner="otro">

            <div class="relevamiento-card-top">

                <div class="relevamiento-icon">
                    <i class="fa-solid fa-clipboard-list"></i>
                </div>

                <div class="relevamiento-main">

                    <div class="relevamiento-title-row">

                        <strong>
                            R-2024-000122
                        </strong>

                        <span class="estado estado-progreso">
                            En progreso
                        </span>

                    </div>

                    <div class="relevamiento-lugar">

                        <i class="fa-solid fa-location-dot"></i>

                        Oficina Neuquén

                    </div>

                </div>

                <i class="fa-solid fa-chevron-right card-arrow"></i>

            </div>


            <div class="relevamiento-card-info">

                <div>
                    <i class="fa-regular fa-calendar"></i>
                    24/05/2024
                </div>

                <div>
                    <i class="fa-regular fa-clock"></i>
                    15:30
                </div>

                <div>
                    <i class="fa-solid fa-box"></i>
                    3 bienes
                </div>

            </div>


            <div class="relevamiento-card-footer">

                <span>
                    <i class="fa-regular fa-user"></i>
                    María Rosa López
                </span>

                <span>
                    Hace 1 día
                </span>

            </div>

        </div>


        <!-- =================================================
             RELEVAMIENTO 3
        ================================================== -->
        <div
            class="relevamiento-card"
            data-search="R-2024-000121 planta industrial completado"
            data-owner="mio">

            <div class="relevamiento-card-top">

                <div class="relevamiento-icon">
                    <i class="fa-solid fa-clipboard-check"></i>
                </div>

                <div class="relevamiento-main">

                    <div class="relevamiento-title-row">

                        <strong>
                            R-2024-000121
                        </strong>

                        <span class="estado estado-completado">
                            Completado
                        </span>

                    </div>

                    <div class="relevamiento-lugar">

                        <i class="fa-solid fa-location-dot"></i>

                        Planta Industrial

                    </div>

                </div>

                <i class="fa-solid fa-chevron-right card-arrow"></i>

            </div>


            <div class="relevamiento-card-info">

                <div>
                    <i class="fa-regular fa-calendar"></i>
                    23/05/2024
                </div>

                <div>
                    <i class="fa-regular fa-clock"></i>
                    09:45
                </div>

                <div>
                    <i class="fa-solid fa-box"></i>
                    8 bienes
                </div>

            </div>


            <div class="relevamiento-card-footer">

                <span>
                    <i class="fa-regular fa-user"></i>
                    Luis Eduardo García
                </span>

                <span>
                    Hace 3 días
                </span>

            </div>

        </div>


        <!-- =================================================
             RELEVAMIENTO 4
        ================================================== -->
        <div
            class="relevamiento-card"
            data-search="R-2024-000120 depósito sur pendiente"
            data-owner="otro">

            <div class="relevamiento-card-top">

                <div class="relevamiento-icon">
                    <i class="fa-solid fa-clipboard"></i>
                </div>

                <div class="relevamiento-main">

                    <div class="relevamiento-title-row">

                        <strong>
                            R-2024-000120
                        </strong>

                        <span class="estado estado-pendiente">
                            Pendiente
                        </span>

                    </div>

                    <div class="relevamiento-lugar">

                        <i class="fa-solid fa-location-dot"></i>

                        Depósito Sur

                    </div>

                </div>

                <i class="fa-solid fa-chevron-right card-arrow"></i>

            </div>


            <div class="relevamiento-card-info">

                <div>
                    <i class="fa-regular fa-calendar"></i>
                    22/05/2024
                </div>

                <div>
                    <i class="fa-regular fa-clock"></i>
                    11:20
                </div>

                <div>
                    <i class="fa-solid fa-box"></i>
                    2 bienes
                </div>

            </div>


            <div class="relevamiento-card-footer">

                <span>
                    <i class="fa-regular fa-user"></i>
                    Juan Pérez
                </span>

                <span>
                    Hace 4 días
                </span>

            </div>

        </div>


        <!-- =================================================
             RELEVAMIENTO 5
        ================================================== -->
        <div
            class="relevamiento-card"
            data-search="R-2024-000119 sucursal plottier completado"
            data-owner="mio">

            <div class="relevamiento-card-top">

                <div class="relevamiento-icon">
                    <i class="fa-solid fa-clipboard-check"></i>
                </div>

                <div class="relevamiento-main">

                    <div class="relevamiento-title-row">

                        <strong>
                            R-2024-000119
                        </strong>

                        <span class="estado estado-completado">
                            Completado
                        </span>

                    </div>

                    <div class="relevamiento-lugar">

                        <i class="fa-solid fa-location-dot"></i>

                        Sucursal Plottier

                    </div>

                </div>

                <i class="fa-solid fa-chevron-right card-arrow"></i>

            </div>


            <div class="relevamiento-card-info">

                <div>
                    <i class="fa-regular fa-calendar"></i>
                    21/05/2024
                </div>

                <div>
                    <i class="fa-regular fa-clock"></i>
                    16:40
                </div>

                <div>
                    <i class="fa-solid fa-box"></i>
                    4 bienes
                </div>

            </div>


            <div class="relevamiento-card-footer">

                <span>
                    <i class="fa-regular fa-user"></i>
                    Luis Eduardo García
                </span>

                <span>
                    Hace 5 días
                </span>

            </div>

        </div>

    </div>


    <!-- =====================================================
         SIN RESULTADOS
    ====================================================== -->
    <div
        id="sinResultados"
        class="sin-resultados"
        style="display:none;">

        <div class="sin-resultados-icon">
            <i class="fa-solid fa-clipboard-list"></i>
        </div>

        <strong>No se encontraron relevamientos</strong>

        <span>
            Probá cambiando los filtros o el texto de búsqueda.
        </span>

    </div>


    <!-- =====================================================
         BOTÓN NUEVO
    ====================================================== -->
    <button
        type="button" 
        class="btn-nuevo-relevamiento"
        onclick="window.location.href='<?= Url::to(['relevamientopat/create']) ?>'">

        <i class="fa-solid fa-plus"></i>

    </button>


 

</div>


<!-- =========================================================
     FILTROS AVANZADOS
========================================================== -->

<div
    id="panelFiltros"
    class="panel-filtros">

    <div class="panel-filtros-header">

        <strong>Filtros</strong>

        <button
            type="button"
            id="cerrarFiltros">

            <i class="fa-solid fa-xmark"></i>

        </button>

    </div>


    <div class="filtro-form">

        <label>Fecha desde</label>

        <div class="input-icon">

            <i class="fa-regular fa-calendar"></i>

            <input
                type="date"
                id="fechaDesde">

        </div>


        <label>Fecha hasta</label>

        <div class="input-icon">

            <i class="fa-regular fa-calendar"></i>

            <input
                type="date"
                id="fechaHasta">

        </div>


        <label>Lugar</label>

        <select id="filtroLugar">

            <option value="">Todos</option>
            <option>Depósito Central</option>
            <option>Oficina Neuquén</option>
            <option>Planta Industrial</option>
            <option>Depósito Sur</option>
            <option>Sucursal Plottier</option>

        </select>


        <label>Estado</label>

        <select id="filtroEstado">

            <option value="">Todos</option>
            <option value="Completado">Completado</option>
            <option value="En progreso">En progreso</option>
            <option value="Pendiente">Pendiente</option>

        </select>


        <label>Responsable</label>

        <select id="filtroResponsable">

            <option value="">Todos</option>
            <option>Luis Eduardo García</option>
            <option>María Rosa López</option>
            <option>Juan Pérez</option>

        </select>


        <div class="filtros-footer">

            <button
                type="button"
                id="limpiarFiltros"
                class="btn-limpiar">

                Limpiar filtros

            </button>

            <button
                type="button"
                id="aplicarFiltros"
                class="btn-aplicar">

                Aplicar filtros

            </button>

        </div>

    </div>

</div>

<div
    id="overlayFiltros"
    class="overlay-filtros">
</div>

<style>
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
   BASE
========================================================= */

.relevamientos-page {
    min-height: 100vh;
    background: #f7f8fa;
    padding-bottom: 95px;
    font-family: -apple-system, BlinkMacSystemFont, "Segoe UI",
                 Roboto, Arial, sans-serif;
    color: #172033;
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
   TABS
========================================================= */

.relevamientos-tabs {
    background: white;

    display: flex;

    padding: 10px 14px 8px;

    gap: 6px;

    border-bottom: 1px solid #e8ebf0;
}

.relevamiento-tab {
    flex: 1;

    border: 0;

    background: transparent;

    color: #667085;

    font-size: 13px;
    font-weight: 600;

    padding: 10px 8px;

    border-radius: 9px;

    cursor: pointer;
}

.relevamiento-tab.active {
    background: #0756d9;
    color: white;
}


/* =========================================================
   SEARCH
========================================================= */

.relevamientos-search {
    padding: 13px 15px 8px;
}

.search-box {
    height: 45px;

    background: white;

    border: 1px solid #e0e4ea;

    border-radius: 10px;

    display: flex;
    align-items: center;

    padding: 0 13px;

    box-shadow: 0 1px 3px rgba(0,0,0,.03);
}

.search-box > i {
    color: #8b95a5;
    font-size: 14px;
}

.search-box input {
    border: 0;
    outline: 0;

    flex: 1;

    height: 100%;

    padding: 0 10px;

    font-size: 14px;

    background: transparent;
}

.search-clear {
    border: 0;
    background: transparent;

    color: #9ba3af;

    display: none;

    cursor: pointer;
}


/* =========================================================
   FILTROS RAPIDOS
========================================================= */

.filtros-rapidos {
    display: flex;

    gap: 7px;

    padding: 0 15px 10px;

    overflow-x: auto;

    scrollbar-width: none;
}

.filtros-rapidos::-webkit-scrollbar {
    display: none;
}

.filtro-chip {
    white-space: nowrap;

    height: 34px;

    background: white;

    border: 1px solid #dfe4ea;

    border-radius: 8px;

    padding: 0 10px;

    color: #465264;

    font-size: 12px;

    display: flex;
    align-items: center;

    gap: 6px;

    cursor: pointer;
}

.filtro-chip i:last-child {
    font-size: 8px;
}

.filtro-mas {
    color: #0756d9;
}


/* =========================================================
   INFO
========================================================= */

.relevamientos-info {
    display: flex;

    justify-content: space-between;
    align-items: center;

    padding: 4px 16px 10px;
}

.relevamientos-info strong {
    font-size: 14px;
}

.relevamientos-info span {
    font-size: 12px;
    color: #7a8493;
    margin-left: 4px;
}

.btn-ordenar {
    border: 0;
    background: transparent;

    color: #0756d9;

    font-size: 12px;

    cursor: pointer;
}


/* =========================================================
   CARDS
========================================================= */

.relevamientos-list {
    padding: 0 15px;
}

.relevamiento-card {
    background: white;

    border: 1px solid #e5e8ed;

    border-radius: 12px;

    padding: 13px;

    margin-bottom: 10px;

    box-shadow: 0 2px 5px rgba(16,24,40,.04);

    cursor: pointer;

    transition: .15s;
}

.relevamiento-card:active {
    transform: scale(.99);
}

.relevamiento-card-top {
    display: flex;
    align-items: center;
}

.relevamiento-icon {
    width: 42px;
    height: 42px;

    border-radius: 11px;

    background: #eaf1ff;

    color: #0756d9;

    display: flex;
    align-items: center;
    justify-content: center;

    font-size: 17px;

    flex-shrink: 0;
}

.relevamiento-main {
    flex: 1;
    min-width: 0;

    margin-left: 11px;
}

.relevamiento-title-row {
    display: flex;
    align-items: center;
    gap: 7px;
}

.relevamiento-title-row strong {
    font-size: 14px;
}

.estado {
    font-size: 10px;
    font-weight: 600;

    padding: 4px 7px;

    border-radius: 6px;

    white-space: nowrap;
}

.estado-completado {
    color: #168044;
    background: #e8f8ef;
}

.estado-progreso {
    color: #1765d1;
    background: #e7f0ff;
}

.estado-pendiente {
    color: #a66700;
    background: #fff4d9;
}

.relevamiento-lugar {
    margin-top: 4px;

    font-size: 12px;

    color: #596474;
}

.relevamiento-lugar i {
    width: 15px;

    color: #7e8998;
}

.card-arrow {
    color: #9aa3af;
    font-size: 12px;

    margin-left: 7px;
}


/* =========================================================
   CARD INFO
========================================================= */

.relevamiento-card-info {
    display: flex;

    gap: 14px;

    margin-top: 13px;

    padding-top: 9px;

    border-top: 1px solid #edf0f3;

    color: #687384;

    font-size: 11px;
}

.relevamiento-card-info div {
    display: flex;
    align-items: center;
    gap: 5px;
}

.relevamiento-card-info i {
    color: #8c96a5;
}


/* =========================================================
   CARD FOOTER
========================================================= */

.relevamiento-card-footer {
    display: flex;

    justify-content: space-between;

    margin-top: 8px;

    font-size: 10px;

    color: #9099a6;
}

.relevamiento-card-footer span:first-child {
    color: #687384;
}

.relevamiento-card-footer i {
    margin-right: 4px;
}


/* =========================================================
   SIN RESULTADOS
========================================================= */

.sin-resultados {
    text-align: center;

    padding: 55px 30px;

    color: #7b8593;
}

.sin-resultados-icon {
    width: 60px;
    height: 60px;

    margin: 0 auto 14px;

    border-radius: 50%;

    background: #edf3ff;

    color: #0756d9;

    display: flex;
    align-items: center;
    justify-content: center;

    font-size: 22px;
}

.sin-resultados strong {
    display: block;

    color: #273142;

    font-size: 15px;

    margin-bottom: 5px;
}

.sin-resultados span {
    font-size: 12px;
}


/* =========================================================
   BOTON NUEVO
========================================================= */

.btn-nuevo-relevamiento {
    position: fixed;

    right: 22px;
    bottom: 82px;

    width: 54px;
    height: 54px;

    border: 0;

    border-radius: 50%;

    background: #0756d9;

    color: white;

    font-size: 21px;

    box-shadow: 0 5px 15px rgba(7,86,217,.35);

    cursor: pointer;

    z-index: 100;
}

.btn-nuevo-relevamiento:active {
    transform: scale(.94);
}


/* =========================================================
   BOTTOM NAV
========================================================= */

.bottom-navigation {
    position: fixed;

    left: 0;
    right: 0;
    bottom: 0;

    height: 66px;

    background: white;

    border-top: 1px solid #e5e8ed;

    display: flex;

    justify-content: space-around;

    z-index: 90;

    padding-bottom: env(safe-area-inset-bottom);
}

.bottom-navigation a {
    flex: 1;

    text-decoration: none;

    color: #7c8694;

    display: flex;

    flex-direction: column;

    justify-content: center;

    align-items: center;

    gap: 4px;

    font-size: 10px;
}

.bottom-navigation a i {
    font-size: 18px;
}

.bottom-navigation a.active {
    color: #0756d9;
    font-weight: 600;
}


/* =========================================================
   PANEL FILTROS
========================================================= */

.panel-filtros {
    position: fixed;

    left: 0;
    right: 0;
    bottom: 0;

    background: white;

    border-radius: 18px 18px 0 0;

    z-index: 1001;

    transform: translateY(100%);

    transition: transform .25s ease;

    box-shadow: 0 -8px 30px rgba(0,0,0,.15);

    max-height: 85vh;

    overflow-y: auto;
}

.panel-filtros.open {
    transform: translateY(0);
}

.overlay-filtros {
    position: fixed;

    inset: 0;

    background: rgba(0,0,0,.42);

    z-index: 1000;

    opacity: 0;

    visibility: hidden;

    transition: .2s;
}

.overlay-filtros.open {
    opacity: 1;
    visibility: visible;
}

.panel-filtros-header {
    height: 60px;

    display: flex;

    align-items: center;

    justify-content: space-between;

    padding: 0 18px;

    border-bottom: 1px solid #edf0f3;
}

.panel-filtros-header strong {
    font-size: 17px;
}

.panel-filtros-header button {
    border: 0;

    background: #f1f3f6;

    width: 32px;
    height: 32px;

    border-radius: 50%;

    color: #606b7b;

    cursor: pointer;
}

.filtro-form {
    padding: 18px;
}

.filtro-form label {
    display: block;

    margin-bottom: 6px;
    margin-top: 13px;

    font-size: 12px;

    font-weight: 600;

    color: #344054;
}

.filtro-form label:first-child {
    margin-top: 0;
}

.filtro-form input,
.filtro-form select {
    width: 100%;

    height: 43px;

    border: 1px solid #dfe4ea;

    border-radius: 9px;

    padding: 0 12px;

    outline: none;

    font-size: 13px;

    background: white;

    color: #344054;
}

.input-icon {
    position: relative;
}

.input-icon i {
    position: absolute;

    left: 13px;
    top: 14px;

    color: #8c96a5;

    font-size: 13px;
}

.input-icon input {
    padding-left: 36px;
}

.filtros-footer {
    margin-top: 25px;
}

.btn-limpiar {
    width: 100%;

    border: 0;

    background: transparent;

    color: #0756d9;

    height: 42px;

    font-size: 13px;

    font-weight: 600;

    cursor: pointer;
}

.btn-aplicar {
    width: 100%;

    height: 45px;

    border: 0;

    border-radius: 9px;

    background: #0756d9;

    color: white;

    font-size: 13px;

    font-weight: 600;

    cursor: pointer;
}


/* =========================================================
   DESKTOP
========================================================= */

@media (min-width: 768px) {

    .relevamientos-page {
        max-width: 760px;
        margin: 0 auto;
        min-height: 100vh;

        border-left: 1px solid #e5e8ed;
        border-right: 1px solid #e5e8ed;
    }

    .bottom-navigation {
        max-width: 760px;
        left: 50%;
        transform: translateX(-50%);
    }

    .btn-nuevo-relevamiento {
        right: calc(50% - 350px);
    }

    .panel-filtros {
        max-width: 500px;

        left: 50%;
        right: auto;

        width: 500px;

        transform: translate(-50%, 100%);
    }

    .panel-filtros.open {
        transform: translate(-50%, 0);
    }

}

</style>


<script>

document.addEventListener('DOMContentLoaded', function () {

    const tabs = document.querySelectorAll('.relevamiento-tab');

    const cards = document.querySelectorAll('.relevamiento-card');

    const buscador = document.getElementById('buscarRelevamientos');

    const contador = document.getElementById('contadorRelevamientos');

    const sinResultados = document.getElementById('sinResultados');

    const btnLimpiarBusqueda =
        document.getElementById('btnLimpiarBusqueda');


    /* =====================================================
       TABS
    ====================================================== */

    tabs.forEach(tab => {

        tab.addEventListener('click', function () {

            tabs.forEach(t => t.classList.remove('active'));

            this.classList.add('active');

            const tipo = this.dataset.tab;

            let visibles = 0;

            cards.forEach(card => {

                let mostrar = true;

                if (tipo === 'mios') {

                    mostrar = card.dataset.owner === 'mio';

                }

                if (tipo === 'ultimos') {

                    mostrar = true;

                }

                if (tipo === 'todos') {

                    mostrar = true;

                }

                /*
                 * Guardamos el estado para combinar
                 * con el buscador.
                 */
                card.dataset.tabVisible = mostrar ? '1' : '0';

            });

            aplicarBusqueda();

        });

    });


    /* =====================================================
       BUSCADOR
    ====================================================== */

    buscador.addEventListener('input', function () {

        btnLimpiarBusqueda.style.display =
            this.value.length ? 'block' : 'none';

        aplicarBusqueda();

    });


    btnLimpiarBusqueda.addEventListener('click', function () {

        buscador.value = '';

        this.style.display = 'none';

        aplicarBusqueda();

    });


    function aplicarBusqueda() {

        const texto =
            buscador.value.toLowerCase().trim();

        let visibles = 0;

        cards.forEach(card => {

            const contenido =
                card.dataset.search.toLowerCase();

            const tabVisible =
                card.dataset.tabVisible !== '0';

            const coincide =
                !texto ||
                contenido.includes(texto);

            const mostrar =
                tabVisible && coincide;

            card.style.display =
                mostrar ? '' : 'none';

            if (mostrar) {
                visibles++;
            }

        });

        contador.textContent = visibles;

        sinResultados.style.display =
            visibles === 0 ? 'block' : 'none';

    }


    /*
     * Estado inicial
     */
    cards.forEach(card => {

        card.dataset.tabVisible = '1';

    });


    /* =====================================================
       PANEL FILTROS
    ====================================================== */

    const panel =
        document.getElementById('panelFiltros');

    const overlay =
        document.getElementById('overlayFiltros');

    const btnAbrir =
        document.getElementById('btnAbrirFiltros');

    const btnFiltrosAvanzados =
        document.getElementById('btnFiltrosAvanzados');

    const btnCerrar =
        document.getElementById('cerrarFiltros');


    function abrirFiltros() {

        panel.classList.add('open');

        overlay.classList.add('open');

        document.body.style.overflow = 'hidden';

    }


    function cerrarFiltros() {

        panel.classList.remove('open');

        overlay.classList.remove('open');

        document.body.style.overflow = '';

    }


    btnAbrir.addEventListener('click', abrirFiltros);

    btnFiltrosAvanzados.addEventListener(
        'click',
        abrirFiltros
    );

    btnCerrar.addEventListener(
        'click',
        cerrarFiltros
    );

    overlay.addEventListener(
        'click',
        cerrarFiltros
    );


    /* =====================================================
       LIMPIAR FILTROS
    ====================================================== */

    document.getElementById('limpiarFiltros')
        .addEventListener('click', function () {

            document.getElementById('fechaDesde').value = '';

            document.getElementById('fechaHasta').value = '';

            document.getElementById('filtroLugar').value = '';

            document.getElementById('filtroEstado').value = '';

            document.getElementById('filtroResponsable').value = '';

        });


    /* =====================================================
       APLICAR FILTROS
    ====================================================== */

    document.getElementById('aplicarFiltros')
        .addEventListener('click', function () {

            const lugar =
                document.getElementById('filtroLugar').value;

            const estado =
                document.getElementById('filtroEstado').value;

            const responsable =
                document.getElementById('filtroResponsable').value;


            let visibles = 0;


            cards.forEach(card => {

                let mostrar = true;

                const texto =
                    card.dataset.search.toLowerCase();


                if (
                    lugar &&
                    !texto.includes(lugar.toLowerCase())
                ) {
                    mostrar = false;
                }


                if (
                    estado &&
                    !texto.includes(estado.toLowerCase())
                ) {
                    mostrar = false;
                }


                if (
                    responsable &&
                    !texto.includes(responsable.toLowerCase())
                ) {
                    mostrar = false;
                }


                /*
                 * Respetar también la pestaña seleccionada.
                 */
                if (card.dataset.tabVisible === '0') {
                    mostrar = false;
                }


                card.style.display =
                    mostrar ? '' : 'none';


                if (mostrar) {
                    visibles++;
                }

            });


            contador.textContent = visibles;


            sinResultados.style.display =
                visibles === 0 ? 'block' : 'none';


            cerrarFiltros();

        });


    /* =====================================================
       CLICK EN RELEVAMIENTO
    ====================================================== */

    cards.forEach(card => {

        card.addEventListener('click', function () {

            const codigo =
                this.querySelector(
                    '.relevamiento-title-row strong'
                ).textContent.trim();

            /*
             * Por ahora usamos el código.
             * Después lo reemplazamos por el ID real.
             */

             window.location.href =
            '<?= \yii\helpers\Url::to([
                '/relevamientopat/detalle-relevamiento'
            ]) ?>'
            + '&id='
            + encodeURIComponent(1);

        });

    });

});

</script>