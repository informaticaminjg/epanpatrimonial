<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var array $personas */

$this->title = 'Registro por Persona';

?>

<div class="rp-page">
    
    <!-- =====================================================
        CONTENIDO
    ===================================================== -->

    <div class="rp-content">


        <!-- ICONO -->
        <div class="rp-main-icon">

            <i class="fas fa-address-card"></i>

        </div>


        <!-- TITULO -->

        <h1>
            Consultar bienes<br>
            por persona
        </h1>


        <p class="rp-description">
            Buscá a la persona para ver los bienes<br>
            que tiene asignados.
        </p>


        <!-- =================================================
             BUSCADOR
             ================================================= -->

        <div class="rp-search">

            <i class="fas fa-search"></i>

            <input
                type="text"
                id="rpBuscarPersona"
                placeholder="Buscar por nombre apellido, dni o legajo"
                autocomplete="off"
            >

        </div>


        <!-- =================================================
             BUSQUEDAS RECIENTES
             ================================================= -->

        <div class="rp-section-title">
            Búsquedas recientes
        </div>


        <div class="rp-personas-list" id="rpPersonasList">

            <?php $listaimagenes = [
                'https://randomuser.me/api/portraits/men/32.jpg',
                'https://randomuser.me/api/portraits/women/44.jpg',
                'https://randomuser.me/api/portraits/men/46.jpg',
                'https://randomuser.me/api/portraits/women/65.jpg',
                'https://randomuser.me/api/portraits/men/75.jpg'
                
                ]; 
                $varimg=0;
            ?>
            <?php foreach ($personas as $persona): ?>

                <?php

                $nombreCompleto =
                    $persona['nombre'] . ' ' .
                    $persona['apellido'];

                $textoBusqueda = strtolower(
                    $nombreCompleto . ' ' .
                    $persona['dni'] . ' ' .
                    $persona['legajo'] . ' ' .
                    $persona['reparticion']
                );

                ?>


                <a
                    href="#"
                    class="rp-persona"
                    data-id="<?= Html::encode($persona['id']) ?>"
                    data-nombre="<?= Html::encode($nombreCompleto) ?>"
                    data-dni="<?= Html::encode($persona['dni']) ?>"
                    data-legajo="<?= Html::encode($persona['legajo']) ?>"
                    data-area="<?= Html::encode($persona['reparticion']) ?>"
                    data-cargo="<?= Html::encode($persona['cargo'] ?? 'Sin especificar') ?>"
                    data-search="<?= Html::encode($textoBusqueda) ?>"
                >

                    <!-- ICONO PERSONA -->

                    <div class="rp-persona-icon">
                        <img src=<?= $listaimagenes[$varimg] ?>
                            alt="Juan Pérez">
                    </div>
                    <?php $varimg++;?>

                    <!-- INFORMACION -->

                    <div class="rp-persona-info">

                        <div class="rp-persona-name">

                            <?= Html::encode($nombreCompleto) ?>

                        </div>


                        <div class="rp-persona-dni">

                            DNI <?= Html::encode($persona['dni']) ?>

                        </div>


                        <!-- Estos datos quedan disponibles
                             para la búsqueda y para la próxima
                             pantalla -->

                        <div class="rp-persona-extra">

                            Legajo <?= Html::encode($persona['legajo']) ?>

                            ·

                            <?= Html::encode($persona['reparticion']) ?>

                        </div>

                    </div>


                    <!-- RELOJ -->

                    <div class="rp-persona-history">

                        <i class="far fa-clock"></i>

                    </div>

                </a>

            <?php endforeach; ?>


        </div>


        <!-- SIN RESULTADOS -->

        <div
            id="rpSinResultados"
            class="rp-no-results"
        >

            <i class="far fa-user"></i>

            <strong>
                No se encontraron personas
            </strong>

            <span>
                Probá buscando por nombre, DNI o legajo.
            </span>

        </div>


    </div>


   
</div>

<!-- ==========================================================
     MODAL INFORMACIÓN DE LA PERSONA
========================================================== -->

