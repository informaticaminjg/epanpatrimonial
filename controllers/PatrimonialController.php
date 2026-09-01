<?php

namespace app\controllers;
use yii\filters\AccessControl;
use Yii;
use yii\web\Controller;
use yii\web\Response;
use app\models\Bien;
use app\models\HistorialEscaneo;
use app\models\UsuarioCuenta;
use app\services\SicoproService;

class PatrimonialController extends Controller
{
    public function behaviors(): array
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    public $layout = 'main';

    public function actionIndex()
    {
        $ultimos = HistorialEscaneo::find()
            ->where(['usuario_id' => $this->usuarioId()])
            ->orderBy(['fecha_hora' => SORT_DESC])
            ->limit(5)
            ->all();

        return $this->render('index', [
            'ultimos' => $ultimos,
        ]);
    }

    public function actionEscanearMatricula()
    {
        return $this->render('escanear-matricula');
    }

    public function actionEscanearBarcode()
    {
        return $this->render('escanear-barcode');
    }

    public function actionBuscar()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        $tipo = Yii::$app->request->post('tipo', 'matricula');
        $valor = trim(Yii::$app->request->post('valor', ''));

        if ($valor === '') {
            return ['ok' => false, 'mensaje' => 'Debe ingresar o escanear un valor.'];
        }

        $sicopro = new SicoproService();
        $bien = $tipo === 'barcode'
            ? $sicopro->buscarPorCodigoBarras($valor)
            : $sicopro->buscarPorMatricula($valor);
        
        if (!$bien) {
            return [
                'ok' => false,
                'mensaje' => 'No se encontró un bien en SICOPRO con ese dato.'
            ];
        }

       $historial = new HistorialEscaneo();

        $historial->usuario_id = $this->usuarioId();
        $historial->patrimonio_id = $bien->id;
        $historial->codigo = $valor;
        $historial->descripcion = 'Consulta por ' . $tipo;
        $historial->fecha_hora = date('Y-m-d H:i:s');

        $historial->save(false);

        return [
            'ok' => true,
            'redirect' => Yii::$app->urlManager->createUrl([
                'patrimonial/detalle',
                'id' => $bien->id
            ])
        ];
    }


     // ==========================================================
    // REGISTRO PATRIMONIAL POR PERSONA
    // ==========================================================
    public function actionRegistroPorPersona()
    {
        // ======================================================
        // PERSONAS DEMO
        // ======================================================

        $personas = [

            [
                'id' => 1,
                'nombre' => 'Juan',
                'apellido' => 'Pérez',
                'dni' => '12.345.678',
                'legajo' => '45821',
                'reparticion' => 'Secretaría Administrativa',
            ],

            [
                'id' => 2,
                'nombre' => 'María',
                'apellido' => 'López',
                'dni' => '23.456.789',
                'legajo' => '39214',
                'reparticion' => 'Dirección General de Contabilidad',
            ],

            [
                'id' => 3,
                'nombre' => 'Carlos',
                'apellido' => 'Gómez',
                'dni' => '34.567.890',
                'legajo' => '51236',
                'reparticion' => 'Dirección de Sistemas',
            ],

            [
                'id' => 4,
                'nombre' => 'Ana',
                'apellido' => 'Martínez',
                'dni' => '27.891.234',
                'legajo' => '44125',
                'reparticion' => 'Secretaría de Recursos Humanos',
            ],

            [
                'id' => 5,
                'nombre' => 'Roberto',
                'apellido' => 'Fernández',
                'dni' => '18.765.432',
                'legajo' => '37654',
                'reparticion' => 'Dirección de Compras',
            ],

        ];

        return $this->render('registro-por-persona', [
            'personas' => $personas,
        ]);
    }


    public function actionDetalle($id)
    {
        $sicopro = new SicoproService();

        $bien = $sicopro->obtenerBienCompleto($id);

        if (!$bien) {
            return $this->asJson([
                'ok' => false,
                'mensaje' => 'Bien no encontrado',
                'matricula_recibida' => $id,
            ]);
        }

        return $this->render('detalle', [
            'bien' => $bien,
        ]);
    }
