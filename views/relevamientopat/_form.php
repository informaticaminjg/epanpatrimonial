<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Relevamientopat $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="relevamiento-form">

    <div class="relevamiento-header">
        <div class="relevamiento-icon">
            <i class="fa-solid fa-building"></i>
        </div>

        <div>
            <h2>Nuevo relevamiento</h2>
            <p>Registrá el lugar donde vas a relevar los bienes.</p>
        </div>
    </div>

    <?php $form = ActiveForm::begin([
        'options' => [
            'class' => 'relevamiento-form-content'
        ]
    ]); ?>

    <div class="form-section">

        <label class="form-label-custom">
            <i class="fa-solid fa-location-dot"></i>
            Lugar del relevamiento
        </label>

        <?= $form->field($model, 'lugar_relevamiento', [
            'options' => ['class' => 'form-group-custom'],
            'template' => "{input}\n{error}"
        ])->textInput([
            'maxlength' => true,
            'class' => 'form-control-custom',
            'placeholder' => 'Ej. Oficina de Patrimonio'
        ]) ?>

    </div>


   <div class="form-section">

    <label class="form-label-custom">
        <i class="fa-solid fa-map-location-dot"></i>
        Ubicación
    </label>

    <div class="location-box">

        <div class="location-icon">
            <i class="fa-solid fa-location-crosshairs"></i>
        </div>

        <div class="location-info">
            <strong id="location-status">
                Ubicación no obtenida
            </strong>

            <span id="location-coordinates">
                Presioná el botón para obtener tu ubicación
            </span>
            <div id="location-address" class="location-address"></div>
            <div class="location-details">
                <label>
                    <i class="fa-solid fa-note-sticky"></i>
                    Detalles de la ubicación
                </label>

                <textarea
                    id="relevamiento-detalles-ubicacion"
                    name="Relevamientopat[detalles_ubicacion]"
                    class="form-control-custom"
                    rows="3"
                    placeholder="Ej. Ingreso por calle Rioja, acceso lateral, segundo portón, edificio principal, piso 5..."
                ></textarea>
            </div>
        </div>

    </div>

    <button
        type="button"
        id="btn-obtener-ubicacion"
        class="btn-location"
        onclick="obtenerUbicacion()"
    >
        <i class="fa-solid fa-location-crosshairs"></i>
        Obtener mi ubicación
    </button>

    <div id="mapa-relevamiento"></div>

</div>

    <div class="form-section">

        <label class="form-label-custom">
            <i class="fa-solid fa-align-left"></i>
            Descripción
            <small>Opcional</small>
        </label>

        <?= $form->field($model, 'descripcion', [
            'options' => ['class' => 'form-group-custom'],
            'template' => "{input}\n{error}"
        ])->textarea([
            'rows' => 4,
            'class' => 'form-control-custom textarea-custom',
            'placeholder' => 'Podés agregar una observación sobre el relevamiento...'
        ]) ?>

    </div>


    <?= Html::hiddenInput('Relevamientopat[latitud]', '', [
        'id' => 'relevamiento-latitud'
    ]) ?>

    <?= Html::hiddenInput('Relevamientopat[longitud]', '', [
        'id' => 'relevamiento-longitud'
    ]) ?>


    <div class="relevamiento-info">

        <div class="info-icon">
            <i class="fa-solid fa-circle-info"></i>
        </div>

        <div>
            <strong>¿Qué vas a hacer?</strong>
            <span>
                Una vez iniciado el relevamiento podrás agregar los bienes
                encontrados, consultar su información y registrar fotografías.
            </span>
        </div>

    </div>


    <div class="relevamiento-actions">

       <button
            type="button"
            id="btn-comenzar-relevamiento"
            class="btn-start-relevamiento"
        >
            <i class="fa-solid fa-play"></i>
            Comenzar relevamiento
        </button>

    </div>


<div id="registro-bienes" class="registro-bienes" style="display:none;">

    <div class="registro-bienes-header">

        <div class="registro-icon">
            <i class="fa-solid fa-boxes-stacked"></i>
        </div>

        <div class="registro-bienes-info">
            <h3>Registro de bienes</h3>
            <p>Agregá los bienes encontrados durante el relevamiento.</p>
        </div>

    </div>

    <!-- Compartir tarea en vivo -->
    <div
        id="contenedor-compartir-tarea"
        class="compartir-tarea-container"
        style="display:none;">

        <button
            type="button"
            id="btn-compartir-tarea"
            class="btn-compartir-tarea"
            onclick="compartirTareaEnVivo()">

            <i class="fa-solid fa-share-nodes"></i>
            Compartir tarea colaborativa

        </button>

    </div>
<!-- ==========================================================
     MODAL COMPARTIR TAREA COLABORATIVA
     ========================================================== -->

<div id="modalCompartirTarea" class="rp-modal">

    <div class="rp-modal-overlay" onclick="cerrarCompartirTarea()"></div>

    <div class="rp-modal-content compartir-modal">

        <div class="rp-modal-header">

            <div>
                <div class="rp-modal-title">
                    <i class="fa-solid fa-user-group"></i>
                    Compartir tarea colaborativa
                </div>

                <div class="rp-modal-subtitle">
                    Invita a otras personas a colaborar en este relevamiento
                </div>
            </div>

            <button
                type="button"
                class="rp-modal-close"
                onclick="cerrarCompartirTarea()">
                &times;
            </button>

        </div>

<!-- INICIO DIV SIMULADOR INVITACION -->
        <div class="rp-modal-body">

            <!-- RELEVAMIENTO -->
            <div class="compartir-relevamiento-info">

                <div class="compartir-info-icon">
                    <i class="fa-solid fa-clipboard-list"></i>
                </div>

                <div>
                    <strong id="compartirNombreRelevamiento">
                        Relevamiento actual
                    </strong>

                    <span>
                        Las personas invitadas podrán colaborar relevando bienes.
                    </span>
                </div>

            </div>


            <!-- BUSCADOR -->
            <div class="compartir-label">
                Seleccionar personas
            </div>

            <div class="compartir-buscador">

                <i class="fa-solid fa-magnifying-glass"></i>

                <input
                    type="text"
                    id="buscarUsuarioColaborador"
                    placeholder="Buscar por nombre o usuario..."
                    oninput="filtrarUsuariosColaboradores()">

            </div>


            <!-- LISTADO -->
            <div
                id="listaUsuariosColaboradores"
                class="lista-usuarios-colaboradores">
            </div>


            <!-- SELECCIONADOS -->
            <div class="seleccionados-container">

                <div class="compartir-label">
                    Personas seleccionadas
                </div>

                <div
                    id="usuariosSeleccionados"
                    class="usuarios-seleccionados">

                    <span class="sin-seleccion">
                        Ninguna persona seleccionada
                    </span>

                </div>

            </div>


            <!-- MENSAJE -->
            <div class="compartir-label">
                Mensaje <span>(opcional)</span>
            </div>

            <textarea
                id="mensajeInvitacion"
                class="mensaje-invitacion"
                rows="3"
                placeholder="Escribí un mensaje para las personas invitadas..."></textarea>


        </div>


        <div class="rp-modal-footer">

            <button
                type="button"
                class="btn-modal-secondary"
                onclick="cerrarCompartirTarea()">
                Cancelar
            </button>

            <button
                type="button"
                class="btn-modal-primary"
                onclick="enviarInvitaciones()">

                <i class="fa-solid fa-paper-plane"></i>
                Enviar invitaciones

            </button>

        </div>

    </div>

</div>
<!-- FIN DIV SIMULADOR INVITACION-->
 <!-- INICIO  DIV SIMULADOR INVITACION RECIBIDA-->
<!-- ==========================================================
     MODAL INVITACIÓN RECIBIDA
     ========================================================== -->
<div id="invitacionToast" class="invitacion-toast">

    <div class="invitacion-toast-header">

        <div class="invitacion-toast-icon">
            <i class="fa-solid fa-user-group"></i>
        </div>

        <div>
            <strong>Nueva invitación</strong>
            <span>Solicitud de colaboración</span>
        </div>

        <button
            type="button"
            onclick="cerrarInvitacionToast()"
            class="invitacion-toast-close">
            &times;
        </button>

    </div>


    <div class="invitacion-toast-body">

        <strong id="invitacionRemitente">
            Luis García
        </strong>

        te invita a colaborar en:

        <strong id="invitacionRelevamiento">
            Relevamiento actual
        </strong>

    </div>


    <div
        id="invitacionMensaje"
        class="invitacion-toast-mensaje">
    </div>


    <div class="invitacion-toast-actions">

        <button
            type="button"
            class="btn-toast-rechazar"
            onclick="rechazarInvitacion()">

            Rechazar

        </button>

        <button
            type="button"
            class="btn-toast-aceptar"
            onclick="aceptarInvitacion()">

            <i class="fa-solid fa-check"></i>
            Aceptar

        </button>

    </div>

</div>

 <!-- FIN  DIV SIMULADOR INVITACION RECIBIDA-->
  <!-- INICIO SIMULACION COLABORADORES -->
<!-- ==========================================================
     COLABORADORES
     ========================================================== -->

<div class="colaboradores-card">

    <div class="colaboradores-header">

        <div>
            <div class="colaboradores-title">
                <i class="fa-solid fa-users"></i>
                Colaboradores
            </div>

            <div class="colaboradores-subtitle">
                Personas trabajando en este relevamiento
            </div>
        </div>

        <span
            id="cantidadColaboradores"
            class="colaboradores-count">
            1
        </span>

    </div>


    <div id="listaColaboradores">

        <div class="colaborador-item">

            <div class="colaborador-avatar">
                LG
            </div>

            <div class="colaborador-info">

                <strong>Luis García</strong>

                <span>
                    <i class="fa-solid fa-circle estado-online"></i>
                    Creador del relevamiento
                </span>

            </div>

            <div class="colaborador-estado">
                Creador
            </div>

        </div>

    </div>

</div>
    <!-- FIN SIMULACION COLABORADORES -->
<!-- INICIO SIMULACION BIENES COLABORATIVOS-->
    <!-- ==========================================================
     BIENES DEL RELEVAMIENTO
     ========================================================== -->


 <!-- FIN SIMULACION BIENES COLABORATIVOS-->
    <!-- BUSCAR / INGRESAR MATRÍCULA -->

    <div class="registro-busqueda">

        <label class="form-label-custom">
            <i class="fa-solid fa-barcode"></i>
            Matrícula o código de barras
        </label>

        <div class="busqueda-row">

            <input
                type="text"
                id="matricula-busqueda"
                class="form-control-custom"
                placeholder="Ingresá la matrícula"
            >

           <button
                type="button"
                id="btn-buscar-bien"
                class="btn-buscar-bien"
                title="Buscar el bien en SICOPRO"
            >
                <i class="fa-solid fa-magnifying-glass"></i>
                <span class="texto-sicopro">SICOPRO</span>
            </button>

        </div>
        <div id="resultado-sicopro" class="resultado-sicopro" style="display:none;"></div>
        <div class="botones-escanear">
            <button
                type="button"
                id="btn-escanear-matricula"
                class="btn-escanear-bien"
            >
                <i class="fa-solid fa-camera"></i>
                Escanear matrícula
            </button>

            <button
                type="button"
                id="btn-escanear-codigo"
                class="btn-escanear-bien"
            >
                <i class="fa-solid fa-barcode"></i>
                Escanear código de barras
            </button>
        </div>
    </div>


    <!-- DATOS DEL BIEN -->

    <div id="bien-encontrado" class="bien-encontrado" style="display:none;">

        <div class="bien-encontrado-header">

            <i class="fa-solid fa-circle-check"></i>

            <strong>Datos del bien</strong>

        </div>


        <!-- MATRÍCULA -->

        <div class="bien-campo">

            <label>
                Matrícula
            </label>

            <input
                type="text"
                id="bien-matricula"
                class="form-control-custom"
                readonly
            >

        </div>


        <!-- PERSONA A CARGO -->

        <div class="bien-campo">

            <label>
                Persona a cargo
            </label>

            <input
                type="text"
                id="bien-persona-cargo"
                class="form-control-custom"
                placeholder="Persona responsable"
            >

        </div>


        <!-- LUGAR -->

        <div class="bien-campo">

            <label>
                Lugar al que pertenece
            </label>

            <input
                type="text"
                id="bien-lugar-pertenece"
                class="form-control-custom"
                placeholder="Ej. Oficina de Patrimonio"
            >

        </div>
        <!-- SECTOR -->

        <div class="bien-campo">

            <label>
                Sector
            </label>

            <input
                type="text"
                id="bien-sector"
                class="form-control-custom"
                placeholder="Ej. Administración"
            >

        </div>

        <!-- ESTADO -->

        <div class="bien-campo">

            <label>
                Estado del bien
            </label>

            <select
                id="bien-estado"
                class="form-control-custom"
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

                <option value="Inexistente">
                    Inexistente
                </option>

            </select>

        </div>




<!-- REGISTRO FOTOGRÁFICO -->

<div class="bien-campo registro-fotografico">

    <label>
        Registro fotográfico
        <span class="campo-opcional">(opcional)</span>
    </label>

    <div class="fotografias-container">

        <!-- BOTONES -->

        <div class="fotografias-botones">

            <button
                type="button"
                id="btn-tomar-foto"
                class="btn-fotografia"
                onclick="abrirCamaraFoto()"
            >
                <i class="fa-solid fa-camera"></i>
                Tomar foto
            </button>
            <label for="bien-fotos-archivos" class="btn-fotografia">
                <i class="fa-solid fa-paperclip"></i>
                Adjuntar archivos
            </label>

        </div>


        <!-- INPUT PARA ARCHIVOS -->

        <input
            type="file"
            id="bien-fotos-archivos"
            accept="image/*"
            multiple
            hidden
        >


        <!-- PREVIEW -->

       <div id="contenedor-fotografias"></div>

    </div>

</div>


<!-- =========================
     MODAL DE CÁMARA
========================= -->

<div
    id="modal-camara-foto"
    class="modal-camara-foto"
    style="display:none;"
>
    <div id="preparando-camara" class="preparando-camara">
        <div class="spinner-camara"></div>
        <div>Preparando cámara...</div>
    </div>

    <div class="camara-foto-contenido">

        <div class="camara-foto-header">

            <strong>
                Tomar fotografía
            </strong>

            <button
                type="button"
                id="btn-cerrar-camara"
                class="btn-cerrar-camara"
                onclick="cerrarCamaraFoto()"
            >
                <i class="fa-solid fa-xmark"></i>
            </button>

        </div>


        <div class="camara-video-container">

            <video
                id="video-camara-foto"
                autoplay
                playsinline
            ></video>

        </div>


        <div class="camara-foto-controles">

           <button
                type="button"
                id="btn-capturar-foto"
                class="btn-capturar-foto"
                onclick="capturarFoto()"
            >
                <i class="fa-solid fa-camera"></i>
            </button>
        </div>

    </div>

</div>


        
        <button
            type="button"
            id="btn-agregar-bien"
            class="btn-agregar-bien"
        >

            <i class="fa-solid fa-plus"></i>

            Agregar al relevamiento

        </button>

    </div>


    <!-- BIENES REGISTRADOS -->

    <div class="bienes-registrados">

        <div class="bienes-title">

            <strong>
                Bienes registrados
            </strong>

            <span id="cantidad-bienes">
                0
            </span>

        </div>


        <div id="lista-bienes">

            <div class="lista-vacia">

                <i class="fa-solid fa-box-open"></i>

                <span>
                    Aún no registraste ningún bien.
                </span>

            </div>

        </div>

    </div>


    <!-- JSON CON TODOS LOS BIENES -->

    <input
        type="hidden"
        name="bienes_relevados"
        id="bienes-relevados"
        value=""
    >

    <!-- FINALIZAR -->

    <div class="finalizar-relevamiento">

        <button
            type="submit"
            id="btn-finalizar-relevamiento"
            class="btn-finalizar-relevamiento"
        >

            <i class="fa-solid fa-check"></i>

            Finalizar relevamiento

        </button>

    </div>

</div>
<div id="visor-fotos-bien" class="visor-fotos-bien">

    <button
        type="button"
        class="cerrar-visor-fotos"
        onclick="cerrarGaleriaBien()"
    >
        <i class="fa-solid fa-xmark"></i>
    </button>

    <div class="swiper swiper-fotos-bien">

        <div class="swiper-wrapper" id="swiper-wrapper-fotos-bien">
        </div>

        <div class="swiper-button-prev"></div>
        <div class="swiper-button-next"></div>

        <div class="swiper-pagination"></div>

    </div>

</div>
<div id="visor-foto-zoom">

    <button
        type="button"
        class="cerrar-foto-zoom"
        onclick="cerrarFotoZoom()"
    >
        <i class="fa-solid fa-xmark"></i>
    </button>

    <div class="swiper swiper-fotos">

        <div class="swiper-wrapper" id="swiper-fotos-wrapper">
            <!-- Las fotos se agregan con JS -->
        </div>

        <div class="swiper-button-prev"></div>
        <div class="swiper-button-next"></div>

        <div class="swiper-pagination"></div>

    </div>

</div>
<div id="visor-foto" class="visor-foto">

    <button
        type="button"
        class="cerrar-visor-foto"
        onclick="cerrarFotoCompleta()"
    >
        <i class="fa-solid fa-xmark"></i>
    </button>

    <img
        id="imagen-visor-foto"
        src=""
        alt="Foto"
    >

</div>

<div id="modal-ver-relevamiento" class="modal-ver-relevamiento">

    <div class="modal-ver-relevamiento-contenido">

        <button
            type="button"
            id="cerrar-modal-ver-relevamiento"
            class="cerrar-modal-ver-relevamiento"
            title="Cerrar"
        >
            <i class="fa-solid fa-xmark"></i>
        </button>

        <div id="contenido-ver-relevamiento"></div>

    </div>

</div>
<div id="flash-foto" class="flash-foto"></div>

    <?php ActiveForm::end(); ?>

</div>

<link
    rel="stylesheet"
    href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
/>

<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<link
    rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"
/>

<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<style>
/*INICIO ESTILO SIMULACION*/
.compartir-modal {
    width: 650px;
    max-width: 95%;
}