<div id="rpPersonaModal" class="rp-modal">

    <div class="rp-modal-overlay"></div>

    <div class="rp-modal-content">

        <!-- HEADER -->

        <div class="rp-modal-header">

            <button type="button" id="rpModalCerrar" class="rp-modal-close">
                <i class="fas fa-times"></i>
            </button>

            <div class="rp-persona-icon">
                        <img src="https://randomuser.me/api/portraits/men/46.jpg"
                            alt="Juan Pérez">
                    </div>

            <div class="rp-modal-persona">

                <div id="modalNombre" class="rp-modal-nombre">
                    Juan Pérez
                </div>

                <div id="modalDni" class="rp-modal-dni">
                    DNI 12.345.678
                </div>

            </div>

        </div>


        <!-- INFORMACIÓN -->

        <div class="rp-modal-info">

            <div class="rp-modal-info-item">

                <span>Área</span>

                <strong id="modalArea">
                    Secretaría Administrativa
                </strong>

            </div>

            <div class="rp-modal-info-item">

                <span>Cargo</span>

                <strong id="modalCargo">
                    Analista
                </strong>

            </div>

            <div class="rp-modal-info-item">

                <span>Legajo</span>

                <strong id="modalLegajo">
                    12345
                </strong>

            </div>

        </div>


        <!-- INDICADORES -->

        <div class="rp-modal-stats">

            <div class="rp-modal-stat">

                <div id="modalAsignados" class="rp-stat-number blue">
                    8
                </div>

                <div class="rp-stat-label">
                    Bienes<br>asignados
                </div>

            </div>


            <div class="rp-modal-stat">

                <div id="modalEnUso" class="rp-stat-number green">
                    7
                </div>

                <div class="rp-stat-label">
                    En uso
                </div>

            </div>


            <div class="rp-modal-stat">

                <div id="modalReparacion" class="rp-stat-number orange">
                    1
                </div>

                <div class="rp-stat-label">
                    En reparación
                </div>

            </div>

        </div>


        <!-- BIENES -->

        <div class="rp-modal-section-header">

            <strong>Bienes asignados</strong>

            <button type="button" class="rp-modal-filter">
                Filtrar
                <i class="fas fa-filter"></i>
            </button>

        </div>


        <div class="rp-modal-bienes">

            <!-- BIEN 1 -->

            <div class="rp-modal-bien">

                <div class="rp-bien-icon">
                    <i class="fas fa-laptop"></i>
                </div>

                <div class="rp-bien-info">

                    <strong>MAT-2024-000123</strong>

                    <span>Notebook Dell Latitude 5420</span>

                    <small>Asignado el 15/03/2024</small>

                </div>

                <div class="rp-bien-status en-uso">
                    En uso
                </div>

                <i class="fas fa-chevron-right rp-bien-arrow"></i>

            </div>


            <!-- BIEN 2 -->

            <div class="rp-modal-bien">

                <div class="rp-bien-icon">
                    <i class="fas fa-desktop"></i>
                </div>

                <div class="rp-bien-info">

                    <strong>MAT-2024-000098</strong>

                    <span>Monitor 24" LG</span>

                    <small>Asignado el 10/02/2024</small>

                </div>

                <div class="rp-bien-status en-uso">
                    En uso
                </div>

                <i class="fas fa-chevron-right rp-bien-arrow"></i>

            </div>


            <!-- BIEN 3 -->

            <div class="rp-modal-bien">

                <div class="rp-bien-icon">
                    <i class="fas fa-print"></i>
                </div>

                <div class="rp-bien-info">

                    <strong>MAT-2024-000077</strong>

                    <span>Impresora HP LaserJet Pro</span>

                    <small>Asignado el 05/02/2024</small>

                </div>

                <div class="rp-bien-status reparacion">
                    En reparación
                </div>

                <i class="fas fa-chevron-right rp-bien-arrow"></i>

            </div>


            <!-- BIEN 4 -->

            <div class="rp-modal-bien">

                <div class="rp-bien-icon">
                    <i class="fas fa-chair"></i>
                </div>

                <div class="rp-bien-info">

                    <strong>MAT-2023-000456</strong>

                    <span>Silla Ergonómica</span>

                    <small>Asignado el 20/12/2023</small>

                </div>

                <div class="rp-bien-status en-uso">
                    En uso
                </div>

                <i class="fas fa-chevron-right rp-bien-arrow"></i>

            </div>

        </div>

        <!-- BOTÓN CERRAR -->

        <div class="rp-persona-modal-cerrar-container">

            <button type="button"
                    id="rpPersonaModalCerrarBottom"
                    class="rp-persona-modal-cerrar">

                <i class="fas fa-times"></i>

                Cerrar

            </button>

        </div>


    </div>

</div>


<!-- ==========================================================
     FIN DE MODAL INFORMACIÓN DE LA PERSONA
========================================================== -->

<!-- ==========================================================
     MODAL INFORMACIÓN DEL BIEN
========================================================== -->

<div id="rpBienModal" class="rp-modal rp-bien-modal" style="display: none;">

    <div class="rp-modal-overlay"></div>

    <div class="rp-modal-content rp-bien-modal-content">

        <!-- HEADER -->

        <div class="rp-modal-header">

            <button type="button" id="rpBienModalCerrar" class="rp-modal-close">
                <i class="fas fa-times"></i>
            </button>

            <div class="rp-modal-avatar rp-bien-avatar">
                <i id="bienModalIcono" class="fas fa-laptop"></i>
            </div>

            <div class="rp-modal-persona">

                <div id="bienModalMatricula" class="rp-modal-nombre">
                    MAT-2024-000123
                </div>

                <div id="bienModalDescripcion" class="rp-modal-dni">
                    Notebook Dell Latitude 5420
                </div>

            </div>

        </div>


        <!-- ESTADO -->

        <div class="rp-bien-detalle-estado">

            <span id="bienModalEstado" class="rp-bien-status en-uso">
                En uso
            </span>

        </div>


        <!-- INFORMACIÓN DEL BIEN -->

        <div class="rp-modal-section-header">
            <strong>Información del bien</strong>
        </div>

        <div class="rp-bien-detalle-info">

            <div class="rp-modal-info-item rp-bien-descripcion">
                <span>Descripción</span>
                <strong id="bienModalDescripcionInfo">
                    Notebook Dell Latitude 5420
                </strong>
            </div>

            <div class="rp-modal-info-item">
                <span>Estado</span>
                <strong id="bienModalEstadoInfo">
                    En uso
                </strong>
            </div>

            <div class="rp-modal-info-item">
                <span>Fecha de asignación</span>
                <strong id="bienModalFecha">
                    15/03/2024
                </strong>
            </div>

        </div>


        <!-- UBICACIÓN -->

        <div class="rp-modal-section-header">
            <strong>Ubicación</strong>
        </div>

        <div class="rp-bien-ubicacion">

            <div class="rp-bien-ubicacion-icon">
                <i class="fas fa-location-dot"></i>
            </div>

            <div>
                <strong id="bienModalLugar">
                    Secretaría Administrativa
                </strong>

                <span id="bienModalArea">
                    Área de Sistemas
                </span>
            </div>

        </div>


        <!-- HOJA DE RUTA -->

        <div class="rp-modal-section-header">
            <strong>Hoja de ruta</strong>
        </div>

        <div class="rp-bien-hoja-ruta">

            <!-- MOVIMIENTO 1 -->

            <div class="rp-ruta-item">

                <div class="rp-ruta-icon">
                    <i class="fas fa-user"></i>
                </div>

                <div class="rp-ruta-info">

                    <strong>Asignado a Juan Pérez</strong>

                    <span>
                        Secretaría Administrativa
                    </span>

                    <small>
                        15/03/2024
                    </small>

                </div>

            </div>


            <!-- MOVIMIENTO 2 -->

            <div class="rp-ruta-item">

                <div class="rp-ruta-icon">
                    <i class="fas fa-building"></i>
                </div>

                <div class="rp-ruta-info">

                    <strong>Ingreso al organismo</strong>

                    <span>
                        Patrimonio General
                    </span>

                    <small>
                        10/01/2024
                    </small>

                </div>

            </div>


            <!-- MOVIMIENTO 3 -->

            <div class="rp-ruta-item">

                <div class="rp-ruta-icon">
                    <i class="fas fa-box"></i>
                </div>

                <div class="rp-ruta-info">

                    <strong>Alta del bien</strong>

                    <span>
                        Registro Patrimonial
                    </span>

                    <small>
                        08/01/2024
                    </small>

                </div>

            </div>

        </div>


        <!-- ACCIONES -->

        <!-- IMÁGENES DEL BIEN -->

        <div class="rp-modal-section-header">
            <strong>Imágenes</strong>

            <span id="bienModalCantidadImagenes" class="rp-imagenes-cantidad">
                4 imágenes
            </span>
        </div>

        <div class="rp-bien-galeria">

            <div class="rp-bien-imagen" data-index="0">
                <img src="https://images.unsplash.com/photo-1496181133206-80ce9b88a853"
                    alt="Notebook">
            </div>

            <div class="rp-bien-imagen" data-index="1">
                <img src="https://images.unsplash.com/photo-1523275335684-37898b6baf30"
                    alt="Bien patrimonial">
            </div>

            <div class="rp-bien-imagen" data-index="2">
                <img src="https://images.unsplash.com/photo-1550745165-9bc0b252726f"
                    alt="Equipo">
            </div>

            <div class="rp-bien-imagen" data-index="3">
                <img src="https://images.unsplash.com/photo-1588872657578-7efd1f1555ed"
                    alt="Computadora">
            </div>

        </div>
        <!-- BOTÓN CERRAR -->

        <div class="rp-bien-modal-cerrar-container">

            <button type="button"
                    id="rpBienModalCerrarBottom"
                    class="rp-bien-modal-cerrar">

                <i class="fas fa-times"></i>

                Cerrar

            </button>

        </div>

    </div>

