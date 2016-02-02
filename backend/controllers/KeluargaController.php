<?php

namespace backend\controllers;

use Yii;
use common\models\Keluarga;
use common\models\BaseUpdatable;
use backend\models\KeluargaSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\VarDumper;

/**
 * KeluargaController implements the CRUD actions for Keluarga model.
 */
class KeluargaController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Keluarga models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new KeluargaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Keluarga model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Keluarga model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Keluarga();

        if ($model->load(Yii::$app->request->post())) {
			$no_kk = substr($model->kepala_keluarga,0,6).Yii::$app->formatter->asDate('now', 'ddMMyy').$model->id;
			$model->id = $no_kk;
			$model->tanggal_terbit = date('Y-m-d');
			$model->tanggal_pembaruan = date('Y-m-d');
			$model->status = 1;
			$updatable = BaseUpdatable::findOne($model->kepala_keluarga);
			$updatable->no_kk = $no_kk;
			$updatable->status_keluarga = 1;
			//echo var_dump($model);
			if($model->save() && $updatable->save()){
				return $this->redirect(['view', 'id' => $model->id]);
			}else{
				VarDumper::dump($model->getErrors(),5678,true);
				//return $this->actionIndex();
			}
        } else {
            return $this->renderAjax('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Keluarga model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Keluarga model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Keluarga model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Keluarga the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Keluarga::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