.rp-modal {
    display: none;
    position: fixed;
    inset: 0;
    z-index: 99990;
    align-items: center;
    justify-content: center;
}

.rp-modal.active {
    display: flex;
}
.rp-modal-overlay {
    position: absolute;
    inset: 0;
    background: rgba(15, 23, 42, 0.45);
    backdrop-filter: blur(2px);
}

.rp-modal-content {
    position: relative;
    z-index: 2;
    background: #fff;
    border-radius: 14px;
    box-shadow: 0 20px 60px rgba(0,0,0,.20);
    max-height: 90vh;
    overflow-y: auto;
}
.compartir-relevamiento-info {
    display: flex;
    align-items: center;
    gap: 14px;
    padding: 14px;
    background: #f6f8fb;
    border-radius: 12px;
    margin-bottom: 20px;
}

.compartir-info-icon {
    width: 42px;
    height: 42px;
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: #e8eef8;
    color: #315a91;
    font-size: 18px;
}

.compartir-relevamiento-info strong {
    display: block;
    font-size: 15px;
}

.compartir-relevamiento-info span {
    display: block;
    color: #777;
    font-size: 12px;
    margin-top: 3px;
}

.compartir-label {
    font-size: 13px;
    font-weight: 600;
    color: #444;
    margin-bottom: 7px;
}

.compartir-label span {
    font-weight: 400;
    color: #999;
}

.compartir-buscador {
    height: 42px;
    border: 1px solid #dce1e7;
    border-radius: 9px;
    display: flex;
    align-items: center;
    padding: 0 13px;
    margin-bottom: 10px;
}

.compartir-buscador i {
    color: #999;
    margin-right: 9px;
}

.compartir-buscador input {
    border: 0;
    outline: 0;
    width: 100%;
    font-size: 14px;
}

.lista-usuarios-colaboradores {
    max-height: 230px;
    overflow-y: auto;
    border: 1px solid #edf0f3;
    border-radius: 10px;
}

.usuario-colaborador-item {
    display: flex;
    align-items: center;
    gap: 11px;
    padding: 11px 13px;
    cursor: pointer;
    border-bottom: 1px solid #f0f1f3;
    transition: .15s;
}

.usuario-colaborador-item:last-child {
    border-bottom: 0;
}

.usuario-colaborador-item:hover {
    background: #f7f9fc;
}

.usuario-colaborador-item.seleccionado {
    background: #f0f5fb;
}

.usuario-colaborador-item.ya-colaborador {
    cursor: default;
    opacity: .65;
}

.usuario-check {
    width: 20px;
}

.usuario-check input {
    width: 16px;
    height: 16px;
}

.usuario-avatar,
.colaborador-avatar {
    width: 38px;
    height: 38px;
    min-width: 38px;
    border-radius: 50%;
    background: #e8edf5;
    color: #315a91;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 12px;
    font-weight: 700;
}

.usuario-datos {
    flex: 1;
}

.usuario-datos strong {
    display: block;
    font-size: 13px;
    color: #333;
}

.usuario-datos span {
    font-size: 11px;
    color: #999;
}

.usuario-ya-colabora {
    font-size: 11px;
    color: #777;
}

.usuarios-seleccionados {
    display: flex;
    flex-wrap: wrap;
    gap: 7px;
    min-height: 35px;
    margin-bottom: 18px;
}

.sin-seleccion {
    color: #aaa;
    font-size: 12px;
    padding-top: 8px;
}

.usuario-chip {
    display: flex;
    align-items: center;
    gap: 6px;
    background: #edf3fa;
    color: #315a91;
    border-radius: 20px;
    padding: 4px 8px 4px 5px;
    font-size: 12px;
}

.chip-avatar {
    width: 25px;
    height: 25px;
    border-radius: 50%;
    background: #fff;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 9px;
    font-weight: bold;
}

.usuario-chip button {
    border: 0;
    background: transparent;
    color: #777;
    cursor: pointer;
    font-size: 16px;
}

.mensaje-invitacion {
    width: 100%;
    resize: vertical;
    border: 1px solid #dce1e7;
    border-radius: 9px;
    padding: 10px;
    font-size: 13px;
    outline: none;
    box-sizing: border-box;
}

.mensaje-invitacion:focus {
    border-color: #9eb6d3;
}


/* ==========================================================
   INVITACIÓN
   ========================================================== */

.invitacion-modal {
    width: 430px;
    max-width: 94%;
    text-align: center;
    padding: 30px;
}

.invitacion-icon {
    width: 65px;
    height: 65px;
    margin: 0 auto 15px;
    border-radius: 50%;
    background: #edf3fa;
    color: #315a91;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 25px;
}

.invitacion-titulo {
    font-size: 20px;
    font-weight: 700;
    margin-bottom: 12px;
}

.invitacion-texto {
    color: #555;
    line-height: 1.6;
    font-size: 14px;
}

.invitacion-mensaje {
    margin: 18px 0;
    padding: 12px;
    border-radius: 9px;
    background: #f6f7f9;
    color: #666;
    font-size: 13px;
    text-align: left;
}

.invitacion-botones {
    display: flex;
    gap: 10px;
    margin-top: 20px;
}

.invitacion-botones button {
    flex: 1;
    height: 42px;
    border-radius: 8px;
    cursor: pointer;
    font-weight: 600;
}

.btn-rechazar {
    border: 1px solid #ddd;
    background: #fff;
    color: #666;
}

.btn-aceptar {
    border: 0;
    background: #315a91;
    color: #fff;
}

/* ==========================================================
   INVITACIÓN FLOTANTE
   ========================================================== */

.invitacion-toast {
    position: fixed;
    top: 70px;
    right: 20px;

    width: 350px;
    max-width: calc(100vw - 40px);

    background: #fff;

    border: 1px solid #e4e8ed;
    border-radius: 14px;

    box-shadow:
        0 12px 35px rgba(0,0,0,.16);

    padding: 15px;

    z-index: 100000;

    transform: translateX(420px);
    opacity: 0;

    transition:
        transform .3s ease,
        opacity .3s ease;
}

.invitacion-toast.active {
    transform: translateX(0);
    opacity: 1;
}


.invitacion-toast-header {
    display: flex;
    align-items: center;
    gap: 10px;
}


.invitacion-toast-icon {
    width: 38px;
    height: 38px;

    border-radius: 50%;

    background: #edf3fa;
    color: #315a91;

    display: flex;
    align-items: center;
    justify-content: center;
}


.invitacion-toast-header > div:nth-child(2) {
    flex: 1;
}


.invitacion-toast-header strong {
    display: block;
    font-size: 14px;
}


.invitacion-toast-header span {
    display: block;
    font-size: 11px;
    color: #999;
    margin-top: 2px;
}


.invitacion-toast-close {
    border: 0;
    background: transparent;
    color: #999;
    font-size: 20px;
    cursor: pointer;
}


.invitacion-toast-body {
    margin-top: 13px;

    font-size: 13px;
    line-height: 1.5;

    color: #555;
}


.invitacion-toast-body strong {
    color: #333;
}


.invitacion-toast-mensaje {
    margin-top: 10px;

    background: #f7f8fa;

    border-radius: 8px;

    padding: 9px;

    font-size: 12px;
    color: #666;
}


.invitacion-toast-actions {
    display: flex;
    gap: 8px;

    margin-top: 13px;
}


.invitacion-toast-actions button {
    flex: 1;

    height: 35px;

    border-radius: 7px;

    font-size: 12px;
    font-weight: 600;

    cursor: pointer;
}


.btn-toast-rechazar {
    background: #fff;
    border: 1px solid #dfe3e8;
    color: #666;
}


.btn-toast-aceptar {
    background: #315a91;
    border: 0;
    color: #fff;
}
/* ==========================================================
   COLABORADORES
   ========================================================== */

.colaboradores-card,
.bienes-colaborativos-card {
    background: #fff;
    border: 1px solid #e8ebef;
    border-radius: 12px;
    margin-top: 20px;
}

.colaboradores-header,
.bienes-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 16px 18px;
    border-bottom: 1px solid #edf0f3;
}

.colaboradores-title,
.bienes-title {
    font-size: 15px;
    font-weight: 700;
}

.colaboradores-title i {
    margin-right: 7px;
    color: #315a91;
}

.colaboradores-subtitle,
.bienes-subtitle {
    color: #999;
    font-size: 11px;
    margin-top: 3px;
}

.colaboradores-count,
#cantidadBienes {
    background: #edf3fa;
    color: #315a91;
    min-width: 28px;
    height: 28px;
    border-radius: 15px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 12px;
    font-weight: bold;
}

.colaborador-item {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 13px 18px;
    border-bottom: 1px solid #f0f1f3;
}

.colaborador-info {
    flex: 1;
}

.colaborador-info strong {
    display: block;
    font-size: 13px;
}

.colaborador-info span {
    display: block;
    color: #999;
    font-size: 11px;
    margin-top: 3px;
}

.estado-online {
    color: #42a66a;
    font-size: 7px;
}

.colaborador-estado {
    font-size: 11px;
    color: #315a91;
}


/* ==========================================================
   BIENES
   ========================================================== */

.bien-colaborativo-item {
    display: flex;
    align-items: center;
    gap: 13px;
    padding: 14px 18px;
    border-bottom: 1px solid #f0f1f3;
}

.bien-icon {
    width: 38px;
    height: 38px;
    border-radius: 9px;
    background: #f0f3f7;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #315a91;
}

.bien-datos {
    flex: 1;
}

.bien-datos strong {
    display: block;
    font-size: 13px;
}

.bien-datos span {
    color: #999;
    font-size: 11px;
}

.bien-relevado-por {
    display: flex;
    align-items: center;
    gap: 7px;
    font-size: 11px;
    color: #666;
}

.mini-avatar {
    width: 26px;
    height: 26px;
    border-radius: 50%;
    background: #edf3fa;
    color: #315a91;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 8px;
    font-weight: bold;
}

.sin-bienes {
    padding: 25px;
    text-align: center;
    color: #aaa;
    font-size: 12px;
}


/* ==========================================================
   TOAST
   ========================================================== */

.rp-toast {
    position: fixed;
    right: 25px;
    bottom: 25px;
    min-width: 280px;
    max-width: 380px;
    padding: 13px 16px;
    background: #fff;
    border: 1px solid #e5e8ec;
    border-radius: 10px;
    box-shadow: 0 8px 30px rgba(0,0,0,.12);
    display: flex;
    align-items: center;
    gap: 11px;
    transform: translateY(30px);
    opacity: 0;
    transition: .3s;
    z-index: 99999;
    font-size: 13px;
}

.rp-toast.show {
    transform: translateY(0);
    opacity: 1;
}

.rp-toast-icon {
    width: 28px;
    height: 28px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
}

.rp-toast-success .rp-toast-icon {
    background: #eaf6ee;
    color: #42a66a;
}

.rp-toast-warning .rp-toast-icon {
    background: #fff5df;
    color: #d99421;
}
/*FIN ESTILO SIMULACION*/
</style>

<script>
 /*INICIO CODIGO SIMULACION*/
    /* ==========================================================
       USUARIOS SIMULADOS
       ========================================================== */

    const usuariosColaboradores = [

        {
            id: 1,
            nombre: "Luis García",
            usuario: "lgarcia",
            avatar: "LG"
        },

        {
            id: 2,
            nombre: "Juan Pérez",
            usuario: "jperez",
            avatar: "JP"
        },

        {
            id: 3,
            nombre: "María González",
            usuario: "mgonzalez",
            avatar: "MG"
        },

        {
            id: 4,
            nombre: "Carlos Rodríguez",
            usuario: "crodriguez",
            avatar: "CR"
        },

        {
            id: 5,
            nombre: "Ana López",
            usuario: "alopez",
            avatar: "AL"
        },

        {
            id: 6,
            nombre: "Pedro Fernández",
            usuario: "pfernandez",
            avatar: "PF"
        },

        {
            id: 7,
            nombre: "Laura Martínez",
            usuario: "lmartinez",
            avatar: "LM"
        },

        {
            id: 8,
            nombre: "Sergio Gómez",
            usuario: "sgomez",
            avatar: "SG"
        }

    ];


    /* ==========================================================
       ESTADO SIMULADO
       ========================================================== */

    let usuariosSeleccionados = [];

    let colaboradores = [

        {
            id: 1,
            nombre: "Luis García",
            usuario: "lgarcia",
            avatar: "LG",
            rol: "Creador",
            estado: "online"
        }

    ];


    let invitacionesPendientes = [];




    /* ==========================================================
       ABRIR MODAL
       ========================================================== */

    function compartirTareaEnVivo() {

        document
            .getElementById("modalCompartirTarea")
            .classList.add("active");

        document
            .getElementById("buscarUsuarioColaborador")
            .value = "";

        renderUsuariosColaboradores();

    }


    /* ==========================================================
       CERRAR MODAL
       ========================================================== */

    function cerrarCompartirTarea() {

        document
            .getElementById("modalCompartirTarea")
            .classList.remove("active");

    }


    /* ==========================================================
       MOSTRAR USUARIOS
       ========================================================== */

    function renderUsuariosColaboradores() {

        const contenedor =
            document.getElementById(
                "listaUsuariosColaboradores"
            );

        const texto =
            document
                .getElementById(
                    "buscarUsuarioColaborador"
                )
                .value
                .toLowerCase();


        const filtrados =
            usuariosColaboradores.filter(usuario => {

                return (
                    usuario.nombre
                        .toLowerCase()
                        .includes(texto)
                    ||
                    usuario.usuario
                        .toLowerCase()
                        .includes(texto)
                );

            });


        contenedor.innerHTML = "";


        filtrados.forEach(usuario => {

            const seleccionado =
                usuariosSeleccionados.some(
                    u => u.id === usuario.id
                );


            const yaColabora =
                colaboradores.some(
                    u => u.id === usuario.id
                );


            const item =
                document.createElement("div");

            item.className =
                "usuario-colaborador-item";


            if (seleccionado) {

                item.classList.add("seleccionado");

            }


            if (yaColabora) {

                item.classList.add("ya-colaborador");

            }


            item.innerHTML = `

                <div class="usuario-check">

                    ${
                        yaColabora
                        ?
                        '<i class="fa-solid fa-check"></i>'
                        :
                        `
                        <input
                            type="checkbox"
                            ${seleccionado ? "checked" : ""}
                            ${yaColabora ? "disabled" : ""}
                        >
                        `
                    }

                </div>


                <div class="usuario-avatar">
                    ${usuario.avatar}
                </div>


                <div class="usuario-datos">

                    <strong>
                        ${usuario.nombre}
                    </strong>

                    <span>
                        @${usuario.usuario}
                    </span>

                </div>


                ${
                    yaColabora
                    ?
                    `
                    <span class="usuario-ya-colabora">
                        Ya colabora
                    </span>
                    `
                    :
                    ""
                }

            `;


            if (!yaColabora) {

                item.onclick = function () {

                    seleccionarUsuario(usuario);

                };

            }


            contenedor.appendChild(item);

        });

    }


    /* ==========================================================
       FILTRAR USUARIOS
       ========================================================== */

    function filtrarUsuariosColaboradores() {

        renderUsuariosColaboradores();

    }


    /* ==========================================================
       SELECCIONAR USUARIO
       ========================================================== */

    function seleccionarUsuario(usuario) {

        const existe =
            usuariosSeleccionados.some(
                u => u.id === usuario.id
            );


        if (existe) {

            usuariosSeleccionados =
                usuariosSeleccionados.filter(
                    u => u.id !== usuario.id
                );

        } else {

            usuariosSeleccionados.push(usuario);

        }


        renderUsuariosColaboradores();

        renderUsuariosSeleccionados();

    }


    /* ==========================================================
       MOSTRAR SELECCIONADOS
       ========================================================== */

    function renderUsuariosSeleccionados() {

        const contenedor =
            document.getElementById(
                "usuariosSeleccionados"
            );


        if (usuariosSeleccionados.length === 0) {

            contenedor.innerHTML = `
                <span class="sin-seleccion">
                    Ninguna persona seleccionada
                </span>
            `;

            return;

        }


        contenedor.innerHTML = "";


        usuariosSeleccionados.forEach(usuario => {

            const chip =
                document.createElement("div");

            chip.className =
                "usuario-chip";


            chip.innerHTML = `

                <span class="chip-avatar">
                    ${usuario.avatar}
                </span>

                ${usuario.nombre}

                <button
                    type="button"
                    onclick="quitarUsuario(${usuario.id})">

                    &times;

                </button>

            `;


            contenedor.appendChild(chip);

        });

    }


    /* ==========================================================
       QUITAR USUARIO
       ========================================================== */

    function quitarUsuario(id) {

        usuariosSeleccionados =
            usuariosSeleccionados.filter(
                usuario => usuario.id !== id
            );


        renderUsuariosSeleccionados();

        renderUsuariosColaboradores();

    }


    /* ==========================================================
       ENVIAR INVITACIONES
       ========================================================== */

    function enviarInvitaciones() {

        if (usuariosSeleccionados.length === 0) {

            mostrarToast(
                "Seleccioná al menos una persona",
                "warning"
            );

            return;

        }


        const mensaje =
            document
                .getElementById("mensajeInvitacion")
                .value
                .trim();


        usuariosSeleccionados.forEach(usuario => {

            invitacionesPendientes.push({

                id: Date.now() + usuario.id,

                usuario: usuario,

                mensaje: mensaje,

                estado: "pendiente"

            });

        });


        cerrarCompartirTarea();


        mostrarToast(
            `Se enviaron ${usuariosSeleccionados.length} invitación(es)`,
            "success"
        );


        /*
         * SIMULAMOS QUE LLEGA UNA INVITACIÓN
         * AL USUARIO DESTINATARIO
         */

        setTimeout(() => {

            mostrarInvitacionRecibida(
                usuariosSeleccionados[0],
                mensaje
            );

        }, 1000);


        usuariosSeleccionados = [];

        renderUsuariosSeleccionados();

    }


    /* ==========================================================
       MOSTRAR INVITACIÓN
       ========================================================== */
