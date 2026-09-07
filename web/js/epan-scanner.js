
(function () {

    'use strict';

    // =========================================================
    // EPAN SCANNER
    // OCR PATRIMONIAL MEDIANTE SERVIDOR
    //
    // Ejemplo:
    // 724-191973
    //
    // IMPORTANTE:
    // El OCR ya NO se ejecuta en el navegador.
    //
    // La fotografía se envía al servidor mediante:
    //
    // EPAN.ocrUrl
    //
    // =========================================================


    // =========================================================
    // ELEMENTOS HTML
    // =========================================================

    const video =
        document.getElementById('camera');

    const captureBtn =
        document.getElementById('captureBtn');

    const manualBtn =
        document.getElementById('manualBtn');

    const buscarBtn =
        document.getElementById('buscarBtn') ||
        document.getElementById('buscarBarcodeBtn');

    const resultPanel =
        document.getElementById('result-panel');

    const resultInput =
        document.getElementById('matriculaResult') ||
        document.getElementById('barcodeResult');

    const status =
        document.getElementById('ocr-status') ||
        document.getElementById('barcode-status');


    // =========================================================
    // VARIABLES
    // =========================================================

    let stream = null;

    let barcodeDetector = null;
    let barcodeScanning = false;
    let barcodeFrame = null;
    let barcodeDetectando = false;

    let procesandoOCR = false;


    // =========================================================
    // CONFIGURACIÓN
    // =========================================================

    const CONFIG = {

        // Ampliación del recorte.
        scale: 4,

        // Mínimo de dígitos para considerar
        // que puede existir un número patrimonial.
        minDigits: 3,

        // Separador patrimonial.
        separator: '-'

    };


    // =========================================================
    // UTILIDADES
    // =========================================================

    function setStatus(text) {

        if (status) {
            status.textContent = text;
        }

    }


    function mostrarMensaje(mensaje) {

        if (typeof mostrarToast === 'function') {

            mostrarToast(mensaje);

        } else {

            alert(mensaje);

        }

    }


    function sleep(ms) {

        return new Promise(function (resolve) {

            setTimeout(resolve, ms);

        });

    }


    // =========================================================
    // CÁMARA
    // =========================================================

    async function iniciarCamara() {

        if (!video) {

            console.error(
                'No existe #camera'
            );

            return;
        }


        try {

            setStatus(
                'Solicitando acceso a la cámara...'
            );


            if (
                !navigator.mediaDevices ||
                !navigator.mediaDevices.getUserMedia
            ) {

                throw new Error(
                    'El navegador no permite acceder a la cámara.'
                );

            }


            stream =
                await navigator.mediaDevices.getUserMedia({

                    video: {

                        facingMode: {
                            ideal: 'environment'
                        },

                        width: {
                            ideal: 1920,
                            min: 1280
                        },

                        height: {
                            ideal: 1080,
                            min: 720
                        }

                    },

                    audio: false

                });


            video.srcObject =
                stream;


            await video.play();


            console.log(
                '======================================'
            );

            console.log(
                'CÁMARA INICIADA'
            );

            console.log(
                'VIDEO:',
                video.videoWidth,
                'x',
                video.videoHeight
            );

            console.log(
                '======================================'
            );


            if (
                window.EPAN &&
                EPAN.tipo === 'barcode'
            ) {

                setStatus(
                    'Apuntá al código de barras'
                );

            } else {

                setStatus(
                    'Apuntá al número de matrícula'
                );

            }


        } catch (error) {

            console.error(
                'ERROR CÁMARA:',
                error
            );


            setStatus(
                'Error de cámara: ' +
                error.message
            );

        }

    }


    // =========================================================
    // LECTOR DE CÓDIGO DE BARRAS
    // =========================================================

    async function iniciarLectorBarcode() {

        console.log(
            '======================================'
        );

        console.log(
            'INICIANDO LECTOR DE CÓDIGO DE BARRAS'
        );

        console.log(
            '======================================'
        );


        // -----------------------------------------------------
        // Verificar disponibilidad
        // -----------------------------------------------------

        if (
            !('BarcodeDetector' in window)
        ) {

            console.warn(
                'BarcodeDetector no está disponible en este navegador.'
            );

            setStatus(
                'El navegador no dispone de lector de códigos de barras.'
            );

            return;

        }


        try {

            const formatos =
                await BarcodeDetector.getSupportedFormats();


            console.log(
                'FORMATOS SOPORTADOS:',
                formatos
            );


            // -------------------------------------------------
            // Formatos permitidos
            // -------------------------------------------------

            const formatosPermitidos = [

                'ean_13',
                'ean_8',
                'upc_a',
                'upc_e',
                'code_128',
                'code_39',
                'code_93',
                'codabar',
                'itf'

            ];


            const formatosDisponibles =
                formatosPermitidos.filter(
                    function (formato) {

                        return formatos.includes(
                            formato
                        );

                    }
                );


            console.log(
                'FORMATOS UTILIZADOS:',
                formatosDisponibles
            );


            if (
                !formatosDisponibles.length
            ) {

                throw new Error(
                    'El navegador no tiene un formato de código compatible.'
                );

            }


            barcodeDetector =
                new BarcodeDetector({

                    formats:
                        formatosDisponibles

                });


            barcodeScanning =
                true;


            setStatus(
                'Apuntá al código de barras'
            );


            escanearBarcode();


        } catch (error) {

            console.error(
                'ERROR INICIANDO LECTOR:',
                error
            );


            setStatus(
                'No se pudo iniciar el lector de códigos.'
            );

        }

    }


    // =========================================================
    // ESCANEAR CÓDIGO DE BARRAS
    // =========================================================

    // =========================================================
// ESCANEAR CÓDIGO DE BARRAS
// =========================================================

async function escanearBarcode() {

    if (!barcodeScanning) {
        return;
    }


    if (
        !barcodeDetector ||
        !video ||
        !video.videoWidth
    ) {

        barcodeFrame =
            requestAnimationFrame(
                escanearBarcode
            );

        return;

    }


    // -----------------------------------------------------
    // Evitar detecciones simultáneas
    // -----------------------------------------------------

    if (barcodeDetectando) {

        barcodeFrame =
            requestAnimationFrame(
                escanearBarcode
            );

        return;

    }


    barcodeDetectando = true;


    try {

        const resultados =
            await barcodeDetector.detect(
                video
            );


        if (
            resultados &&
            resultados.length > 0
        ) {

            const resultado =
                resultados[0];


            const codigo =
                resultado.rawValue;


            console.log(
                '======================================'
            );

            console.log(
                'CÓDIGO DE BARRAS DETECTADO:',
                codigo
            );

            console.log(
                'FORMATO:',
                resultado.format
            );

            console.log(
                '======================================'
            );


            if (!codigo) {
                return;
            }


            // -------------------------------------------------
            // Detener temporalmente el escaneo
            // -------------------------------------------------

            barcodeScanning = false;


            if (barcodeFrame) {

                cancelAnimationFrame(
                    barcodeFrame
                );

                barcodeFrame = null;

            }


            // -------------------------------------------------
            // Mostrar código
            // -------------------------------------------------

            if (resultInput) {

                resultInput.value =
                    codigo;

            }


            setStatus(
                'Código detectado: ' +
                codigo
            );


            // -------------------------------------------------
            // Liberar el bloqueo ANTES de buscar
            // -------------------------------------------------

            barcodeDetectando = false;


            // -------------------------------------------------
            // Buscar automáticamente
            // -------------------------------------------------

            try {

                await buscar(
                    codigo
                );

            } catch (error) {

                console.error(
                    'ERROR BUSCANDO CÓDIGO:',
                    error
                );

            }


            // -------------------------------------------------
            // VOLVER A ACTIVAR EL LECTOR
            // -------------------------------------------------

            // Si la búsqueda produjo una redirección,
            // la página ya estará navegando y esto no tendrá
            // efecto práctico.

            if (
                window.EPAN &&
                EPAN.tipo === 'barcode'
            ) {

                barcodeScanning = true;

                barcodeDetectando = false;

                barcodeFrame = null;


                setStatus(
                    'Apuntá al siguiente código de barras'
                );


                console.log(
                    '======================================'
                );

                console.log(
                    'LECTOR REACTIVADO'
                );

                console.log(
                    'LISTO PARA LEER OTRO CÓDIGO'
                );

                console.log(
                    '======================================'
                );


                barcodeFrame =
                    requestAnimationFrame(
                        escanearBarcode
                    );

            }


            return;

        }


    } catch (error) {

        console.error(
            'ERROR LEYENDO CÓDIGO:',
            error
        );

    } finally {

        barcodeDetectando = false;

    }


    // -----------------------------------------------------
    // Continuar escaneando
    // -----------------------------------------------------

    if (barcodeScanning) {

        barcodeFrame =
            requestAnimationFrame(
                escanearBarcode
            );

    }

}

    // =========================================================
    // OBTENER RECUADRO BLANCO
    // =========================================================

    function obtenerRecuadro() {

        const frame =
            document.querySelector(
                '.scan-frame'
            );


        if (!frame) {

            throw new Error(
                'No se encontró .scan-frame'
            );

        }


        if (!video) {

            throw new Error(
                'No existe el elemento de video.'
            );

        }


        const videoRect =
            video.getBoundingClientRect();


        const frameRect =
            frame.getBoundingClientRect();


        console.log(
            '======================================'
        );


        console.log(
            'VIDEO EN PANTALLA:',
            {

                x: videoRect.x,
                y: videoRect.y,

                width: videoRect.width,
                height: videoRect.height

            }
        );


        console.log(
            'RECUADRO BLANCO:',
            {

                x: frameRect.x,
                y: frameRect.y,

                width: frameRect.width,
                height: frameRect.height

            }
        );


        // -----------------------------------------------------
        // Coordenadas relativas al video
        // -----------------------------------------------------

        const relativeX =
            frameRect.left -
            videoRect.left;


        const relativeY =
            frameRect.top -
            videoRect.top;


        // -----------------------------------------------------
        // Escala video real / video mostrado
        // -----------------------------------------------------

        const scaleX =
            video.videoWidth /
            videoRect.width;


        const scaleY =
            video.videoHeight /
            videoRect.height;


        let x =
            relativeX *
            scaleX;


        let y =
            relativeY *
            scaleY;


        let width =
            frameRect.width *
            scaleX;


        let height =
            frameRect.height *
            scaleY;


        // -----------------------------------------------------
        // Limitar a los bordes
        // -----------------------------------------------------

        x =
            Math.max(
                0,
                Math.min(
                    x,
                    video.videoWidth
                )
            );


        y =
            Math.max(
                0,
                Math.min(
                    y,
                    video.videoHeight
                )
            );


        width =
            Math.min(
                width,
                video.videoWidth - x
            );


        height =
            Math.min(
                height,
                video.videoHeight - y
            );


        console.log(
            'RECORTE REAL:',
            {
                x,
                y,
                width,
                height
            }
        );


        console.log(
            '======================================'
        );


        return {

            x:
                Math.round(x),

            y:
                Math.round(y),

            width:
                Math.round(width),

            height:
                Math.round(height)

        };

    }


    // =========================================================
    // CAPTURAR SOLAMENTE EL RECUADRO
    // =========================================================

    function capturarRecuadro() {

        const crop =
            obtenerRecuadro();


        const canvas =
            document.createElement(
                'canvas'
            );


        canvas.width =
            crop.width *
            CONFIG.scale;


        canvas.height =
            crop.height *
            CONFIG.scale;


        const ctx =
            canvas.getContext(
                '2d',
                {
                    willReadFrequently: true
                }
            );


        ctx.imageSmoothingEnabled =
            true;


        ctx.imageSmoothingQuality =
            'high';


        ctx.drawImage(

            video,

            crop.x,
            crop.y,

            crop.width,
            crop.height,

            0,
            0,

            canvas.width,
            canvas.height

        );


        console.log(
            'FOTOGRAFÍA ORIGINAL:',
            crop.width,
            'x',
            crop.height
        );


        console.log(
            'IMAGEN AMPLIADA:',
            canvas.width,
            'x',
            canvas.height
        );


        return canvas;

    }


    // =========================================================
    // CREAR VERSION NORMAL
    // =========================================================

    function crearVersionNormal(source) {

        const canvas =
            document.createElement(
                'canvas'
            );


        canvas.width =
            source.width;


        canvas.height =
            source.height;


        const ctx =
            canvas.getContext(
                '2d',
                {
                    willReadFrequently: true
                }
            );


        ctx.drawImage(
            source,
            0,
            0
        );


        return canvas;

    }


    // =========================================================
    // ESCALA DE GRISES
    // =========================================================

    function crearVersionGrises(source) {

        const canvas =
            crearVersionNormal(
                source
            );


        const ctx =
            canvas.getContext(
                '2d',
                {
                    willReadFrequently: true
                }
            );


        const image =
            ctx.getImageData(
                0,
                0,
                canvas.width,
                canvas.height
            );


        const data =
            image.data;


        for (
            let i = 0;
            i < data.length;
            i += 4
        ) {

            const r =
                data[i];


            const g =
                data[i + 1];


            const b =
                data[i + 2];


            const gray =
                (
                    0.299 * r +
                    0.587 * g +
                    0.114 * b
                );


            data[i] =
                gray;


            data[i + 1] =
                gray;


            data[i + 2] =
                gray;

        }


        ctx.putImageData(
            image,
            0,
            0
        );


        return canvas;

    }


    // =========================================================
    // CONTRASTE
    // =========================================================

    function crearVersionContraste(source) {

        const canvas =
            crearVersionGrises(
                source
            );


        const ctx =
            canvas.getContext(
                '2d',
                {
                    willReadFrequently: true
                }
            );


        const image =
            ctx.getImageData(
                0,
                0,
                canvas.width,
                canvas.height
            );


        const data =
            image.data;


        for (
            let i = 0;
            i < data.length;
            i += 4
        ) {

            let value =
                data[i];


            value =
                (
                    value -
                    128
                ) *
                1.8 +
                128;


            value =
                Math.max(
                    0,
                    Math.min(
                        255,
                        value
                    )
                );


            data[i] =
                value;


            data[i + 1] =
                value;


            data[i + 2] =
                value;

        }


        ctx.putImageData(
            image,
            0,
            0
        );


        return canvas;

    }


    // =========================================================
    // UMBRAL
    // =========================================================

    function crearVersionUmbral(source) {

        const canvas =
            crearVersionGrises(
                source
            );


        const ctx =
            canvas.getContext(
                '2d',
                {
                    willReadFrequently: true
                }
            );


        const image =
            ctx.getImageData(
                0,
                0,
                canvas.width,
                canvas.height
            );


        const data =
            image.data;


        for (
            let i = 0;
            i < data.length;
            i += 4
        ) {

            const value =
                data[i];


            const result =
                value > 150
                    ? 255
                    : 0;


            data[i] =
                result;


            data[i + 1] =
                result;


            data[i + 2] =
                result;

        }


        ctx.putImageData(
            image,
            0,
            0
        );


        return canvas;

    }


    // =========================================================
    // CANVAS -> BLOB
    // =========================================================

    function canvasToBlob(canvas) {

        return new Promise(
            function (resolve, reject) {

                canvas.toBlob(

                    function (blob) {

                        if (!blob) {

                            reject(
                                new Error(
                                    'No se pudo convertir la imagen.'
                                )
                            );

                            return;

                        }


                        resolve(blob);

                    },

                    'image/jpeg',

                    0.92

                );

            }
        );

    }


    // =========================================================
    // NORMALIZAR NÚMERO PATRIMONIAL
    // =========================================================

    function normalizarNumeroPatrimonial(texto) {

        if (!texto) {
            return '';
        }


        let limpio =
            texto
                .toUpperCase()
                .trim();


        console.log(
            'TEXTO RECIBIDO:',
            limpio
        );


        // -----------------------------------------------------
        // Correcciones típicas de OCR
        // -----------------------------------------------------

        limpio =
            limpio

                .replace(
                    /O/g,
                    '0'
                )

                .replace(
                    /D/g,
                    '0'
                )

                .replace(
                    /I/g,
                    '1'
                )

                .replace(
                    /L/g,
                    '1'
                )

                .replace(
                    /Z/g,
                    '2'
                )

                .replace(
                    /S/g,
                    '5'
                )

                .replace(
                    /B/g,
                    '8'
                );


        // -----------------------------------------------------
        // Buscar formato:
        //
        // 724-191973
        // 724 191973
        // 724/191973
        // -----------------------------------------------------

        let encontrado =
            limpio.match(
                /\b(\d{2,5})\s*[-./]\s*(\d{4,10})\b/
            );


        if (encontrado) {

            return (
                encontrado[1] +
                CONFIG.separator +
                encontrado[2]
            );

        }


        // -----------------------------------------------------
        // Buscar dos grupos separados por espacios
        // -----------------------------------------------------

        encontrado =
            limpio.match(
                /\b(\d{2,5})\s+(\d{4,10})\b/
            );


        if (encontrado) {

            return (
                encontrado[1] +
                CONFIG.separator +
                encontrado[2]
            );

        }


        // -----------------------------------------------------
        // Buscar número continuo
        //
        // Ejemplo:
        //
        // 724191973
        // -----------------------------------------------------

        const numeros =
            limpio.match(
                /\b\d{7,15}\b/g
            );


        if (
            numeros &&
            numeros.length
        ) {

            const numero =
                numeros.sort(
                    function (a, b) {

                        return (
                            b.length -
                            a.length
                        );

                    }
                )[0];


            if (
                numero.length >= 7
            ) {

                const primerBloque =
                    numero.substring(
                        0,
                        3
                    );


                const segundoBloque =
                    numero.substring(
                        3
                    );


                return (
                    primerBloque +
                    CONFIG.separator +
                    segundoBloque
                );

            }

        }


        // -----------------------------------------------------
        // Último intento:
        // eliminar todo excepto números
        // -----------------------------------------------------

        const soloNumeros =
            limpio.replace(
                /[^0-9]/g,
                ''
            );


        if (
            soloNumeros.length <
            CONFIG.minDigits
        ) {

            return '';

        }


        if (
            soloNumeros.length >= 7
        ) {

            return (

                soloNumeros.substring(
                    0,
                    3
                ) +

                CONFIG.separator +

                soloNumeros.substring(
                    3
                )

            );

        }


        return soloNumeros;

    }


    // =========================================================
    // OBTENER URL OCR
    // =========================================================

    function obtenerOCRUrl() {

        if (
            !window.EPAN ||
            !EPAN.ocrUrl
        ) {

            console.error(
                'EPAN.ocrUrl no está definido.'
            );


            return null;

        }


        return EPAN.ocrUrl;

    }


    // =========================================================
    // ENVIAR IMAGEN AL SERVIDOR
    // =========================================================

    async function enviarImagenOCR(blob) {

        const url =
            obtenerOCRUrl();


        if (!url) {

            throw new Error(
                'No se configuró la URL del OCR.'
            );

        }


        if (!blob) {

            throw new Error(
                'No se recibió ninguna imagen.'
            );

        }


        console.log(
            '======================================'
        );


        console.log(
            'ENVIANDO IMAGEN AL OCR DEL SERVIDOR'
        );


        console.log(
            'OCR URL:',
            url
        );


        console.log(
            'BLOB:',
            blob.type,
            blob.size
        );


        console.log(
            '======================================'
        );


        setStatus(
            'Analizando fotografía...'
        );


        const formData =
            new FormData();


        formData.append(
            'imagen',
            blob,
            'matricula.jpg'
        );


        // -----------------------------------------------------
        // CSRF
        // -----------------------------------------------------

        const csrfToken =
            window.EPAN
                ? EPAN.csrfToken
                : null;


        const headers = {

            'X-Requested-With':
                'XMLHttpRequest'

        };


        if (csrfToken) {

            headers[
                'X-CSRF-Token'
            ] =
                csrfToken;

        }


        try {

            const respuesta =
                await fetch(

                    url,

                    {

                        method:
                            'POST',

                        credentials:
                            'same-origin',

                        headers:
                            headers,

                        body:
                            formData

                    }

                );


            console.log(
                'HTTP STATUS:',
                respuesta.status
            );


            console.log(
                'HTTP OK:',
                respuesta.ok
            );


            const textoRespuesta =
                await respuesta.text();


            console.log(
                'RESPUESTA OCR SERVIDOR:',
                textoRespuesta
            );


            if (!respuesta.ok) {

                throw new Error(
                    'HTTP ' +
                    respuesta.status +
                    ': ' +
                    textoRespuesta
                );

            }


            let data;


            try {

                data =
                    JSON.parse(
                        textoRespuesta
                    );

            } catch (errorJSON) {

                console.error(
                    'RESPUESTA OCR NO ES JSON:',
                    textoRespuesta
                );


                throw new Error(
                    'El servidor no devolvió JSON válido.'
                );

            }


            console.log(
                'JSON OCR:',
                data
            );


            if (!data.ok) {

                const mensaje =
                    data.error ||
                    data.mensaje ||
                    'No se pudo analizar la imagen.';


                setStatus(
                    mensaje
                );


                mostrarMensaje(
                    mensaje
                );


                return {

                    ok: false,

                    numero: '',

                    texto:
                        data.texto ||
                        data.texto_ocr ||
                        ''

                };

            }


            // -------------------------------------------------
            // Obtener número
            // -------------------------------------------------

            let numero =
                data.numero ||
                data.numero_patrimonial ||
                '';


            let textoOCR =
                data.texto ||
                data.texto_ocr ||
                '';


            // -------------------------------------------------
            // Si el servidor devuelve texto pero no
            // devuelve directamente el número, intentamos
            // extraerlo en JavaScript.
            // -------------------------------------------------

            if (
                !numero &&
                textoOCR
            ) {

                numero =
                    normalizarNumeroPatrimonial(
                        textoOCR
                    );

            }


            // -------------------------------------------------
            // Normalizar número
            // -------------------------------------------------

            if (numero) {

                numero =
                    normalizarNumeroPatrimonial(
                        numero
                    );

            }


            console.log(
                'NÚMERO OCR FINAL:',
                numero
            );


            console.log(
                'TEXTO OCR:',
                textoOCR
            );


            // -------------------------------------------------
            // Mostrar resultado
            // -------------------------------------------------

            if (
                numero &&
                resultInput
            ) {

                resultInput.value =
                    numero;


                if (resultPanel) {

                    resultPanel.classList.remove(
                        'hidden'
                    );

                }


                setStatus(
                    'Número detectado: ' +
                    numero
                );


                return {

                    ok: true,

                    numero:
                        numero,

                    texto:
                        textoOCR,

                    data:
                        data

                };

            }


            // -------------------------------------------------
            // No encontrado
            // -------------------------------------------------

            setStatus(
                'No se encontró ningún número.'
            );


            mostrarMensaje(
                'Se procesó la imagen pero no se encontró el número de matrícula.'
            );


            return {

                ok: false,

                numero: '',

                texto:
                    textoOCR,

                data:
                    data

            };


        } catch (error) {

            console.error(
                'ERROR OCR:',
                error
            );


            setStatus(
                'Error al comunicarse con el servidor OCR.'
            );


            mostrarMensaje(
                'Error al comunicarse con el servidor OCR.\n\n' +
                error.message
            );


            throw error;

        }

    }


    // =========================================================
    // ANALIZAR FOTOGRAFÍA
    // =========================================================

    async function analizarFotografia() {

        if (procesandoOCR) {

            console.log(
                'Ya existe un análisis en curso.'
            );

            return;

        }


        procesandoOCR =
            true;


        try {

            console.log(
                '======================================'
            );


            console.log(
                'INICIANDO ANÁLISIS DE FOTOGRAFÍA'
            );


            console.log(
                '======================================'
            );


            setStatus(
                'Tomando fotografía...'
            );


            // -------------------------------------------------
            // Capturar recuadro
            // -------------------------------------------------

            const fotografia =
                capturarRecuadro();


            // -------------------------------------------------
            // Crear versiones
            // -------------------------------------------------

            const versiones = [

                {
                    nombre:
                        'ORIGINAL',

                    canvas:
                        crearVersionNormal(
                            fotografia
                        )
                },

                {
                    nombre:
                        'GRISES',

                    canvas:
                        crearVersionGrises(
                            fotografia
                        )
                },

                {
                    nombre:
                        'CONTRASTE',

                    canvas:
                        crearVersionContraste(
                            fotografia
                        )
                },

                {
                    nombre:
                        'UMBRAL',

                    canvas:
                        crearVersionUmbral(
                            fotografia
                        )
                }

            ];


            console.log(
                'VERSIONES:',
                versiones.length
            );


            // -------------------------------------------------
            // Probar cada versión
            //
            // Esto es importante porque OCR.space puede
            // reconocer una versión mejor que otra.
            // -------------------------------------------------

            let numeroFinal =
                '';


            let textoFinal =
                '';


            for (
                let i = 0;
                i < versiones.length;
                i++
            ) {

                const version =
                    versiones[i];


                console.log(
                    '--------------------------------------'
                );


                console.log(
                    'PROCESANDO VERSIÓN:',
                    version.nombre
                );


                setStatus(
                    'Analizando imagen (' +
                    (i + 1) +
                    '/' +
                    versiones.length +
                    ')...'
                );


                try {

                    const blob =
                        await canvasToBlob(
                            version.canvas
                        );


                    const resultado =
                        await enviarImagenOCR(
                            blob
                        );


                    console.log(
                        'RESULTADO VERSIÓN:',
                        version.nombre,
                        resultado
                    );


                    if (
                        resultado &&
                        resultado.numero
                    ) {

                        numeroFinal =
                            resultado.numero;


                        textoFinal =
                            resultado.texto ||
                            '';


                        console.log(
                            'NÚMERO ENCONTRADO EN:',
                            version.nombre
                        );


                        break;

                    }


                    if (
                        resultado &&
                        resultado.texto
                    ) {

                        textoFinal =
                            resultado.texto;

                    }


                } catch (error) {

                    console.error(
                        'ERROR PROCESANDO VERSIÓN:',
                        version.nombre,
                        error
                    );

                }

            }


            // -------------------------------------------------
            // Mostrar resultado final
            // -------------------------------------------------

            console.log(
                '======================================'
            );


            console.log(
                'RESULTADO OCR FINAL:',
                {

                    numero:
                        numeroFinal,

                    texto:
                        textoFinal

                }
            );


            console.log(
                '======================================'
            );


            if (resultPanel) {

                resultPanel.classList.remove(
                    'hidden'
                );

            }


            if (resultInput) {

                resultInput.value =
                    numeroFinal;

            }


            if (numeroFinal) {

                setStatus(
                    'Número detectado: ' +
                    numeroFinal
                );


                console.log(
                    'NÚMERO PATRIMONIAL FINAL:',
                    numeroFinal
                );


            } else {

                setStatus(
                    'No pude reconocer el número. Acercá la cámara y probá nuevamente.'
                );


                console.log(
                    'NÚMERO PATRIMONIAL NO DETECTADO'
                );

            }


            return {

                numero:
                    numeroFinal,

                texto:
                    textoFinal

            };


        } finally {

            procesandoOCR =
                false;

        }

    }


    // =========================================================
    // BÚSQUEDA EN SICOPRO
    // =========================================================

    async function buscar(valor) {

        // -----------------------------------------------------
        // Normalizar
        // -----------------------------------------------------

        valor =
            String(
                valor || ''
            )
                .trim()
                .toUpperCase();


        // -----------------------------------------------------
        // Validar
        // -----------------------------------------------------

        if (!valor) {

            if (
                window.EPAN &&
                EPAN.tipo === 'barcode'
            ) {

                mostrarMensaje(
                    'Ingresá un código de barras.'
                );

            } else {

                mostrarMensaje(
                    'Ingresá un número patrimonial.'
                );

            }


            return;

        }


        // -----------------------------------------------------
        // Verificar EPAN
        // -----------------------------------------------------

        if (
            !window.EPAN ||
            !EPAN.buscarUrl
        ) {

            console.error(
                'EPAN.buscarUrl no está definido.'
            );


            mostrarMensaje(
                'No se configuró la URL de búsqueda.'
            );


            return;

        }


        // -----------------------------------------------------
        // CSRF
        // -----------------------------------------------------

        const csrfToken =
            EPAN.csrfToken;


        if (!csrfToken) {

            console.error(
                'EPAN.csrfToken no está definido.'
            );


            mostrarMensaje(
                'No se pudo validar la solicitud.'
            );


            setStatus(
                'Error de seguridad.'
            );


            return;

        }


        // -----------------------------------------------------
        // Formulario
        // -----------------------------------------------------

        const form =
            new URLSearchParams();


        form.append(
            '_csrf',
            csrfToken
        );


        form.append(
            'tipo',
            EPAN.tipo
        );


        form.append(
            'valor',
            valor
        );


        console.log(
            '======================================'
        );


        console.log(
            'DATOS DE BÚSQUEDA:',
            {

                tipo:
                    EPAN.tipo,

                valor:
                    valor,

                url:
                    EPAN.buscarUrl

            }
        );


        console.log(
            '======================================'
        );


        try {

            setStatus(
                'Buscando en SICOPRO...'
            );


            const response =
                await fetch(

                    EPAN.buscarUrl,

                    {

                        method:
                            'POST',

                        credentials:
                            'same-origin',

                        headers: {

                            'Content-Type':
                                'application/x-www-form-urlencoded; charset=UTF-8',

                            'X-Requested-With':
                                'XMLHttpRequest'

                        },

                        body:
                            form.toString()

                    }

                );


            console.log(
                'STATUS:',
                response.status
            );


            console.log(
                'URL FINAL:',
                response.url
            );


            const texto =
                await response.text();


            console.log(
                'RESPUESTA SERVIDOR:',
                texto
            );


            if (!response.ok) {

                throw new Error(
                    'HTTP ' +
                    response.status +
                    ': ' +
                    texto
                );

            }


            let data;


            try {

                data =
                    JSON.parse(
                        texto
                    );

            } catch (jsonError) {

                console.error(
                    'RESPUESTA NO ES JSON:',
                    texto
                );


                throw new Error(
                    'El servidor no devolvió JSON válido.'
                );

            }


            console.log(
                'JSON BÚSQUEDA:',
                data
            );


            // -------------------------------------------------
            // BIEN ENCONTRADO
            // -------------------------------------------------

            if (data.ok) {

                console.log(
                    'BIEN ENCONTRADO:',
                    data
                );


                if (
                    data.redirect
                ) {

                    setStatus(
                        'Bien encontrado. Abriendo detalle...'
                    );


                    window.location.href =
                        data.redirect;


                    return;

                }


                throw new Error(
                    'El servidor no devolvió la URL de detalle.'
                );

            }


            // -------------------------------------------------
            // BIEN NO ENCONTRADO
            // -------------------------------------------------

            const mensaje =
                data.mensaje ||
                (
                    EPAN.tipo === 'barcode'

                        ? 'Código de barras no encontrado.'

                        : 'Número patrimonial no encontrado.'
                );


            mostrarMensaje(
                mensaje
            );


            setStatus(
                mensaje
            );


        } catch (error) {

            console.error(
                'ERROR BÚSQUEDA:',
                error
            );


            mostrarMensaje(
                'Error de comunicación con el servidor.'
            );


            setStatus(
                'Error de comunicación.'
            );

        }

    }


    // =========================================================
    // BOTÓN CAPTURAR
    // =========================================================

    if (captureBtn) {

        captureBtn.addEventListener(

            'click',

            async function () {

                if (
                    !video ||
                    !video.videoWidth
                ) {

                    setStatus(
                        'La cámara todavía no está lista.'
                    );


                    return;

                }


                if (procesandoOCR) {

                    return;

                }


                captureBtn.disabled =
                    true;


                try {

                    await analizarFotografia();


                } catch (error) {

                    console.error(
                        'ERROR ANÁLISIS:',
                        error
                    );


                    setStatus(
                        'Error al analizar la fotografía.'
                    );


                } finally {

                    captureBtn.disabled =
                        false;

                }

            }

        );

    }


    // =========================================================
    // BOTÓN MANUAL
    // =========================================================

    if (manualBtn) {

        manualBtn.addEventListener(

            'click',

            function () {

                if (resultPanel) {

                    resultPanel.classList.remove(
                        'hidden'
                    );

                }


                if (resultInput) {

                    resultInput.focus();

                }

            }

        );

    }


    // =========================================================
    // BOTÓN BUSCAR
    // =========================================================

    if (buscarBtn) {

        buscarBtn.addEventListener(

            'click',

            function () {

                if (!resultInput) {

                    return;

                }


                buscar(
                    resultInput.value
                );

            }

        );

    }


    // =========================================================
    // ENTER EN EL CAMPO
    // =========================================================

    if (resultInput) {

        resultInput.addEventListener(

            'keydown',

            function (event) {

                if (
                    event.key === 'Enter'
                ) {

                    event.preventDefault();


                    buscar(
                        resultInput.value
                    );

                }

            }

        );

    }


    // =========================================================
    // INICIALIZACIÓN
    // =========================================================

    document.addEventListener(

        'DOMContentLoaded',

        async function () {

            console.log(
                '======================================'
            );


            console.log(
                'EPAN SCANNER INICIANDO'
            );


            console.log(
                'OCR: SERVIDOR'
            );


            console.log(
                '======================================'
            );


            await iniciarCamara();


            // -------------------------------------------------
            // Código de barras
            // -------------------------------------------------

            if (
                window.EPAN &&
                EPAN.tipo === 'barcode'
            ) {

                await iniciarLectorBarcode();

            }

        }

    );


    // =========================================================
    // CERRAR CÁMARA
    // =========================================================

    window.addEventListener(

        'beforeunload',

        function () {

            // -------------------------------------------------
            // Detener cámara
            // -------------------------------------------------

            if (stream) {

                stream
                    .getTracks()
                    .forEach(
                        function (track) {

                            track.stop();

                        }
                    );

            }


            // -------------------------------------------------
            // Detener barcode
            // -------------------------------------------------

            barcodeScanning =
                false;


            if (barcodeFrame) {

                cancelAnimationFrame(
                    barcodeFrame
                );


                barcodeFrame =
                    null;

            }

        }

    );


})();