</div>

<!-- ==========================================================
     FIN DE MODAL INFORMACIÓN DEL BIEN
========================================================== -->

<!-- ==========================================================
     VISOR DE IMÁGENES
========================================================== -->

<div id="rpImagenViewer" class="rp-imagen-viewer">

    <div class="rp-imagen-viewer-overlay"></div>

    <button type="button"
            id="rpImagenCerrar"
            class="rp-imagen-cerrar">

        <i class="fas fa-times"></i>

    </button>


    <button type="button"
            id="rpImagenAnterior"
            class="rp-imagen-nav rp-imagen-anterior">

        <i class="fas fa-chevron-left"></i>

    </button>


    <div class="rp-imagen-viewer-contenido">

        <img id="rpImagenGrande"
             src=""
             alt="Imagen del bien">

    </div>


    <button type="button"
            id="rpImagenSiguiente"
            class="rp-imagen-nav rp-imagen-siguiente">

        <i class="fas fa-chevron-right"></i>

    </button>


    <div id="rpImagenContador" class="rp-imagen-contador">
        1 / 4
    </div>

</div>

<style>
    .rp-persona-icon {
    width: 48px;
    height: 48px;
    border-radius: 50%;
    overflow: hidden;
    flex-shrink: 0;
}

.rp-persona-icon img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    display: block;
}
    /* ==========================================================
   BOTÓN CERRAR - MODAL PERSONA
========================================================== */

.rp-persona-modal-cerrar-container {
    padding: 0 24px 24px;
}


.rp-persona-modal-cerrar {
    width: 100%;

    padding: 12px 18px;

    border: 1px solid #e5e7eb;

    border-radius: 10px;

    background: #f8fafc;

    color: #475569;

    font-size: 13px;
    font-weight: 600;

    cursor: pointer;

    display: flex;
    align-items: center;
    justify-content: center;

    gap: 8px;

    transition: all .15s ease;
}


.rp-persona-modal-cerrar:hover {
    background: #f1f5f9;
    color: #1f2937;
}


.rp-persona-modal-cerrar i {
    font-size: 12px;
}
/* ==========================================================
   BOTÓN CERRAR DEL MODAL DEL BIEN
========================================================== */

.rp-bien-modal-cerrar-container {
    padding: 0 24px 24px;
}


.rp-bien-modal-cerrar {
    width: 100%;

    padding: 12px 18px;

    border: 1px solid #e5e7eb;

    border-radius: 10px;

    background: #f8fafc;

    color: #475569;

    font-size: 13px;
    font-weight: 600;

    cursor: pointer;

    display: flex;
    align-items: center;
    justify-content: center;

    gap: 8px;

    transition: all .15s ease;
}


.rp-bien-modal-cerrar:hover {
    background: #f1f5f9;
    color: #1f2937;
}


.rp-bien-modal-cerrar i {
    font-size: 12px;
}
    /* ==========================================================
   VISOR DE IMÁGENES
========================================================== */

.rp-imagen-viewer {
    position: fixed;

    inset: 0;

    z-index: 100000;

    display: none;

    align-items: center;
    justify-content: center;
}


.rp-imagen-viewer.active {
    display: flex;
}


.rp-imagen-viewer-overlay {
    position: absolute;

    inset: 0;

    background: rgba(0, 0, 0, .88);
}


/* Imagen */