function mostrarInvitacionRecibida(usuario, mensaje) {

    document.getElementById(
        "invitacionRemitente"
    ).textContent = "Luis García";


    document.getElementById(
        "invitacionRelevamiento"
    ).textContent =
        document.getElementById(
            "compartirNombreRelevamiento"
        ).textContent;


    document.getElementById(
        "invitacionMensaje"
    ).textContent =
        mensaje ||
        "Te invita a colaborar en este relevamiento.";


    document.getElementById(
        "invitacionToast"
    ).classList.add("active");

    // 🔔 Sonido de nueva invitación
    reproducirSonidoInvitacion();

}
function reproducirSonidoInvitacion()
{
    try {

        const audioContext =
            new (
                window.AudioContext ||
                window.webkitAudioContext
            )();

        const oscillator =
            audioContext.createOscillator();

        const gain =
            audioContext.createGain();


        oscillator.type = 'sine';


        // Primer tono
        oscillator.frequency.setValueAtTime(
            660,
            audioContext.currentTime
        );


        // Segundo tono
        oscillator.frequency.setValueAtTime(
            880,
            audioContext.currentTime + 0.12
        );


        gain.gain.setValueAtTime(
            0.0001,
            audioContext.currentTime
        );


        gain.gain.exponentialRampToValueAtTime(
            0.05,
            audioContext.currentTime + 0.02
        );


        gain.gain.exponentialRampToValueAtTime(
            0.0001,
            audioContext.currentTime + 0.35
        );


        oscillator.connect(gain);

        gain.connect(
            audioContext.destination
        );


        oscillator.start();

        oscillator.stop(
            audioContext.currentTime + 0.35
        );

    }
    catch (e) {

        console.log(
            'No se pudo reproducir el sonido de invitación',
            e
        );

    }
}
    function cerrarInvitacionToast() {

    document.getElementById(
        "invitacionToast"
    ).classList.remove("active");

}
    /* ==========================================================
       ACEPTAR INVITACIÓN
       ========================================================== */

   /* ==========================================================
   ACEPTAR INVITACIÓN
   ========================================================== */
function mostrarToastColaborador(mensaje)
{
    let toast = document.getElementById('toast-colaborador');

    if (!toast) {

        toast = document.createElement('div');

        toast.id = 'toast-colaborador';

        document.body.appendChild(toast);
    }


    toast.innerHTML = `

        <div class="toast-colaborador-icono">
            <i class="fa-solid fa-user"></i>
        </div>

        <div class="toast-colaborador-contenido">

            <strong>
                ${escapeHtml(mensaje)}
            </strong>

            <div class="toast-escribiendo">

                <span></span>
                <span></span>
                <span></span>

            </div>

        </div>

    `;


    toast.className = 'toast-colaborador activo';


    // Sonido suave de alerta
    reproducirSonidoSuave();


    // Ocultar después de 2.5 segundos
    clearTimeout(window.toastColaboradorTimer);

    window.toastColaboradorTimer =
        setTimeout(function () {

            toast.classList.remove('activo');

        }, 2500);
}
function aceptarInvitacion() {

    const modal =
        document.getElementById("invitacionToast");

    if (modal) {
        modal.classList.remove("active");
    }

    const invitacion =
        invitacionesPendientes.find(
            i => i.estado === "pendiente"
        );

    if (!invitacion) return;

    invitacion.estado = "aceptada";

    const usuario =
        invitacion.usuario;

    colaboradores.push({
        id: usuario.id,
        nombre: usuario.nombre,
        usuario: usuario.usuario,
        avatar: usuario.avatar,
        rol: "Colaborador",
        estado: "online"
    });

    renderColaboradores();

    // Aviso inmediato
    mostrarToast(
        `${usuario.nombre} aceptó la invitación`,
        "success"
    );

    reproducirSonidoAceptacion();


    /*
     * SIMULACIÓN:
     * después de unos segundos el colaborador
     * agrega automáticamente un bien.
     */
    setTimeout(function () {

        mostrarToastColaborador(
            `${usuario.nombre} está agregando un bien`
        );

        setTimeout(function () {

            agregarBienSimulado(
                usuario.id,
                "BIEN-00482",
                "Computadora portátil Lenovo",
                [
                    "https://commons.wikimedia.org/wiki/Special:Redirect/file/Lenovo_laptop_2025.jpg",
                    "https://commons.wikimedia.org/wiki/Special:Redirect/file/Lenovo_laptop_2019.jpg",
                    "https://commons.wikimedia.org/wiki/Special:Redirect/file/Lenovo_laptop_yat.jpg"
                ],
                "Oficina de Patrimonio",
                "Administración"
            );

        }, 2500);

    }, 9000);
}


/* ==========================================================
   RECHAZAR INVITACIÓN
   ========================================================== */
function reproducirSonidoAceptacion()
{
    try {

        const audioContext =
            new (
                window.AudioContext ||
                window.webkitAudioContext
            )();

        const oscillator =
            audioContext.createOscillator();

        const gain =
            audioContext.createGain();


        oscillator.type = 'sine';


        // Sonido ascendente suave
        oscillator.frequency.setValueAtTime(
            520,
            audioContext.currentTime
        );

        oscillator.frequency.setValueAtTime(
            780,
            audioContext.currentTime + 0.12
        );


        gain.gain.setValueAtTime(
            0.0001,
            audioContext.currentTime
        );

        gain.gain.exponentialRampToValueAtTime(
            0.045,
            audioContext.currentTime + 0.02
        );

        gain.gain.exponentialRampToValueAtTime(
            0.0001,
            audioContext.currentTime + 0.30
        );


        oscillator.connect(gain);
        gain.connect(audioContext.destination);


        oscillator.start();

        oscillator.stop(
            audioContext.currentTime + 0.30
        );

    }
    catch (e) {

        console.log(
            'No se pudo reproducir el sonido de aceptación',
            e
        );

    }
}
function rechazarInvitacion() {

    const modal = document.getElementById("invitacionToast");

    if (modal) {
        modal.classList.remove("active");
    }

    const invitacion =
        invitacionesPendientes.find(
            i => i.estado === "pendiente"
        );

    if (!invitacion) return;

    invitacion.estado = "rechazada";

    mostrarToast(
        `${invitacion.usuario.nombre} rechazó la invitación`,
        "warning"
    );
}
    /* ==========================================================
       RENDER COLABORADORES
       ========================================================== */

    function renderColaboradores() {

        const contenedor =
            document.getElementById(
                "listaColaboradores"
            );


        contenedor.innerHTML = "";


        colaboradores.forEach(usuario => {

            const item =
                document.createElement("div");

            item.className =
                "colaborador-item";


            item.innerHTML = `

                <div class="colaborador-avatar">
                    ${usuario.avatar}
                </div>


                <div class="colaborador-info">

                    <strong>
                        ${usuario.nombre}
                    </strong>

                    <span>

                        <i class="fa-solid fa-circle
                            estado-online">
                        </i>

                        ${
                            usuario.rol === "Creador"
                            ? "Creador del relevamiento"
                            : "Relevando bienes"
                        }

                    </span>

                </div>


                <div class="colaborador-estado">

                    ${
                        usuario.rol === "Creador"
                        ? "Creador"
                        : "Activo"
                    }

                </div>

            `;


            contenedor.appendChild(item);

        });


        document
            .getElementById(
                "cantidadColaboradores"
            )
            .textContent =
                colaboradores.length;

    }


    /* ==========================================================
       AGREGAR BIEN SIMULADO
       ========================================================== */

    

    /* ==========================================================
       RENDER BIENES
       ========================================================== */

    

    /* ==========================================================
       TOAST
       ========================================================== */

    function mostrarToast(
        mensaje,
        tipo = "success"
    ) {

        const toast =
            document.createElement("div");

        toast.className =
            `rp-toast rp-toast-${tipo}`;


        toast.innerHTML = `

            <div class="rp-toast-icon">

                ${
                    tipo === "success"
                    ?
                    '<i class="fa-solid fa-check"></i>'
                    :
                    '<i class="fa-solid fa-circle-exclamation"></i>'
                }

            </div>

            <div>
                ${mensaje}
            </div>

        `;


        document.body.appendChild(toast);


        setTimeout(() => {

            toast.classList.add("show");

        }, 20);


        setTimeout(() => {

            toast.classList.remove("show");

            setTimeout(() => {

                toast.remove();

            }, 300);

        }, 3500);

    }


    /* ==========================================================
       SIMULACIÓN AUTOMÁTICA DE OTRO USUARIO
       ========================================================== */

    function simularBienMaria() {

        const maria =
            colaboradores.find(
                u => u.id === 3
            );


        if (!maria) {

            mostrarToast(
                "María todavía no aceptó la invitación",
                "warning"
            );

            return;

        }


        agregarBienSimulado(
            3,
            "000456",
            "Notebook Lenovo"
        );

    }


    function simularBienJuan() {

        const juan =
            colaboradores.find(
                u => u.id === 2
            );


        if (!juan) {

            mostrarToast(
                "Juan todavía no aceptó la invitación",
                "warning"
            );

            return;

        }


        agregarBienSimulado(
            2,
            "000789",
            "Silla giratoria"
        );

    }
/* ==========================================================
   AGREGAR BIEN SIMULADO A BIENES REGISTRADOS
   ========================================================== */

  
    /*  FIN CODIGO SIMULACION */
</script>

<script>
window.bienesRegistradosSimulados = window.bienesRegistradosSimulados || [];
function agregarBienSimulado(
    usuarioId,
    matricula,
    bienRelevado,
    fotos = [],
    lugar = "Sin especificar",
    sector = "Sin especificar"
) {

    const usuario = colaboradores.find(
        u => u.id === usuarioId
    );

    if (!usuario) {
        console.log("El usuario no está colaborando");
        return;
    }

    const lista = document.getElementById('lista-bienes');

    if (!lista) {
        console.error('❌ No existe #lista-bienes');
        return;
    }


    /* ======================================================
       ELIMINAR ESTADO VACÍO
    ====================================================== */

    const estadoVacio = lista.querySelector(
        '.lista-bienes-vacia, .lista-vacia, .bienes-vacios, .sin-bienes, .empty-state'
    );

    if (estadoVacio) {
        estadoVacio.remove();
    }


    /* ======================================================
       CREAR EL OBJETO DEL BIEN
    ====================================================== */

    const bien = {

        matricula: matricula,

        bien_relevado: bienRelevado,

        persona_cargo: usuario.nombre,

        lugar_pertenece: lugar,
        sector: sector,
        estado_bien: "Regular",

        fotos: Array.isArray(fotos) ? fotos : [],

        agregado_por: usuario.nombre,

        usuario_id: usuarioId

    };


    /*
     * Guardamos los bienes simulados en un array separado
     * para no mezclarlos con bienesRelevados.
     */

    if (typeof bienesRelevados === 'undefined') {
        window.bienesRelevados = [];
    }

    bienesRelevados.push(bien);


    const index =
        bienesRelevados.length - 1;


    /* ======================================================
       FOTOS
    ====================================================== */

    const fotosBien =
        bien.fotos || [];


    let previewFotos = '';


    if (fotosBien.length > 0) {

        previewFotos = `
            <div class="bien-fotos-preview">

                ${fotosBien.map(function (foto, fotoIndex) {

                    return `
                        <img
                            src="${foto}"
                            class="bien-foto-miniatura"
                            alt="Foto ${fotoIndex + 1}"
                            title="Foto ${fotoIndex + 1} de ${fotosBien.length}"
                            onclick="abrirGaleriaBienSimulado(${index}, ${fotoIndex})"
                        >
                    `;

                }).join('')}

            </div>
        `;

    }


    /* ======================================================
       CREAR ITEM
    ====================================================== */

    const item =
        document.createElement('div');


    item.className = 'bien-item bien-nuevo-colaborador';


    item.innerHTML = `

        <div class="bien-item-icon">

            <i class="fa-solid fa-box"></i>

        </div>


        <div class="bien-item-info">

            <div class="bien-titulo">

    <strong>
        Matrícula:
        ${escapeHtml(bien.matricula)}
    </strong>

    <span class="bien-relevado-por">

        <i class="fa-solid fa-user"></i>

        Rel.:
        ${escapeHtml(bien.agregado_por || 'Sin especificar')}

        <span class="bien-rol">
            ${escapeHtml(
                bien.rol_relevamiento || 'Colaborador'
            )}
        </span>

    </span>


    <span
        class="bien-fotos"
        title="Cantidad de fotos del bien"
    >

        <i class="fa-solid fa-camera"></i>

        ${fotosBien.length}

    </span>

</div>

            <span>

                <b>Bien relevado:</b>

                ${escapeHtml(
                    bien.bien_relevado || 'Sin especificar'
                )}

            </span>


            <span>

                <b>Persona:</b>

                ${escapeHtml(
                    bien.persona_cargo || 'Sin especificar'
                )}

            </span>


            <span>

                <b>Lugar:</b>

                ${escapeHtml(
                    bien.lugar_pertenece || 'Sin especificar'
                )}

            </span>
            <span>

                <b>Sector:</b>

                ${escapeHtml(
                    bien.sector || 'Sin especificar'
                )}

            </span>

            <span class="bien-estado">

                Estado:

                ${escapeHtml(
                    bien.estado_bien || 'Regular'
                )}

            </span>


           <div class="bien-agregado-por">
                <strong>${escapeHtml(usuario.nombre)}</strong>
                <span>agregó este bien</span>
            </div>


        </div>


        <button
            type="button"
            class="btn-ver-relevamiento"
            onclick="verBienSimulado(${index})"
            title="Ver información completa"
        >

            <i class="fa-solid fa-eye"></i>

        </button>
        <!-- ELIMINAR -->

        <button
            type="button"
            class="btn-eliminar-bien"
            onclick="eliminarBienSimulado(${index})"
            title="Eliminar bien"
        >
            <i class="fa-solid fa-trash"></i>
        </button>

        <!-- FOTOS ABAJO DE TODO -->

        ${previewFotos}

    `;


    lista.appendChild(item);
    

    const contador2 =
        document.getElementById('cantidad-bienes');

    if (contador2) {

        const cantidad2 =
            lista.querySelectorAll('.bien-item').length;

        contador2.textContent = cantidad2;

    }
    setTimeout(function () {

        // Titila 3 veces
        item.classList.add('bien-item-resaltado');

        // Cuando termina el titileo
        setTimeout(function () {

            item.classList.remove('bien-item-resaltado');

            // Queda resaltado un rato
            item.classList.add('bien-item-destacado');

            // Después vuelve a la normalidad
            setTimeout(function () {

                item.classList.remove('bien-item-destacado');

            }, 5000);

        }, 1800);

    }, 50);

    /* ======================================================
       ACTUALIZAR CONTADOR
    ====================================================== */

    const contador =
        document.getElementById(
            'cantidad-bienes-registrados'
        );


    if (contador) {

        const cantidadActual =
            lista.querySelectorAll('.bien-item').length;

        contador.textContent =
            cantidadActual;

    }


    /* ======================================================
       RESALTAR NUEVO BIEN
    ====================================================== */

    setTimeout(function () {

        item.classList.remove(
            'bien-nuevo-colaborador'
        );

    }, 4500);


    
    /* ======================================================
       AVISO
    ====================================================== */

    mostrarToastBienAgregado(
        `${usuario.nombre} agregó un bien`
    );

}
   function mostrarToastBienAgregado(mensaje)
{
    let toast = document.getElementById(
        'toast-bien-agregado'
    );

    if (!toast) {

        toast = document.createElement('div');

        toast.id = 'toast-bien-agregado';

        document.body.appendChild(toast);
    }


    toast.innerHTML = `

        <div class="toast-bien-agregado-icono">
            <i class="fa-solid fa-check"></i>
        </div>

        <div class="toast-bien-agregado-texto">

            <strong>
                ${escapeHtml(mensaje)}
            </strong>

        </div>

    `;


    toast.className =
        'toast-bien-agregado activo';


    // 🔔 Sonido suave
    reproducirSonidoBienAgregado();


    clearTimeout(
        window.toastBienAgregadoTimer
    );


    window.toastBienAgregadoTimer =
        setTimeout(function () {

            toast.classList.remove('activo');

        }, 3500);
}


    let swiperFotosBien = null;


function abrirGaleriaBien(bienIndex, fotoIndex)
{

    const bien =
        bienesRelevados[bienIndex];

    if (!bien) return;


    const fotos =
        bien.fotos || [];

    if (fotos.length === 0) return;


    const visor =
        document.getElementById('visor-fotos-bien');

    const wrapper =
        document.getElementById('swiper-wrapper-fotos-bien');


    /*
     * Crear slides
     */
    wrapper.innerHTML = fotos.map(function (foto) {

        return `
            <div class="swiper-slide">

                <img
                    src="${foto}"
                    alt="Foto del bien"
                >

            </div>
        `;

    }).join('');


    /*
     * Mostrar visor
     */
    visor.classList.add('activo');


    /*
     * Destruir Swiper anterior
     */
    if (swiperFotosBien) {

        swiperFotosBien.destroy(
            true,
            true
        );

        swiperFotosBien = null;
    }


    /*
     * Crear Swiper
     */
    swiperFotosBien = new Swiper(
        '.swiper-fotos-bien',
        {
            initialSlide: fotoIndex,

            slidesPerView: 1,

            spaceBetween: 0,

            centeredSlides: true,

            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev'
            },

            pagination: {
                el: '.swiper-pagination',
                clickable: true
            },

            keyboard: {
                enabled: true
            },

            zoom: true,

            on: {

                init: function () {

                    console.log(
                        'Galería iniciada',
                        this.activeIndex
                    );

                }

            }

        }
    );

}
function cerrarGaleriaBien()
{  console.log("en cerrarGaleriaBien()");

    const visor =
        document.getElementById('visor-fotos-bien');

    visor.classList.remove('activo');

    if (swiperFotosBien) {

        swiperFotosBien.destroy(
            true,
            true
        );

        swiperFotosBien = null;
    }

}

