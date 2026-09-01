
<?php

use yii\helpers\Html;

$this->title = 'Mi Cuenta';

/*
|--------------------------------------------------------------------------
| DATOS SIMULADOS
|--------------------------------------------------------------------------
|
| POR AHORA NO SE CONSULTA NINGUNA TABLA.
|
| Más adelante estos datos vendrán de:
|
| mjg_main_user
|   iduser
|   username
|   password
|   email1
|   profile
|   idpersona
|
| mjg_main_persona
|   idpersona
|   nombre
|   apellido
|   documento
|   empleado
|   legajo
|   asignacion
|
| mjg_main_oficina
|   idoficina
|   descripcion
|
|--------------------------------------------------------------------------
| RELACIONES FUTURAS
|--------------------------------------------------------------------------
|
| mjg_main_user.iduser
|     =
| Yii::$app->user->id
|
| mjg_main_user.idpersona
|     =
| mjg_main_persona.idpersona
|
| mjg_main_persona.asignacion
|     =
| mjg_main_oficina.idoficina
|
|--------------------------------------------------------------------------
| FUTURO EJEMPLO
|--------------------------------------------------------------------------
|
| $user = MjgMainUser::findOne([
|     'iduser' => Yii::$app->user->id
| ]);
|
| $persona = MjgMainPersona::findOne([
|     'idpersona' => $user->idpersona
| ]);
|
| $oficina = MjgMainOficina::findOne([
|     'idoficina' => $persona->asignacion
| ]);
|
*/


// ================================================================
// DATOS SIMULADOS
// ================================================================

$cuenta = (object) [

    // ------------------------------------------------------------
    // mjg_main_user
    // ------------------------------------------------------------

    'iduser' => 40,

    'username' => 'lgarcia',

    'email' => 'luis.garcia@municipalidad.gob.ar',

    // Nombre del archivo de imagen almacenado en profile
    'profile' => 'perfil_usuario.jpg',


    // ------------------------------------------------------------
    // mjg_main_persona
    // ------------------------------------------------------------

    'nombre' => 'Luis Eduardo',

    'apellido' => 'Garcia Carrillo',

    'documento' => '28.456.789',

    'empleado' => true,

    'legajo' => '12345',


    // ------------------------------------------------------------
    // mjg_main_oficina
    // ------------------------------------------------------------

    'oficina' => 'Oficina de Patrimonio',

    'dependencia' => 'Oficina de Patrimonio',


    // ------------------------------------------------------------
    // OTROS DATOS SIMULADOS
    // ------------------------------------------------------------

    'telefono' => '299 555-1234',
];


// ================================================================
// DATOS PARA MOSTRAR
// ================================================================

$nombreCompleto = $cuenta->nombre . ' ' . $cuenta->apellido;

$tipoEmpleado = $cuenta->empleado
    ? 'Empleado de la Provincia'
    : 'Usuario externo';


// ================================================================
// FOTO DE PERFIL
// ================================================================
//
// POR AHORA no utilizamos el archivo real.
//
// Cuando se conecte con mjg_main_user.profile:
//
// $fotoPerfil = Yii::getAlias(
//     '@web/uploads/perfiles/' . $cuenta->profile
// );
//
// Por ahora usamos el avatar de Font Awesome.
//

$fotoPerfil = null;

?>