.rp-imagen-viewer-contenido {
    position: relative;

    z-index: 2;

    width: 90%;
    height: 85%;

    display: flex;

    align-items: center;
    justify-content: center;
}


.rp-imagen-viewer-contenido img {
    max-width: 100%;
    max-height: 100%;

    object-fit: contain;

    border-radius: 8px;

    user-select: none;

    -webkit-user-drag: none;
}


/* Cerrar */

.rp-imagen-cerrar {
    position: absolute;

    top: 20px;
    right: 25px;

    z-index: 5;

    width: 42px;
    height: 42px;

    border: none;

    border-radius: 50%;

    background: rgba(255,255,255,.15);

    color: white;

    font-size: 18px;

    cursor: pointer;
}


/* Flechas */

.rp-imagen-nav {
    position: absolute;

    top: 50%;

    transform: translateY(-50%);

    z-index: 5;

    width: 45px;
    height: 45px;

    border: none;

    border-radius: 50%;

    background: rgba(255,255,255,.15);

    color: white;

    font-size: 18px;

    cursor: pointer;
}


.rp-imagen-anterior {
    left: 25px;
}


.rp-imagen-siguiente {
    right: 25px;
}


/* Contador */

.rp-imagen-contador {
    position: absolute;

    bottom: 20px;

    left: 50%;

    transform: translateX(-50%);

    z-index: 5;

    color: white;

    font-size: 13px;

    background: rgba(0,0,0,.4);

    padding: 6px 12px;

    border-radius: 20px;
}
/* ==========================================================
   GALERÍA DE IMÁGENES
========================================================== */

.rp-imagenes-cantidad {
    font-size: 11px;
    font-weight: 500;
    color: #94a3b8;
}


.rp-bien-galeria {
    display: grid;

    grid-template-columns: repeat(4, 1fr);

    gap: 10px;

    padding: 0 24px 20px;
}


.rp-bien-imagen {
    position: relative;

    width: 100%;
    aspect-ratio: 1 / 1;

    border-radius: 10px;

    overflow: hidden;

    background: #f1f5f9;

    cursor: pointer;

    transition: transform .15s ease;
}


.rp-bien-imagen:hover {
    transform: scale(1.03);
}


.rp-bien-imagen img {
    width: 100%;
    height: 100%;

    object-fit: cover;

    display: block;
}
    /* ==========================================================
   HOJA DE RUTA
========================================================== */

.rp-bien-hoja-ruta {
    position: relative;
    margin: 0 24px 20px;
}


/* Línea vertical */

.rp-bien-hoja-ruta::before {
    content: "";

    position: absolute;

    left: 19px;
    top: 20px;
    bottom: 20px;

    width: 2px;

    background: #e5e7eb;
}


/* Movimiento */

.rp-ruta-item {
    position: relative;

    display: flex;
    align-items: flex-start;

    gap: 13px;

    padding: 10px 0;
}


/* Icono */

.rp-ruta-icon {
    position: relative;

    z-index: 2;

    flex-shrink: 0;

    width: 40px;
    height: 40px;

    border-radius: 50%;

    background: #eef4ff;
    color: #2563eb;

    display: flex;
    align-items: center;
    justify-content: center;

    font-size: 14px;
}


/* Información */

.rp-ruta-info {
    padding-top: 2px;
}

.rp-ruta-info strong {
    display: block;

    font-size: 13px;
    font-weight: 600;

    color: #1f2937;
}

.rp-ruta-info span {
    display: block;

    margin-top: 3px;

    font-size: 12px;

    color: #64748b;
}

.rp-ruta-info small {
    display: block;

    margin-top: 4px;

    font-size: 11px;

    color: #94a3b8;
}


    .rp-bien-descripcion {
    grid-column: 1 / -1;
}
/* ==========================================================
   MODAL DEL BIEN - POR ENCIMA DEL MODAL DE PERSONA
========================================================== */

#rpBienModal {
    position: fixed !important;
    inset: 0 !important;

    width: 100%;
    height: 100%;

    z-index: 99999 !important;

    display: none;

    align-items: center;
    justify-content: center;
}


/* Overlay */

#rpBienModal .rp-modal-overlay {
    position: absolute;
    inset: 0;

    background: rgba(0, 0, 0, 0.45);

    z-index: 1;
}


/* Contenido */

#rpBienModal .rp-modal-content {
    position: relative;

    z-index: 2;

    width: 92%;
    max-width: 620px;
    max-height: 90vh;

    overflow-y: auto;

    background: #fff;

    border-radius: 18px;

    box-shadow: 0 20px 60px rgba(0, 0, 0, .25);
}


/* Cursor */

.rp-modal-bien {
    cursor: pointer;
}
    /* ==========================================================
   MODAL DEL BIEN
========================================================== */

.rp-bien-modal {
    z-index: 1100;
}

.rp-bien-modal .rp-modal-overlay {
    z-index: 1101;
}

.rp-bien-modal .rp-modal-content {
    z-index: 1102;
}


/* Icono del bien */

.rp-bien-avatar {
    background: #eef4ff;
    color: #2563eb;
}


/* Estado */

.rp-bien-detalle-estado {
    display: flex;
    justify-content: flex-end;
    padding: 16px 24px 0;
}


/* Información */

.rp-bien-detalle-info {
    padding: 0 24px 10px;
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 18px 25px;
}


/* Ubicación */

.rp-bien-ubicacion {
    margin: 0 24px 10px;
    padding: 14px;
    border-radius: 12px;
    background: #f8fafc;
    display: flex;
    align-items: center;
    gap: 13px;
}

.rp-bien-ubicacion-icon {
    width: 40px;
    height: 40px;
    border-radius: 10px;
    background: #eef4ff;
    color: #2563eb;

    display: flex;
    align-items: center;
    justify-content: center;
}