let swiperFotos = null;
let fotosZoom = [];
let indiceFotoZoom = 0;
    function verRelevamiento(index) {

    const bien = bienesRelevados[index];

    if (!bien) {
        return;
    }

    console.log('RELEVAMIENTO:', bien);

    /*
     * ==========================================
     * FOTOGRAFÍAS
     * ==========================================
     */

    let fotosHtml = '';

    if (bien.fotos && bien.fotos.length > 0) {

        fotosHtml = `
            <div class="detalle-fotos">

                <div class="detalle-fotos-titulo">
                    <i class="fa-solid fa-camera"></i>
                    Fotografías
                </div>

                <div class="detalle-fotos-grid">
        `;

        bien.fotos.forEach(function (foto) {

            fotosHtml += `
                <div class="detalle-foto">
                    <img
                        src="${foto}"
                        alt="Fotografía del bien"
                    >
                </div>
            `;

        });

        fotosHtml += `
                </div>

            </div>
        `;

    } else {

        fotosHtml = `
            <div class="detalle-sin-fotos">
                <i class="fa-solid fa-camera-slash"></i>
                No se registraron fotografías.
            </div>
        `;
    }


    /*
     * ==========================================
     * DETALLE
     * ==========================================
     */

    let html = `
        <div class="detalle-relevamiento">

            <div class="detalle-relevamiento-header">

                <i class="fa-solid fa-clipboard-list"></i>

                <div>

                    <h3>
                        Detalle del relevamiento
                    </h3>

                    <span>
                        Información cargada
                    </span>

                </div>

            </div>


            <div class="detalle-relevamiento-grid">


                <div class="detalle-item">

                    <span>
                        Matrícula
                    </span>

                    <strong>
                        ${escapeHtml(
                            bien.matricula || '-'
                        )}
                    </strong>

                </div>


                <div class="detalle-item">

                    <span>
                        Persona a cargo
                    </span>

                    <strong>
                        ${escapeHtml(
                            bien.persona_cargo || '-'
                        )}
                    </strong>

                </div>


                <div class="detalle-item">

                    <span>
                        Lugar al que pertenece
                    </span>

                    <strong>
                        ${escapeHtml(
                            bien.lugar_pertenece || '-'
                        )}
                    </strong>

                </div>
                <div class="detalle-item">

                    <span>
                        Sector
                    </span>

                    <strong>
                        ${escapeHtml(
                            bien.sector || '-'
                        )}
                    </strong>

                </div>

                <div class="detalle-item">

                    <span>
                        Estado del bien
                    </span>

                    <strong>
                        ${escapeHtml(
                            bien.estado_bien || '-'
                        )}
                    </strong>

                </div>


            </div>


            ${fotosHtml}


        </div>
    `;


    mostrarModalRelevamiento(html);
}

function efectoFlashFoto() {

    const flash = document.getElementById('flash-foto');

    if (!flash) {
        return;
    }

    flash.classList.remove('activo');

    // Permite volver a ejecutar la animación
    void flash.offsetWidth;

    flash.classList.add('activo');
}
function mostrarModalRelevamiento(html) {

    const modal = document.getElementById('modal-ver-relevamiento');
    const contenido = document.getElementById('contenido-ver-relevamiento');

    if (!modal || !contenido) {
        return;
    }

    contenido.innerHTML = html;

    modal.classList.add('activo');
}


function cerrarModalRelevamiento() {

    const modal = document.getElementById('modal-ver-relevamiento');

    if (!modal) {
        return;
    }

    modal.classList.remove('activo');
}


document.addEventListener('DOMContentLoaded', function () {

    const botonCerrar =
        document.getElementById('cerrar-modal-ver-relevamiento');

    if (botonCerrar) {

        botonCerrar.addEventListener('click', function (e) {

            e.preventDefault();
            e.stopPropagation();

            cerrarModalRelevamiento();
        });
    }

});
function sonidoCamara() {

    const AudioContext =
        window.AudioContext ||
        window.webkitAudioContext;

    if (!AudioContext) {
        return;
    }

    const audioContext = new AudioContext();

    const ahora = audioContext.currentTime;

    /*
     * Crear ruido mecánico
     */
    function crearRuido(duracion, volumen, frecuenciaInicio, frecuenciaFin, inicio) {

        const bufferSize =
            audioContext.sampleRate * duracion;

        const buffer =
            audioContext.createBuffer(
                1,
                bufferSize,
                audioContext.sampleRate
            );

        const datos =
            buffer.getChannelData(0);

        for (let i = 0; i < bufferSize; i++) {

            datos[i] =
                Math.random() * 2 - 1;
        }

        const fuente =
            audioContext.createBufferSource();

        fuente.buffer = buffer;

        /*
         * Filtro para darle un sonido más
         * parecido a una pieza mecánica.
         */
        const filtro =
            audioContext.createBiquadFilter();

        filtro.type = 'bandpass';

        filtro.frequency.setValueAtTime(
            frecuenciaInicio,
            inicio
        );

        filtro.frequency.exponentialRampToValueAtTime(
            frecuenciaFin,
            inicio + duracion
        );

        filtro.Q.value = 1.2;

        /*
         * Volumen
         */
        const gain =
            audioContext.createGain();

        gain.gain.setValueAtTime(
            0.001,
            inicio
        );

        gain.gain.exponentialRampToValueAtTime(
            volumen,
            inicio + 0.005
        );

        gain.gain.exponentialRampToValueAtTime(
            0.001,
            inicio + duracion
        );

        fuente
            .connect(filtro)
            .connect(gain)
            .connect(audioContext.destination);

        fuente.start(inicio);

        fuente.stop(
            inicio + duracion
        );
    }


    /*
     * PRIMER GOLPE
     * Apertura de la cortina
     */
    crearRuido(
        0.055,
        0.45,
        2800,
        900,
        ahora
    );


    /*
     * SEGUNDO GOLPE
     * Cierre de la cortina
     */
    crearRuido(
        0.070,
        0.35,
        2200,
        650,
        ahora + 0.075
    );


    /*
     * Pequeño golpe grave del mecanismo
     */
    crearRuido(
        0.035,
        0.15,
        700,
        300,
        ahora + 0.145
    );


    /*
     * Cerrar AudioContext
     */
    setTimeout(function () {

        audioContext.close();

    }, 300);
}
   
function obtenerDireccion(lat, lon) {

    const direccion =
        document.getElementById('location-address');

    direccion.textContent = 'Buscando dirección...';

    fetch(
        'https://nominatim.openstreetmap.org/reverse?' +
        'format=json' +
        '&lat=' + encodeURIComponent(lat) +
        '&lon=' + encodeURIComponent(lon) +
        '&zoom=18' +
        '&addressdetails=1' +
        '&accept-language=es'
    )
    .then(response => response.json())
    .then(data => {

        if (data && data.display_name) {

            direccion.textContent =
                data.display_name;

        } else {

            direccion.textContent =
                'Dirección no disponible';

        }

    })
    .catch(error => {

        console.error(
            'Error obteniendo dirección:',
            error
        );

        direccion.textContent =
            'No se pudo obtener la dirección';

    });
}

$('#btn-buscar-bien').on('click', function () {
    $('#contenedor-fotografias').empty();
    const matricula = $('#matricula-busqueda').val().trim();

    if (!matricula) {
        return;
    }

    const $resultado = $('#resultado-sicopro');
    
    // Ocultar resultado anterior
    $resultado.hide().removeClass('encontrado no-encontrado');

    $.ajax({
        url: '<?= \yii\helpers\Url::to(['patrimonial/buscar']) ?>',
        type: 'POST',
        dataType: 'json',
        data: {
            matricula: matricula
        },

        success: function (respuesta) {
            
            if (respuesta.ok) {
                
                $resultado
                    .html('<i class="fa-solid fa-circle-check"></i> Bien encontrado en SICOPRO')
                    .removeClass('no-encontrado')
                    .addClass('encontrado')
                    .fadeIn();

                // Acá podés cargar los datos encontrados
                console.log('Bien encontrado:', respuesta);

            } else {

                $resultado
                    .html('<i class="fa-solid fa-circle-exclamation"></i> No registrado en SICOPRO')
                    .removeClass('encontrado')
                    .addClass('no-encontrado')
                    .fadeIn();

            }
        },

        error: function () {

            $resultado
                .html('<i class="fa-solid fa-triangle-exclamation"></i> No se pudo consultar SICOPRO')
                .removeClass('encontrado')
                .addClass('no-encontrado')
                .fadeIn();
        }
    });
});


/* ============================================================
   CÁMARA FOTOGRÁFICA
============================================================ */

var streamCamaraFoto = null;

async function abrirCamaraFoto() {

    console.log('📷 ABRIENDO CÁMARA');

    const modal =
        document.getElementById('modal-camara-foto');

    const video =
        document.getElementById('video-camara-foto');

    const preparando =
        document.getElementById('preparando-camara');


    if (!modal) {

        console.error(
            '❌ No existe #modal-camara-foto'
        );

        mostrarToast(
            'No se encontró la ventana de cámara.',
            'error'
        );

        return;
    }


    if (!video) {

        console.error(
            '❌ No existe #video-camara-foto'
        );

        mostrarToast(
            'No se encontró el elemento de video.',
            'error'
        );

        return;
    }


    /*
     * Mostrar modal
     */
    modal.style.display = 'flex';


    /*
     * Mostrar "Preparando cámara..."
     */
    if (preparando) {
        preparando.style.display = 'flex';
    }


    try {

        console.log(
            '📷 Solicitando acceso a cámara...'
        );


        if (
            !navigator.mediaDevices ||
            !navigator.mediaDevices.getUserMedia
        ) {

            throw new Error(
                'getUserMedia no está disponible.'
            );
        }


        /*
         * Pedir cámara
         */
        const stream =
            await navigator.mediaDevices.getUserMedia({

                video: {

                    facingMode: {
                        ideal: 'environment'
                    },

                    width: {
                        ideal: 1280
                    },

                    height: {
                        ideal: 720
                    }
                },

                audio: false
            });


        /*
         * Guardar stream
         */
        streamCamaraFoto = stream;


        console.log(
            '✅ CÁMARA OBTENIDA'
        );

        console.log(stream);


        /*
         * Conectar cámara al video
         */
        video.srcObject = stream;

        video.muted = true;
        video.autoplay = true;
        video.playsInline = true;


        /*
         * Reproducir
         */
        await video.play();


        console.log(
            '✅ VIDEO DE CÁMARA REPRODUCIÉNDOSE'
        );


        /*
         * Cámara lista
         */
        if (preparando) {
            preparando.style.display = 'none';
        }


    } catch (error) {

        console.error(
            '❌ ERROR CÁMARA:',
            error
        );


        /*
         * Ocultar preparación
         */
        if (preparando) {
            preparando.style.display = 'none';
        }


        cerrarCamaraFoto();


        let mensaje =
            'No se pudo acceder a la cámara.';


        if (error.name === 'NotAllowedError') {

            mensaje =
                'El acceso a la cámara fue rechazado.\n\n' +
                'Permití el acceso a la cámara en el navegador.';


        } else if (error.name === 'NotFoundError') {

            mensaje =
                'No se encontró ninguna cámara.';


        } else if (error.name === 'NotReadableError') {

            mensaje =
                'La cámara está siendo utilizada por otra aplicación.';


        } else if (error.name === 'SecurityError') {

            mensaje =
                'El navegador bloqueó la cámara por seguridad.';


        } else {

            mensaje +=
                '\n\n' +
                error.name +
                ': ' +
                error.message;
        }


        mostrarToast(
            mensaje,
            'error'
        );
    }
}

/* ============================================================
   CAPTURAR FOTO
============================================================ */

function mostrarFotografias() {

    const preview =
        document.getElementById('contenedor-fotografias');

    if (!preview) {
        console.error('❌ No existe contenedor-fotografias');
        return;
    }

    preview.innerHTML = '';

    fotografiasBien.forEach(function (archivo, index) {

        const reader = new FileReader();

        reader.onload = function (e) {

            const div =
                document.createElement('div');

            div.className =
                'foto-miniatura';


            const img =
                document.createElement('img');

            img.src =
                e.target.result;

            img.alt =
                'Fotografía del bien';

            img.addEventListener('click', function () {

                verFotoZoom(img.src);

            });


            const boton =
                document.createElement('button');

            boton.type =
                'button';

            boton.className =
                'btn-eliminar-foto';

            boton.title =
                'Eliminar foto';

            boton.innerHTML =
                '<i class="fa-solid fa-xmark"></i>';

            boton.addEventListener('click', function (event) {

                event.stopPropagation();

                eliminarFoto(index);

            });


            div.appendChild(img);

            div.appendChild(boton);

            preview.appendChild(div);
        };

        reader.readAsDataURL(archivo);
    });
}



function verFotoZoom(imagen) {

    const visor = document.getElementById('visor-foto-zoom');
    const wrapper = document.getElementById('swiper-fotos-wrapper');

    if (!visor || !wrapper) {
        return;
    }

    // Obtener todas las fotos
    fotosZoom = [];

    document
        .querySelectorAll('#contenedor-fotografias img')
        .forEach(function (img) {

            if (img.src) {
                fotosZoom.push(img.src);
            }

        });

    console.log('FOTOS:', fotosZoom);

    // Buscar cuál fue la foto tocada
    let indiceInicial = fotosZoom.indexOf(imagen);

    if (indiceInicial < 0) {
        indiceInicial = 0;
    }

    // Limpiar slides anteriores
    wrapper.innerHTML = '';

    // Crear slides
    fotosZoom.forEach(function (foto) {

        const slide = document.createElement('div');

        slide.className = 'swiper-slide';

        slide.innerHTML = `
            <img
                src="${foto}"
                alt="Fotografía"
                draggable="false"
            >
        `;

        wrapper.appendChild(slide);

    });

    visor.classList.add('activo');

    // Destruir instancia anterior
    if (swiperFotos) {
        swiperFotos.destroy(true, true);
        swiperFotos = null;
    }

    // Crear Swiper
    swiperFotos = new Swiper('.swiper-fotos', {

        initialSlide: indiceInicial,

        slidesPerView: 1,

        spaceBetween: 0,

        loop: false,

        speed: 300,

        allowTouchMove: true,

        grabCursor: true,

        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev'
        },

        pagination: {
            el: '.swiper-pagination',
            clickable: true
        }

    });
}
function fotoAnterior() {

    if (
        !fotosZoom ||
        fotosZoom.length <= 1
    ) {
        return;
    }


    indiceFotoZoom--;


    if (indiceFotoZoom < 0) {

        indiceFotoZoom =
            fotosZoom.length - 1;

    }


    mostrarFotoZoomActual();

}
function fotoSiguiente() {

    if (
        !fotosZoom ||
        fotosZoom.length <= 1
    ) {
        return;
    }


    indiceFotoZoom++;


    if (
        indiceFotoZoom >= fotosZoom.length
    ) {

        indiceFotoZoom = 0;

    }


    mostrarFotoZoomActual();

}
function mostrarFotoZoomActual() {

    const imagenZoom =
        document.getElementById('imagen-foto-zoom');

    const contador =
        document.getElementById('visor-foto-contador');

    if (
        !imagenZoom ||
        !fotosZoom.length
    ) {
        return;
    }


    /*
     * Animación
     */

    imagenZoom.classList.remove(
        'cambiando'
    );


    void imagenZoom.offsetWidth;


    imagenZoom.src =
        fotosZoom[indiceFotoZoom];


    imagenZoom.classList.add(
        'cambiando'
    );


    /*
     * Contador
     */

    if (contador) {

        contador.textContent =
            (indiceFotoZoom + 1) +
            ' / ' +
            fotosZoom.length;

    }


    console.log(
        '📷 Mostrando:',
        indiceFotoZoom + 1,
        '/',
        fotosZoom.length
    );

}
let inicioTouchX = 0;
let inicioTouchY = 0;
let movimientoTouchX = 0;

document.addEventListener('DOMContentLoaded', function () {

    const contenedor =
        document.getElementById('visor-foto-contenedor');

    if (!contenedor) {
        return;
    }


    /*
     * ==========================================
     * TOUCH START
     * ==========================================
     */

    contenedor.addEventListener('touchstart', function (e) {

        if (!e.touches || e.touches.length !== 1) {
            return;
        }

        inicioTouchX =
            e.touches[0].clientX;

        inicioTouchY =
            e.touches[0].clientY;

        movimientoTouchX = 0;

    }, {
        passive: true
    });


    /*
     * ==========================================
     * TOUCH MOVE
     * ==========================================
     */

    contenedor.addEventListener('touchmove', function (e) {

        if (!e.touches || e.touches.length !== 1) {
            return;
        }

        movimientoTouchX =
            e.touches[0].clientX - inicioTouchX;

    }, {
        passive: true
    });


    /*
     * ==========================================
     * TOUCH END
     * ==========================================
     */

    contenedor.addEventListener('touchend', function () {

        const diferenciaX =
            movimientoTouchX;

        const diferenciaY =
            0;

        console.log(
            'SWIPE:',
            diferenciaX
        );


        /*
         * Movimiento mínimo
         */

        if (
            Math.abs(diferenciaX) < 50
        ) {
            return;
        }


        /*
         * IZQUIERDA
         */

        if (diferenciaX < 0) {

            console.log(
                '➡️ SIGUIENTE FOTO'
            );

            fotoSiguiente();

        }


        /*
         * DERECHA
         */

        else {

            console.log(
                '⬅️ FOTO ANTERIOR'
            );

            fotoAnterior();

        }

    }, {
        passive: true
    });

});


function cerrarFotoZoom() { console.log("cerrarFotoZoom()");

    const visor = document.getElementById('visor-foto-zoom');

    if (!visor) {
        return;
    }

    visor.classList.remove('activo');

}

function eliminarFoto(indice) {

    console.log(
        '🗑️ Eliminando fotografía:',
        indice
    );

    window.fotografiasBien.splice(
        indice,
        1
    );

    console.log(
        '📷 Fotos restantes:',
        window.fotografiasBien.length
    );

    mostrarFotografias();

}
/* ============================================================
   CERRAR CÁMARA
============================================================ */
/*
function cerrarCamaraFoto() {

    console.log('📷 CERRANDO CÁMARA');

    if (streamCamaraFoto) {

        streamCamaraFoto
            .getTracks()
            .forEach(function (track) {
                track.stop();
            });

        streamCamaraFoto = null;
    }

    const video =
        document.getElementById('video-camara-foto');

    if (video) {

        video.pause();
        video.srcObject = null;
    }

    const modal =
        document.getElementById('modal-camara-foto');

    if (modal) {

        modal.style.display = 'none';
    }
}*/
function cerrarCamaraFoto() {

    console.log('🔥🔥🔥 CERRAR CAMARA EJECUTADO');

    const modal =
        document.getElementById('modal-camara-foto');

    console.log('MODAL:', modal);

    if (modal) {
        modal.style.display = 'none';
        console.log('✅ MODAL OCULTADO');
    }
}
function cerrarFotoCompleta() {

    const visor =
        document.getElementById('visor-foto');

    if (!visor) return;

    visor.classList.remove('activo');

    document.getElementById('imagen-visor-foto').src = '';

}
</script>
<style>
    .toast-bien-agregado {

    position: fixed;

    bottom: 25px;
    left: 50%;

    transform:
        translate(-50%, 30px);

    display: flex;
    align-items: center;

    gap: 12px;

    background: #ffffff;

    color: #333;

    padding: 12px 18px;

    border-radius: 14px;

    box-shadow:
        0 8px 30px rgba(0,0,0,.15);

    opacity: 0;

    pointer-events: none;

    transition:
        opacity .25s ease,
        transform .25s ease;

    z-index: 99999;
}


