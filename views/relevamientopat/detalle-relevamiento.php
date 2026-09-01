<?php

use yii\helpers\Url;

/** @var yii\web\View $this */

$this->title = 'Detalle de Relevamiento';

?>

<div class="detalle-relevamiento-page">

    <!-- =====================================================
         HEADER
    ====================================================== -->

    <div class="detalle-header">

        <h1>Detalle de Relevamiento</h1>

        <button
            type="button"
            class="detalle-header-share"
            onclick="compartirRelevamiento()">

            <i class="fa-solid fa-share-nodes"></i>

        </button>

    </div>


    <!-- =====================================================
         CONTENIDO
    ====================================================== -->

    <div class="detalle-contenido">


        <!-- =================================================
             TARJETA PRINCIPAL
        ================================================== -->

        <div class="relevamiento-resumen-card">

            <div class="resumen-card-header">

                <strong>
                    R-2024-000123
                </strong>

                <span class="estado-completado">
                    Completado
                </span>

            </div>


            <div class="resumen-card-dato">

                <i class="fa-solid fa-location-dot"></i>

                <span>
                    Depósito Central
                </span>

            </div>


            <div class="resumen-card-dato">

                <i class="fa-regular fa-calendar"></i>

                <span>
                    26/05/2024 10:15
                </span>

            </div>


            <div class="resumen-card-dato">

                <i class="fa-regular fa-id-badge"></i>

                <span>
                    Responsable: Luis Eduardo García
                </span>

            </div>

        </div>


        <!-- =================================================
             TABS
        ================================================== -->

        <div class="detalle-tabs">

            <button
                type="button"
                class="detalle-tab active"
                data-tab="resumen">

                Resumen

            </button>


            <button
                type="button"
                class="detalle-tab"
                data-tab="bienes">

                Bienes (5)

            </button>


            <button
                type="button"
                class="detalle-tab"
                data-tab="ubicacion">

                Ubicación

            </button>


            <button
                type="button"
                class="detalle-tab"
                data-tab="fotos">

                Fotos

            </button>

        </div>


        <!-- =================================================
             TAB RESUMEN
        ================================================== -->

        <div
            id="tab-resumen"
            class="detalle-tab-content active">


            <!-- =============================================
                 INFORMACION GENERAL
            ============================================== -->

            <div class="detalle-card">

                <h2>
                    Información general
                </h2>


                <div class="detalle-info-row">

                    <span class="detalle-label">
                        Lugar
                    </span>

                    <span class="detalle-value">
                        Depósito Central
                    </span>

                </div>


                <div class="detalle-info-row">

                    <span class="detalle-label">
                        Dirección
                    </span>

                    <span class="detalle-value">
                        Av. Olascoaga 1234, Neuquén
                    </span>

                </div>


                <div class="detalle-info-row">

                    <span class="detalle-label">
                        Descripción
                    </span>

                    <span class="detalle-value">
                        Relevamiento de activos en depósito
                        central. Equipos y mobiliario.
                    </span>

                </div>


                <div class="detalle-info-row">

                    <span class="detalle-label">
                        Fecha y hora
                    </span>

                    <span class="detalle-value">
                        26/05/2024 10:15
                    </span>

                </div>


                <div class="detalle-info-row">

                    <span class="detalle-label">
                        Estado
                    </span>

                    <span class="detalle-value">

                        <span class="estado-completado estado-inline">
                            Completado
                        </span>

                    </span>

                </div>

            </div>


            <!-- =============================================
                 UBICACION
            ============================================== -->

            <div class="detalle-card ubicacion-card">

                <h2>
                    Ubicación
                </h2>


                <div id="mapa-relevamiento"
                    class="leaflet-container leaflet-touch leaflet-retina leaflet-fade-anim leaflet-grab leaflet-touch-drag leaflet-touch-zoom">
                </div>


                <div class="coordenadas">

                    Lat: -38.9516, Lng: -68.0591

                </div>
                <div class="distancia-lugar">
                    <i class="fa-solid fa-location-arrow"></i>

                    <div>
                        <span class="distancia-label">
                            Distancia al lugar
                        </span>

                        <strong id="distancia-lugar">
                            Calculando...
                        </strong>
                    </div>
                </div>

            </div>


            <!-- =============================================
                 RESUMEN DE BIENES
            ============================================== -->

            <div class="detalle-card bienes-resumen-card">

                <h2>
                    Resumen de bienes
                </h2>


                <div class="metricas-bienes">

                    <div class="metrica-bien">

                        <span>
                            Total bienes
                        </span>

                        <strong>
                            5
                        </strong>

                    </div>


                    <div class="metrica-bien">

                        <span>
                            Escaneos
                        </span>

                        <strong>
                            5
                        </strong>

                    </div>

                </div>

            </div>

        </div>


        <!-- =================================================
             TAB BIENES
        ================================================== -->

        <div
            id="tab-bienes"
            class="detalle-tab-content">


            <div class="detalle-card">

                <h2>
                    Bienes relevados
                </h2>


                <div class="bien-listado">

                    <div class="bien-item">

                        <div class="bien-item-icon">
                            <i class="fa-solid fa-laptop"></i>
                        </div>

                        <div class="bien-item-info">

                            <strong>
                                MAT-2024-000123
                            </strong>

                            <span>
                                Notebook Dell Latitude 5420
                            </span>

                        </div>

                        <i class="fa-solid fa-chevron-right"></i>

                    </div>


                    <div class="bien-item">

                        <div class="bien-item-icon">
                            <i class="fa-solid fa-desktop"></i>
                        </div>

                        <div class="bien-item-info">

                            <strong>
                                MAT-2024-000122
                            </strong>

                            <span>
                                Computadora de escritorio
                            </span>

                        </div>

                        <i class="fa-solid fa-chevron-right"></i>

                    </div>


                    <div class="bien-item">

                        <div class="bien-item-icon">
                            <i class="fa-solid fa-print"></i>
                        </div>

                        <div class="bien-item-info">

                            <strong>
                                MAT-2024-000121
                            </strong>

                            <span>
                                Impresora HP LaserJet
                            </span>

                        </div>

                        <i class="fa-solid fa-chevron-right"></i>

                    </div>


                    <div class="bien-item">

                        <div class="bien-item-icon">
                            <i class="fa-solid fa-chair"></i>
                        </div>

                        <div class="bien-item-info">

                            <strong>
                                MAT-2024-000120
                            </strong>

                            <span>
                                Silla ejecutiva ergonómica
                            </span>

                        </div>

                        <i class="fa-solid fa-chevron-right"></i>

                    </div>


                    <div class="bien-item">

                        <div class="bien-item-icon">
                            <i class="fa-solid fa-tv"></i>
                        </div>

                        <div class="bien-item-info">

                            <strong>
                                MAT-2024-000119
                            </strong>

                            <span>
                                Monitor Samsung 24"
                            </span>

                        </div>

                        <i class="fa-solid fa-chevron-right"></i>

                    </div>

                </div>

            </div>

        </div>


        <!-- =================================================
             TAB UBICACION
        ================================================== -->

        <div
            id="tab-ubicacion"
            class="detalle-tab-content">

            <div class="detalle-card">

                <h2>
                    Ubicación del relevamiento
                </h2>

                <div id="mapa-relevamiento-grande" class="mapa-relevamiento mapa-grande"></div>

                <div class="direccion-ubicacion">

                    <strong>
                        Depósito Central
                    </strong>

                    <span>
                        Av. Olascoaga 1234, Neuquén
                    </span>

                    <span>
                        Lat: -38.9516 · Lng: -68.0591
                    </span>

                </div>

            </div>

        </div>


        <!-- =================================================
             TAB FOTOS
        ================================================== -->

        <div
            id="tab-fotos"
            class="detalle-tab-content">

            <div class="detalle-card">

                <h2>
                    Fotografías
                </h2>

                
                <!-- =====================================================
     SWIPER CSS