.rp-bien-ubicacion strong {
    display: block;
    font-size: 14px;
    color: #1f2937;
}

.rp-bien-ubicacion span {
    display: block;
    margin-top: 3px;
    font-size: 12px;
    color: #6b7280;
}


/* Responsable */

.rp-bien-responsable {
    margin: 0 24px 15px;
    padding: 14px;
    border-radius: 12px;
    border: 1px solid #e5e7eb;

    display: flex;
    align-items: center;
    gap: 12px;
}

.rp-bien-responsable-avatar {
    width: 40px;
    height: 40px;
    border-radius: 50%;

    background: #f1f5f9;
    color: #64748b;

    display: flex;
    align-items: center;
    justify-content: center;
}

.rp-bien-responsable strong {
    display: block;
    font-size: 14px;
    color: #1f2937;
}

.rp-bien-responsable span {
    display: block;
    margin-top: 3px;
    font-size: 12px;
    color: #6b7280;
}


/* Acciones */

.rp-bien-modal-actions {
    padding: 15px 24px 24px;
    display: flex;
    gap: 10px;
}

.rp-bien-action {
    flex: 1;
    border: none;
    border-radius: 10px;
    padding: 12px 15px;

    font-size: 13px;
    font-weight: 600;

    cursor: pointer;

    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
}

.rp-bien-action.secondary {
    background: #f1f5f9;
    color: #475569;
}

.rp-bien-action.primary {
    background: #2563eb;
    color: white;
}
</style>

<script>
    document.addEventListener('DOMContentLoaded', function () {

    const viewer = document.getElementById('rpImagenViewer');
    const imagenGrande = document.getElementById('rpImagenGrande');

    const cerrar = document.getElementById('rpImagenCerrar');
    const anterior = document.getElementById('rpImagenAnterior');
    const siguiente = document.getElementById('rpImagenSiguiente');

    const contador = document.getElementById('rpImagenContador');

    const imagenes = document.querySelectorAll('.rp-bien-imagen img');

    let indiceActual = 0;


    /*
     * Abrir imagen
     */

    imagenes.forEach(function (imagen, index) {

        imagen.parentElement.addEventListener('click', function () {

            indiceActual = index;

            mostrarImagen();

            viewer.classList.add('active');

        });

    });


    /*
     * Mostrar imagen actual
     */

    function mostrarImagen() {

        if (!imagenes.length) {
            return;
        }

        imagenGrande.src = imagenes[indiceActual].src;

        imagenGrande.alt = imagenes[indiceActual].alt;

        contador.textContent =
            (indiceActual + 1) + ' / ' + imagenes.length;

    }


    /*
     * Siguiente
     */

    siguiente.addEventListener('click', function () {

        indiceActual++;

        if (indiceActual >= imagenes.length) {
            indiceActual = 0;
        }

        mostrarImagen();

    });


    /*
     * Anterior
     */

    anterior.addEventListener('click', function () {

        indiceActual--;

        if (indiceActual < 0) {
            indiceActual = imagenes.length - 1;
        }

        mostrarImagen();

    });


    /*
     * Cerrar
     */

    cerrar.addEventListener('click', cerrarViewer);

    document.querySelector('.rp-imagen-viewer-overlay')
        .addEventListener('click', cerrarViewer);


    function cerrarViewer() {

        viewer.classList.remove('active');

        imagenGrande.src = '';

    }


    /*
     * ======================================================
     * SWIPE
     * ======================================================
     */

    let touchStartX = 0;
    let touchEndX = 0;


    imagenGrande.addEventListener('touchstart', function (e) {

        touchStartX = e.changedTouches[0].screenX;

    }, { passive: true });


    imagenGrande.addEventListener('touchend', function (e) {

        touchEndX = e.changedTouches[0].screenX;

        procesarSwipe();

    }, { passive: true });


    function procesarSwipe() {

        const diferencia = touchEndX - touchStartX;


        // Swipe hacia la izquierda
        // siguiente

        if (diferencia < -50) {

            indiceActual++;

            if (indiceActual >= imagenes.length) {
                indiceActual = 0;
            }

            mostrarImagen();

        }


        // Swipe hacia la derecha
        // anterior

        if (diferencia > 50) {

            indiceActual--;

            if (indiceActual < 0) {
                indiceActual = imagenes.length - 1;
            }

            mostrarImagen();

        }

    }

});
document.addEventListener('DOMContentLoaded', function () {

    const bienModal = document.getElementById('rpBienModal');
    const bienModalCerrar = document.getElementById('rpBienModalCerrar');
    const bienModalCerrarBottom = document.getElementById('rpBienModalCerrarBottom');
    if (bienModalCerrarBottom) {

        bienModalCerrarBottom.addEventListener('click', function () {

            bienModal.style.display = 'none';

            document.body.style.overflow = '';

        });

    }
    /*
     * Verificar que el modal exista
     */
    if (!bienModal) {
        console.error('No existe #rpBienModal');
        return;
    }


    /*
     * Hacer clic en cualquier bien
     */
    document.querySelectorAll('.rp-modal-bien').forEach(function (bien) {

        bien.addEventListener('click', function () {

            console.log('CLICK EN BIEN');

            /*
             * Obtener los datos directamente del HTML
             */

            const matricula = this
                .querySelector('.rp-bien-info strong')
                ?.textContent
                .trim();

            const descripcion = this
                .querySelector('.rp-bien-info span')
                ?.textContent
                .trim();

            const fecha = this
                .querySelector('.rp-bien-info small')
                ?.textContent
                .replace('Asignado el ', '')
                .trim();

            const estadoElement = this
                .querySelector('.rp-bien-status');

            const estado = estadoElement
                ? estadoElement.textContent.trim()
                : '';


            console.log({
                matricula,
                descripcion,
                fecha,
                estado
            });


            /*
             * Cargar información
             */

            document.getElementById('bienModalMatricula').textContent =
                matricula || '';

            document.getElementById('bienModalDescripcion').textContent =
                descripcion || '';

            /*document.getElementById('bienModalMatriculaInfo').textContent =
                matricula || '';*/

            document.getElementById('bienModalDescripcionInfo').textContent =
                descripcion || '';

            document.getElementById('bienModalFecha').textContent =
                fecha || '';

            document.getElementById('bienModalEstadoInfo').textContent =
                estado || '';


            /*
             * Estado
             */

            const estadoModal =
                document.getElementById('bienModalEstado');

            if (estadoElement) {

                estadoModal.textContent = estado;

                estadoModal.className =
                    estadoElement.className;

            }


            /*
             * Abrir el modal
             *
             * IMPORTANTE:
             * no usamos .active
             */

            bienModal.style.display = 'flex';


            /*
             * Aseguramos que quede por encima
             */

            bienModal.style.zIndex = '99999';


            /*
             * Evitamos scroll del fondo
             */

            document.body.style.overflow = 'hidden';

        });

    });


    /*
     * Cerrar
     */

    if (bienModalCerrar) {

        bienModalCerrar.addEventListener('click', function () {

            bienModal.style.display = 'none';

            document.body.style.overflow = '';

        });

    }


    /*
     * Cerrar haciendo click en el fondo
     */

    const overlay =
        bienModal.querySelector('.rp-modal-overlay');

    if (overlay) {

        overlay.addEventListener('click', function () {

            bienModal.style.display = 'none';

            document.body.style.overflow = '';

        });

    }

});
document.addEventListener('DOMContentLoaded', function () {



    const modal = document.getElementById('rpPersonaModal');
    const cerrar = document.getElementById('rpModalCerrar');

    const overlay = modal.querySelector('.rp-modal-overlay');
    const rpPersonaModalCerrarBottom = document.getElementById('rpPersonaModalCerrarBottom');

    rpPersonaModalCerrarBottom.addEventListener('click', function () {

        cerrarModal();

    });
    const personas = document.querySelectorAll('.rp-persona');


    personas.forEach(function (persona) {

        persona.addEventListener('click', function (e) {

            e.preventDefault();

            /*
             * Datos de la persona seleccionada
             */

            const nombre =
                this.dataset.nombre || '';

            const dni =
                this.dataset.dni || '';

            const legajo =
                this.dataset.legajo || '';

            const area =
                this.dataset.area || '';

            const cargo =
                this.dataset.cargo || 'Sin especificar';


            /*
             * Cargar información en el modal
             */

            document.getElementById('modalNombre').textContent =
                nombre;

            document.getElementById('modalDni').textContent =
                'DNI ' + dni;

            document.getElementById('modalArea').textContent =
                area;

            document.getElementById('modalCargo').textContent =
                cargo;

            document.getElementById('modalLegajo').textContent =
                legajo;


            /*
             * Mostrar modal
             */

            modal.classList.add('show');

            document.body.style.overflow = 'hidden';

        });

    });


    /*
     * Cerrar
     */

    function cerrarModal() {

        modal.classList.remove('show');

        document.body.style.overflow = '';

    }


    cerrar.addEventListener('click', cerrarModal);

    overlay.addEventListener('click', cerrarModal);


    /*
     * Cerrar con ESC
     */

    document.addEventListener('keydown', function (e) {

        if (e.key === 'Escape' && modal.classList.contains('show')) {

            cerrarModal();

        }

    });







    const buscador =
        document.getElementById('rpBuscarPersona');



    const sinResultados =
        document.getElementById('rpSinResultados');


    buscador.addEventListener('input', function () {

        const texto =
            this.value
                .toLowerCase()
                .trim();


        let encontrados = 0;


        personas.forEach(function (persona) {

            const datos =
                persona.dataset.search || '';


            if (datos.includes(texto)) {

                persona.style.display = 'flex';

                encontrados++;

            } else {

                persona.style.display = 'none';

            }

        });


        if (encontrados === 0) {

            sinResultados.style.display = 'flex';

        } else {

            sinResultados.style.display = 'none';

        }

    });

});