.toast-bien-agregado.activo {

    opacity: 1;

    transform:
        translate(-50%, 0);

}


.toast-bien-agregado-icono {

    width: 38px;
    height: 38px;

    border-radius: 50%;

    display: flex;

    align-items: center;
    justify-content: center;

    background: #e9f8ef;

    color: #20a05a;

    font-size: 17px;

}


.toast-bien-agregado-texto strong {

    font-size: 14px;

    font-weight: 600;

}

    .toast-colaborador {
    position: fixed;
    bottom: 25px;
    left: 50%;
    transform: translate(-50%, 30px);
    
    display: flex;
    align-items: center;
    gap: 12px;

    background: #ffffff;
    color: #333;

    padding: 12px 18px;

    border-radius: 14px;

    box-shadow:
        0 8px 30px rgba(0,0,0,.15);

    opacity: 0;

    pointer-events: none;

    transition:
        opacity .25s ease,
        transform .25s ease;

    z-index: 99999;
}


.toast-colaborador.activo {

    opacity: 1;

    transform:
        translate(-50%, 0);

}


.toast-colaborador-icono {

    width: 38px;
    height: 38px;

    border-radius: 50%;

    display: flex;
    align-items: center;
    justify-content: center;

    background: #eef2ff;
    color: #4f46e5;

    flex-shrink: 0;

}


.toast-colaborador-contenido {

    display: flex;
    align-items: center;
    gap: 10px;

}


.toast-colaborador-contenido strong {

    font-size: 14px;
    font-weight: 600;

    white-space: nowrap;

}


/* =========================================
   TRES PUNTITOS "ESCRIBIENDO"
========================================= */

.toast-escribiendo {

    display: flex;

    align-items: center;

    gap: 4px;

}


.toast-escribiendo span {

    width: 5px;
    height: 5px;

    background: #777;

    border-radius: 50%;

    animation:
        puntoEscribiendo 1.4s infinite ease-in-out;

}


.toast-escribiendo span:nth-child(1) {
    animation-delay: 0s;
}

.toast-escribiendo span:nth-child(2) {
    animation-delay: .2s;
}

.toast-escribiendo span:nth-child(3) {
    animation-delay: .4s;
}


@keyframes puntoEscribiendo {

    0%, 60%, 100% {

        opacity: .25;

        transform: translateY(0);

    }

    30% {

        opacity: 1;

        transform: translateY(-3px);

    }

}

.bien-titulo {
    display: flex;
    align-items: center;
    gap: 12px;
    flex-wrap: wrap;
    margin-bottom: 5px;
}

.bien-titulo strong {
    display: inline-flex;
    align-items: center;
    gap: 4px;
}

.bien-relevado-por {
    display: inline-flex;
    align-items: center;
    gap: 5px;
    font-size: 13px;
    font-weight: 500;
    color: #666;
    white-space: nowrap;
}

.bien-relevado-por i {
    font-size: 12px;
}

.bien-rol {
    padding: 2px 7px;
    border-radius: 10px;
    font-size: 11px;
    font-weight: 600;
    background: #eef2ff;
    color: #4f46e5;
    margin-left: 2px;
}

.bien-titulo .bien-fotos {
    display: inline-flex;
    align-items: center;
    gap: 4px;
    white-space: nowrap;
}
    .bien-item-resaltado {
    animation: bienTitilar 0.6s ease-in-out 3;
}

@keyframes bienTitilar {
    0%, 100% {
        background-color: transparent;
        box-shadow: none;
    }

    50% {
        background-color: #fff8d6;
        box-shadow: 0 0 0 3px rgba(255, 193, 7, 0.18);
    }
}

.bien-item-destacado {
    background-color: #fff8d6 !important;
    box-shadow: 0 0 0 2px rgba(255, 193, 7, 0.25);
    transition: background-color 0.5s ease,
                box-shadow 0.5s ease;
}



.bien-agregado-por {
    display: flex;
    align-items: center;
    gap: 5px;
    margin-top: 7px;
    font-size: 11px;
    color: #8a929d;
}

.bien-agregado-por strong {
    color: #4b5563;
    font-weight: 600;
}

.bien-agregado-por span {
    color: #8a929d;
}
   

    .bien-colaborativo-item.bien-nuevo {
    animation: destacarBienNuevo 4s ease;
}

@keyframes destacarBienNuevo {

    0% {
        background: #e8f7ee;
        transform: translateX(-8px);
        box-shadow: inset 4px 0 0 #42a66a;
    }

    20% {
        background: #dff3e7;
        transform: translateX(0);
        box-shadow: inset 4px 0 0 #42a66a;
    }

    70% {
        background: #e8f7ee;
        box-shadow: inset 4px 0 0 #42a66a;
    }

    100% {
        background: transparent;
        box-shadow: inset 0 0 0 transparent;
    }
}
    .leaflet-control-attribution {
    display: none !important;
}
.registro-bienes-header {
    display: flex;
    align-items: center;
    width: 100%;
    padding: 18px 20px;

    background: #f8fafc;
    border: 1px solid #e5e7eb;
    border-radius: 12px;

    box-sizing: border-box;
}

.registro-icon {
    width: 44px;
    height: 44px;
    min-width: 44px;

    display: flex;
    align-items: center;
    justify-content: center;

    margin-right: 14px;

    border-radius: 10px;

    background: #ffffff;
    border: 1px solid #e5e7eb;

    color: #374151;
}

.registro-icon i {
    font-size: 19px;
}

.registro-bienes-info {
    flex: 1;
    min-width: 0;
}

.registro-bienes-info h3 {
    margin: 0 0 4px;

    font-size: 17px;
    font-weight: 700;
    line-height: 1.25;

    color: #1f2937;
}

.registro-bienes-info p {
    margin: 0;

    font-size: 13px;
    line-height: 1.4;

    color: #6b7280;
}

/* =====================================================
   COMPARTIR TAREA EN VIVO
===================================================== */

.compartir-tarea-container {
    width: 100%;
    display: flex;
    justify-content: flex-end;
    margin-top: 12px;
    margin-bottom: 18px;
}

.btn-compartir-tarea {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 6px;

    padding: 7px 12px;

    border: 1px solid #d9dee7;
    border-radius: 8px;

    background: #ffffff;
    color: #374151;

    font-size: 12px;
    font-weight: 600;

    cursor: pointer;

    transition: all 0.2s ease;
}

.btn-compartir-tarea i {
    font-size: 12px;
}

.btn-compartir-tarea:hover {
    background: #f8fafc;
    border-color: #cbd5e1;
    box-shadow: 0 2px 7px rgba(0, 0, 0, 0.05);
}

.btn-compartir-tarea:active {
    transform: scale(0.98);
}

    .compartir-tarea-container {
    width: 100%;
    display: flex;
    justify-content: flex-end;
    margin: 8px 0 16px;
}

.btn-compartir-tarea {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 6px;

    padding: 7px 11px;

    border: 1px solid #d9dee7;
    border-radius: 8px;

    background: #ffffff;
    color: #374151;

    font-size: 12px;
    font-weight: 600;

    cursor: pointer;

    transition:
        background-color 0.2s ease,
        border-color 0.2s ease,
        box-shadow 0.2s ease,
        transform 0.2s ease;
}

.btn-compartir-tarea i {
    font-size: 12px;
}

.btn-compartir-tarea:hover {
    background: #f8fafc;
    border-color: #cbd5e1;
    box-shadow: 0 2px 7px rgba(0, 0, 0, 0.05);
}

.btn-compartir-tarea:active {
    transform: scale(0.98);
}
    .visor-fotos-bien {
    position: fixed;
    inset: 0;
    z-index: 99999;

    display: none;

    align-items: center;
    justify-content: center;

    background: rgba(0, 0, 0, .95);
}

.visor-fotos-bien.activo {
    display: flex;
}

.swiper-fotos-bien {
    width: 100%;
    height: 100%;
}

.swiper-fotos-bien .swiper-slide {
    display: flex;
    align-items: center;
    justify-content: center;
}

.swiper-fotos-bien .swiper-slide img {
    max-width: 95%;
    max-height: 90%;
    object-fit: contain;
}

.cerrar-visor-fotos {
    position: absolute;
    top: 20px;
    right: 20px;

    z-index: 100000;

    width: 45px;
    height: 45px;

    border: 0;
    border-radius: 50%;

    background: rgba(255,255,255,.15);

    color: white;
    font-size: 24px;

    cursor: pointer;
}

.cerrar-visor-fotos:hover {
    background: rgba(255,255,255,.3);
}
.visor-foto {
    position: fixed;
    inset: 0;
    z-index: 99999;

    display: none;
    align-items: center;
    justify-content: center;

    background: rgba(0, 0, 0, 0.92);
    padding: 20px;
}

.visor-foto.activo {
    display: flex;
}

#imagen-visor-foto {
    max-width: 95vw;
    max-height: 95vh;
    object-fit: contain;
    border-radius: 8px;
}

.cerrar-visor-foto {
    position: absolute;
    top: 20px;
    right: 20px;

    width: 45px;
    height: 45px;

    border: none;
    border-radius: 50%;

    background: rgba(255,255,255,.15);
    color: white;

    font-size: 24px;
    cursor: pointer;

    z-index: 2;
}

.cerrar-visor-foto:hover {
    background: rgba(255,255,255,.3);
}
    .bien-item {
    display: flex;
    flex-wrap: wrap;
}


.bien-fotos-preview {
    width: 100%;
    flex-basis: 100%;
    display: flex;
    flex-wrap: wrap;
    gap: 4px;
    margin-top: 8px;
    padding-top: 6px;
    border-top: 1px solid #eee;
    box-sizing: border-box;
}

.bien-foto-miniatura {
    width: 35px;
    height: 35px;
    object-fit: cover;
    border-radius: 4px;
    border: 1px solid #ddd;
    display: block;
}
.bien-foto-miniatura:hover {
    transform: scale(1.15);
}
.bien-item-info .bien-fotos {
    display: inline-flex !important;
    align-items: center;
   /* vertical-align: middle;*/
    margin-left: 8px;
    padding: 2px 6px;
    border-radius: 10px;
    background: #f1f3f5;
    color: #555;
    font-size: 11px;
    font-weight: normal;
    line-height: 1;
    gap: 3px;
}

.bien-item-info .bien-fotos i {
    font-size: 10px;
}



    .bien-fotos {
    display: inline-flex;
    align-items: center;
    gap: 3px;
    margin-left: 8px;
    padding: 2px 6px;
    border-radius: 10px;
    background: #f1f3f5;
    color: #555;
    font-size: 11px;
    font-weight: normal;
    /*vertical-align: middle;*/
}

.bien-fotos i {
    font-size: 10px;
}
    .preparando-camara {
    position: absolute;
    inset: 0;

    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;

    background: #000;
    color: white;

    z-index: 20;

    font-size: 18px;
    font-weight: 600;
    gap: 15px;
}

.spinner-camara {
    width: 42px;
    height: 42px;

    border: 4px solid rgba(255,255,255,0.3);
    border-top-color: white;

    border-radius: 50%;

    animation: girar-camara 0.8s linear infinite;
}

@keyframes girar-camara {
    to {
        transform: rotate(360deg);
    }
}
#visor-foto-zoom {
    position: fixed;
    inset: 0;
    background: rgba(0, 0, 0, 0.95);
    z-index: 99999;

    display: none;
    align-items: center;
    justify-content: center;
}

#visor-foto-zoom.activo {
    display: flex;
}

.swiper-fotos {
    width: 100%;
    height: 100%;
}

.swiper-fotos .swiper-slide {
    display: flex;
    align-items: center;
    justify-content: center;
}

.swiper-fotos .swiper-slide img {
    max-width: 95%;
    max-height: 90%;
    width: auto;
    height: auto;
    object-fit: contain;
    user-select: none;
    -webkit-user-drag: none;
}

.cerrar-foto-zoom {
    position: absolute;
    top: 20px;
    right: 20px;

    z-index: 100000;

    width: 45px;
    height: 45px;

    border: none;
    border-radius: 50%;

    background: rgba(0, 0, 0, 0.7);
    color: white;

    font-size: 22px;
}

.swiper-button-prev,
.swiper-button-next {
    color: white;
}

.swiper-pagination-bullet {
    background: white;
}
.detalle-fotos {
    margin-top: 20px;
}

.detalle-fotos-titulo {
    display: flex;
    align-items: center;
    gap: 8px;
    margin-bottom: 10px;
    font-size: 14px;
    font-weight: 700;
    color: #333;
}

.detalle-fotos-titulo i {
    color: #f28c28;
}

.detalle-fotos-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 10px;
}

.detalle-foto {
    aspect-ratio: 1 / 1;
    overflow: hidden;
    border-radius: 9px;
    border: 1px solid #ddd;
}

.detalle-foto img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    display: block;
}

.detalle-sin-fotos {
    margin-top: 20px;
    padding: 15px;
    background: #f8f9fa;
    border-radius: 9px;
    color: #888;
    font-size: 13px;
    text-align: center;
}

@media (max-width: 600px) {

    .detalle-fotos-grid {
        grid-template-columns: repeat(2, 1fr);
    }

}













.modal-ver-relevamiento {
    display: none;
    position: fixed;
    inset: 0;
    z-index: 9999;
    background: rgba(0, 0, 0, 0.45);
    align-items: center;
    justify-content: center;
}

.modal-ver-relevamiento.activo {
    display: flex;
}

.modal-ver-relevamiento-contenido {
    position: relative;
    width: min(700px, 92%);
    max-height: 85vh;
    overflow-y: auto;
    background: #fff;
    border-radius: 14px;
    padding: 24px;
}

.cerrar-modal-ver-relevamiento {
    position: absolute;
    top: 10px;
    right: 12px;
    border: none;
    background: transparent;
    color: #666;
    font-size: 22px;
    cursor: pointer;
}

.cerrar-modal-ver-relevamiento:hover {
    color: #dc3545;
}

.modal-detalle-relevamiento {
    display: none;
    position: fixed;
    inset: 0;
    background: rgba(0, 0, 0, 0.45);
    z-index: 9999;
    align-items: center;
    justify-content: center;
}

.modal-detalle-relevamiento.activo {
    display: flex;
}

.modal-detalle-contenido {
    position: relative;
    width: min(700px, 92%);
    max-height: 85vh;
    overflow-y: auto;
    background: #fff;
    border-radius: 14px;
    padding: 24px;
    box-shadow: 0 15px 40px rgba(0, 0, 0, 0.25);
}

.modal-detalle-cerrar {
    position: absolute;
    top: 12px;
    right: 14px;
    border: none;
    background: transparent;
    color: #6c757d;
    font-size: 22px;
    cursor: pointer;
}

.modal-detalle-cerrar:hover {
    color: #dc3545;
}

.detalle-relevamiento-header {
    display: flex;
    align-items: center;
    gap: 12px;
    margin-bottom: 22px;
    padding-right: 30px;
}

.detalle-relevamiento-header > i {
    font-size: 26px;
    color: #6f42c1;
}

.detalle-relevamiento-header h3 {
    margin: 0;
    font-size: 20px;
}

.detalle-relevamiento-header span {
    color: #6c757d;
    font-size: 13px;
}

.detalle-relevamiento-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 12px;
}

.detalle-item {
    background: #f8f9fa;
    border-radius: 8px;
    padding: 12px;
}

.detalle-item span {
    display: block;
    font-size: 12px;
    color: #6c757d;
    margin-bottom: 4px;
}

.detalle-item strong {
    font-size: 14px;
    color: #212529;
}

@media (max-width: 600px) {
    .detalle-relevamiento-grid {
        grid-template-columns: 1fr;
    }
}
.btn-ver-relevamiento,
.btn-eliminar-bien {
    padding: 4px;
    margin: 0 2px;
}
.btn-ver-relevamiento {
    background: transparent;
    border: none;
    outline: none;   
    color: #6f42c1;
    font-size: 18px;
    cursor: pointer;
    transition: all 0.2s ease;
}

.btn-ver-relevamiento:hover {
    color: #59339d;
    transform: scale(1.15);
}

.btn-ver-relevamiento:focus {
    outline: none;
    box-shadow: none;
}
   

.visor-foto-zoom {

    position: fixed;

    inset: 0;

    z-index: 999999;

    background: rgba(0, 0, 0, .92);

    display: flex;

    align-items: center;

    justify-content: center;

    opacity: 0;

    visibility: hidden;

    transition:
        opacity .2s ease;

}


.visor-foto-zoom.activo {

    opacity: 1;

    visibility: visible;

}


/*
 * CONTENEDOR DE LA FOTO
 */

.visor-foto-contenedor {

    width: 100%;

    height: 100%;

    display: flex;

    align-items: center;

    justify-content: center;

    overflow: hidden;

    touch-action: pan-y;

}


#imagen-foto-zoom {

    max-width: 90vw;

    max-height: 85vh;

    width: auto;

    height: auto;

    object-fit: contain;

    border-radius: 8px;

    user-select: none;

    -webkit-user-select: none;

    -webkit-touch-callout: none;

    pointer-events: none;

}


/*
 * ANIMACIÓN
 */

#imagen-foto-zoom.cambiando {

    animation:
        aparecerFoto .18s ease;

}