===================================================== -->

<link
    rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"
/>


<!-- =====================================================
     FOTOS
===================================================== -->

<div class="swiper fotos-swiper">

    <div class="swiper-wrapper">

        <div class="swiper-slide foto-slide">
            <img
                src="https://images.unsplash.com/photo-1561070791-2526d30994b5?auto=format&fit=crop&w=800&q=80"
                alt="Imagen de ejemplo 1"
            >
        </div>

        <div class="swiper-slide foto-slide">
            <img
                src="https://images.unsplash.com/photo-1497366754035-f200968a6e72?auto=format&fit=crop&w=800&q=80"
                alt="Imagen de ejemplo 2"
            >
        </div>

        <div class="swiper-slide foto-slide">
            <img
                src="https://images.unsplash.com/photo-1497366811353-6870744d04b2?auto=format&fit=crop&w=800&q=80"
                alt="Imagen de ejemplo 3"
            >
        </div>

        <div class="swiper-slide foto-slide">
            <img
                src="https://images.unsplash.com/photo-1517048676732-d65bc937f952?auto=format&fit=crop&w=800&q=80"
                alt="Imagen de ejemplo 4"
            >
        </div>

    </div>

</div>


<!-- =====================================================
     VISOR GRANDE
===================================================== -->

<div
    id="visorFotos"
    class="visor-fotos"
