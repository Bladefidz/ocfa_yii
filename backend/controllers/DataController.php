<?php

namespace backend\controllers;

use Yii;
use common\models\DataManagement;
use common\models\BaseUpdatable;
use common\models\Provinces;
use common\models\Regencies;
use common\models\Districts;
use common\models\Villages;
use backend\models\DataSearch;
use backend\models\UpdatableSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * DataController implements the CRUD actions for DataManagement model.
 */
class DataController extends Controller
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
        $searchModel = new DataSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single DataManagement model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
		$model = $this->findModel($id);
		$search = new UpdatableSearch();
		$model->jenis_kelamin = $model->getJenisKelamin($model->jenis_kelamin);
		$model->kewarganegaraan = $model->getKewarganegaraan($model->kewarganegaraan);
		$data = $search->getData($model->nik);
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
        return $this->render('view', [
            'model' => $model,
			'updateable' => $data,
        ]);
    }
	
	/**
	 *	Get kabupaten by id
	 *	@param string $id
	 *	@return string
	 */
	public function actionKabupaten($id)
	{
	 $countRegencies = Regencies::find()->where(['province_id' => $id])->orderBy('name')->count();
	 
	 $regencies = Regencies::find()->where(['province_id' => $id])->orderBy('name')->all();
	 
	 if($countRegencies>0){
		 echo "<option selected disabled>Pilih Kabupaten</option>";
		 foreach($regencies as $kabupaten){
			echo "<option value='".$kabupaten->id."'>".$kabupaten->name."</option>";
		 }
	 }
	 else{
		echo "<option>-</option>";
	 }
	 
	}
	
	/**
	 *	Get kecamatan by id
	 *	@param string $id
	 *	@return string
	 */
	public function actionKecamatan($id)
	{
	 $countDistricts = Districts::find()->where(['regency_id' => $id])->orderBy('name')->count();
	 
	 $districts = Districts::find()->where(['regency_id' => $id])->orderBy('name')->all();
	 
	 if($countDistricts>0){
		 echo "<option selected disabled>Pilih Kecamatan</option>";
		 foreach($districts as $kecamatan){
			echo "<option value='".$kecamatan->id."'>".$kecamatan->name."</option>";
		 }
	 }
	 else{
		echo "<option>-</option>";
	 }
	 
	}
	
	/**
	 *	Get kelurahan by id
	 *	@param string $id
	 *	@return string
	 */
	public function actionKelurahan($id)
	{
	 $countVillages = Villages::find()->where(['district_id' => $id])->orderBy('name')->count();
	 
	 $villages = Villages::find()->where(['district_id' => $id])->orderBy('name')->all();
	 
	 if($countVillages>0){
		 echo "<option selected disabled>Pilih Kelurahan</option>";
		 foreach($villages as $kelurahan){
			echo "<option value='".$kelurahan->id."'>".$kelurahan->name."</option>";
		 }
	 }
	 else{
		echo "<option>-</option>";
	 }
	 
	}

    /**
     * Creates a new DataManagement model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new DataManagement();
		$updatable = new BaseUpdatable();
		
		//$model->jenis_kelamin = $model->getJenisKelamin($model->jenis_kelamin);
        if ($model->load(Yii::$app->request->post())&&$updatable->load(Yii::$app->request->post())) {
			if($model->jenis_kelamin == '1'){
				$nik = substr($updatable->kecamatan,6)+Yii::$app->formatter->asDate($model->tanggal_lahir, 'ddMMyy')+$model->nik;
			}else{
				$nik = substr($updatable->kecamatan,6)+((integer)Yii::$app->formatter->asDate($model->tanggal_lahir, 'dd')+40)+Yii::$app->formatter->asDate($model->tanggal_lahir, 'MMyy')+$model->nik;
			}
			
			/*echo substr($updatable->kecamatan,0,strlen($updatable->kecamatan)-1);
			echo "<br>";
			echo Yii::$app->formatter->asDate($model->tanggal_lahir, 'ddMMyy');
			echo "<br>";
			echo $model->nik;*/
			//if($model->save()){
				
			//}
            //return $this->redirect(['view', 'id' => $model->nik]);
        } else {
            return $this->render('create', [
                'model' => $model,
				'updatable' => $updatable,
            ]);
        }
    }

    /**
     * Updates an existing DataManagement model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModelUpdatable($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->nik]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing DataManagement model.
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
     * Finds the DataManagement model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
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
	
	/**
     * Finds the BaseUpdatable model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return BaseUpdatable the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModelUpdatable($id)
    {
        if (($model = BaseUpdatable::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
