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
class ArsipController extends CoreController
{
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
		//$search = $model->baseUpdatable;
		$model->jenis_kelamin = $model->getJenisKelamin($model->jenis_kelamin);
		$lokasi = new \yii\base\DynamicModel(['kelurahan','kecamatan','kabupaten','provinsi']);
		$lokasi->addRule(['kelurahan','kecamatan','kabupaten','provinsi'], 'string', ['max' => 20]);
		$updatable =$model->baseUpdatable;
		$updatable = $this->exchangeData($updatable);
		$updatable =$model->tabelDomisili;
		$updatable = $this->exchangeDomisili($lokasi,$updatable);
		//$model->link('lokasi',$lokasi);
        return $this->render('view', [
            'model' => $model,
			'lokasi' => $lokasi,
        ]);	
    }
	
	/**
     * Exchange all location data
	 * @param User $data, Lokasi $lokasi
     * @return mixed
     */
    public function exchangeDomisili($lokasi,$data)
    {
		$lokasi->kelurahan = Villages::findOne($data->kelurahan)->name;
		$lokasi->kecamatan = Districts::findOne(substr($data->kelurahan,0,strlen($data->kelurahan)-3))->name;
		$lokasi->kabupaten = Regencies::findOne(substr($data->kelurahan,0,strlen($data->kelurahan)-6))->name;
		$lokasi->provinsi = Provinces::findOne(substr($data->kelurahan,0,strlen($data->kelurahan)-8))->name;
	}
	
	/**
     * Exchange all data
	 * @param User $data
     * @return mixed
     */
    public function exchangeData($data)
    {
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
		$model->ket = null;
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