</script>

<style>
    /* ==========================================================
   MODAL PERSONA
   ========================================================== */
.rp-modal {
    display: none;
}

.rp-modal.show {
    display: flex;
}
.rp-modal {
    position: fixed;
    inset: 0;
    z-index: 9999;

    display: none;

    align-items: center;
    justify-content: center;

    padding: 16px;
}

.rp-modal.show {
    display: flex;
}


/* FONDO */

.rp-modal-overlay {
    position: absolute;
    inset: 0;

    background: rgba(15, 23, 42, .48);

    backdrop-filter: blur(2px);
}


/* CONTENEDOR */

.rp-modal-content {
    position: relative;
    z-index: 2;

    width: 100%;
    max-width: 390px;

    max-height: 90vh;

    overflow-y: auto;

    background: #fff;

    border-radius: 18px;

    box-shadow:
        0 20px 60px rgba(0,0,0,.20);

    animation: rpModalOpen .20s ease;
}

@keyframes rpModalOpen {

    from {
        opacity: 0;
        transform: translateY(15px) scale(.97);
    }

    to {
        opacity: 1;
        transform: translateY(0) scale(1);
    }

}


/* HEADER */

.rp-modal-header {

    display: flex;

    align-items: center;

    padding: 22px 20px 18px;

    border-bottom: 1px solid #edf0f4;

    position: relative;
}


.rp-modal-close {

    position: absolute;

    top: 12px;
    right: 12px;

    width: 32px;
    height: 32px;

    border: none;

    border-radius: 50%;

    background: #f4f6f9;

    color: #7c8797;

    cursor: pointer;

    display: flex;
    align-items: center;
    justify-content: center;
}


