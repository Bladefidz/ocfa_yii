<?php

namespace backend\controllers;

use Yii;
use common\models\DataManagement;
use backend\models\ArsipSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use backend\models\UpdatableSearch;
use common\models\Provinces;
use common\models\Regencies;
use common\models\Districts;
use common\models\Villages;
use yii\filters\VerbFilter;

/**
 * ArsipController implements the CRUD actions for DataManagement model.
 */
class ArsipController extends Controller
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
     * Lists all DataManagement models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ArsipSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single DataManagement model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
		$search = new UpdatableSearch();
		$model->jenis_kelamin = $model->getJenisKelamin($model->jenis_kelamin);
		$model->kewarganegaraan = $model->getKewarganegaraan($model->kewarganegaraan);
		$data = $this->exchangeData($search->getData($model->nik));
        return $this->render('view', [
            'model' => $model,
			'updateable' => $data,
        ]);	
    }
	
	/**
     * Exchange all data
	 * @param User $data
     * @return mixed
     */
    public function exchangeData($data)
    {
		$data->provinsi = Provinces::findOne($data->provinsi)->name;
		$data->kabupaten = Regencies::findOne($data->kabupaten)->name;
		$data->kecamatan = Districts::findOne($data->kecamatan)->name;
		$data->kelurahan = Villages::findOne($data->kelurahan)->name;
		switch($data->agama){
			case '1':
				$agama = 'Islam';
				break;
			case '2':
				$agama = 'Kristen';
				break;
			case '3':
				$agama = 'Katholik';
				break;
			case '4':
				$agama = 'Hindu';
				break;
			case '5':
				$agama = 'Budha';
				break;
			case '6':
				$agama = 'Konghucu';
				break;
			case '7':
				$agama = 'Lainnya';
				break;
			
		}
		$data->agama = $agama;
		switch($data->status_perkawinan){
			case '0':
				$status_perkawinan = 'Belum Menikah';
				break;
			case '1':
				$status_perkawinan = 'Menikah';
				break;
			case '2':
				$status_perkawinan = 'Cerai';
				break;
			case '3':
				$status_perkawinan = 'Cerai ditinggal mati';
				break;
		}
		$data->status_perkawinan = $status_perkawinan;
		if($data->pekerjaan == 'NULL'){
			$data->pekerjaan = '-';
		}
		switch($data->pendidikan_terakhir){
			case '1':
				$pend_terakhir = 'SD';
				break;
			case '2':
				$pend_terakhir = 'SMP';
				break;
			case '3':
				$pend_terakhir = 'SMA';
				break;
			case '4':
				$pend_terakhir = 'D 1';
				break;
			case '5':
				$pend_terakhir = 'D 2';
				break;
			case '6':
				$pend_terakhir = 'D 3';
				break;
			case '7':
				$pend_terakhir = 'D 4 / Sarjana (S 1)';
				break;
			case '8':
				$pend_terakhir = 'Pasca Sarjana (S 2)';
				break;
			case '9':
				$pend_terakhir = 'Pasca Sarjana (S 3)';
				break;
		}
		$data->pendidikan_terakhir = $pend_terakhir;
		return $data;
	}

    /**
     * Deletes an existing DataManagement model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }
	
	/**
     * Take from Arsip to DataManagement.
     * If take is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionTake($id)
    {
        $model = $this->findModel($id);
		$model->arsip = 0;
		$model->update();

        return $this->redirect(['index']);
    }
	
	/**
     * Arsip an exiting DataManagement model.
     * If asrip is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionArsip($id)
    {
        $model = $this->findModel($id);
		$model->arsip = 1;
		$model->update();

        return $this->redirect(['index']);
    }

    /**
     * Finds the DataManagement model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return DataManagement the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = DataManagement::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