>

    <!-- BOTÓN CERRAR -->

    <button
        type="button"
        id="cerrarVisorFotos"
        class="cerrar-visor-fotos"
    >
        <i class="fa-solid fa-xmark"></i>
    </button>


    <!-- SWIPER GRANDE -->

    <div class="swiper visor-swiper">

        <div class="swiper-wrapper">

            <div class="swiper-slide">

                <img
                    src="https://images.unsplash.com/photo-1561070791-2526d30994b5?auto=format&fit=crop&w=1800&q=90"
                    alt="Imagen de ejemplo 1"
                >

            </div>

            <div class="swiper-slide">

                <img
                    src="https://images.unsplash.com/photo-1497366754035-f200968a6e72?auto=format&fit=crop&w=1800&q=90"
                    alt="Imagen de ejemplo 2"
                >

            </div>

            <div class="swiper-slide">

                <img
                    src="https://images.unsplash.com/photo-1497366811353-6870744d04b2?auto=format&fit=crop&w=1800&q=90"
                    alt="Imagen de ejemplo 3"
                >

            </div>

            <div class="swiper-slide">

                <img
                    src="https://images.unsplash.com/photo-1517048676732-d65bc937f952?auto=format&fit=crop&w=1800&q=90"
                    alt="Imagen de ejemplo 4"
                >

            </div>

        </div>


        <!-- FLECHAS -->

        <div class="swiper-button-prev"></div>

        <div class="swiper-button-next"></div>


        <!-- PAGINACIÓN -->

        <div class="swiper-pagination"></div>

    </div>

</div>

                








                

            </div>

            </div>

        </div>

    </div>

</div>


<!-- =====================================================
     CSS
===================================================== -->

<style>
.ubicacion-card {
    width: 100%;
}

.ubicacion-card-header {
    display: flex;
    align-items: center;
    gap: 12px;
    margin-bottom: 12px;
}

.ubicacion-card-header > i {
    font-size: 22px;
}

.ubicacion-card-header span {
    display: block;
    font-size: 16px;
    font-weight: 700;
}

.ubicacion-card-header small {
    display: block;
    margin-top: 2px;
    font-size: 13px;
    color: #777;
}

.distancia-lugar {
    display: flex;
    align-items: center;
    gap: 12px;
    margin-top: 12px;
    padding: 12px 14px;
    border-radius: 10px;
    background: #f5f7fa;
}

.distancia-icono {
    width: 38px;
    height: 38px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    background: #e9eef5;
}

.distancia-info span {
    display: block;
    font-size: 13px;
    color: #777;
}

.distancia-info strong {
    display: block;
    margin-top: 2px;
    font-size: 17px;
}
/* =====================================================
   CONTENEDOR DE FOTOS
===================================================== */

.fotos-swiper {
    width: 100%;
    overflow: hidden;
}


/* =====================================================
   MOSTRAR LAS 4 FOTOS JUNTAS
===================================================== */

.fotos-swiper .swiper-wrapper {

    display: grid !important;

    grid-template-columns:
        repeat(4, minmax(0, 1fr));

    gap: 12px;

    transform: none !important;

}


/* =====================================================
   FOTO
===================================================== */

.fotos-swiper .swiper-slide {

    width: 100% !important;

    height: 180px;

    margin: 0 !important;

    border-radius: 12px;

    overflow: hidden;

    cursor: pointer;

    position: relative;

}


/* =====================================================
   IMAGEN
===================================================== */

.fotos-swiper .swiper-slide img {

    width: 100%;

    height: 100%;

    display: block;

    object-fit: cover;

    transition:
        transform .25s ease,
        filter .25s ease;

}