/*
    public function actionQr($id)
    {
        $bien = Bien::findOne($id);
        if (!$bien) {
            throw new \yii\web\NotFoundHttpException('Bien no encontrado.');
        }

        return $this->render('qr', [
            'bien' => $bien,
        ]);
    }
*/
public function actionQr($id)
{
    $sicopro = new SicoproService();

    // Obtener el bien de la misma manera que detalle.php
    $bien = $sicopro->obtenerBienCompleto($id);

    if (!$bien) {
        throw new \yii\web\NotFoundHttpException(
            'Bien no encontrado.'
        );
    }

    return $this->render('qr', [
        'bien' => $bien,
    ]);
}

    public function actionImprimir($id)
    {
        $sicopro = new SicoproService();
        $bien = $sicopro->obtenerBienCompleto($id);

        if (!$bien) {
            throw new \yii\web\NotFoundHttpException('Bien no encontrado.');
        }

        return $this->render('imprimir', [
            'bien' => $bien,
        ]);
    }

    public function actionHistorial()
    {
        $historial = HistorialEscaneo::find()
                ->where(['usuario_id' => $this->usuarioId()])
                ->orderBy(['fecha_hora' => SORT_DESC])
                ->limit(100)
                ->all();

            return $this->render('historial', [
                'historial' => $historial,
            ]);
       
    }


    public function actionReconocerMatricula()
{
    Yii::$app->response->format =
        \yii\web\Response::FORMAT_JSON;

    try {

        /*
         * =====================================================
         * 1. VERIFICAR QUE LLEGÓ LA IMAGEN
         * =====================================================
         */

        if (empty($_FILES['imagen'])) {

            return [
                'ok' => false,
                'error' => 'PHP no recibió el archivo "imagen".',
                'files' => $_FILES
            ];
        }


        $archivo =
            $_FILES['imagen'];


        if ($archivo['error'] !== UPLOAD_ERR_OK) {

            return [
                'ok' => false,
                'error' =>
                    'Error de subida PHP: ' .
                    $archivo['error']
            ];
        }


        $ruta =
            $archivo['tmp_name'];


        if (!file_exists($ruta)) {

            return [
                'ok' => false,
                'error' =>
                    'El archivo temporal no existe.'
            ];
        }


        /*
         * =====================================================
         * 2. VERIFICAR CURL
         * =====================================================
         */

        if (!function_exists('curl_init')) {

            return [
                'ok' => false,
                'error' =>
                    'cURL NO está habilitado en PHP.'
            ];
        }


        /*
         * =====================================================
         * 3. OCR.SPACE
         * =====================================================
         */

        $apiKey = 'helloworld';


        $ch =
            curl_init(
                'https://api.ocr.space/parse/image'
            );


        $postData = [

            'apikey' =>
                $apiKey,

            'language' =>
                'eng',

            'isOverlayRequired' =>
                'false',

            'detectOrientation' =>
                'true',

            'scale' =>
                'true',

            'OCREngine' =>
                '2',

            'file' =>
                new \CURLFile(
                    $ruta,
                    'image/jpeg',
                    'matricula.jpg'
                )
        ];


        curl_setopt_array(
            $ch,
            [

                CURLOPT_RETURNTRANSFER =>
                    true,

                CURLOPT_POST =>
                    true,

                CURLOPT_POSTFIELDS =>
                    $postData,

                CURLOPT_TIMEOUT =>
                    90,

                CURLOPT_CONNECTTIMEOUT =>
                    30,

                CURLOPT_SSL_VERIFYPEER =>
                    true,

                CURLOPT_SSL_VERIFYHOST =>
                    2
            ]
        );


        $respuesta =
            curl_exec($ch);


        $curlError =
            curl_error($ch);


        $curlErrno =
            curl_errno($ch);


        $httpCode =
            curl_getinfo(
                $ch,
                CURLINFO_HTTP_CODE
            );


        curl_close($ch);


        /*
         * =====================================================
         * 4. ERROR CURL
         * =====================================================
         */

        if ($respuesta === false) {

            return [

                'ok' => false,

                'error' =>
                    'cURL falló.',

                'curl_errno' =>
                    $curlErrno,

                'curl_error' =>
                    $curlError,

                'http_code' =>
                    $httpCode
            ];
        }


        /*
         * =====================================================
         * 5. DECODIFICAR OCR.SPACE
         * =====================================================
         */

        $json =
            json_decode(
                $respuesta,
                true
            );


        if ($json === null) {

            return [

                'ok' => false,

                'error' =>
                    'OCR.space no devolvió JSON.',

                'http_code' =>
                    $httpCode,

                'respuesta' =>
                    $respuesta
            ];
        }


        /*
         * =====================================================
         * 6. ERROR DE OCR.SPACE
         * =====================================================
         */

        if (
            isset(
                $json['IsErroredOnProcessing']
            ) &&
            $json['IsErroredOnProcessing']
        ) {

            return [

                'ok' => false,

                'error' =>
                    $json['ErrorMessage']
                    ?? 'OCR.space informó un error.',

                'respuesta_ocr' =>
                    $json
            ];
        }


        /*
         * =====================================================
         * 7. EXTRAER TEXTO
         * =====================================================
         */

        $texto = '';


        if (
            !empty(
                $json['ParsedResults']
            )
        ) {

            foreach (
                $json['ParsedResults']
                as $resultado
            ) {

                if (
                    isset(
                        $resultado['ParsedText']
                    )
                ) {

                    $texto .=
                        ' ' .
                        $resultado['ParsedText'];
                }
            }
        }


        $texto =
            trim($texto);


        /*
         * =====================================================
         * 8. BUSCAR NÚMERO
         * =====================================================
         */

        $numero =
            null;


        /*
         * Primero buscamos:
         *
         * 424-191993
         * 424 191993
         * 424/191993
         */

        if (
            preg_match(
                '/(\d{3})\D{0,5}(\d{5,8})/',
                $texto,
                $m
            )
        ) {

            $numero =
                $m[1] .
                '-' .
                $m[2];

        } else {

            /*
             * Si OCR.space devuelve:
             *
             * 424191993
             */

            $soloNumeros =
                preg_replace(
                    '/[^0-9]/',
                    '',
                    $texto
                );


            if (
                preg_match(
                    '/^\d{8,11}$/',
                    $soloNumeros
                )
            ) {

                $numero =
                    substr(
                        $soloNumeros,
                        0,
                        3
                    )
                    .
                    '-'
                    .
                    substr(
                        $soloNumeros,
                        3
                    );
            }
        }


        /*
         * =====================================================
         * 9. RESPUESTA FINAL
         * =====================================================
         */

        return [

            'ok' =>
                true,

            'numero' =>
                $numero,

            'numero_sin_formato' =>
                $numero
                    ? preg_replace(
                        '/[^0-9]/',
                        '',
                        $numero
                    )
                    : null,

            'texto_ocr' =>
                $texto,

            'http_code' =>
                $httpCode,

            'respuesta_ocr' =>
                $json
        ];


    } catch (\Throwable $e) {

        return [

            'ok' =>
                false,

            'error' =>
                $e->getMessage(),

            'archivo' =>
                $e->getFile(),

            'linea' =>
                $e->getLine()
        ];
    }
}


    public function actionCuenta()
    {
        $cuenta = (object) [
            'id' => $this->usuarioId(),
            'nombre' => 'Luis Eduardo Garcia',
            'email' => 'luis.garcia@municipalidad.gob.ar',
            'telefono' => '299 555-1234',
            'dependencia' => 'Municipalidad de Neuquén',
            'cargo' => 'Administrador',
        ];

        return $this->render('cuenta', [
            'cuenta' => $cuenta,
        ]);
    }

    public function actionActualizarCuenta()
    {
        $cuenta = UsuarioCuenta::findOne(['id' => $this->usuarioId()]);

        if (!$cuenta) {
            $cuenta = new UsuarioCuenta();
            $cuenta->id = $this->usuarioId();
        }

        if ($cuenta->load(Yii::$app->request->post()) && $cuenta->save()) {
            Yii::$app->session->setFlash('success', 'Datos actualizados correctamente.');
        } else {
            Yii::$app->session->setFlash('error', 'No se pudieron actualizar los datos.');
        }

        return $this->redirect(['cuenta']);
    }

    private function usuarioId()
    {
        return Yii::$app->user->isGuest ? 1 : (int)Yii::$app->user->id;
    }
}
