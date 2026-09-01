<?php
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'Código QR';
$contenido = Url::to(['patrimonial/detalle', 'id' => $bien->id], true);
?>

<div class="page qr-page">
    <div class="qr-card">
        <div class="qr-label">MATRÍCULA DEL BIEN</div>
        <h1><?= Html::encode($bien->matricula) ?></h1>

        <div id="qrcode"></div>

        <p>Escaneá este código para consultar la información del bien.</p>
        <!--<div class="qr-url"><?php //Html::encode($contenido) ?></div>-->
    </div>

    <button class="primary-button" onclick="downloadQR()">
        <i class="fa-solid fa-download"></i> Guardar QR
    </button>

    <button class="secondary-button full" onclick="shareQR()">
        <i class="fa-solid fa-share-nodes"></i> Compartir QR
    </button>
</div>

<script src="https://cdn.jsdelivr.net/npm/qrcodejs@1.0.0/qrcode.min.js"></script>
<script>
const qrUrl = <?= json_encode($contenido) ?>;

new QRCode(document.getElementById("qrcode"), {
    text: qrUrl,
    width: 240,
    height: 240,
    correctLevel: QRCode.CorrectLevel.H
});

function downloadQR() {
    const canvas = document.querySelector("#qrcode canvas");
    if (!canvas) return;
    const a = document.createElement("a");
    a.href = canvas.toDataURL("image/png");
    a.download = "QR-<?= Html::encode($bien->matricula) ?>.png";
    a.click();
}

async function shareQR() {
    try {
        const canvas = document.querySelector("#qrcode canvas");

        if (!canvas) {
            alert("No se pudo obtener el código QR.");
            return;
        }

        // Convertir EL MISMO QR que se muestra en pantalla en una imagen
        const blob = await new Promise(resolve => {
            canvas.toBlob(resolve, "image/png");
        });

        if (!blob) {
            alert("No se pudo generar la imagen del QR.");
            return;
        }

        const file = new File(
            [blob],
            "QR-<?= Html::encode($bien->matricula) ?>.png",
            {
                type: "image/png"
            }
        );

        // Compartir la imagen del QR
        if (
            navigator.share &&
            navigator.canShare &&
            navigator.canShare({ files: [file] })
        ) {
            await navigator.share({
                title: "ePan Patrimonial",
                text: "<?= Html::encode($bien->matricula) ?>",
                files: [file]
            });

            return;
        }

        // Si no permite compartir archivos
        alert("Este dispositivo no permite compartir el QR como imagen.");

    } catch (error) {
        console.error("Error al compartir QR:", error);
        alert("No se pudo compartir el código QR.");
    }
}
</script>