.rp-modal-close:hover {
    background: #e9edf3;
}


/* AVATAR */

.rp-modal-avatar {

    width: 64px;
    height: 64px;

    min-width: 64px;

    border-radius: 50%;

    background: linear-gradient(
        135deg,
        #6f24e8,
        #7b36f0
    );

    color: #fff;

    display: flex;
    align-items: center;
    justify-content: center;

    font-size: 28px;

    margin-right: 14px;
}


/* PERSONA */

.rp-modal-nombre {

     font-size: 18px;

    font-weight: 750;

    color: #111827;

    margin-bottom: 3px;
}


.rp-modal-dni {

    font-size: 13px;

    color: #737e8f;
}


/* INFO */

.rp-modal-info {

    padding: 16px 20px 6px;
}


.rp-modal-info-item {

    display: flex;

    justify-content: space-between;

    align-items: center;

    padding: 7px 0;
}


.rp-modal-info-item span {

    font-size: 12px;

    color: #8993a3;
}


.rp-modal-info-item strong {

    font-size: 12px;

    color: #374151;

    text-align: right;
}


/* ESTADÍSTICAS */

.rp-modal-stats {

    display: grid;

    grid-template-columns: repeat(3, 1fr);

    gap: 10px;

    padding: 12px 20px 18px;
}


.rp-modal-stat {

    min-height: 72px;

    background: #fff;

    border: 1px solid #e5e9ef;

    border-radius: 10px;

    display: flex;

    flex-direction: column;

    align-items: center;

    justify-content: center;

    box-shadow:
        0 2px 7px rgba(20,40,80,.04);
}


.rp-stat-number {

    font-size: 21px;

    font-weight: 700;

    line-height: 1;

    margin-bottom: 5px;
}


.rp-stat-number.blue {
    color: #0867d8;
}


.rp-stat-number.green {
    color: #099268;
}


.rp-stat-number.orange {
    color: #e58a00;
}


.rp-stat-label {

    text-align: center;

    font-size: 10px;

    line-height: 1.25;

    color: #667085;
}


/* HEADER BIENES */

.rp-modal-section-header {

    display: flex;

    align-items: center;

    justify-content: space-between;

    padding: 2px 20px 10px;
}


.rp-modal-section-header strong {

    color: #111827;

    font-size: 14px;
}


.rp-modal-filter {

    border: 1px solid #e1e6ed;

    background: #fff;

    color: #0867d8;

    border-radius: 8px;

    padding: 6px 9px;

    font-size: 11px;

    cursor: pointer;
}


.rp-modal-filter i {

    margin-left: 4px;

    font-size: 10px;
}


/* LISTA BIENES */

.rp-modal-bienes {

    border-top: 1px solid #edf0f4;
}


.rp-modal-bien {

    min-height: 76px;

    display: flex;

    align-items: center;

    padding: 9px 12px;

    border-bottom: 1px solid #edf0f4;

    position: relative;
}


.rp-modal-bien:last-child {
    border-bottom: none;
}


/* ICONO */

.rp-bien-icon {

    width: 40px;
    height: 40px;

    min-width: 40px;

    border-radius: 50%;

    background: #f5f7fa;

    color: #1d2939;

    display: flex;

    align-items: center;
    justify-content: center;

    margin-right: 10px;

    font-size: 17px;
}


/* INFO BIEN */

.rp-bien-info {

    flex: 1;

    min-width: 0;

    display: flex;

    flex-direction: column;
}


.rp-bien-info strong {

    color: #182230;

    font-size: 12px;

    margin-bottom: 2px;
}


.rp-bien-info span {

    color: #596579;

    font-size: 11px;

    white-space: nowrap;

    overflow: hidden;

    text-overflow: ellipsis;
}


.rp-bien-info small {

    color: #9aa3b1;

    font-size: 11px;

    margin-top: 2px;
}


/* ESTADO */

.rp-bien-status {

    align-self: flex-start;

    margin-top: 2px;

    padding: 5px 7px;

    border-radius: 7px;

    font-size: 9px;

    font-weight: 600;

    white-space: nowrap;
}


.rp-bien-status.en-uso {

    background: #eaf8f2;

    color: #15936a;
}


.rp-bien-status.reparacion {

    background: #fff5df;

    color: #d98400;
}


/* FLECHA */

.rp-bien-arrow {

    color: #8993a3;

    font-size: 12px;

    margin-left: 7px;
}


/* DESKTOP */

@media (min-width: 700px) {

    .rp-modal-content {
        max-width: 430px;
    }

}
/* ==========================================================
   ePAN PATRIMONIAL
   REGISTRO POR PERSONA
   ========================================================== */


/* ==========================================================
   CONTENEDOR
   ========================================================== */

.rp-persona {

    min-height: 100vh;

    background: #f7f9fc;

    position: relative;

    padding-bottom: 78px;

    font-family:
        -apple-system,
        BlinkMacSystemFont,
        "Segoe UI",
        Roboto,
        Arial,
        sans-serif;

}


/* ==========================================================
   HEADER
   ========================================================== */

.rp-header {

    height: 62px;

    background: linear-gradient(
        135deg,
        #0867d8,
        #0754c7
    );

    color: #fff;

    display: flex;

    align-items: center;

    padding: 0 16px;

    box-shadow:
        0 2px 8px rgba(0,0,0,.10);

}


.rp-back {

    width: 40px;

    height: 40px;

    display: flex;

    align-items: center;

    justify-content: center;

    color: #fff;

    text-decoration: none;

    font-size: 21px;

    margin-right: 7px;

}


.rp-header-title {

    font-size: 17px;

    font-weight: 700;

}


/* ==========================================================
   CONTENIDO
   ========================================================== */

.rp-content {

    max-width: 100%;

    margin: 0 auto;

    padding:
        12px
        16px
        30px;

}