/* EFECTO AL PASAR EL MOUSE */

.fotos-swiper .foto-slide:hover img {

    transform: scale(1.05);

    filter: brightness(.9);

}


/* =====================================================
   VISOR GRANDE
===================================================== */

.visor-fotos {

    position: fixed;

    inset: 0;

    width: 100%;
    height: 100%;

    background:
        rgba(0, 0, 0, .94);

    z-index: 999999;

    display: none;

}


/* VISOR ABIERTO */

.visor-fotos.abierto {

    display: block;

}


/* =====================================================
   SWIPER DEL VISOR
===================================================== */

.visor-swiper {

    width: 100%;

    height: 100%;

}


/* =====================================================
   SLIDE GRANDE
===================================================== */

.visor-swiper .swiper-slide {

    width: 100%;

    height: 100%;

    display: flex;

    align-items: center;

    justify-content: center;

}


/* =====================================================
   IMAGEN GRANDE
===================================================== */

.visor-swiper .swiper-slide img {

    max-width: 90%;

    max-height: 85%;

    width: auto;

    height: auto;

    object-fit: contain;

    border-radius: 8px;

    user-select: none;

}


/* =====================================================
   BOTÓN CERRAR
===================================================== */

.cerrar-visor-fotos {

    position: absolute;

    top: 20px;

    right: 25px;

    width: 46px;

    height: 46px;

    border: none;

    border-radius: 50%;

    background:
        rgba(255, 255, 255, .18);

    color: white;

    font-size: 22px;

    display: flex;

    align-items: center;

    justify-content: center;

    cursor: pointer;

    z-index: 1000001;

    transition:
        background .2s ease,
        transform .2s ease;

}


.cerrar-visor-fotos:hover {

    background:
        rgba(255, 255, 255, .30);

    transform: scale(1.05);

}


/* =====================================================
   FLECHAS
===================================================== */

.visor-swiper
.swiper-button-prev,

.visor-swiper
.swiper-button-next {

    color: white;

}


/* =====================================================
   PAGINACIÓN
===================================================== */

.visor-swiper
.swiper-pagination {

    bottom: 25px;

}


.visor-swiper
.swiper-pagination-bullet {

    background: white;

}


/* =====================================================
   RESPONSIVE
===================================================== */

@media (max-width: 700px) {

    .fotos-swiper .swiper-wrapper {

        grid-template-columns:
            repeat(2, minmax(0, 1fr));

    }

    .fotos-swiper .swiper-slide {

        height: 150px;

    }

}

</style>


<!-- =====================================================
     SWIPER JS
===================================================== -->

<script
    src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js">
</script>


<!-- =====================================================
     JAVASCRIPT
===================================================== -->

<script>

