(function () {

    'use strict';

    // =========================================================
    // EPAN SCANNER
    // OCR PATRIMONIAL CON PADDLEOCR
    // Ejemplo:
    // 724-191973
    // =========================================================

    const video = document.getElementById('camera');

    const captureBtn =
        document.getElementById('captureBtn');

    const manualBtn =
        document.getElementById('manualBtn');

    const buscarBtn =
        document.getElementById('buscarBtn') ||
        document.getElementById('buscarBarcodeBtn');
    /*
    const resultPanel = document.getElementById('result-panel');
    const resultInput = document.getElementById('matriculaResult');
    const status = document.getElementById('ocr-status');
    */

    const resultPanel =
    document.getElementById('result-panel');

    const resultInput =
        document.getElementById('matriculaResult') ||
        document.getElementById('barcodeResult');

    const status =
        document.getElementById('ocr-status') ||
        document.getElementById('barcode-status');


    let stream = null;

    let paddleOCR = null;
    let paddleInicializado = false;
    let inicializandoOCR = false;

    // =========================================================
    // CONFIGURACIÓN
    // =========================================================

    const CONFIG = {

        // Ampliación de la fotografía.
        scale: 4,

        // No exigimos cantidad de dígitos.
        minDigits: 3,

        // Formato patrimonial.
        // Ejemplo:
        //
        // 724191973
        //
        // se convierte en:
        //
        // 724-191973
        //
        // PERO solamente si PaddleOCR entrega una cadena
        // suficientemente clara.
        separator: '-',

        // Umbral de confianza.
        confidence: 0.25,

        // PaddleOCR.
        lang: 'en',

        ocrVersion: 'PP-OCRv5'
    };


    // =========================================================
    // UTILIDADES
    // =========================================================

    function setStatus(text) {

        if (status) {
            status.textContent = text;
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


            video.srcObject = stream;

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


            if (EPAN && EPAN.tipo === 'barcode') {

                setStatus(
                    'Apuntá al código de barras'
                );

            } else {

                setStatus(
                    'Apuntá al número de matricula'
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

let barcodeDetector = null;
let barcodeScanning = false;
let barcodeFrame = null;
let barcodeDetectando = false;


// =========================================================
// INICIAR LECTOR DE CÓDIGO DE BARRAS
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
    // Comprobar BarcodeDetector
    // -----------------------------------------------------

    if (!('BarcodeDetector' in window)) {

        console.log(
            'BarcodeDetector no disponible. Se utiliza el lector alternativo.'
        );

    }

    try {

        const formatos =
            await BarcodeDetector.getSupportedFormats();


        console.log(
            'FORMATOS SOPORTADOS:',
            formatos
        );


        // -------------------------------------------------
        // Formatos que nos interesan
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


        if (!formatosDisponibles.length) {

            throw new Error(
                'El navegador no tiene un formato de código compatible.'
            );

        }


        barcodeDetector =
            new BarcodeDetector({

                formats:
                    formatosDisponibles

            });


        barcodeScanning = true;


        setStatus(
            'Apuntá al código de barras'
        );


        // -------------------------------------------------
        // Comenzar análisis
        // -------------------------------------------------

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
// ANALIZAR CÁMARA
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
    // Evitar dos detecciones simultáneas
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

                barcodeDetectando = false;

                barcodeFrame =
                    requestAnimationFrame(
                        escanearBarcode
                    );

                return;

            }


            // -------------------------------------------------
            // Detener el escaneo
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
                'Código detectado: ' + codigo
            );


            // -------------------------------------------------
            // Buscar automáticamente en SICOPRO
            // -------------------------------------------------

            await buscar(codigo);


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


    if (barcodeScanning) {

        barcodeFrame =
            requestAnimationFrame(
                escanearBarcode
            );

    }

}





    // =========================================================
    // CARGAR PADDLEOCR
    // =========================================================
    //
    // El paquete npm debe estar disponible mediante el bundle
    // generado por tu aplicación.
    //
    // window.PaddleOCR deberá existir.
    //
    // =========================================================

    async function inicializarPaddleOCR() {

        if (paddleInicializado) {
            return paddleOCR;
        }

        if (inicializandoOCR) {

            while (inicializandoOCR) {
                await sleep(100);
            }

            return paddleOCR;
        }


        inicializandoOCR = true;


        try {

            setStatus(
                'Inicializando OCR...'
            );


            if (
                typeof window.PaddleOCR === 'undefined'
            ) {

                throw new Error(
                    'PaddleOCR no está cargado.'
                );

            }


            console.log(
                '======================================'
            );

            console.log(
                'INICIALIZANDO PADDLEOCR'
            );

            console.log(
                'Versión:',
                CONFIG.ocrVersion
            );

            console.log(
                '======================================'
            );


            paddleOCR =
                await window.PaddleOCR.create({

                    lang: CONFIG.lang,

                    ocrVersion:
                        CONFIG.ocrVersion,

                    ortOptions: {

                        backend: 'wasm',

                        numThreads: 2,

                        simd: true

                    }

                });


            paddleInicializado = true;


            console.log(
                'PADDLEOCR LISTO'
            );


            return paddleOCR;


        } catch (error) {

            console.error(
                'ERROR INICIALIZANDO PADDLEOCR:',
                error
            );

            paddleOCR = null;

            throw error;


        } finally {

            inicializandoOCR = false;

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


        // Coordenadas relativas al video.
        const relativeX =
            frameRect.left -
            videoRect.left;

        const relativeY =
            frameRect.top -
            videoRect.top;


        // Escala entre video real y video mostrado.
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


        // =====================================================
        // LIMITAR A LOS BORDES DEL VIDEO
        // =====================================================

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
            'RECORTE REAL EN VIDEO:',
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

            x: Math.round(x),
            y: Math.round(y),

            width: Math.round(width),
            height: Math.round(height)

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


        ctx.imageSmoothingEnabled = true;

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
    // CREAR VERSIÓN NORMAL
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
    // EXTRAER RESULTADO DE PADDLE
    // =========================================================

    function extraerTexto(resultado) {

        if (!resultado) {
            return '';
        }


        let textos = [];


        if (
            Array.isArray(
                resultado.items
            )
        ) {

            resultado.items.forEach(
                function (item) {

                    if (
                        item &&
                        typeof item.text === 'string'
                    ) {

                        textos.push(
                            item.text
                        );

                    }

                }
            );

        }


        return textos.join(' ');

    }


    // =========================================================
    // LIMPIAR TEXTO
    // =========================================================

    function limpiarTextoPatrimonial(texto) {

        if (!texto) {
            return '';
        }


        texto =
            texto
                .toUpperCase()
                .trim();


        console.log(
            'TEXTO PADDLE ORIGINAL:',
            texto
        );


        // =====================================================
        // CORRECCIONES OCR
        // =====================================================

        texto =
            texto

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


        // =====================================================
        // DEJAR SOLO NÚMEROS Y -
        // =====================================================

        texto =
            texto.replace(
                /[^0-9-]/g,
                ''
            );


        // =====================================================
        // LIMPIAR GUIONES
        // =====================================================

        texto =
            texto.replace(
                /-+/g,
                '-'
            );


        texto =
            texto.replace(
                /^-+/,
                ''
            );


        texto =
            texto.replace(
                /-+$/,
                ''
            );


        return texto;

    }


    // =========================================================
    // OBTENER NÚMERO PATRIMONIAL
    // =========================================================

    function obtenerNumeroPatrimonial(texto) {

        let limpio =
            limpiarTextoPatrimonial(
                texto
            );


        if (!limpio) {
            return '';
        }


        // =====================================================
        // SI YA VIENE CON GUION
        // =====================================================

        if (
            limpio.indexOf('-') !== -1
        ) {

            const partes =
                limpio.split('-');


            const numeros =
                partes.filter(
                    function (p) {

                        return (
                            p &&
                            /^\d+$/.test(p)
                        );

                    }
                );


            if (numeros.length >= 2) {

                return (
                    numeros[0] +
                    '-' +
                    numeros.slice(1).join('')
                );

            }

        }


        // =====================================================
        // SIN GUION
        // =====================================================

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


        // =====================================================
        // FORMATO PATRIMONIAL
        //
        // Ejemplo:
        //
        // 724191973
        //
        // 724-191973
        //
        // =====================================================

        if (
            soloNumeros.length >= 7
        ) {

            const primerBloque =
                soloNumeros.substring(
                    0,
                    3
                );


            const segundoBloque =
                soloNumeros.substring(
                    3
                );


            return (
                primerBloque +
                '-' +
                segundoBloque
            );

        }


        return soloNumeros;

    }


    // =========================================================
    // EJECUTAR PADDLE OCR
    // =========================================================

    async function ejecutarPaddleOCR(
        canvas,
        numeroVersion
    ) {

        const ocr =
            await inicializarPaddleOCR();


        console.log(
            '--------------------------------------'
        );

        console.log(
            'PADDLE OCR VERSIÓN',
            numeroVersion
        );

        console.log(
            'IMAGEN:',
            canvas.width,
            'x',
            canvas.height
        );


        setStatus(
            'Analizando imagen...'
        );


        const resultados =
            await ocr.predict(

                canvas,

                {

                    textDetLimitSideLen:
                        1536,

                    textDetThresh:
                        0.20,

                    textDetBoxThresh:
                        0.20,

                    textRecScoreThresh:
                        0.20

                }

            );


        const resultado =
            resultados[0];


        console.log(
            'RESULTADO PADDLE:',
            resultado
        );


        const texto =
            extraerTexto(
                resultado
            );


        console.log(
            'OCR PADDLE:',
            texto
        );


        const numero =
            obtenerNumeroPatrimonial(
                texto
            );


        console.log(
            'NÚMERO PATRIMONIAL:',
            numero
        );


        return {

            texto: texto,

            numero: numero,

            resultado: resultado

        };

    }


    // =========================================================
    // ANALIZAR FOTOGRAFÍA
    // =========================================================

    async function analizarFotografia() {

        console.log(
            '======================================'
        );

        console.log(
            'INICIANDO ANÁLISIS'
        );

        console.log(
            '======================================'
        );


        setStatus(
            'Tomando fotografía...'
        );


        const fotografia =
            capturarRecuadro();


        // =====================================================
        // CREAR VERSIONES
        // =====================================================

        const versiones = [

            {
                nombre: 'ORIGINAL',
                canvas:
                    crearVersionNormal(
                        fotografia
                    )
            },

            {
                nombre: 'GRISES',
                canvas:
                    crearVersionGrises(
                        fotografia
                    )
            },

            {
                nombre: 'CONTRASTE',
                canvas:
                    crearVersionContraste(
                        fotografia
                    )
            },

            {
                nombre: 'UMBRAL',
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


        const resultados = [];


        // =====================================================
        // PROCESAR
        // =====================================================

        for (
            let i = 0;
            i < versiones.length;
            i++
        ) {

            const version =
                versiones[i];


            try {

                const resultado =
                    await ejecutarPaddleOCR(

                        version.canvas,

                        i + 1

                    );


                resultados.push({

                    version:
                        version.nombre,

                    texto:
                        resultado.texto,

                    numero:
                        resultado.numero,

                    resultado:
                        resultado.resultado

                });


                // =================================================
                // SI YA TENEMOS RESULTADO
                // =================================================

                if (
                    resultado.numero
                ) {

                    console.log(
                        'RESULTADO ENCONTRADO EN:',
                        version.nombre
                    );

                    break;

                }

            } catch (error) {

                console.error(
                    'ERROR OCR:',
                    version.nombre,
                    error
                );

            }

        }


        console.log(
            '======================================'
        );

        console.log(
            'RESULTADOS OCR:',
            resultados
        );

        console.log(
            '======================================'
        );


        // =====================================================
        // BUSCAR MEJOR RESULTADO
        // =====================================================

        let numeroFinal = '';


        for (
            let i = 0;
            i < resultados.length;
            i++
        ) {

            if (
                resultados[i].numero
            ) {

                numeroFinal =
                    resultados[i].numero;

                break;

            }

        }


        // =====================================================
        // MOSTRAR
        // =====================================================

        resultPanel.classList.remove(
            'hidden'
        );


        resultInput.value =
            numeroFinal;


        if (numeroFinal) {

            setStatus(
                'Número detectado. Verificá antes de buscar.'
            );


            console.log(
                '======================================'
            );

            console.log(
                'NÚMERO PATRIMONIAL FINAL:',
                numeroFinal
            );

            console.log(
                '======================================'
            );


        } else {

            setStatus(
                'No pude reconocer el número. Acercá la cámara y probá nuevamente.'
            );


            console.log(
                'NÚMERO PATRIMONIAL NO DETECTADO'
            );

        }

    }


    // =========================================================
    // BOTÓN CÁMARA
    // =========================================================

    if (captureBtn) {

        captureBtn.addEventListener(
            'click',
            async function () {

                if (
                    !video.videoWidth
                ) {

                    setStatus(
                        'La cámara todavía no está lista.'
                    );

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

                resultPanel.classList.remove(
                    'hidden'
                );

                resultInput.focus();

            }
        );

    }


    // =========================================================
    // BÚSQUEDA
    // =========================================================
async function buscar(valor) {

    // =========================================================
    // NORMALIZAR VALOR
    // =========================================================

    valor = valor
        .trim()
        .toUpperCase();


    // =========================================================
    // VALIDAR VALOR
    // =========================================================

    if (!valor) {

        if (
            window.EPAN &&
            EPAN.tipo === 'barcode'
        ) {

            if (typeof mostrarToast === 'function') {

                mostrarToast(
                    'Ingresá un código de barras.'
                );

            } else {

                alert(
                    'Ingresá un código de barras.'
                );
            }

        } else {

            if (typeof mostrarToast === 'function') {

                mostrarToast(
                    'Ingresá un número patrimonial.'
                );

            } else {

                alert(
                    'Ingresá un número patrimonial.'
                );
            }
        }

        return;
    }


    // =========================================================
    // VERIFICAR EPAN
    // =========================================================

    if (
        !window.EPAN ||
        !EPAN.buscarUrl
    ) {

        console.error(
            'EPAN.buscarUrl no está definido.'
        );

        if (typeof mostrarToast === 'function') {

            mostrarToast(
                'No se configuró la URL de búsqueda.'
            );

        } else {

            alert(
                'No se configuró la URL de búsqueda.'
            );
        }

        return;
    }


    // =========================================================
    // OBTENER CSRF
    // =========================================================

    const csrfToken =
        EPAN.csrfToken;


    console.log(
        'CSRF EPAN:',
        csrfToken
    );


    if (!csrfToken) {

        console.error(
            'EPAN.csrfToken no está definido.'
        );

        if (typeof mostrarToast === 'function') {

            mostrarToast(
                'No se pudo validar la solicitud.'
            );

        } else {

            alert(
                'No se pudo validar la solicitud.'
            );
        }

        setStatus(
            'Error de seguridad.'
        );

        return;
    }


    // =========================================================
    // CREAR FORMULARIO
    // =========================================================

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
        'DATOS DE BÚSQUEDA:',
        {
            tipo: EPAN.tipo,
            valor: valor,
            url: EPAN.buscarUrl
        }
    );


    // =========================================================
    // BUSCAR EN SICOPRO
    // =========================================================

    try {

        setStatus(
            'Buscando en SICOPRO...'
        );


        const response =
            await fetch(
                EPAN.buscarUrl,
                {
                    method: 'POST',

                    credentials: 'same-origin',

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


        // =====================================================
        // INFORMACIÓN DE LA RESPUESTA
        // =====================================================

        console.log(
            'STATUS:',
            response.status
        );

        console.log(
            'URL FINAL:',
            response.url
        );


        // =====================================================
        // LEER RESPUESTA
        // =====================================================

        const texto =
            await response.text();


        console.log(
            'RESPUESTA SERVIDOR:',
            texto
        );


        // =====================================================
        // ERROR HTTP
        // =====================================================

        if (!response.ok) {

            throw new Error(
                `HTTP ${response.status}: ${texto}`
            );
        }


        // =====================================================
        // CONVERTIR RESPUESTA A JSON
        // =====================================================

        let data;

        try {

            data =
                JSON.parse(texto);

        } catch (jsonError) {

            console.error(
                'RESPUESTA NO ES JSON:',
                texto
            );

            throw new Error(
                'El servidor no devolvió JSON válido.'
            );
        }


        // =====================================================
        // BIEN ENCONTRADO
        // =====================================================

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


        // =====================================================
        // BIEN NO ENCONTRADO
        // =====================================================

        const mensaje =
            data.mensaje ||
            (
                EPAN.tipo === 'barcode'
                    ? 'Código de barras no encontrado.'
                    : 'Número patrimonial no encontrado.'
            );


        if (
            typeof mostrarToast === 'function'
        ) {

            mostrarToast(
                mensaje
            );

        } else {

            alert(
                mensaje
            );
        }


        setStatus(
            mensaje
        );


    } catch (error) {

        // =====================================================
        // ERROR
        // =====================================================

        console.error(
            'ERROR BÚSQUEDA:',
            error
        );


        if (
            typeof mostrarToast === 'function'
        ) {

            mostrarToast(
                'Error de comunicación con el servidor.'
            );

        } else {

            alert(
                'Error de comunicación con el servidor.'
            );
        }


        setStatus(
            'Error de comunicación.'
        );
    }

}
    
    if (buscarBtn) {

        buscarBtn.addEventListener(
            'click',
            function () {

                buscar(
                    resultInput.value
                );

            }
        );

    }


    // =========================================================
    // INICIALIZACIÓN
    // =========================================================

    document.addEventListener(
        'DOMContentLoaded',
        async function () {

            await iniciarCamara();


            // ================================================
            // CÓDIGO DE BARRAS
            // ================================================

            if (
                window.EPAN &&
                EPAN.tipo === 'barcode'
            ) {

                iniciarLectorBarcode();

            }

        }
    );


    // =========================================================
    // CERRAR CÁMARA
    // =========================================================

    window.addEventListener(
        'beforeunload',
        function () {

            if (stream) {

                stream
                    .getTracks()
                    .forEach(
                        function (track) {

                            track.stop();

                        }
                    );

            }


            if (paddleOCR) {

                try {

                    paddleOCR.dispose();

                } catch (e) {

                    console.warn(
                        'No se pudo liberar PaddleOCR:',
                        e
                    );

                }

            }

        }
    );


})();