<div class="page">

    <!-- ==========================================================
         MENSAJE DE ÉXITO
         ========================================================== -->

    <?php if (Yii::$app->session->hasFlash('success')): ?>

        <div class="flash-success">
            <?= Html::encode(
                Yii::$app->session->getFlash('success')
            ) ?>
        </div>

    <?php endif; ?>


    <!-- ==========================================================
         PERFIL
         ========================================================== -->

    <div class="profile-card">

        <div class="profile-avatar">
            <?php   $fotoPerfil2=  '/perfil/miperfil.png';  ?>
            <?php if ($fotoPerfil2): ?>
            

                <img
                    src="<?= Html::encode($fotoPerfil2) ?>"
                    alt="Foto de perfil"
                >

            <?php else: ?>

                <i class="fa-solid fa-user"></i>

            <?php endif; ?>

        </div>


        <div class="profile-info">

            <strong>
                <?= Html::encode($nombreCompleto) ?>
            </strong>

            <span>
                <?= Html::encode($cuenta->email) ?>
            </span>

            <small>
                <?= Html::encode($cuenta->oficina) ?>
            </small>

        </div>

    </div>


    <!-- ==========================================================
         INFORMACIÓN PERSONAL
         ========================================================== -->

    <div class="detail-card">

        <div class="detail-title">

            <i class="fa-solid fa-id-card"></i>

            Información personal

        </div>


        <div class="account-data-grid">


            <!-- Nombre -->

            <div class="account-data-item">

                <label>Nombre completo</label>

                <span>
                    <?= Html::encode($nombreCompleto) ?>
                </span>

            </div>


            <!-- Usuario -->

            <div class="account-data-item">

                <label>Usuario</label>

                <span>
                    <?= Html::encode($cuenta->username) ?>
                </span>

            </div>


            <!-- DNI -->

            <div class="account-data-item">

                <label>DNI</label>

                <span>
                    <?= Html::encode($cuenta->documento) ?>
                </span>

            </div>


            <!-- Legajo -->

            <div class="account-data-item">

                <label>Legajo</label>

                <span>
                    <?= Html::encode($cuenta->legajo) ?>
                </span>

            </div>


            <!-- Condición -->

            <div class="account-data-item">

                <label>Condición</label>

                <span>
                    <?= Html::encode($tipoEmpleado) ?>
                </span>

            </div>


            <!-- Oficina -->

            <div class="account-data-item">

                <label>Oficina</label>

                <span>
                    <?= Html::encode($cuenta->oficina) ?>
                </span>

            </div>


        </div>

    </div>


    <!-- ==========================================================
         CONFIGURACIÓN DE CUENTA
         ========================================================== -->

    <div class="detail-card">

        <div class="detail-title">

            <i class="fa-solid fa-user-gear"></i>

            Configuración de Cuenta

        </div>


        <div class="account-form">


            <!-- ==================================================
                 NOMBRE
                 ================================================== -->

            <div class="form-group">

                <label for="cuenta-nombre">
                    Nombre completo
                </label>

                <input
                    type="text"
                    id="cuenta-nombre"
                    class="form-control"
                    value="<?= Html::encode($nombreCompleto) ?>"
                >

            </div>


            <!-- ==================================================
                 EMAIL
                 ================================================== -->

            <div class="form-group">

                <label for="cuenta-email">
                    Correo electrónico
                </label>

                <input
                    type="email"
                    id="cuenta-email"
                    class="form-control"
                    value="<?= Html::encode($cuenta->email) ?>"
                >

            </div>


            <!-- ==================================================
                 TELEFONO
                 ================================================== -->

            <div class="form-group">

                <label for="cuenta-telefono">
                    Teléfono
                </label>

                <input
                    type="text"
                    id="cuenta-telefono"
                    class="form-control"
                    value="<?= Html::encode($cuenta->telefono) ?>"
                >

            </div>


            <!-- ==================================================
                 DEPENDENCIA
                 ================================================== -->

            <div class="form-group">

                <label for="cuenta-dependencia">
                    Dependencia
                </label>

                <input
                    type="text"
                    id="cuenta-dependencia"
                    class="form-control"
                    value="<?= Html::encode($cuenta->dependencia) ?>"
                >

            </div>


            <!-- ==================================================
                 BOTONES
                 ================================================== -->

            <div class="account-form-buttons">


                <!-- GUARDAR -->

                <button
                    type="button"
                    class="primary-button"
                    id="btnGuardarCuenta"
                >

                    <i class="fa-solid fa-check"></i>

                    Guardar cambios

                </button>


              


            </div>

        </div>

    </div>

<!-- ==========================================================
     MODAL GUARDAR CAMBIOS
     ========================================================== -->

<div
    id="modalGuardarCuenta"
    class="account-modal"
>

    <div class="account-modal-box">

        <!-- X -->

        <button
            type="button"
            class="account-modal-close"
            id="cerrarModalGuardar"
            aria-label="Cerrar"
        >
            <i class="fa-solid fa-xmark"></i>
        </button>


        <!-- ICONO -->

        <div class="account-modal-icon">
            <i class="fa-solid fa-check"></i>
        </div>


        <!-- TÍTULO -->

        <h3>
            Guardar cambios
        </h3>


        <!-- MENSAJE -->

        <p>
            Los cambios se guardarán cuando esta función esté habilitada.
        </p>


        <!-- BOTÓN CERRAR -->

        <button
            type="button"
            class="primary-button account-modal-button"
            id="btnCerrarGuardar"
        >
            Cerrar
        </button>

    </div>

</div>
    <!-- ==========================================================
         OPCIONES DE CUENTA
         ========================================================== -->

<!-- ==========================================================
     OPCIONES DE CUENTA
     ========================================================== -->

