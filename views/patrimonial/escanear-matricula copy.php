
<?php

use yii\helpers\Url;

$this->title = 'Escanear Matrícula';
?>
<?php

$this->registerMetaTag([
    'name' => 'csrf-token',
    'content' => Yii::$app->request->csrfToken
]);

?>
<style>

/* =========================================================
   ESCÁNER DE MATRÍCULA
   ========================================================= */

.scanner-page {
    width: 100%;
    max-width: 100%;
    box-sizing: border-box;
}


/* =========================================================
   AYUDA
   ========================================================= */

.scanner-help {
    margin-bottom: 16px;
    display: flex;
    flex-direction: column;
    gap: 4px;
}

.scanner-help strong {
    font-size: 18px;
    color: #1f2937;
}

.scanner-help span {
    font-size: 14px;
    color: #6b7280;
}


/* =========================================================
   CÁMARA
   ========================================================= */

/*
 * IMPORTANTE:
 * Fijamos la proporción de la cámara.
 * Esto evita que aparezca una zona negra enorme debajo.
 */

.camera-box {
    position: relative !important;

    width: 100% !important;

    height: auto !important;

    aspect-ratio: 16 / 9 !important;

    min-height: 0 !important;
    max-height: none !important;

    overflow: hidden !important;

    border-radius: 18px;

    background: #000;

    box-sizing: border-box;
}


/* Video */

#camera {
    display: block !important;

    width: 100% !important;
    height: 100% !important;

    min-height: 0 !important;
    max-height: none !important;

    margin: 0 !important;
    padding: 0 !important;

    object-fit: cover !important;

    background: #000;

    /*
     * No aplicar transformaciones al video.
     */
    transform: none !important;
}


/* =========================================================
   OVERLAY
   ========================================================= */

.camera-overlay {
    position: absolute !important;

    left: 0 !important;
    top: 0 !important;
    right: 0 !important;
    bottom: 0 !important;

    width: 100% !important;
    height: 100% !important;

    pointer-events: none !important;

    z-index: 10 !important;
}


/*
 * MUY IMPORTANTE:
 *
 * Eliminamos cualquier marco azul que pueda venir
 * de CSS anterior.
 */

.camera-overlay::before,
.camera-overlay::after {
    content: none !important;

    display: none !important;

    border: none !important;
}


/* =========================================================
   MARCO ÚNICO
   ========================================================= */

.scan-frame {
    position: absolute !important;

    /*
     * Tamaño del recuadro.
     */
    width: 72% !important;
    height: 26% !important;

    left: 50% !important;
    top: 50% !important;

    transform: translate(-50%, -50%) !important;

    margin: 0 !important;
    padding: 0 !important;

    border: none !important;
    outline: none !important;

    background: transparent !important;

    box-sizing: border-box !important;

    z-index: 20 !important;
}


/* =========================================================
   ELIMINAR CUALQUIER BORDE DEL MARCO
   ========================================================= */

.scan-frame::before,
.scan-frame::after {
    content: none !important;

    display: none !important;

    border: none !important;
}


/* =========================================================
   ESQUINAS
   ========================================================= */

.scan-frame .corner {
    position: absolute !important;

    width: 34px !important;
    height: 34px !important;

    margin: 0 !important;
    padding: 0 !important;

    background: transparent !important;

    box-sizing: border-box !important;

    border-color: #ffffff !important;
    border-style: solid !important;

    z-index: 30 !important;
}


/* =========================================================
   ARRIBA IZQUIERDA
   ========================================================= */

.scan-frame .corner.tl {
    left: 0 !important;
    top: 0 !important;

    right: auto !important;
    bottom: auto !important;

    border-width: 3px 0 0 3px !important;

    border-radius: 5px 0 0 0 !important;
}


/* =========================================================
   ARRIBA DERECHA
   ========================================================= */

.scan-frame .corner.tr {
    right: 0 !important;
    top: 0 !important;

    left: auto !important;
    bottom: auto !important;

    border-width: 3px 3px 0 0 !important;

    border-radius: 0 5px 0 0 !important;
}


/* =========================================================
   ABAJO IZQUIERDA
   ========================================================= */

.scan-frame .corner.bl {
    left: 0 !important;
    bottom: 0 !important;

    right: auto !important;
    top: auto !important;

    border-width: 0 0 3px 3px !important;

    border-radius: 0 0 0 5px !important;
}