@keyframes aparecerFoto {

    from {

        opacity: .3;

        transform:
            scale(.96);

    }

    to {

        opacity: 1;

        transform:
            scale(1);

    }

}


/*
 * CERRAR
 */

.cerrar-foto-zoom {

    position: absolute;

    top: 18px;

    right: 20px;

    width: 44px;

    height: 44px;

    border: none;

    border-radius: 50%;

    background:
        rgba(0,0,0,.65);

    color: white;

    font-size: 23px;

    cursor: pointer;

    z-index: 20;

}


/*
 * ANTERIOR
 */

.visor-foto-anterior,
.visor-foto-siguiente {

    position: absolute;

    top: 50%;

    transform:
        translateY(-50%);

    width: 46px;

    height: 46px;

    border: none;

    border-radius: 50%;

    background:
        rgba(0,0,0,.55);

    color: white;

    font-size: 20px;

    cursor: pointer;

    z-index: 20;

}


.visor-foto-anterior {

    left: 15px;

}


.visor-foto-siguiente {

    right: 15px;

}


/*
 * CONTADOR
 */

.visor-foto-contador {

    position: absolute;

    bottom: 20px;

    left: 50%;

    transform:
        translateX(-50%);

    padding: 6px 12px;

    border-radius: 20px;

    background:
        rgba(0,0,0,.6);

    color: white;

    font-size: 13px;

    z-index: 20;

}


.cerrar-foto-zoom:hover {
    background: #dc3545;
}

.toast-custom {
    position: fixed;

    top: 20px;
    right: 20px;

    min-width: 300px;
    max-width: 420px;

    padding: 14px 16px;

    display: flex;
    align-items: center;
    gap: 12px;

    border-radius: 10px;

    color: white;
    font-size: 15px;

    box-shadow:
        0 6px 20px rgba(0, 0, 0, 0.25);

    z-index: 999999;

    opacity: 0;

    transform:
        translateX(30px);

    transition:
        opacity 0.25s ease,
        transform 0.25s ease;

    /* IMPORTANTE */
    pointer-events: none;
}

.toast-custom.mostrar {
    opacity: 1;

    transform:
        translateX(0);

    /* vuelve a permitir interacción */
    pointer-events: auto;
}


/* Error */

.toast-error {
    background: #dc3545;
}


/* Éxito */

.toast-success {
    background: #198754;
}


/* Advertencia */

.toast-warning {
    background: #f0ad4e;
}


.toast-icono {

    width: 28px;
    height: 28px;

    display: flex;

    align-items: center;
    justify-content: center;

    border-radius: 50%;

    background:
        rgba(255, 255, 255, 0.2);

    font-weight: bold;

    font-size: 17px;
}


.toast-texto {

    flex: 1;
}


.toast-cerrar {

    border: none;

    background: transparent;

    color: white;

    font-size: 24px;

    line-height: 1;

    cursor: pointer;

    opacity: 0.8;

    padding: 0;
}


.toast-cerrar:hover {

    opacity: 1;
}
   #contenedor-fotografias {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 10px;
    width: 100%;
}

.foto-miniatura {
    position: relative;
    width: 100%;
    aspect-ratio: 1 / 1;
}

.foto-miniatura img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    display: block;
    border-radius: 8px;
    cursor: zoom-in;
}

.btn-eliminar-foto {
    position: absolute;

    top: 5px;
    right: 5px;

    width: 26px;
    height: 26px;

    border: none;
    border-radius: 50%;

    background: rgba(0, 0, 0, 0.75);

    color: white;

    font-size: 17px;

    cursor: pointer;

    z-index: 10;

    display: flex;
    align-items: center;
    justify-content: center;
}

.btn-eliminar-foto:hover {
    background: #dc3545;
}


/* Destello de cámara */
.flash-foto {
    position: fixed;
    inset: 0;
    background: white;
    opacity: 0;
    pointer-events: none;
    z-index: 99999;
}

.flash-foto.activo {
    animation: flashCamara 120ms ease-out;
}

@keyframes flashCamara {
    0% {
        opacity: 0;
    }

    40% {
        opacity: 0.9;
    }

    100% {
        opacity: 0;
    }
}
.input-fotografia {
    position: absolute;
    width: 1px;
    height: 1px;
    opacity: 0;
    pointer-events: none;
}
.fotografias-botones {
    display: flex;
    align-items: center;
    gap: 8px;
}

.fotografias-botones .btn-fotografia {
    display: inline-flex !important;
    align-items: center !important;
    justify-content: center !important;
    height: 38px !important;
    padding: 0 14px !important;
    margin: 0 !important;
    box-sizing: border-box;
    line-height: 1 !important;
    gap: 6px;
}

.fotografias-botones .btn-fotografia i {
    display: inline-flex;
    align-items: center;
    justify-content: center;
}
.btn-fotografia {
    display: inline-flex !important;
    align-items: center !important;
    justify-content: center !important;
    gap: 6px;

    height: 38px;
    /*padding: 0 14px;*/

    border: 1px solid #ced4da;
    border-radius: 6px;

    background: #fff;
    color: #495057;

    font-size: 13px;
    font-weight: 500;

    cursor: pointer;
   
}

.btn-fotografia:hover {
    background: #f8f9fa;
}


/* =========================
   MODAL CÁMARA
========================= */

.modal-camara-foto {
    position: fixed;
    inset: 0;

    z-index: 99999;

    background: rgba(0, 0, 0, .75);

    display: flex;
    align-items: center;
    justify-content: center;

    padding: 15px;
}


.camara-foto-contenido {
    width: 100%;
    max-width: 500px;

    background: #fff;

    border-radius: 10px;

    overflow: hidden;
}


.camara-foto-header {
    height: 50px;

    padding: 0 15px;

    display: flex;
    align-items: center;
    justify-content: space-between;

    border-bottom: 1px solid #eee;
}


.btn-cerrar-camara {
    border: none;
    background: transparent;

    font-size: 20px;

    cursor: pointer;

    color: #555;
}


/* VIDEO */

.camara-video-container {
    width: 100%;

    background: #000;

    position: relative;
}


#video-camara-foto {
    display: block;

    width: 100%;

    max-height: 70vh;

    object-fit: cover;
}


/* BOTÓN CAPTURAR */

.camara-foto-controles {
    height: 80px;

    display: flex;

    align-items: center;
    justify-content: center;
}


.btn-capturar-foto {
    width: 58px;
    height: 58px;

    border-radius: 50%;

    border: 4px solid #ddd;

    background: #fff;

    color: #333;

    font-size: 20px;

    cursor: pointer;
}

/* PREVISUALIZACIÓN */

.bien-fotografias-preview {
    display: flex;
    flex-wrap: wrap;
    gap: 8px;
    margin-top: 10px;
}


.foto-preview {
    position: relative;

    width: 82px;
    height: 82px;

    border-radius: 6px;
    overflow: hidden;

    border: 1px solid #dee2e6;
}


.foto-preview img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}


.btn-eliminar-foto {
    position: absolute;
    top: 4px;
    right: 4px;

    width: 23px;
    height: 23px;

    padding: 0;

    border: none;
    border-radius: 50%;

    background: rgba(0,0,0,.65);
    color: white;

    display: flex;
    align-items: center;
    justify-content: center;

    cursor: pointer;
}

    .resultado-sicopro {
    margin-top: 8px;
    padding: 8px 12px;
    border-radius: 6px;
    font-size: 13px;
    font-weight: 600;
    display: inline-flex;
    align-items: center;
    gap: 7px;
}

.resultado-sicopro.encontrado {
    background: #e8f7ee;
    color: #198754;
    border: 1px solid #b7e4c7;
}

.resultado-sicopro.no-encontrado {
    background: #fff3cd;
    color: #856404;
    border: 1px solid #ffe69c;
}


    .botones-escanear {
    display: flex;
    gap: 10px;
    width: 100%;
}

.botones-escanear .btn-escanear-bien {
    flex: 1;
}
.btn-buscar-bien {
    width: 120px;
    min-width: 120px;
    padding: 8px 6px;
    font-size: 11px;
    white-space: nowrap;
}

.btn-buscar-bien i {
    font-size: 14px;
}

.texto-sicopro {
    font-size: 11px;
}
.location-address {
    margin-top: 5px;
    font-size: 12px;
    font-weight: 600;
    color: #555;
    line-height: 1.4;
}


.bien-campo {
    margin-bottom: 13px;
}

.bien-campo label {
    display: block;
    margin-bottom: 6px;
    font-size: 12px;
    font-weight: 700;
    color: #555;
}

.bien-campo select {
    appearance: auto;
    min-height: 48px;
}

.bien-encontrado {
    margin-top: 16px;
    padding: 15px;
    border-radius: 13px;
    background: #f8fff9;
    border: 1px solid #d9efdd;
}

.bien-encontrado-header {
    display: flex;
    align-items: center;
    gap: 7px;
    color: #198754;
    margin-bottom: 15px;
}

.bien-encontrado-header i {
    font-size: 18px;
}

.bien-item {
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 12px;
    margin-bottom: 8px;
    background: #fff;
    border: 1px solid #e5e5e5;
    border-radius: 11px;
}

.bien-item-icon {
    width: 38px;
    height: 38px;
    min-width: 38px;
    border-radius: 9px;
    background: #fff3e8;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #f28c28;
}

.bien-item-info {
    flex: 1;
    min-width: 0;
}

.bien-item-info strong {
    display: block;
    font-size: 13px;
    color: #333;
}

.bien-item-info span {
    display: block;
    margin-top: 3px;
    font-size: 11px;
    color: #888;
}

.bien-item-info .bien-estado {
    color: #198754;
    font-weight: 700;
}

.btn-eliminar-bien {
    border: 0;
    background: transparent;
    color: #dc3545;
    font-size: 16px;
    cursor: pointer;
    padding: 4px;
    margin: 0 2px;
}

.btn-eliminar-bien:hover {
    color: #a71d2a;
}



.registro-bienes {
    margin-top: 25px;
    padding-top: 22px;
    border-top: 2px solid #f1f1f1;
}

.registro-header {
    display: flex;
    align-items: center;
    gap: 12px;
    margin-bottom: 20px;
}

.registro-icon {
    width: 46px;
    height: 46px;
    border-radius: 13px;
    background: #fff3e8;
    color: #f28c28;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 20px;
}

.registro-header h3 {
    margin: 0;
    font-size: 17px;
    color: #222;
}

.registro-header p {
    margin: 3px 0 0;
    font-size: 12px;
    color: #888;
}

.busqueda-row {
    display: flex;
    gap: 8px;
}

.busqueda-row input {
    flex: 1;
}

.btn-buscar-bien {
    width: 50px;
    border: 0;
    border-radius: 12px;
    background: #f28c28;
    color: #fff;
    font-size: 17px;
}

.btn-escanear-bien {
    width: 100%;
    height: 45px;
    margin-top: 10px;
    border: 1px solid #ddd;
    border-radius: 11px;
    background: #fff;
    color: #444;
    font-weight: 700;
}

.btn-escanear-bien i {
    color: #f28c28;
    margin-right: 6px;
}

.bien-encontrado {
    margin-top: 16px;
    padding: 15px;
    border-radius: 13px;
    background: #f8fff9;
    border: 1px solid #d9efdd;
}

.bien-encontrado-header {
    display: flex;
    align-items: center;
    gap: 7px;
    color: #198754;
    margin-bottom: 10px;
}

.bien-encontrado-header i {
    font-size: 18px;
}

.btn-agregar-bien {
    width: 100%;
    height: 44px;
    margin-top: 12px;
    border: 0;
    border-radius: 11px;
    background: #198754;
    color: #fff;
    font-weight: 700;
}

.bienes-registrados {
    margin-top: 22px;
}

.bienes-title {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 10px;
}

.bienes-title strong {
    font-size: 14px;
    color: #333;
}

.bienes-title span {
    min-width: 28px;
    height: 28px;
    padding: 0 8px;
    border-radius: 14px;
    background: #fff3e8;
    color: #f28c28;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 12px;
    font-weight: 700;
}

.lista-vacia {
    padding: 25px 10px;
    text-align: center;
    color: #999;
    font-size: 12px;
}

.lista-vacia i {
    display: block;
    font-size: 25px;
    margin-bottom: 8px;
}

.bien-item {
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 12px;
    margin-bottom: 8px;
    background: #fff;
    border: 1px solid #e5e5e5;
    border-radius: 11px;
}

.bien-item-icon {
    width: 36px;
    height: 36px;
    border-radius: 9px;
    background: #f5f5f5;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #f28c28;
}

.bien-item-info {
    flex: 1;
}

.bien-item-info strong {
    display: block;
    font-size: 13px;
    color: #333;
}

.bien-item-info span {
    display: block;
    margin-top: 2px;
    font-size: 11px;
    color: #888;
}

.btn-eliminar-bien {
    border: 0;
    background: transparent;
    color: #dc3545;
    font-size: 16px;
}

.finalizar-relevamiento {
    margin-top: 22px;
}

.btn-finalizar-relevamiento {
    width: 100%;
    height: 52px;
    border: 0;
    border-radius: 13px;
    background: #198754;
    color: #fff;
    font-size: 15px;
    font-weight: 700;
    box-shadow: 0 5px 12px rgba(25,135,84,.18);
}
    .btn-location {
    width: 100%;
    height: 46px;
    margin-top: 10px;
    border: 1px solid #f28c28;
    border-radius: 11px;
    background: #fff;
    color: #f28c28;
    font-size: 14px;
    font-weight: 700;
    cursor: pointer;
}

.btn-location i {
    margin-right: 6px;
}

.btn-location:active {
    transform: scale(.98);
}

.btn-location.loading {
    opacity: .7;
    pointer-events: none;
}

.btn-location.success {
    background: #f28c28;
    color: #fff;
}
#mapa-relevamiento {
    width: 100%;
    height: 260px;
    margin-top: 10px;
    border-radius: 14px;
    overflow: hidden;
    border: 1px solid #ddd;
    box-shadow: 0 2px 8px rgba(0,0,0,.08);
}
.relevamiento-form {
    max-width: 520px;
    margin: 0 auto;
    padding: 18px 16px 30px;
}

.relevamiento-header {
    display: flex;
    align-items: center;
    gap: 14px;
    margin-bottom: 24px;
}

.relevamiento-icon {
    width: 52px;
    height: 52px;
    min-width: 52px;
    border-radius: 15px;
    background: #fff3e8;
    color: #f28c28;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 23px;
}

.relevamiento-header h2 {
    margin: 0;
    font-size: 22px;
    font-weight: 700;
    color: #222;
}

.relevamiento-header p {
    margin: 4px 0 0;
    font-size: 13px;
    color: #777;
}

.form-section {
    margin-bottom: 20px;
}

.form-label-custom {
    display: flex;
    align-items: center;
    gap: 8px;
    margin-bottom: 8px;
    font-size: 14px;
    font-weight: 700;
    color: #333;
}

.form-label-custom i {
    color: #f28c28;
}

.form-label-custom small {
    margin-left: auto;
    font-size: 11px;
    color: #999;
    font-weight: 500;
}

.form-group-custom {
    margin-bottom: 0;
}

.form-control-custom {
    width: 100%;
    min-height: 48px;
    padding: 12px 14px;
    border: 1px solid #ddd;
    border-radius: 12px;
    background: #fff;
    font-size: 14px;
    color: #333;
    box-sizing: border-box;
    outline: none;
}

.form-control-custom:focus {
    border-color: #f28c28;
    box-shadow: 0 0 0 3px rgba(242, 140, 40, .10);
}

.textarea-custom {
    min-height: 100px;
    resize: vertical;
}

.location-box {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 13px;
    border-radius: 12px;
    background: #f7f7f7;
    border: 1px solid #e5e5e5;
}

.location-icon {
    width: 42px;
    height: 42px;
    border-radius: 11px;
    background: #fff;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #f28c28;
    font-size: 19px;
}

.location-info {
    display: flex;
    flex-direction: column;
    gap: 3px;
}

.location-info strong {
    font-size: 13px;
    color: #333;
}

.location-info span {
    font-size: 11px;
    color: #888;
}

.relevamiento-info {
    display: flex;
    gap: 11px;
    padding: 14px;
    border-radius: 12px;
    background: #f8f9fa;
    margin-top: 8px;
}

.info-icon {
    color: #6c757d;
    font-size: 18px;
}

.relevamiento-info div:last-child {
    display: flex;
    flex-direction: column;
    gap: 4px;
}

.relevamiento-info strong {
    font-size: 13px;
    color: #333;
}

.relevamiento-info span {
    font-size: 12px;
    line-height: 1.45;
    color: #777;
}

.relevamiento-actions {
    margin-top: 22px;
}

.btn-start-relevamiento {
    width: 100%;
    height: 52px;
    border: 0;
    border-radius: 13px;
    background: #f28c28;
    color: #fff;
    font-size: 15px;
    font-weight: 700;
    cursor: pointer;
    box-shadow: 0 5px 12px rgba(242, 140, 40, .20);
}

.btn-start-relevamiento i {
    margin-right: 7px;
}

.btn-start-relevamiento:active {
    transform: scale(.98);
}

.has-error .form-control-custom {
    border-color: #dc3545;
}

.help-block {
    margin: 5px 0 0;
    font-size: 11px;
    color: #dc3545;
}

</style>