<div class="account-options">


    <!-- ======================================================
         CAMBIAR CONTRASEÑA
         ====================================================== -->

    <div
        class="account-option"
        id="btnCambiarPassword"
    >

        <i class="fa-solid fa-lock"></i>

        <span>
            Cambiar contraseña
        </span>

        <i class="fa-solid fa-chevron-right"></i>

    </div>


    <!-- ======================================================
         NOTIFICACIONES
         ====================================================== -->

    <div
        class="account-option"
        id="btnNotificaciones"
    >

        <i class="fa-regular fa-bell"></i>

        <span>
            Notificaciones
        </span>

        <b>
            Activadas
        </b>

    </div>


    <!-- ======================================================
         SINCRONIZAR
         ====================================================== -->

    <div
        class="account-option"
        id="btnSincronizar"
    >

        <i class="fa-solid fa-rotate"></i>

        <span>
            Sincronizar datos
        </span>

        <i class="fa-solid fa-chevron-right"></i>

    </div>


</div>


<!-- ==========================================================
     INFORMACIÓN DE LA APLICACIÓN
     ========================================================== -->

<div class="about-card">

    <strong>
        ePan Patrimonial
    </strong>

    <span>
        Versión 1.0.0
    </span>

    <span>
        Integración SICOPRO: simulada
    </span>

</div>


<!-- ==========================================================
     MODAL CAMBIAR CONTRASEÑA
     ========================================================== -->

<div
    id="modalCambiarPassword"
    class="account-modal"
>

    <div class="account-modal-box">

        <button
            type="button"
            class="account-modal-close"
            data-modal="modalCambiarPassword"
            aria-label="Cerrar"
        >
            <i class="fa-solid fa-xmark"></i>
        </button>


        <div class="account-modal-icon">
            <i class="fa-solid fa-lock"></i>
        </div>


        <h3>
            Cambiar contraseña
        </h3>


        <p>
            Esta función estará disponible próximamente.
        </p>


        <button
            type="button"
            class="primary-button account-modal-button"
            data-modal="modalCambiarPassword"
        >
            Cerrar
        </button>

    </div>

</div>


<!-- ==========================================================
     MODAL NOTIFICACIONES
     ========================================================== -->

<div
    id="modalNotificaciones"
    class="account-modal"
>

    <div class="account-modal-box">

        <button
            type="button"
            class="account-modal-close"
            data-modal="modalNotificaciones"
            aria-label="Cerrar"
        >
            <i class="fa-solid fa-xmark"></i>
        </button>


        <div class="account-modal-icon">
            <i class="fa-regular fa-bell"></i>
        </div>


        <h3>
            Notificaciones
        </h3>


        <p>
            Las notificaciones están activadas.
        </p>


        <button
            type="button"
            class="primary-button account-modal-button"
            data-modal="modalNotificaciones"
        >
            Cerrar
        </button>

    </div>

</div>


<!-- ==========================================================
     MODAL SINCRONIZAR
     ========================================================== -->

<div
    id="modalSincronizar"
    class="account-modal"
>

    <div class="account-modal-box">

        <button
            type="button"
            class="account-modal-close"
            data-modal="modalSincronizar"
            aria-label="Cerrar"
        >
            <i class="fa-solid fa-xmark"></i>
        </button>


        <div class="account-modal-icon">
            <i class="fa-solid fa-rotate"></i>
        </div>


        <h3>
            Sincronizar datos
        </h3>


        <p>
            La sincronización con SICOPRO estará disponible próximamente.
        </p>


        <button
            type="button"
            class="primary-button account-modal-button"
            data-modal="modalSincronizar"
        >
            Cerrar
        </button>

    </div>

</div>



<style>
.profile-avatar {
    width: 96px;
    height: 96px;
    min-width: 96px;
    border-radius: 50%;
    overflow: hidden;
    display: flex;
    align-items: center;
    justify-content: center;
    background: #f1f5f9;
}

.profile-avatar img {
    width: 100%;
    height: 100%;
    display: block;
    object-fit: cover;
    border-radius: 50%;
}
/* ==========================================================
   MODALES
   ========================================================== */

.account-modal {

    display: none;

    position: fixed;

    inset: 0;

    z-index: 9999;

    background: rgba(0, 0, 0, 0.45);

    align-items: center;

    justify-content: center;

    padding: 20px;

    opacity: 0;

    transition: opacity .25s ease;

}


/* Modal visible */

.account-modal.show {

    display: flex;

    opacity: 1;

}


/* ==========================================================
   CAJA DEL MODAL
   ========================================================== */

.account-modal-box {

    position: relative;

    width: 100%;

    max-width: 420px;

    background: #ffffff;

    border-radius: 18px;

    padding: 30px 25px 25px;

    text-align: center;

    box-shadow: 0 15px 45px rgba(0, 0, 0, .20);

    transform: translateY(15px) scale(.97);

    transition: transform .25s ease;

}