/* =========================================================
   ABAJO DERECHA
   ========================================================= */

.scan-frame .corner.br {
    right: 0 !important;
    bottom: 0 !important;

    left: auto !important;
    top: auto !important;

    border-width: 0 3px 3px 0 !important;

    border-radius: 0 0 5px 0 !important;
}


/* =========================================================
   LÍNEA DE ESCANEO
   ========================================================= */
/*
.scan-line {
    position: absolute !important;

    left: 5% !important;
    right: 5% !important;

    top: 50% !important;

    width: auto !important;
    height: 2px !important;

    transform: translateY(-50%) !important;

    margin: 0 !important;
    padding: 0 !important;

    background: rgba(255, 255, 255, 0.65) !important;

    border: none !important;

    box-shadow: none !important;

    z-index: 25 !important;
}*/


/* =========================================================
   ESTADO OCR
   ========================================================= */

.scanner-status {
    position: absolute !important;

    left: 50% !important;
    bottom: 14px !important;

    transform: translateX(-50%) !important;

    z-index: 50 !important;

    background: rgba(0, 0, 0, 0.72) !important;

    color: #fff !important;

    padding: 7px 14px !important;

    border-radius: 20px !important;

    font-size: 12px !important;

    white-space: nowrap;

    max-width: 90%;

    overflow: hidden;

    text-overflow: ellipsis;
}


/* =========================================================
   CONTROLES
   ========================================================= */

.scanner-controls {
    display: flex;

    align-items: center;
    justify-content: center;

    gap: 14px;

    margin-top: 18px;
}


/* Botón cámara */

.round-camera {
    width: 58px;
    height: 58px;

    border: none;

    border-radius: 50%;

    background: #1683ff;

    color: #fff;

    display: flex;

    align-items: center;
    justify-content: center;

    cursor: pointer;

    font-size: 20px;

    box-shadow:
        0 5px 15px rgba(22, 131, 255, 0.25);

    transition:
        transform 0.15s ease,
        box-shadow 0.15s ease;
}

.round-camera:hover {
    transform: scale(1.05);
}

.round-camera:active {
    transform: scale(0.96);
}


/* Botón manual */

.secondary-button {
    min-height: 46px;

    padding: 0 18px;

    border: 1px solid #d1d5db;

    border-radius: 10px;

    background: #fff;

    color: #374151;

    cursor: pointer;

    font-size: 14px;

    display: flex;

    align-items: center;

    gap: 8px;
}

.secondary-button:hover {
    background: #f9fafb;
}


/* =========================================================
   RESULTADO
   ========================================================= */

.scan-result {
    margin-top: 20px;

    padding: 18px;

    border-radius: 14px;

    background: #f8fafc;

    border: 1px solid #e5e7eb;

    display: flex;

    flex-direction: column;

    gap: 9px;
}

.scan-result.hidden {
    display: none;
}

.scan-result label {
    font-size: 13px;

    font-weight: 600;

    color: #374151;
}

.scan-result input {
    width: 100%;

    box-sizing: border-box;

    height: 44px;

    padding: 0 13px;

    border: 1px solid #d1d5db;

    border-radius: 9px;

    font-size: 16px;

    text-transform: uppercase;

    outline: none;
}

.scan-result input:focus {
    border-color: #1683ff;

    box-shadow:
        0 0 0 3px rgba(22, 131, 255, 0.12);
}

.scan-result small {
    color: #6b7280;

    font-size: 12px;

    line-height: 1.4;
}


/* Botón buscar */

.primary-button {
    min-height: 46px;

    margin-top: 6px;

    border: none;

    border-radius: 10px;

    background: #1683ff;

    color: #fff;

    font-size: 14px;

    font-weight: 600;

    cursor: pointer;

    display: flex;

    align-items: center;
    justify-content: center;

    gap: 8px;
}

.primary-button:hover {
    background: #0d73e3;
}


/* =========================================================
   CONSEJO
   ========================================================= */

.scanner-tip {
    margin-top: 16px;

    padding: 12px 14px;

    border-radius: 10px;

    background: #f3f7fb;

    color: #5b6470;

    display: flex;

    align-items: flex-start;

    gap: 9px;

    font-size: 12px;

    line-height: 1.45;
}

.scanner-tip i {
    margin-top: 2px;

    color: #1683ff;
}


/* =========================================================
   CELULAR
   ========================================================= */

