<?php

namespace app\controllers;

use app\models\Relevamientopat;
use app\models\RelevamientopatSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use Yii;
/**
 * RelevamientopatController implements the CRUD actions for Relevamientopat model.
 */
class RelevamientopatController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all Relevamientopat models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new RelevamientopatSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Relevamientopat model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Relevamientopat model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    /**
     * Iniciar un nuevo relevamiento
     */
    public function actionCreate()
    {
        $model = new Relevamientopat();

        if ($this->request->isPost) {

            if ($model->load($this->request->post())) {

                // Usuario logueado
                $model->idpersona = Yii::$app->user->id;

                // Fecha y hora actual
                $model->fecha_creacion = date('Y-m-d H:i:s');

                if ($model->save()) {

                    return $this->redirect([
                        'agregar-bienes',
                        'id' => $model->id
                    ]);
                }
            }

        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }
    public function actionDetalleRelevamiento($id)
    {
        return $this->render('detalle-relevamiento', [
            'id' => $id,
        ]);
    }
    /**
     * Pantalla principal para agregar bienes
     */
    public function actionAgregarBienes($id)
    {
        $relevamiento = $this->findModel($id);

        $bienes = RelevamientopatBien::find()
            ->where(['idrelevamiento' => $id])
            ->orderBy(['id' => SORT_DESC])
            ->all();

        $bien = new RelevamientopatBien();

        return $this->render('agregar-bienes', [
            'relevamiento' => $relevamiento,
            'bienes' => $bienes,
            'bien' => $bien,
        ]);
    }

    /**
     * Guardar un bien dentro del relevamiento
     */
    public function actionAgregarBien($id)
    {
        $relevamiento = $this->findModel($id);

        $bien = new RelevamientopatBien();

        if ($bien->load($this->request->post())) {

            $bien->idrelevamiento = $relevamiento->id;

            if ($bien->save()) {

                Yii::$app->session->setFlash(
                    'success',
                    'Bien agregado correctamente.'
                );

                return $this->redirect([
                    'agregar-bienes',
                    'id' => $relevamiento->id
                ]);
            }
        }

        $bienes = RelevamientopatBien::find()
            ->where(['idrelevamiento' => $id])
            ->orderBy(['id' => SORT_DESC])
            ->all();

        return $this->render('agregar-bienes', [
            'relevamiento' => $relevamiento,
            'bienes' => $bienes,
            'bien' => $bien,
        ]);
    }

    /**
     * Eliminar un bien del relevamiento
     */
    public function actionEliminarBien($id)
    {
        $bien = RelevamientopatBien::findOne($id);

        if ($bien === null) {
            throw new NotFoundHttpException(
                'El bien solicitado no existe.'
            );
        }

        $relevamientoId = $bien->idrelevamiento;

        $bien->delete();

        Yii::$app->session->setFlash(
            'success',
            'Bien eliminado del relevamiento.'
        );

        return $this->redirect([
            'agregar-bienes',
            'id' => $relevamientoId
        ]);
    }

    /**
     * Finalizar relevamiento
     */
    public function actionFinalizar($id)
    {
        $relevamiento = $this->findModel($id);

        return $this->redirect([
            'view',
            'id' => $relevamiento->id
        ]);
    }

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if (
            $this->request->isPost &&
            $model->load($this->request->post()) &&
            $model->save()
        ) {
            return $this->redirect([
                'view',
                'id' => $model->id
            ]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    protected function findModel($id)
    {
        if (
            ($model = Relevamientopat::findOne(['id' => $id])) !== null
        ) {
            return $model;
        }

        throw new NotFoundHttpException(
            'The requested page does not exist.'
        );
    }
}