/* Animación */

.account-modal.show .account-modal-box {

    transform: translateY(0) scale(1);

}


/* ==========================================================
   BOTÓN X
   ========================================================== */

.account-modal-close {

    position: absolute;

    top: 12px;

    right: 12px;

    width: 34px;

    height: 34px;

    border: none;

    background: transparent;

    color: #777;

    border-radius: 50%;

    cursor: pointer;

    font-size: 18px;

    display: flex;

    align-items: center;

    justify-content: center;

    transition: .2s;

}


.account-modal-close:hover {

    background: #f1f1f1;

    color: #333;

}


/* ==========================================================
   ICONO
   ========================================================== */

.account-modal-icon {

    width: 60px;

    height: 60px;

    margin: 0 auto 15px;

    border-radius: 50%;

    background: #f1f5f9;

    display: flex;

    align-items: center;

    justify-content: center;

    font-size: 25px;

}


/* ==========================================================
   TITULO
   ========================================================== */

.account-modal-box h3 {

    margin: 0 0 10px;

    font-size: 20px;

    font-weight: 700;

    color: #1f2937;

}


/* ==========================================================
   TEXTO
   ========================================================== */

.account-modal-box p {

    margin: 0 0 25px;

    font-size: 14px;

    line-height: 1.5;

    color: #6b7280;

}


/* ==========================================================
   BOTÓN CERRAR
   ========================================================== */

.account-modal-button {

    width: 100%;

    justify-content: center;

}

</style>


<script>

    // ================================================================
// MODAL GUARDAR CAMBIOS
// ================================================================

const btnGuardarCuenta = document.getElementById('btnGuardarCuenta');
const modalGuardarCuenta = document.getElementById('modalGuardarCuenta');
const cerrarModalGuardar = document.getElementById('cerrarModalGuardar');
const btnCerrarGuardar = document.getElementById('btnCerrarGuardar');


// ABRIR

if (btnGuardarCuenta && modalGuardarCuenta) {

    btnGuardarCuenta.addEventListener('click', function () {

        modalGuardarCuenta.classList.add('show');

    });

}


// CERRAR CON X

if (cerrarModalGuardar && modalGuardarCuenta) {

    cerrarModalGuardar.addEventListener('click', function () {

        modalGuardarCuenta.classList.remove('show');

    });

}


// CERRAR CON BOTÓN

if (btnCerrarGuardar && modalGuardarCuenta) {

    btnCerrarGuardar.addEventListener('click', function () {

        modalGuardarCuenta.classList.remove('show');

    });

}


// CERRAR HACIENDO CLICK FUERA

if (modalGuardarCuenta) {

    modalGuardarCuenta.addEventListener('click', function (event) {

        if (event.target === modalGuardarCuenta) {

            modalGuardarCuenta.classList.remove('show');

        }

    });

}
    // ========================================================
// GUARDAR CAMBIOS
// ========================================================
//
// Este modal NO se cierra automáticamente.
// Solo se cierra con X o con el botón Cerrar.
//


if (btnGuardarCuenta) {

    btnGuardarCuenta.addEventListener('click', function () {

        abrirModal('modalGuardarCuenta');

    });

}

document.addEventListener('DOMContentLoaded', function () {


    // ========================================================
    // ABRIR MODAL
    // ========================================================

    function abrirModal(id) {

        const modal = document.getElementById(id);

        if (!modal) {
            return;
        }

        modal.classList.add('show');


        // Guardamos el temporizador para poder cancelarlo
        // si el usuario cierra manualmente.

        clearTimeout(modal.autoCloseTimer);


        // Se cierra automáticamente después de 4 segundos.

        modal.autoCloseTimer = setTimeout(function () {

            cerrarModal(id);

        }, 4000);

    }


    // ========================================================
    // CERRAR MODAL
    // ========================================================

    function cerrarModal(id) {

        const modal = document.getElementById(id);

        if (!modal) {
            return;
        }

        clearTimeout(modal.autoCloseTimer);

        modal.classList.remove('show');


        // Después de la animación eliminamos display:flex.

        setTimeout(function () {

            if (!modal.classList.contains('show')) {
                modal.style.display = '';
            }

        }, 250);

    }


    // ========================================================
    // CAMBIAR CONTRASEÑA
    // ========================================================

    const btnPassword = document.getElementById(
        'btnCambiarPassword'
    );

    if (btnPassword) {

        btnPassword.addEventListener('click', function () {

            abrirModal('modalCambiarPassword');

        });

    }


    // ========================================================
    // NOTIFICACIONES
    // ========================================================

    const btnNotificaciones = document.getElementById(
        'btnNotificaciones'
    );

    if (btnNotificaciones) {

        btnNotificaciones.addEventListener('click', function () {

            abrirModal('modalNotificaciones');

        });

    }


    // ========================================================
    // SINCRONIZAR
    // ========================================================

    const btnSincronizar = document.getElementById(
        'btnSincronizar'
    );

    if (btnSincronizar) {

        btnSincronizar.addEventListener('click', function () {

            abrirModal('modalSincronizar');

        });

    }


    // ========================================================
    // BOTONES X Y CERRAR
    // ========================================================

    document.querySelectorAll(
        '.account-modal-close, .account-modal-button'
    ).forEach(function (button) {

        button.addEventListener('click', function () {

            const modalId = this.getAttribute('data-modal');

            cerrarModal(modalId);

        });

    });


    // ========================================================
    // CERRAR HACIENDO CLICK FUERA DEL MODAL
    // ========================================================

    document.querySelectorAll('.account-modal').forEach(
        function (modal) {

            modal.addEventListener('click', function (event) {

                if (event.target === modal) {

                    cerrarModal(modal.id);

                }

            });

        }
    );


});