@media (max-width: 600px) {

    .camera-box {
        aspect-ratio: 4 / 3 !important;
    }

    .scan-frame {
        width: 82% !important;
        height: 24% !important;
    }

    .scan-frame .corner {
        width: 28px !important;
        height: 28px !important;
    }

    .scanner-status {
        bottom: 10px !important;

        font-size: 11px !important;

        padding: 6px 11px !important;
    }

    .scanner-controls {
        gap: 10px;
    }

    .round-camera {
        width: 54px;
        height: 54px;
    }

    .secondary-button {
        padding: 0 14px;

        font-size: 13px;
    }
}

</style>


<div class="scanner-page">

    <div class="scanner-help">

        <strong>
            Apuntá a la matrícula del bien
        </strong>

        <span>
            El sistema intentará reconocer automáticamente el número escrito.
        </span>

    </div>


    <div class="camera-box">

        <video
            id="camera"
            autoplay
            playsinline
            muted>
        </video>


        <div class="camera-overlay">

            <div class="scan-frame">

                <div class="corner tl"></div>

                <div class="corner tr"></div>

                <div class="corner bl"></div>

                <div class="corner br"></div>                

            </div>

        </div>


        <div
            id="ocr-status"
            class="scanner-status">

            Preparando cámara...

        </div>

    </div>


    <div class="scanner-controls">

        <button
            type="button"
            class="round-camera"
            id="captureBtn">

            <i class="fa-solid fa-camera"></i>

        </button>


        <button
            type="button"
            class="secondary-button"
            id="manualBtn">

            <i class="fa-solid fa-keyboard"></i>

            Ingresar manualmente

        </button>

    </div>


    <div
        id="result-panel"
        class="scan-result hidden">

        <label for="matriculaResult">
            Número detectado
        </label>

        <input
            id="matriculaResult"
            type="text"
            placeholder="MAT-2024-000123"
        >

        <small>
            Corregilo si la escritura a mano no fue reconocida correctamente.
        </small>


        <button
            type="button"
            class="primary-button"
            id="buscarBtn">

            <i class="fa-solid fa-magnifying-glass"></i>

            Buscar en SICOPRO

        </button>

    </div>


    <div class="scanner-tip">

        <i class="fa-regular fa-lightbulb"></i>

        <span>
            Consejo: buena iluminación, cámara quieta y que toda la matrícula
            quede dentro del recuadro.
        </span>

    </div>

</div>



<script>

async function iniciarCamara() {

    const video =
        document.getElementById('camera');

    const status =
        document.getElementById('ocr-status');


    try {

        console.log(
            'URL:',
            window.location.href
        );

        console.log(
            'Protocol:',
            window.location.protocol
        );

        console.log(
            'Secure:',
            window.isSecureContext
        );

        console.log(
            'mediaDevices:',
            navigator.mediaDevices
        );


        if (!navigator.mediaDevices) {

            throw new Error(
                'navigator.mediaDevices no está disponible. La página no está en un contexto seguro.'
            );

        }


        if (!navigator.mediaDevices.getUserMedia) {

            throw new Error(
                'getUserMedia no está disponible en este navegador.'
            );

        }


        status.textContent =
            'Solicitando acceso a la cámara...';


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


        video.srcObject = stream;


        await video.play();


        status.textContent =
            'Apuntá a la matrícula';


        console.log(
            'Cámara iniciada correctamente'
        );


    } catch (error) {

        console.error(
            'ERROR DE CÁMARA:',
            error
        );


        status.textContent =
            'Error de cámara: ' +
            error.message;

    }

}


/* =========================================================
   INICIO
   ========================================================= */

document.addEventListener(
    'DOMContentLoaded',
    function () {

        iniciarCamara();

    }
);

</script>

<script>



