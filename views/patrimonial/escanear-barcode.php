<?php
use yii\helpers\Url;
use yii\helpers\Html;

$this->title = 'Escanear Código de Barras';
?>

<div class="scanner-page">
    <div class="scanner-help">
        <strong>Apuntá al código de barras</strong>
        <span>La cámara leerá el código y buscará el bien en SICOPRO.</span>
    </div>

    <div class="camera-box barcode-camera">
        <video id="camera" autoplay playsinline muted></video>
        <div class="camera-overlay green-overlay">
            <div class="corner tl"></div><div class="corner tr"></div>
            <div class="corner bl"></div><div class="corner br"></div>
        </div>
        <div id="barcode-status" class="scanner-status">Preparando cámara...</div>
    </div>

    <div class="barcode-manual">
        <label>Si no se puede leer, ingrese manualmente:</label>
        <div class="inline-input">
            <input id="barcodeResult" type="text" placeholder="Ej. 1234567890123">
            <button id="buscarBarcodeBtn"><i class="fa-solid fa-search"></i></button>
        </div>
    </div>

    <div class="scanner-tip">
        <i class="fa-solid fa-barcode"></i>
        <span>Acercá el código hasta que quede completo y enfocado dentro del recuadro.</span>
    </div>
</div>


<?= Html::hiddenInput(
    Yii::$app->request->csrfParam,
    Yii::$app->request->getCsrfToken()
) ?>


<script>
window.EPAN = {
    buscarUrl: <?= json_encode(Url::to(['patrimonial/buscar'])) ?>,
    tipo: 'barcode',
    csrfToken: <?= json_encode(Yii::$app->request->getCsrfToken()) ?>
};
</script>
<script src="<?= Yii::getAlias('@web') ?>/js/epan-scanner.js"></script>
<style>
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

.camera-box video {
    display: block !important;
    width: 100% !important;
    height: 100% !important;
    min-height: 0 !important;
    max-height: none !important;
    margin: 0 !important;
    padding: 0 !important;
    object-fit: cover !important;
    background: #000;
    transform: none !important;
}
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

/* Eliminar el rectángulo azul/verde anterior */
.camera-overlay::after {
    content: none !important;
    display: none !important;
}
@media (max-width: 600px) {
    .camera-box {
        aspect-ratio: 4 / 3 !important;
    }
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