</script>

<!-- ==============================================================
     JAVASCRIPT
     ============================================================== -->

<?php

$this->registerJs(<<<JS

// ================================================================
// MODAL GUARDAR CAMBIOS
// ================================================================

$('#btnGuardarCuenta').on('click', function () {

    $('#modalGuardarCuenta').addClass('show');

});


// ================================================================
// CERRAR MODAL GUARDAR - X
// ================================================================

$('#cerrarModalGuardar').on('click', function () {

    $('#modalGuardarCuenta').removeClass('show');

});


// ================================================================
// CERRAR MODAL GUARDAR - BOTÓN CERRAR
// ================================================================

$('#btnCerrarGuardar').on('click', function () {

    $('#modalGuardarCuenta').removeClass('show');

});


// ================================================================
// CERRAR MODAL GUARDAR - CLICK FUERA
// ================================================================

$('#modalGuardarCuenta').on('click', function (event) {

    if (event.target === this) {

        $('#modalGuardarCuenta').removeClass('show');

    }

});


// ================================================================
// CAMBIAR CONTRASEÑA
// ================================================================

$('#btnCambiarPassword').on('click', function () {

    const modal = $('#modalCambiarPassword');

    modal.addClass('show');

    clearTimeout(modal.data('timer'));

    const timer = setTimeout(function () {

        modal.removeClass('show');

    }, 4000);

    modal.data('timer', timer);

});


// ================================================================
// NOTIFICACIONES
// ================================================================

$('#btnNotificaciones').on('click', function () {

    const modal = $('#modalNotificaciones');

    modal.addClass('show');

    clearTimeout(modal.data('timer'));

    const timer = setTimeout(function () {

        modal.removeClass('show');

    }, 4000);

    modal.data('timer', timer);

});


// ================================================================
// SINCRONIZAR
// ================================================================

$('#btnSincronizar').on('click', function () {

    const modal = $('#modalSincronizar');

    modal.addClass('show');

    clearTimeout(modal.data('timer'));

    const timer = setTimeout(function () {

        modal.removeClass('show');

    }, 4000);

    modal.data('timer', timer);

});


// ================================================================
// CERRAR X DE LOS OTROS MODALES
// ================================================================

$('.account-modal-close').on('click', function () {

    const modalId = $(this).data('modal');

    if (modalId) {

        $('#' + modalId).removeClass('show');

    } else {

        $(this).closest('.account-modal').removeClass('show');

    }

});


// ================================================================
// CERRAR BOTONES "CERRAR"
// ================================================================

$('.account-modal-button').on('click', function () {

    const modalId = $(this).data('modal');

    if (modalId) {

        $('#' + modalId).removeClass('show');

    } else {

        $(this).closest('.account-modal').removeClass('show');

    }

});


// ================================================================
// CERRAR AL HACER CLICK FUERA
// ================================================================

$('.account-modal').on('click', function (event) {

    if (event.target === this) {

        $(this).removeClass('show');

    }

});


// ================================================================
// CANCELAR CAMBIOS
// ================================================================

$('#btnCancelarCuenta').on('click', function () {

    $('#cuenta-nombre').val(
        '{$nombreCompleto}'
    );

    $('#cuenta-email').val(
        '{$cuenta->email}'
    );

    $('#cuenta-telefono').val(
        '{$cuenta->telefono}'
    );

    $('#cuenta-dependencia').val(
        '{$cuenta->dependencia}'
    );

});

JS
);

?>