document.addEventListener(
    'DOMContentLoaded',
    function () {


        /* =================================================
           VISOR
        ================================================= */

        const visor =
            document.getElementById(
                'visorFotos'
            );


        const cerrar =
            document.getElementById(
                'cerrarVisorFotos'
            );


        /* =================================================
           SWIPER DEL VISOR
        ================================================= */

        const visorSwiper =
            new Swiper(
                '.visor-swiper',
                {

                    slidesPerView: 1,

                    spaceBetween: 0,

                    navigation: {

                        nextEl:
                            '.visor-swiper .swiper-button-next',

                        prevEl:
                            '.visor-swiper .swiper-button-prev'

                    },

                    pagination: {

                        el:
                            '.visor-swiper .swiper-pagination',

                        clickable: true

                    },

                    keyboard: {

                        enabled: true

                    },

                    mousewheel: {

                        enabled: true

                    }

                }
            );


        /* =================================================
           CLICK EN LAS FOTOS
        ================================================= */

        const fotos =
            document.querySelectorAll(
                '.fotos-swiper .foto-slide'
            );


        fotos.forEach(
            function (foto, index) {

                foto.addEventListener(
                    'click',
                    function () {

                        visor.classList.add(
                            'abierto'
                        );


                        /*
                         * Ir a la foto seleccionada
                         */

                        visorSwiper.slideTo(
                            index,
                            0
                        );

                    }
                );

            }
        );


        /* =================================================
           CERRAR
        ================================================= */

        cerrar.addEventListener(
            'click',
            function () {

                visor.classList.remove(
                    'abierto'
                );

            }
        );


        /* =================================================
           CERRAR TOCANDO AFUERA
        ================================================= */

        visor.addEventListener(
            'click',
            function (event) {

                if (
                    event.target === visor
                ) {

                    visor.classList.remove(
                        'abierto'
                    );

                }

            }
        );


        /* =================================================
           ESC
        ================================================= */

        document.addEventListener(
            'keydown',
            function (event) {

                if (
                    event.key === 'Escape'
                ) {

                    visor.classList.remove(
                        'abierto'
                    );

                }

            }
        );

    }
);
navigator.geolocation.getCurrentPosition(
    function (position) {

        const latUsuario =
            position.coords.latitude;

        const lonUsuario =
            position.coords.longitude;

        const distancia =
            calcularDistancia(
                latUsuario,
                lonUsuario,
                latitudFija,
                longitudFija
            );

        console.log(
            'Distancia:',
            distancia
        );


        // =================================================
        // MOSTRAR DISTANCIA EN LA PANTALLA
        // =================================================

        const elementoDistancia =
            document.getElementById('distancia-lugar');

        if (elementoDistancia) {

            if (distancia < 1000) {

                elementoDistancia.textContent =
                    Math.round(distancia) + ' metros';

            } else {

                elementoDistancia.textContent =
                    (distancia / 1000).toFixed(2) + ' km';

            }

        }

    },

    function (error) {

        console.log(
            'No se pudo obtener la ubicación',
            error
        );

        const elementoDistancia =
            document.getElementById('distancia-lugar');

        if (elementoDistancia) {

            elementoDistancia.textContent =
                'No se pudo obtener la ubicación';

        }

    },

    {
        enableHighAccuracy: true,
        timeout: 10000,
        maximumAge: 0
    }
);
function calcularDistancia(lat1, lon1, lat2, lon2) {

    const R = 6371000; // metros

    const dLat =
        (lat2 - lat1) * Math.PI / 180;

    const dLon =
        (lon2 - lon1) * Math.PI / 180;

    const a =
        Math.sin(dLat / 2) *
        Math.sin(dLat / 2) +
        Math.cos(lat1 * Math.PI / 180) *
        Math.cos(lat2 * Math.PI / 180) *
        Math.sin(dLon / 2) *
        Math.sin(dLon / 2);

    const c =
        2 * Math.atan2(
            Math.sqrt(a),
            Math.sqrt(1 - a)
        );

    return R * c;
}
function actualizarDistancia(latUsuario, lonUsuario) {

    const latitudFija = -38.9516;
    const longitudFija = -68.0591;

    const distancia = calcularDistancia(
        latUsuario,
        lonUsuario,
        latitudFija,
        longitudFija
    );

    const elemento =
        document.getElementById('distancia-lugar');

    if (!elemento) {
        return;
    }

    if (distancia < 1000) {

        elemento.textContent =
            Math.round(distancia) + ' metros';

    } else {

        elemento.textContent =
            (distancia / 1000).toFixed(2) + ' km';

    }
}
</script>

<style>

/* =========================================================
   BASE
========================================================= */
#mapa-relevamiento-grande {
    width: 100%;
    height: 450px;
    border-radius: 12px;
    overflow: hidden;
}
.detalle-relevamiento-page {

    min-height: 100vh;

    background: #f7f8fa;

    padding-bottom: 30px;

    font-family:
        Inter,
        -apple-system,
        BlinkMacSystemFont,
        "SF Pro Display",
        "SF Pro Text",
        "Segoe UI",
        Roboto,
        Arial,
        sans-serif;

    color: #172033;

    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;

}


/* =========================================================
   HEADER
========================================================= */

.detalle-header {

    height: 50px;

    background: transparent;

    color: #101828;

    display: flex;

    align-items: center;

    justify-content: space-between;

    padding: 0 18px;

   
}


.detalle-header h1 {

    margin: 0;

    font-size: 18px;

    font-weight: 700;

    text-align: start;

    flex: 1;

}


.detalle-header-back,
.detalle-header-share {

    width: 38px;

    height: 38px;

    border: 0;

    background: transparent;

    color:#101828;

    display: flex;

    align-items: center;

    justify-content: center;

    border-radius: 50%;

    font-size: 19px;

    cursor: pointer;

}