<script>
    function reproducirSonidoBienAgregado()
{
    try {

        const audioContext =
            new (
                window.AudioContext ||
                window.webkitAudioContext
            )();


        const oscillator =
            audioContext.createOscillator();


        const gain =
            audioContext.createGain();


        oscillator.type = 'sine';


        // Sonido tipo "ding"
        oscillator.frequency.setValueAtTime(
            880,
            audioContext.currentTime
        );


        oscillator.frequency.exponentialRampToValueAtTime(
            1200,
            audioContext.currentTime + 0.12
        );


        gain.gain.setValueAtTime(
            0.0001,
            audioContext.currentTime
        );


        gain.gain.exponentialRampToValueAtTime(
            0.05,
            audioContext.currentTime + 0.02
        );


        gain.gain.exponentialRampToValueAtTime(
            0.0001,
            audioContext.currentTime + 0.35
        );


        oscillator.connect(gain);

        gain.connect(
            audioContext.destination
        );


        oscillator.start();

        oscillator.stop(
            audioContext.currentTime + 0.35
        );

    }
    catch (e) {

        console.log(
            'No se pudo reproducir el sonido',
            e
        );

    }
}
function reproducirSonidoSuave()
{
    try {

        const audioContext =
            new (
                window.AudioContext ||
                window.webkitAudioContext
            )();


        const oscillator =
            audioContext.createOscillator();


        const gain =
            audioContext.createGain();


        oscillator.type = 'sine';

        oscillator.frequency.value = 660;


        gain.gain.setValueAtTime(
            0.0001,
            audioContext.currentTime
        );


        gain.gain.exponentialRampToValueAtTime(
            0.04,
            audioContext.currentTime + 0.02
        );


        gain.gain.exponentialRampToValueAtTime(
            0.0001,
            audioContext.currentTime + 0.25
        );


        oscillator.connect(gain);

        gain.connect(
            audioContext.destination
        );


        oscillator.start();

        oscillator.stop(
            audioContext.currentTime + 0.25
        );

    }
    catch (e) {

        console.log(
            'No se pudo reproducir el sonido',
            e
        );

    }
}
/*
 * ============================================================
 * REGISTRO DE BIENES DEL RELEVAMIENTO
 * ============================================================
 */

let bienesRelevados = [];


/*
 * Cuando se presiona "Buscar"
 */
document.addEventListener('DOMContentLoaded', function () {

    const btnBuscar = document.getElementById('btn-buscar-bien');

    if (btnBuscar) {

        btnBuscar.addEventListener('click', function () {

            const matricula =
                document.getElementById('matricula-busqueda').value.trim();

            if (matricula === '') {
                
                mostrarToast('Ingresá una matrícula.', 'info');
                return;
            }

           // $('#contenedor-fotografias').empty();
            /*
             * Mostrar formulario del bien
             */
            document.getElementById(
                'bien-encontrado'
            ).style.display = 'block';


            /*
             * Pasar matrícula
             */
            document.getElementById(
                'bien-matricula'
            ).value = matricula;


            /*
             * Limpiar datos anteriores
             */
            document.getElementById(
                'bien-persona-cargo'
            ).value = '';

            document.getElementById(
                'bien-lugar-pertenece'
            ).value = '';

            document.getElementById(
                'bien-estado'
            ).value = '';

        });

    }


    /*
     * Agregar bien
     */
    const btnAgregar =
        document.getElementById('btn-agregar-bien');


    if (btnAgregar) {

        btnAgregar.addEventListener('click', function () {

            agregarBienAlRelevamiento();

        });

    }


    /*
     * Escanear código
     *
     * Por ahora deja cargada la matrícula.
     * Después podemos conectar esto con tu lector
     * de código de barras.
     */
    const btnEscanear =
        document.getElementById('btn-escanear-bien');


    if (btnEscanear) {

        btnEscanear.addEventListener('click', function () {
            
            mostrarToast('Acá se abrirá el lector de código de barras.', 'success');
        });

    }

});


/*
 * ============================================================
 * AGREGAR BIEN
 * ============================================================
 */

function agregarBienAlRelevamiento()
{

    const matricula =
        document.getElementById('bien-matricula').value.trim();


    const personaCargo =
        document.getElementById('bien-persona-cargo').value.trim();


    const lugarPertenece =
        document.getElementById('bien-lugar-pertenece').value.trim();


    const sector =
        document.getElementById('bien-sector').value.trim();


    const estadoBien =
        document.getElementById('bien-estado').value;


    /*
     * Validar matrícula
     */
    if (matricula === '') {

        mostrarToast('La matrícula es obligatoria.');
        return;

    }


    /*
     * Validar persona
     */
    if (personaCargo === '') {

        mostrarToast('Ingresá la persona a cargo.');
        return;

    }


    /*
     * Validar lugar
     */
    if (lugarPertenece === '') {

        mostrarToast('Ingresá el lugar al que pertenece.');
        return;

    }


    /*
     * Validar sector
     */
    if (sector === '') {

        mostrarToast('Ingresá el sector.', 'warning');
        return;

    }


    /*
     * Validar estado
     */
    if (estadoBien === '') {

        mostrarToast('Seleccioná el estado del bien.', 'warning');
        return;

    }


    /*
     * Evitar matrícula repetida
     */
    const existe =
        bienesRelevados.some(function (bien) {

            return bien.matricula === matricula;

        });


    if (existe) {

        mostrarToast(
            'Esta matrícula ya fue agregada al relevamiento.',
            'warning'
        );

        return;

    }


    /*
     * FOTOS
     */
    const fotos = [];

    document
        .querySelectorAll('#contenedor-fotografias img')
        .forEach(function (img) {

            fotos.push(img.src);

        });


    console.log('FOTOS DEL BIEN:', fotos);
    console.log('SECTOR DEL BIEN:', sector);


    /*
     * Crear objeto
     */
    const bien = {

        matricula: matricula,

        persona_cargo: personaCargo,

        lugar_pertenece: lugarPertenece,

        sector: sector,

        estado_bien: estadoBien,

        fotos: fotos

    };


    console.log('BIEN COMPLETO:', bien);


    /*
     * Agregar al array
     */
    bienesRelevados.push(bien);


    /*
     * Las fotos ya fueron copiadas a bien.fotos.
     */
    window.fotografiasBien = [];


    document
        .getElementById('contenedor-fotografias')
        .innerHTML = '';


    /*
     * Actualizar pantalla
     */
    mostrarBienes();


    /*
     * Guardar JSON en hidden
     */
    actualizarInputBienes();


    /*
     * Limpiar formulario
     */
    document.getElementById(
        'matricula-busqueda'
    ).value = '';


    document.getElementById(
        'bien-matricula'
    ).value = '';


    document.getElementById(
        'bien-persona-cargo'
    ).value = '';


    document.getElementById(
        'bien-lugar-pertenece'
    ).value = '';


    document.getElementById(
        'bien-sector'
    ).value = '';


    document.getElementById(
        'bien-estado'
    ).value = '';


    /*
     * Ocultar formulario
     */
    document.getElementById(
        'bien-encontrado'
    ).style.display = 'none';

}
function cerrarToast() {

    const toast =
        document.getElementById('toast-mensaje');

    if (!toast) {
        return;
    }

    toast.classList.remove('mostrar');
}
/*
 * ============================================================
 * MOSTRAR BIENES
 * ============================================================
 */

function mostrarBienes()
{

    const lista =
        document.getElementById('lista-bienes');


    const cantidad =
        document.getElementById('cantidad-bienes');


    /*
     * Actualizar cantidad
     */
    cantidad.textContent =
        bienesRelevados.length;


    /*
     * Si no hay bienes
     */
    if (bienesRelevados.length === 0) {

        lista.innerHTML = `
            <div class="lista-vacia">

                <i class="fa-solid fa-box-open"></i>

                <span>
                    Aún no registraste ningún bien.
                </span>

            </div>
        `;

        return;

    }


    /*
     * Construir lista
     */
    lista.innerHTML = '';


    bienesRelevados.forEach(function (bien, index) {

        const item =
            document.createElement('div');


        item.className = 'bien-item';
        /*
         * Fotos del bien
         */
        const fotos =
            bien.fotos || [];


        let previewFotos = '';
        if (fotos.length > 0) {

            previewFotos = `
                <div class="bien-fotos-preview">

                    ${fotos.map(function (foto, fotoIndex) {

                        return `
                            <img
                                src="${foto}"
                                class="bien-foto-miniatura"
                                alt="Foto ${fotoIndex + 1}"
                                title="Foto ${fotoIndex + 1} de ${fotos.length}"
                                 onclick="abrirGaleriaBien(${index}, ${fotoIndex})"
                            >
                        `;

                    }).join('')}

                </div>
            `;

        }
        <?php 
        
        $userId = Yii::$app->user->id;

        $usuario = (new \yii\db\Query())
            ->select([
                'u.iduser',
                'u.idpersona',
                'p.nombre',
                'p.apellido'
            ])
            ->from(['u' => 'mjg_main_user'])
            ->innerJoin(
                ['p' => 'mjg_main_persona'],
                'p.idpersona = u.idpersona'
            )
            ->where(['u.iduser' => $userId])
            ->one();

       $nombre = explode(' ', trim($usuario['nombre'] ?? ''))[0];
        $apellido = explode(' ', trim($usuario['apellido'] ?? ''))[0];

        $nombreCompleto = $nombre . ' ' . $apellido;
        
        ?>
        bien.rol_relevamiento="creador";
        item.innerHTML = `

            <div class="bien-item-icon">

                <i class="fa-solid fa-box"></i>

            </div>


            <div class="bien-item-info">

                <div class="bien-titulo">

                    <strong>
                        Matrícula:
                        ${escapeHtml(bien.matricula)}
                    </strong>

                    <span class="bien-relevado-por">

                        <i class="fa-solid fa-user"></i>

                        Rel.:
                        ${escapeHtml(
                           '<?= \yii\helpers\Html::encode($nombreCompleto) ?>' || 'Sin especificar'
                        )}

                        <span class="bien-rol">
                            ${escapeHtml(
                                bien.rol_relevamiento || 'Creador'
                            )}
                        </span>

                    </span>


                    <span
                        class="bien-fotos"
                        title="Cantidad de fotos del bien relevado: ${(bien.fotos || []).length}"
                    >

                        <i class="fa-solid fa-camera"></i>

                        ${(bien.fotos || []).length}

                    </span>

                </div>
                <span>
                    <b>Bien relevado:</b>
                    ${escapeHtml(bien.bien_relevado || 'Sin especificar')}
                </span>
                <span>
                    <b>Persona:</b>
                    ${escapeHtml(bien.persona_cargo)}
                </span>

                <span>
                    <b>Lugar:</b>
                    ${escapeHtml(bien.lugar_pertenece)}
                </span>
                <span>
                    <b>Sector:</b>
                    ${escapeHtml(
                        bien.sector || 'Sin especificar'
                    )}
                </span>
                <span class="bien-estado">
                    Estado:
                    ${escapeHtml(bien.estado_bien)}
                </span>      
                     

            </div>

            <button
                type="button"
                class="btn-ver-relevamiento"
                onclick="verRelevamiento(${index})"
                title="Ver información completa"
            >
                <i class="fa-solid fa-eye"></i>
            </button>
            <button
                type="button"
                class="btn-eliminar-bien"
                onclick="eliminarBien(${index})"
                title="Eliminar bien"
            >

                <i class="fa-solid fa-trash"></i>

            </button>
            <!-- FOTOS ABAJO DE TODO -->
            ${previewFotos}
        `;


        lista.appendChild(item);

    });

}
function abrirFotoCompleta(src) {

    const visor = document.getElementById('visor-foto');

    const imagen = document.getElementById('imagen-visor-foto');

    if (!visor || !imagen) return;

    imagen.src = src;

    visor.classList.add('activo');

}

/*
 * ============================================================
 * ELIMINAR BIEN
 * ============================================================
 */

function eliminarBien(index)
{

    if (!confirm('¿Querés eliminar este bien del relevamiento?')) {

        return;

    }


    bienesRelevados.splice(index, 1);


    mostrarBienes();


    actualizarInputBienes();

}


/*
 * ============================================================
 * GUARDAR JSON
 * ============================================================
 */

function actualizarInputBienes()
{

    const input =
        document.getElementById('bienes-relevados');


    input.value =
        JSON.stringify(bienesRelevados);

}


/*
 * ============================================================
 * SEGURIDAD PARA MOSTRAR TEXTO
 * ============================================================
 */

function escapeHtml(text)
{

    const div =
        document.createElement('div');

    div.textContent = text;

    return div.innerHTML;

}

document.addEventListener('DOMContentLoaded', function () {

    const btnComenzar = document.getElementById(
        'btn-comenzar-relevamiento'
    );

    const registroBienes = document.getElementById(
        'registro-bienes'
    );

    const contenedorCompartir = document.getElementById(
        'contenedor-compartir-tarea'
    );

    btnComenzar.addEventListener('click', function () {

        registroBienes.style.display = 'block';

        contenedorCompartir.style.display = 'flex';

        btnComenzar.style.display = 'none';

        registroBienes.scrollIntoView({
            behavior: 'smooth',
            block: 'start'
        });

    });

});

    let mapaRelevamiento;
let marcadorRelevamiento = null;

document.addEventListener('DOMContentLoaded', function () {

    const status = document.getElementById('location-status');
    const coordinates = document.getElementById('location-coordinates');

    /*
     * Crear mapa inicialmente centrado en Neuquén
     */
    mapaRelevamiento = L.map('mapa-relevamiento').setView(
        [-38.9516, -68.0591],
        13
    );

    L.tileLayer(
        'https://tile.openstreetmap.org/{z}/{x}/{y}.png',
        {
            maxZoom: 19,
            attribution: '&copy; OpenStreetMap'
        }
    ).addTo(mapaRelevamiento);
    mapaRelevamiento.on('click', function(e) {

        const lat = e.latlng.lat;
        const lon = e.latlng.lng;

        // Actualizar coordenadas y dirección
        actualizarCoordenadas(lat, lon);

        // Crear o mover marcador
        if (marcadorRelevamiento) {

            marcadorRelevamiento.setLatLng([
                lat,
                lon
            ]);

        } else {

            marcadorRelevamiento = L.marker(
                [lat, lon],
                {
                    draggable: true
                }
            ).addTo(mapaRelevamiento);

            // Si después arrastra el marcador
            marcadorRelevamiento.on(
                'dragend',
                function() {

                    const posicion =
                        marcadorRelevamiento.getLatLng();

                    actualizarCoordenadas(
                        posicion.lat,
                        posicion.lng
                    );

                }
            );
        }

    });
    /*
     * Intentar obtener ubicación automáticamente
     */
    obtenerUbicacion();
});


function obtenerUbicacion() {

    const status = document.getElementById('location-status');
    const coordinates = document.getElementById('location-coordinates');

    const latitud = document.getElementById('relevamiento-latitud');
    const longitud = document.getElementById('relevamiento-longitud');

    const boton = document.getElementById('btn-obtener-ubicacion');


    if (!navigator.geolocation) {

        status.textContent = 'GPS no disponible';

        coordinates.textContent =
            'Este dispositivo no permite obtener la ubicación.';

        return;
    }


    status.textContent = 'Obteniendo ubicación...';

    coordinates.textContent =
        'Esperando señal GPS';

    boton.classList.add('loading');

    boton.innerHTML =
        '<i class="fa-solid fa-spinner fa-spin"></i> Obteniendo ubicación...';


    navigator.geolocation.getCurrentPosition(

        function (position) {

            const lat = position.coords.latitude;
            const lon = position.coords.longitude;


            /*
             * Guardar coordenadas
             */
            actualizarCoordenadas(lat, lon);


            /*
             * Estado
             */
            status.textContent = 'Ubicación obtenida';

            boton.classList.remove('loading');
            boton.classList.add('success');

            boton.innerHTML =
                '<i class="fa-solid fa-check"></i> Ubicación obtenida';


            /*
             * Eliminar marcador anterior
             */
            if (marcadorRelevamiento) {
                mapaRelevamiento.removeLayer(
                    marcadorRelevamiento
                );
            }


            /*
             * Crear marcador ARRRASTRABLE
             */
            marcadorRelevamiento = L.marker(
                [lat, lon],
                {
                    draggable: true
                }
            )
            .addTo(mapaRelevamiento);


            /*
             * Popup
             */
            marcadorRelevamiento.bindPopup(
                '<b>Ubicación del relevamiento</b><br>' +
                'Podés mover este marcador.'
            );


            /*
             * Cuando el usuario mueve el pin
             */
            marcadorRelevamiento.on(
                'dragend',
                function () {

                    const posicion =
                        marcadorRelevamiento.getLatLng();

                    actualizarCoordenadas(
                        posicion.lat,
                        posicion.lng
                    );

                    status.textContent =
                        'Ubicación ajustada';

                    coordinates.textContent =
                        posicion.lat.toFixed(6) +
                        ', ' +
                        posicion.lng.toFixed(6);

                }
            );


            /*
             * Centrar mapa
             */
            mapaRelevamiento.setView(
                [lat, lon],
                17
            );

        },


        function (error) {

            boton.classList.remove('loading');
            boton.classList.remove('success');

            boton.innerHTML =
                '<i class="fa-solid fa-location-crosshairs"></i> ' +
                'Obtener mi ubicación';


            if (error.code === 1) {

                status.textContent =
                    'Permiso de ubicación rechazado';

                coordinates.textContent =
                    'Permití el acceso a tu ubicación y volvé a intentarlo.';

            } else if (error.code === 2) {

                status.textContent =
                    'No se pudo determinar la ubicación';

                coordinates.textContent =
                    'Verificá que el GPS esté activado y volvé a intentarlo.';

            } else if (error.code === 3) {

                status.textContent =
                    'Tiempo de espera agotado';

                coordinates.textContent =
                    'No se obtuvo señal GPS. Volvé a intentarlo.';

            } else {

                status.textContent =
                    'No se pudo obtener la ubicación';

                coordinates.textContent =
                    'Volvé a presionar "Obtener mi ubicación".';
            }

        },


        {
            enableHighAccuracy: true,
            timeout: 15000,
            maximumAge: 0
        }

    );
}


/*
 * Actualizar los campos ocultos y el texto
 */