/* ==========================================================
   ICONO PRINCIPAL
   ========================================================== */

.rp-main-icon {

    width: 84px;

    height: 84px;

    border-radius: 50%;

    background: linear-gradient(
        135deg,
        #6f24e8,
        #7b36f0
    );

    color: white;

    display: flex;

    align-items: center;

    justify-content: center;

    margin:
        0 auto
        12px;

    font-size: 34px;

    box-shadow:
        0 7px 18px
        rgba(110,40,220,.18);

}


/* ==========================================================
   TITULO
   ========================================================== */

.rp-content h1 {

    margin: 0;

    text-align: center;

    color: #111827;

    font-size: 25px;

    line-height: 1.16;

    font-weight: 800;

}


/* ==========================================================
   DESCRIPCION
   ========================================================== */

.rp-description {

    margin:
        11px
        0
        28px;

    text-align: center;

    color: #697386;

    font-size: 13px;

    line-height: 1.45;

}


/* ==========================================================
   BUSCADOR
   ========================================================== */

.rp-search {

    height: 50px;

    background: #fff;

    border:
        1px solid
        #e3e7ed;

    border-radius: 11px;

    display: flex;

    align-items: center;

    padding:
        0
        15px;

    box-shadow:
        0 2px 8px
        rgba(20,40,80,.04);

    margin-bottom: 24px;

}


.rp-search i {

    color: #8c96a6;

    font-size: 16px;

    margin-right: 12px;

}


.rp-search input {

    border: none;

    outline: none;

    background: transparent;

    width: 100%;

    height: 100%;

    font-size: 13px;

    color: #182230;

}


.rp-search input::placeholder {

    color: #9ca5b3;

}


/* ==========================================================
   TITULO SECCION
   ========================================================== */

.rp-section-title {

    color: #111827;

    font-size: 13px;

    font-weight: 750;

    margin:
        0
        0
        10px;

}


/* ==========================================================
   LISTA
   ========================================================== */

.rp-personas-list {

    background: #fff;

    border:
        1px solid
        #e4e8ee;

    border-radius: 11px;

    overflow: hidden;

    box-shadow:
        0 2px 8px
        rgba(20,40,80,.04);

}


/* ==========================================================
   PERSONA
   ========================================================== */

.rp-persona {

    min-height: 78px;

    display: flex;

    align-items: center;

    padding:
        10px
        12px;

    text-decoration: none;

    background: #fff;

    color: inherit;

    border-bottom:
        1px solid
        #edf0f4;

    transition:
        background .15s ease;

}


.rp-persona:last-child {

    border-bottom: none;

}


.rp-persona:hover {

    background: #f8faff;

}


.rp-persona:active {

    background: #f0f5ff;

}


/* ==========================================================
   ICONO PERSONA
   ========================================================== */

.rp-persona-icon {

    width: 43px;

    height: 43px;

    min-width: 43px;

    border-radius: 50%;

    background: #f4f7fb;

    color: #0965d7;

    display: flex;

    align-items: center;

    justify-content: center;

    margin-right: 12px;

    font-size: 17px;

}


/* ==========================================================
   INFORMACION PERSONA
   ========================================================== */

.rp-persona-info {

    flex: 1;

    min-width: 0;

}


.rp-persona-name {

    color: #111827;

    font-size: 13px;

    font-weight: 700;

    margin-bottom: 3px;

}


.rp-persona-dni {

    color: #737e8f;

    font-size: 12px;

}


.rp-persona-extra {

    color: #a0a8b5;

    font-size: 10px;

    margin-top: 3px;

    white-space: nowrap;

    overflow: hidden;

    text-overflow: ellipsis;

}


/* ==========================================================
   RELOJ
   ========================================================== */

.rp-persona-history {

    width: 35px;

    min-width: 35px;

    text-align: center;

    color: #8b95a5;

    font-size: 17px;

}


/* ==========================================================
   SIN RESULTADOS
   ========================================================== */

.rp-no-results {

    display: none;

    flex-direction: column;

    align-items: center;

    text-align: center;

    padding: 40px 20px;

    color: #8a94a4;

}


.rp-no-results i {

    font-size: 30px;

    margin-bottom: 10px;

}


.rp-no-results strong {

    color: #374151;

    font-size: 13px;

    margin-bottom: 4px;

}


.rp-no-results span {

    font-size: 11px;

}


/* ==========================================================
   NAVEGACION INFERIOR
   ========================================================== */

.rp-bottom-nav {

    position: fixed;

    bottom: 0;

    left: 0;

    right: 0;

    height: 70px;

    background: #fff;

    border-top:
        1px solid
        #e4e8ee;

    display: flex;

    align-items: center;

    justify-content: space-around;

    z-index: 1000;

    box-shadow:
        0 -2px 8px
        rgba(0,0,0,.04);

}


/* ==========================================================
   ITEMS NAVEGACION
   ========================================================== */

.rp-nav-item {

    flex: 1;

    height: 100%;

    display: flex;

    flex-direction: column;

    align-items: center;

    justify-content: center;

    gap: 4px;

    text-decoration: none;

    color: #8d97a7;

    font-size: 10px;

}


.rp-nav-item i {

    font-size: 18px;

}


.rp-nav-item.active {

    color: #0866d8;

    font-weight: 600;

}


.rp-nav-item.active i {

    font-size: 19px;

}


/* ==========================================================
   DESKTOP
   ========================================================== */

@media (min-width: 700px) {

    .rp-persona {

        max-width: 520px;

        margin-left: auto;

        margin-right: auto;

    }


    .rp-bottom-nav {

        max-width: 520px;

        left: 50%;

        right: auto;

        transform: translateX(-50%);

        border-radius:
            0
            0
            12px
            12px;

    }

}

</style>