.detalle-header-back:active,
.detalle-header-share:active {

    background: rgba(255,255,255,.15);

}


/* =========================================================
   CONTENIDO
========================================================= */

.detalle-contenido {

    padding: 16px 15px 30px;

}


/* =========================================================
   TARJETA PRINCIPAL
========================================================= */

.relevamiento-resumen-card {

    background: white;

    border: 1px solid #e5e8ed;

    border-radius: 11px;

    padding: 17px;

    box-shadow:
        0 2px 6px rgba(16,24,40,.04);

}


.resumen-card-header {

    display: flex;

    align-items: center;

    justify-content: space-between;

    margin-bottom: 15px;

}


.resumen-card-header strong {

    font-size: 18px;

    color: #101828;

}


.estado-completado {

    display: inline-flex;

    align-items: center;

    background: #dff7e8;

    color: #07853c;

    border-radius: 6px;

    padding: 6px 9px;

    font-size: 11px;

    font-weight: 600;

    white-space: nowrap;

}


.resumen-card-dato {

    display: flex;

    align-items: center;

    gap: 10px;

    margin-top: 10px;

    color: #445066;

    font-size: 12px;

}


.resumen-card-dato i {

    width: 17px;

    color: #38557f;

    font-size: 13px;

}


/* =========================================================
   TABS
========================================================= */

.detalle-tabs {

    display: flex;

    height: 56px;

    align-items: end;

    margin: 0 -1px;

    background: #f7f8fa;

}


.detalle-tab {

    flex: 1;

    height: 45px;

    border: 0;

    background: transparent;

    color: #1e2b40;

    font-size: 12px;

    cursor: pointer;

    position: relative;

}


.detalle-tab.active {

    color: #064dc8;

    font-weight: 600;

}


.detalle-tab.active::after {

    content: "";

    position: absolute;

    left: 0;

    right: 0;

    bottom: 0;

    height: 2px;

    background: #064dc8;

}


/* =========================================================
   TAB CONTENT
========================================================= */

.detalle-tab-content {

    display: none;

}


.detalle-tab-content.active {

    display: block;

}


/* =========================================================
   CARDS
========================================================= */

.detalle-card {

    background: white;

    border: 1px solid #e5e8ed;

    border-radius: 9px;

    padding: 15px 10px;

    margin-bottom: 0;

    box-shadow:
        0 1px 4px rgba(16,24,40,.03);

}


.detalle-card h2 {

    margin: 0 0 18px;

    font-size: 13px;

    color: #101828;

    font-weight: 700;

}


/* =========================================================
   INFORMACION
========================================================= */

.detalle-info-row {

    display: grid;

    grid-template-columns: 103px 1fr;

    gap: 0;

    margin-bottom: 16px;

    font-size: 11px;

    line-height: 1.45;

}


.detalle-info-row:last-child {

    margin-bottom: 0;

}


.detalle-label {

    color: #172b4d;

    font-weight: 500;

}


.detalle-value {

    color: #26364f;

}


.estado-inline {

    font-size: 10px;

    padding: 4px 7px;

}


/* =========================================================
   MAPA
========================================================= */

.ubicacion-card {

    padding-bottom: 15px;

}


.mapa-relevamiento {

    height: 96px;

    width: 100%;

    position: relative;

    overflow: hidden;

    border-radius: 0;

    background: #ece9df;

}


.mapa-grande {

    height: 230px;

    border-radius: 8px;

}


/*
 * Fondo del mapa.
 * Se construye visualmente para mantener
 * el aspecto de la maqueta.
 */

.mapa-calles {

    position: absolute;

    inset: 0;

    background:
        linear-gradient(
            35deg,
            transparent 0 43%,
            #ffffff 43% 49%,
            transparent 49% 100%
        ),
        linear-gradient(
            115deg,
            transparent 0 48%,
            #ffffff 48% 54%,
            transparent 54% 100%
        ),
        linear-gradient(
            0deg,
            transparent 0 65%,
            #ffffff 65% 70%,
            transparent 70% 100%
        ),
        #ebe8df;

}


.zona-verde {

    position: absolute;

    background: #b9ddb0;

}


.zona-1 {

    width: 100px;
    height: 55px;

    left: -15px;
    top: -10px;

    transform: rotate(15deg);

}