async function enviarImagenOCR(blob) {

    const status = document.getElementById('ocr-status');
    const panel = document.getElementById('result-panel');
    const campo = document.getElementById('matriculaResult');

    status.textContent = 'Analizando código...';

    const formData = new FormData();

    formData.append(
        'imagen',
        blob,
        'matricula.jpg'
    );

    const url =
        '<?= Url::to(["patrimonial/reconocer-matricula"]) ?>';

    console.log('=================================');
    console.log('OCR URL:', url);
    console.log('Blob:', blob);
    console.log('=================================');

    try {

        const respuesta = await fetch(
            url,
            {
                method: 'POST',

                headers: {
                    'X-CSRF-Token':
                        document.querySelector(
                            'meta[name="csrf-token"]'
                        ).getAttribute('content'),

                    'X-Requested-With':
                        'XMLHttpRequest'
                },

                body: formData
            }
        );

        console.log('HTTP STATUS:', respuesta.status);
        console.log('HTTP OK:', respuesta.ok);

        const textoRespuesta =
            await respuesta.text();

        console.log(
            'RESPUESTA DEL SERVIDOR:',
            textoRespuesta
        );

        /*
         * Intentamos convertir la respuesta
         * a JSON
         */

        let data;

        try {

            data =
                JSON.parse(textoRespuesta);

        } catch (e) {

            console.error(
                'LA RESPUESTA NO ES JSON:',
                textoRespuesta
            );

            status.textContent =
                'El servidor devolvió un error';

            alert(
                'El servidor no devolvió JSON.\n\n' +
                'HTTP: ' +
                respuesta.status +
                '\n\n' +
                textoRespuesta.substring(0, 500)
            );

            return;
        }


        console.log(
            'JSON OCR:',
            data
        );


        if (!data.ok) {

            status.textContent =
                'Error OCR';

            alert(
                data.error ||
                'Error desconocido'
            );

            return;
        }


        if (data.numero) {

            campo.value =
                data.numero;

            panel.classList.remove(
                'hidden'
            );

            status.textContent =
                'Número detectado: ' +
                data.numero;

            console.log(
                'NÚMERO:',
                data.numero
            );

        } else {

            status.textContent =
                'No se encontró ningún número';
            mostrarToast(
                'Se procesó la imagen pero no encontró el número de matricula.\n\n' 
                
                //+'Texto detectado:\n' +
                //(data.texto_ocr || '')
            );            
        }


    } catch (error) {

        console.error(
            'ERROR FETCH:',
            error
        );

        status.textContent =
            'Error de comunicación';

        alert(
            'ERROR FETCH:\n\n' +
            error.message
        );
    }

}

</script>

<div id="toastPatrimonial" class="toast-patrimonial"></div>

<style>
.toast-patrimonial {
    position: fixed;
    left: 50%;
    bottom: 90px;
    transform: translateX(-50%) translateY(20px);

    background: #dc3545;
    color: #fff;

    padding: 14px 20px;
    border-radius: 12px;

    font-size: 14px;
    font-weight: 600;

    box-shadow: 0 8px 25px rgba(0,0,0,.25);

    opacity: 0;
    visibility: hidden;

    transition:
        opacity .25s ease,
        transform .25s ease,
        visibility .25s ease;

    z-index: 99999;

    max-width: 90%;
    text-align: center;
}

.toast-patrimonial.show {
    opacity: 1;
    visibility: visible;
    transform: translateX(-50%) translateY(0);
}
</style>

<script>
function mostrarToast(mensaje) {

    const toast = document.getElementById('toastPatrimonial');

    if (!toast) return;

    toast.textContent = mensaje;

    toast.classList.add('show');

    clearTimeout(window.toastPatrimonialTimer);

    window.toastPatrimonialTimer = setTimeout(() => {

        toast.classList.remove('show');

    }, 3000);
}
</script>
<script>
window.EPAN = {
    buscarUrl: <?= json_encode(Url::to(['patrimonial/buscar'])) ?>,
    tipo: 'matricula',
    csrfToken: <?= json_encode(Yii::$app->request->getCsrfToken()) ?>
};
</script>

<script src="<?= Yii::getAlias('@web') ?>/js/epan-scanner.js"></script>

<script>

document.addEventListener('DOMContentLoaded', function () {

    const captureBtn =
        document.getElementById('captureBtn');

    const video =
        document.getElementById('camera');

    captureBtn.addEventListener('click', function () {

        if (!video.videoWidth || !video.videoHeight) {

            alert(
                'La cámara todavía no está lista.'
            );

            return;
        }

        const canvas =
            document.createElement('canvas');

        /*
         * Usamos la resolución real de la cámara
         */
        canvas.width = video.videoWidth;
        canvas.height = video.videoHeight;

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
         * Convertir imagen a JPEG
         */
        canvas.toBlob(
            function (blob) {

                if (!blob) {

                    alert(
                        'No se pudo capturar la imagen.'
                    );

                    return;
                }

                /*
                 * Mandar a OCR.space
                 */
                enviarImagenOCR(blob);

            },
            'image/jpeg',
            0.95
        );

    });

});

</script>
