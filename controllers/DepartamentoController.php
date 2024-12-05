<?php

namespace app\controllers;

use Yii;
use app\models\Departamento;
use app\models\DepartamentoSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
//imporatnte para la imagen
use yii\web\UploadedFile;

/**
 * DepartamentoController implements the CRUD actions for Departamento model.
 */
class DepartamentoController extends Controller
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
     * Lists all Departamento models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new DepartamentoSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Departamento model.
     * @param int $codigo Codigo
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($codigo)
    {
        return $this->render('view', [
            'model' => $this->findModel($codigo),
        ]);
    }

    /**
     * Creates a new Departamento model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Departamento(); // Asumimos que 'Departamento' es tu modelo

        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {
                // Cargar el archivo de imagen
                $model->logo = UploadedFile::getInstance($model, 'logo');

                if ($model->logo instanceof UploadedFile) {
                    // Generar un nombre único para el archivo
                    $filePath = 'img/productos/' . uniqid('logo_') . '.' . $model->logo->extension;

                    // Guardar el archivo en la carpeta 'img/productos'
                    if ($model->logo->saveAs($filePath)) {
                        $model->logo = $filePath; // Guardar la ruta del archivo en el campo 'logo' de la base de datos
                    }
                }

                // Guardar el modelo (incluyendo la ruta de la imagen)
                if ($model->save()) {
                    return $this->redirect(['view', 'codigo' => $model->codigo]); // Redirigir al detalle del departamento
                }
            }
        } else {
            $model->loadDefaultValues(); // Cargar valores predeterminados si no es un POST
        }

        return $this->render('create', [
            'model' => $model, // Pasar el modelo a la vista
        ]);
    }

    /**
     * Updates an existing Departamento model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $codigo Codigo
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($codigo)
    {
        $model = $this->findModel($codigo);

        // Guardar el valor original de 'logo' antes de cargar el formulario
        $originalLogo = $model->logo;

        // Cargar los datos del formulario
        if ($model->load($this->request->post())) {
            // Obtener la imagen cargada (si existe)
            $newLogo = UploadedFile::getInstance($model, 'logo');

            // Si se seleccionó una nueva imagen
            if ($newLogo) {
                // Eliminar la imagen anterior si existe
                if (file_exists(Yii::getAlias('@webroot/') . $originalLogo)) {

                    unlink(Yii::getAlias('@webroot/') . $originalLogo);
                }

                // Generar el nombre de la nueva imagen
                $filePath = 'img/productos/' . uniqid('logo_') . '.' . $newLogo->extension;

                // Guardar la nueva imagen
                if ($newLogo->saveAs(Yii::getAlias('@webroot/') . $filePath)) {
                    $model->logo = $filePath; // Actualizar la ruta de la imagen en la base de datos
                } else {
                    Yii::error('Error al guardar la imagen', __METHOD__);
                }
            } else {
                // Si no se seleccionó una nueva imagen, restaurar el valor original de 'logo'
                $model->logo = $originalLogo;
            }

            // Guardar el modelo (sin cambiar la imagen si no se seleccionó una nueva)
            if ($model->save()) {
                return $this->redirect(['view', 'codigo' => $model->codigo]);
            }
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Departamento model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $codigo Codigo
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($codigo)
    {
        $this->findModel($codigo)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Departamento model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $codigo Codigo
     * @return Departamento the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($codigo)
    {
        if (($model = Departamento::findOne(['codigo' => $codigo])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