.zona-2 {

    width: 85px;
    height: 45px;

    right: 10px;
    bottom: -5px;

    transform: rotate(-18deg);

}


.zona-3 {

    width: 70px;
    height: 35px;

    left: 120px;
    bottom: -15px;

    transform: rotate(20deg);

}


.calle {

    position: absolute;

    background: rgba(255,255,255,.9);

}


.calle-1 {

    width: 8px;

    height: 160%;

    left: 38%;

    top: -30%;

    transform: rotate(28deg);

}


.calle-2 {

    width: 7px;

    height: 160%;

    left: 65%;

    top: -30%;

    transform: rotate(-28deg);

}


.calle-3 {

    height: 7px;

    width: 140%;

    left: -20%;

    top: 35%;

    transform: rotate(-8deg);

}


.calle-4 {

    height: 6px;

    width: 140%;

    left: -20%;

    top: 70%;

    transform: rotate(10deg);

}


.calle-5 {

    height: 5px;

    width: 120%;

    left: -10%;

    top: 15%;

    transform: rotate(18deg);

}


/* =========================================================
   MARCADOR
========================================================= */

.marcador-mapa {

    position: absolute;

    left: 50%;

    top: 50%;

    transform:
        translate(-50%, -55%);

    color: #0756d9;

    font-size: 35px;

    filter:
        drop-shadow(
            0 2px 2px rgba(0,0,0,.15)
        );

}


.coordenadas {

    padding-top: 10px;

    color: #536075;

    font-size: 10px;

}


/* =========================================================
   METRICAS
========================================================= */

.bienes-resumen-card {

    margin-top: 0;

}


.metricas-bienes {

    display: grid;

    grid-template-columns: 1fr 1fr;

    gap: 15px;

}


.metrica-bien {

    height: 82px;

    border: 1px solid #e4e8ee;

    border-radius: 8px;

    display: flex;

    flex-direction: column;

    justify-content: center;

    align-items: center;

}


.metrica-bien span {

    font-size: 10px;

    color: #26364f;

    margin-bottom: 7px;

}


.metrica-bien strong {

    font-size: 21px;

    line-height: 1;

    color: #101010;

}


/* =========================================================
   LISTA DE BIENES
========================================================= */

.bien-listado {

    display: flex;

    flex-direction: column;

}


.bien-item {

    display: flex;

    align-items: center;

    gap: 10px;

    padding: 12px 3px;

    border-bottom: 1px solid #edf0f3;

}


.bien-item:last-child {

    border-bottom: 0;

}


.bien-item-icon {

    width: 39px;

    height: 39px;

    border-radius: 9px;

    background: #edf3ff;

    color: #0756d9;

    display: flex;

    align-items: center;

    justify-content: center;

    flex-shrink: 0;

}


.bien-item-info {

    flex: 1;

    display: flex;

    flex-direction: column;

    gap: 4px;

}


.bien-item-info strong {

    font-size: 12px;

    color: #172033;

}


.bien-item-info span {

    font-size: 10px;

    color: #697586;

}


.bien-item > i {

    color: #9aa3af;

    font-size: 11px;

}


/* =========================================================
   DIRECCION
========================================================= */

.direccion-ubicacion {

    display: flex;

    flex-direction: column;

    gap: 6px;

    padding-top: 14px;

}


.direccion-ubicacion strong {

    font-size: 13px;

}


.direccion-ubicacion span {

    font-size: 11px;

    color: #667085;

}


/* =========================================================
   FOTOS
========================================================= */

.fotos-grid {

    display: grid;

    grid-template-columns:
        repeat(2, 1fr);

    gap: 9px;

}


.foto-placeholder {

    height: 130px;

    background: #edf0f3;

    border-radius: 8px;

    display: flex;

    align-items: center;

    justify-content: center;

    color: #9aa3af;

    font-size: 25px;

}


/* =========================================================
   DESKTOP
========================================================= */

@media (min-width: 768px) {

    .detalle-relevamiento-page {

        max-width: 760px;

        margin: 0 auto;

        min-height: 100vh;

        border-left:
            1px solid #e5e8ed;

        border-right:
            1px solid #e5e8ed;

    }

}


/* =========================================================
   MOBILE
========================================================= */