function actualizarCoordenadas(lat, lon) {

    const latitud =
        document.getElementById('relevamiento-latitud');

    const longitud =
        document.getElementById('relevamiento-longitud');

    const coordinates =
        document.getElementById('location-coordinates');

    const address =
        document.getElementById('location-address');


    // Guardar coordenadas
    latitud.value = lat;
    longitud.value = lon;


    // Seguir mostrando las coordenadas como hasta ahora
    coordinates.textContent =
        Number(lat).toFixed(6) +
        ', ' +
        Number(lon).toFixed(6);


    // Mostrar estado mientras buscamos la dirección
    address.textContent =
        'Buscando dirección...';


    // Consulta inversa a OpenStreetMap
    fetch(
        'https://nominatim.openstreetmap.org/reverse' +
        '?format=json' +
        '&lat=' + encodeURIComponent(lat) +
        '&lon=' + encodeURIComponent(lon) +
        '&zoom=18' +
        '&addressdetails=1' +
        '&accept-language=es'
    )
    .then(function(response) {

        if (!response.ok) {
            throw new Error('Error HTTP ' + response.status);
        }

        return response.json();

    })
    .then(function(data) {

        console.log('RESPUESTA NOMINATIM:', data);


        if (!data || !data.address) {

            address.textContent =
                'Dirección no disponible';

            return;
        }


        const calle =
            data.address.road || '';

        const altura =
            data.address.house_number || '';

        const localidad =
            data.address.city ||
            data.address.town ||
            data.address.village ||
            '';


        /*
         * Construir dirección
         *
         * Ejemplo:
         * Rioja 123
         */

        let direccion = '';

        if (calle && altura) {

            direccion =
                calle + ' ' + altura;

        } else if (calle) {

            direccion =
                calle;

        } else {

            direccion =
                data.display_name || 'Dirección no disponible';
        }


        // Agregar localidad si corresponde
        if (
            localidad &&
            !direccion.includes(localidad)
        ) {

            direccion +=
                ', ' + localidad;
        }


        address.textContent =
            '📍 ' + direccion;

    })
    .catch(function(error) {

        console.error(
            'Error obteniendo dirección:',
            error
        );

        address.textContent =
            '📍 No se pudo obtener la dirección';

    });
}





window.fotografiasBien =
    window.fotografiasBien || [];


/* ============================================================
   ADJUNTAR ARCHIVOS
   Usa exactamente la misma estructura que la cámara
============================================================ */

const inputFotosArchivos =
    document.getElementById('bien-fotos-archivos');

if (inputFotosArchivos) {

    inputFotosArchivos.addEventListener(
        'change',
        function () {

            const archivos =
                Array.from(this.files || []);

            if (!archivos.length) {
                return;
            }

            console.log(
                '📎 ARCHIVOS SELECCIONADOS:',
                archivos.length
            );


            archivos.forEach(function (archivo) {

                /*
                 * Solo imágenes
                 */
                if (!archivo.type.startsWith('image/')) {

                    console.warn(
                        '⚠️ Archivo ignorado:',
                        archivo.name
                    );

                    return;
                }


                /*
                 * AGREGAR A LA MISMA ESTRUCTURA
                 * QUE USA LA CÁMARA
                 */
                window.fotografiasBien.push(
                    archivo
                );

            });


            console.log(
                '📷 TOTAL DE FOTOS:',
                window.fotografiasBien.length
            );


            /*
             * MOSTRAR PREVIEW
             *
             * Es exactamente la misma función
             * que usa capturarFoto()
             */
            mostrarFotografias();


            /*
             * Permite volver a elegir
             * el mismo archivo
             */
            this.value = '';

        }
    );

}


/* ============================================================
   CAPTURAR FOTO
============================================================ */

function capturarFoto(e) {

    console.log('🔥 1 - ENTRÓ A capturarFoto()');

    if (e) {
        e.preventDefault();
        e.stopPropagation();
    }

    console.log('🔥 2 - ANTES DE CAPTURAR');

    const video =
        document.getElementById('video-camara-foto');

    if (!video) {

        console.error(
            '❌ No existe #video-camara-foto'
        );

        return;
    }

    console.log(
        '📹 Video:',
        video.videoWidth,
        video.videoHeight
    );

    if (
        video.videoWidth === 0 ||
        video.videoHeight === 0
    ) {
       
        mostrarToast('La cámara todavía no está lista.', 'warning');
        return;
    }


    /*
     * ==========================================
     * EFECTO DE CÁMARA
     * ==========================================
     */

    efectoFlashFoto();

    sonidoCamara();


    /*
     * ==========================================
     * CREAR CANVAS
     * ==========================================
     */

    const canvas =
        document.createElement('canvas');

    canvas.width =
        video.videoWidth;

    canvas.height =
        video.videoHeight;


    /*
     * ==========================================
     * DIBUJAR FOTO
     * ==========================================
     */

    const ctx =
        canvas.getContext('2d');

    ctx.drawImage(
        video,
        0,
        0,
        canvas.width,
        canvas.height
    );


    /*
     * ==========================================
     * CONVERTIR A ARCHIVO
     * ==========================================
     */

    canvas.toBlob(function (blob) {

        if (!blob) {

            console.error(
                '❌ No se pudo generar la imagen'
            );

            return;
        }


        const archivo =
            new File(
                [blob],
                'foto_' + Date.now() + '.jpg',
                {
                    type: 'image/jpeg'
                }
            );


        /*
         * ==========================================
         * GUARDAR FOTO
         * ==========================================
         */

        window.fotografiasBien =
            window.fotografiasBien || [];

        window.fotografiasBien.push(
            archivo
        );


        console.log(
            '✅ FOTO CAPTURADA'
        );

        console.log(
            '📷 Total de fotos:',
            window.fotografiasBien.length
        );


        /*
         * ==========================================
         * MOSTRAR FOTOGRAFÍAS
         * ==========================================
         */

        mostrarFotografias();


        /*
         * La cámara permanece abierta
         * para sacar otra fotografía.
         */

    }, 'image/jpeg', 0.90);

}
 </script>
 <style>
/* ==========================================================
   MODAL COMPARTIR TAREA - DISEÑO
   ========================================================== */

.compartir-modal {
    width: 620px;
    max-width: calc(100vw - 32px);
    max-height: 88vh;

    background: #ffffff;
    border-radius: 16px;

    overflow: hidden;

    box-shadow:
        0 24px 70px rgba(15, 23, 42, 0.22);
}


/* ==========================================================
   HEADER
   ========================================================== */

.compartir-modal .rp-modal-header {
    display: flex;
    align-items: center;
    justify-content: space-between;

    padding: 20px 22px 17px;

    background: #ffffff;

    border-bottom: 1px solid #edf0f4;
}

.compartir-modal .rp-modal-header > div:first-child {
    display: flex;
    flex-direction: column;
    gap: 4px;
}

.compartir-modal .rp-modal-title {
    display: flex;
    align-items: center;
    gap: 9px;

    color: #172033;

    font-size: 17px;
    font-weight: 700;

    line-height: 1.2;
}

.compartir-modal .rp-modal-title i {
    width: 32px;
    height: 32px;

    display: flex;
    align-items: center;
    justify-content: center;

    border-radius: 9px;

    background: #edf3fa;
    color: #315a91;

    font-size: 15px;
}

.compartir-modal .rp-modal-subtitle {
    padding-left: 41px;

    color: #7b8491;

    font-size: 12px;
    line-height: 1.4;
}


/* ==========================================================
   BOTÓN CERRAR
   ========================================================== */

.compartir-modal .rp-modal-close {
    width: 32px;
    height: 32px;

    display: flex;
    align-items: center;
    justify-content: center;

    padding: 0;

    border: 0;
    border-radius: 8px;

    background: transparent;
    color: #7b8491;

    font-size: 22px;
    font-weight: 400;

    line-height: 1;

    cursor: pointer;

    transition:
        background .15s ease,
        color .15s ease;
}

.compartir-modal .rp-modal-close:hover {
    background: #f1f3f6;
    color: #263244;
}


/* ==========================================================
   BODY
   ========================================================== */

.compartir-modal .rp-modal-body {
    padding: 20px 22px 18px;

    background: #ffffff;

    overflow-y: auto;
}


/* ==========================================================
   INFORMACIÓN DEL RELEVAMIENTO
   ========================================================== */

.compartir-relevamiento-info {
    display: flex;
    align-items: center;

    gap: 12px;

    padding: 13px 14px;

    margin-bottom: 20px;

    background: #f5f7fa;

    border: 1px solid #edf0f4;
    border-radius: 11px;
}

.compartir-info-icon {
    width: 40px;
    height: 40px;

    min-width: 40px;

    display: flex;
    align-items: center;
    justify-content: center;

    border-radius: 9px;

    background: #e8eef8;
    color: #315a91;

    font-size: 16px;
}

.compartir-relevamiento-info strong {
    display: block;

    margin-bottom: 3px;

    color: #263244;

    font-size: 13px;
    font-weight: 700;
}

.compartir-relevamiento-info span {
    display: block;

    color: #7d8693;

    font-size: 11px;
    line-height: 1.4;
}


/* ==========================================================
   LABELS
   ========================================================== */

.compartir-label {
    margin-bottom: 7px;

    color: #394354;

    font-size: 12px;
    font-weight: 700;
}

.compartir-label span {
    color: #9aa1ab;
    font-weight: 400;
}


/* ==========================================================
   BUSCADOR
   ========================================================== */

.compartir-buscador {
    height: 42px;

    display: flex;
    align-items: center;

    box-sizing: border-box;

    padding: 0 12px;

    margin-bottom: 10px;

    background: #ffffff;

    border: 1px solid #dfe4ea;
    border-radius: 9px;

    transition:
        border-color .15s ease,
        box-shadow .15s ease;
}

.compartir-buscador:focus-within {
    border-color: #9db5d4;

    box-shadow:
        0 0 0 3px rgba(49, 90, 145, 0.08);
}

.compartir-buscador i {
    flex-shrink: 0;

    margin-right: 9px;

    color: #9aa2ad;

    font-size: 13px;
}

.compartir-buscador input {
    width: 100%;

    padding: 0;

    border: 0;
    outline: 0;

    background: transparent;

    color: #303947;

    font-family: inherit;
    font-size: 12px;
}

.compartir-buscador input::placeholder {
    color: #a3a9b2;
}


/* ==========================================================
   LISTA DE USUARIOS
   ========================================================== */

.lista-usuarios-colaboradores {
    max-height: 215px;

    overflow-y: auto;

    background: #ffffff;

    border: 1px solid #e5e9ee;
    border-radius: 10px;

    scrollbar-width: thin;
    scrollbar-color: #c5cad1 transparent;
}

.lista-usuarios-colaboradores::-webkit-scrollbar {
    width: 6px;
}

.lista-usuarios-colaboradores::-webkit-scrollbar-track {
    background: transparent;
}

.lista-usuarios-colaboradores::-webkit-scrollbar-thumb {
    background: #c7ccd3;
    border-radius: 10px;
}


/* ==========================================================
   USUARIO
   ========================================================== */

.usuario-colaborador-item {
    min-height: 60px;

    display: flex;
    align-items: center;

    gap: 11px;

    box-sizing: border-box;

    padding: 10px 12px;

    background: #ffffff;

    border-bottom: 1px solid #eef0f3;

    cursor: pointer;

    transition:
        background .15s ease;
}

.usuario-colaborador-item:last-child {
    border-bottom: 0;
}

.usuario-colaborador-item:hover {
    background: #f8fafc;
}

.usuario-colaborador-item.seleccionado {
    background: #f1f6fc;
}

.usuario-colaborador-item.ya-colaborador {
    cursor: default;
    opacity: .65;
}


/* ==========================================================
   CHECK
   ========================================================== */

.usuario-check {
    width: 20px;
    min-width: 20px;

    display: flex;
    align-items: center;
    justify-content: center;

    color: #315a91;
}

.usuario-check input {
    width: 15px;
    height: 15px;

    margin: 0;

    accent-color: #315a91;

    cursor: pointer;
}


/* ==========================================================
   AVATAR
   ========================================================== */

.usuario-avatar {
    width: 34px;
    height: 34px;

    min-width: 34px;

    display: flex;
    align-items: center;
    justify-content: center;

    border-radius: 50%;

    background: #edf2f8;
    color: #315a91;

    font-size: 10px;
    font-weight: 700;
}


/* ==========================================================
   DATOS
   ========================================================== */

.usuario-datos {
    flex: 1;
    min-width: 0;
}

.usuario-datos strong {
    display: block;

    margin-bottom: 2px;

    color: #303947;

    font-size: 12px;
    font-weight: 700;
}

.usuario-datos span {
    display: block;

    color: #9aa1aa;

    font-size: 10px;
}

.usuario-ya-colabora {
    white-space: nowrap;

    color: #9aa1aa;

    font-size: 10px;
}


/* ==========================================================
   SELECCIONADOS
   ========================================================== */

.seleccionados-container {
    margin-top: 16px;
}

.usuarios-seleccionados {
    min-height: 34px;

    display: flex;
    flex-wrap: wrap;
    align-items: center;

    gap: 6px;

    margin-bottom: 16px;
}

.sin-seleccion {
    color: #a2a8b0;

    font-size: 11px;
}


/* ==========================================================
   CHIPS
   ========================================================== */

.usuario-chip {
    display: inline-flex;
    align-items: center;

    gap: 6px;

    padding: 4px 7px 4px 5px;

    background: #edf3fa;

    border: 1px solid #e0e9f4;
    border-radius: 20px;

    color: #315a91;

    font-size: 10px;
    font-weight: 600;
}

.chip-avatar {
    width: 22px;
    height: 22px;

    display: flex;
    align-items: center;
    justify-content: center;

    border-radius: 50%;

    background: #ffffff;

    color: #315a91;

    font-size: 8px;
    font-weight: 700;
}

.usuario-chip button {
    width: 20px;
    height: 20px;

    display: flex;
    align-items: center;
    justify-content: center;

    padding: 0;

    border: 0;
    border-radius: 50%;

    background: transparent;
    color: #7d8793;

    font-size: 14px;

    cursor: pointer;
}

.usuario-chip button:hover {
    background: rgba(0,0,0,.06);
    color: #333;
}


/* ==========================================================
   MENSAJE
   ========================================================== */

.mensaje-invitacion {
    width: 100%;

    box-sizing: border-box;

    min-height: 78px;

    padding: 10px 11px;

    resize: vertical;

    background: #ffffff;

    border: 1px solid #dfe4ea;
    border-radius: 9px;

    outline: none;

    color: #303947;

    font-family: inherit;
    font-size: 11px;

    transition:
        border-color .15s ease,
        box-shadow .15s ease;
}

.mensaje-invitacion::placeholder {
    color: #a3a9b2;
}

.mensaje-invitacion:focus {
    border-color: #9db5d4;

    box-shadow:
        0 0 0 3px rgba(49, 90, 145, 0.08);
}


/* ==========================================================
   FOOTER
   ========================================================== */

.compartir-modal .rp-modal-footer {
    display: flex;
    align-items: center;
    justify-content: flex-end;

    gap: 9px;

    padding: 13px 22px;

    background: #fafbfc;

    border-top: 1px solid #edf0f3;
}


/* ==========================================================
   BOTONES
   ========================================================== */

.compartir-modal .btn-modal-secondary,
.compartir-modal .btn-modal-primary {
    height: 36px;

    display: inline-flex;
    align-items: center;
    justify-content: center;

    gap: 7px;

    padding: 0 14px;

    border-radius: 8px;

    font-family: inherit;

    font-size: 11px;
    font-weight: 600;

    cursor: pointer;

    transition:
        background .15s ease,
        border-color .15s ease,
        transform .1s ease;
}

.compartir-modal .btn-modal-secondary {
    background: #ffffff;

    border: 1px solid #dfe3e8;

    color: #626b77;
}

.compartir-modal .btn-modal-secondary:hover {
    background: #f5f6f8;
    border-color: #d4d9df;
}

.compartir-modal .btn-modal-primary {
    background: #315a91;

    border: 1px solid #315a91;

    color: #ffffff;
}

.compartir-modal .btn-modal-primary:hover {
    background: #284d7d;
    border-color: #284d7d;
}

.compartir-modal .btn-modal-primary:active,
.compartir-modal .btn-modal-secondary:active {
    transform: translateY(1px);
}

.compartir-modal .btn-modal-primary i {
    font-size: 11px;
}


/* ==========================================================
   RESPONSIVE
   ========================================================== */

@media (max-width: 600px) {

    .compartir-modal {
        width: calc(100vw - 20px);
        max-height: 92vh;
        border-radius: 13px;
    }

    .compartir-modal .rp-modal-header {
        padding: 16px;
    }

    .compartir-modal .rp-modal-body {
        padding: 16px;
    }

    .compartir-modal .rp-modal-footer {
        padding: 11px 16px;
    }

    .compartir-modal .rp-modal-title {
        font-size: 15px;
    }

    .compartir-modal .rp-modal-subtitle {
        padding-left: 41px;
        font-size: 11px;
    }
}
/* ==========================================================
   MODAL COMPARTIR - SCROLL INTERNO
   ========================================================== */

.compartir-modal {
    width: 650px;
    max-width: calc(100vw - 24px);

    height: auto;
    max-height: calc(100vh - 24px);

    display: flex;
    flex-direction: column;

    overflow: hidden;
}


/* HEADER FIJO */

.compartir-modal .rp-modal-header {
    flex-shrink: 0;
}


/* CUERPO CON SCROLL */

.compartir-modal .rp-modal-body {
    flex: 1 1 auto;

    min-height: 0;

    overflow-y: auto;
    overflow-x: hidden;

    padding: 20px 22px;

    scrollbar-width: thin;
    scrollbar-color: #c5cad1 transparent;
}

.compartir-modal .rp-modal-body::-webkit-scrollbar {
    width: 6px;
}

.compartir-modal .rp-modal-body::-webkit-scrollbar-track {
    background: transparent;
}

.compartir-modal .rp-modal-body::-webkit-scrollbar-thumb {
    background: #c5cad1;
    border-radius: 10px;
}


/* FOOTER SIEMPRE VISIBLE */

.compartir-modal .rp-modal-footer {
    flex-shrink: 0;

    display: flex;
    align-items: center;
    justify-content: flex-end;

    gap: 9px;

    padding: 12px 22px;

    background: #fafbfc;

    border-top: 1px solid #e8ebef;
}


/* ==========================================================
   CELULAR
   ========================================================== */

@media (max-width: 600px) {

    .rp-modal {
        padding: 12px;
        box-sizing: border-box;
    }

    .compartir-modal {
        width: 100%;
        max-width: 100%;

        max-height: calc(100vh - 24px);

        border-radius: 13px;
    }

    .compartir-modal .rp-modal-header {
        padding: 15px 16px;
    }

    .compartir-modal .rp-modal-body {
        padding: 16px;
    }

    .compartir-modal .rp-modal-footer {
        padding: 11px 16px;

        /* IMPORTANTE:
           que los botones siempre entren */
        gap: 8px;
    }

    .compartir-modal .btn-modal-secondary,
    .compartir-modal .btn-modal-primary {
        height: 36px;
    }
}
 </style>