@media (max-width: 390px) {

    .detalle-contenido {

        padding-left: 12px;

        padding-right: 12px;

    }


    .detalle-info-row {

        grid-template-columns:
            96px 1fr;

    }


    .detalle-tab {

        font-size: 11px;

    }

}
#mapa-relevamiento {
    width: 100%;
    height: 250px;
    border-radius: 12px;
    overflow: hidden;
}
</style>
<link
    rel="stylesheet"
    href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
/>

<script
    src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js">
</script>
<script>

let mapaRelevamiento = null;
let mapaRelevamientoGrande = null;

const latitudFija = -38.9516;
const longitudFija = -68.0591;


/* =====================================================
   CREAR MAPA
===================================================== */

function crearMapa(id, zoom) {

    const elemento = document.getElementById(id);

    if (!elemento) {
        return null;
    }

    const mapa = L.map(id, {
        dragging: false,
        touchZoom: false,
        scrollWheelZoom: false,
        doubleClickZoom: false,
        boxZoom: false,
        keyboard: false,
        zoomControl: true
    });

    mapa.setView(
        [latitudFija, longitudFija],
        zoom
    );

    L.tileLayer(
        'https://tile.openstreetmap.org/{z}/{x}/{y}.png',
        {
            maxZoom: 19,
            attribution: '&copy; OpenStreetMap'
        }
    ).addTo(mapa);

    L.marker([
        latitudFija,
        longitudFija
    ]).addTo(mapa);

    return mapa;
}


/* =====================================================
   INICIALIZAR
===================================================== */

document.addEventListener('DOMContentLoaded', function () {

    // Mapa pequeño
    mapaRelevamiento = crearMapa(
        'mapa-relevamiento',
        17
    );

    // Mapa grande
    mapaRelevamientoGrande = crearMapa(
        'mapa-relevamiento-grande',
        16
    );

});


/* =====================================================
   TABS
===================================================== */

document.addEventListener('DOMContentLoaded', function () {

    const tabs = document.querySelectorAll(
        '.detalle-tab'
    );

    const contenidos = document.querySelectorAll(
        '.detalle-tab-content'
    );

    tabs.forEach(function (tab) {

        tab.addEventListener('click', function () {

            const nombre = this.dataset.tab;

            tabs.forEach(function (item) {
                item.classList.remove('active');
            });

            this.classList.add('active');

            contenidos.forEach(function (contenido) {
                contenido.classList.remove('active');
            });

            const contenido = document.getElementById(
                'tab-' + nombre
            );

            if (contenido) {

                contenido.classList.add('active');

                // Leaflet recalcula el tamaño
                setTimeout(function () {

                    if (mapaRelevamientoGrande) {
                        mapaRelevamientoGrande.invalidateSize();
                    }

                    if (mapaRelevamiento) {
                        mapaRelevamiento.invalidateSize();
                    }

                }, 300);
            }

        });

    });

});

</script>

<script>

document.addEventListener('DOMContentLoaded', function () {

    /* =================================================
       TABS
    ================================================== */

    const tabs = document.querySelectorAll(
        '.detalle-tab'
    );

    const contenidos = document.querySelectorAll(
        '.detalle-tab-content'
    );

    tabs.forEach(function (tab) {

        tab.addEventListener('click', function () {

            const nombre = this.dataset.tab;

            // Activar pestaña
            tabs.forEach(function (item) {

                item.classList.remove('active');

            });

            this.classList.add('active');

            // Ocultar contenidos
            contenidos.forEach(function (contenido) {

                contenido.classList.remove('active');

            });

            // Mostrar contenido
            const contenido = document.getElementById(
                'tab-' + nombre
            );

            if (contenido) {

                contenido.classList.add('active');

            }

        });

    });

});
</script>

<script>



/* =========================================================
   COMPARTIR
========================================================= */

function compartirRelevamiento() {

    const texto =
        'Relevamiento R-2024-000123\n' +
        'Lugar: Depósito Central\n' +
        'Fecha: 26/05/2024 10:15\n' +
        'Estado: Completado\n' +
        'Bienes relevados: 5';


    if (
        navigator.share
    ) {

        navigator.share({

            title:
                'Relevamiento R-2024-000123',

            text:
                texto

        }).catch(
            function () {}
        );

    } else {

        navigator.clipboard
            .writeText(texto)
            .then(function () {

                alert(
                    'Información del relevamiento copiada.'
                );

            });

    }

}

</script>