<?php

namespace backend\controllers;

use Yii;
use yii\helpers\ArrayHelper;
use common\models\DataManagement;
use common\models\BaseUpdatable;
use common\models\Provinces;
use common\models\Regencies;
use common\models\Districts;
use common\models\Villages;
use common\models\UserActivity;
use common\models\TabelDomisili;
use common\models\TabelKematian;
use common\models\TabelKewarganegaraan;
use common\models\Keluarga;
use backend\models\DataSearch;
use backend\models\UpdatableSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\VarDumper;

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
		//$search = new UpdatableSearch();
		$model->jenis_kelamin = $model->getJenisKelamin($model->jenis_kelamin);
		//$data = $search->getData($model->nik);
		//echo var_dump($model->baseUpdatable);
		$lokasi = new \yii\base\DynamicModel(['kelurahan','kecamatan','kabupaten','provinsi']);
		$lokasi->addRule(['kelurahan','kecamatan','kabupaten','provinsi'], 'string', ['max' => 20]);
		$updatable =$model->baseUpdatable;
		$updatable = $this->exchangeData($updatable);
		$updatable = TabelDomisili::find()->where('current = 1 and nik = '.$id)->one();
		$updatable = $this->exchangeDomisili($lokasi,$updatable);
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
		switch($data->status_keluarga){
			case '1':
				$status_keluarga = 'Kepala Keluarga';
				break;
			case '2':
				$status_keluarga = 'Istri';
				break;
			case '3':
				$status_keluarga = 'Anak';
				break;
			default:
				$status_keluarga = '-';
				break;
		}
		$data->status_keluarga = $status_keluarga;
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

		/*if ($data->kewarganegaraan == "1") {
            $data->kewarganegaraan = 'WNI';
        } else {
            $data->kewarganegaraan = 'WNA';
        }*/

		return $data;
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

    public function actionStatkk($nokk)
    {
		$parent = BaseUpdatable::find()->where(['no_kk' => $nokk, 'status_keluarga' => 1])->all();
		if(count($parent)>0){
		 	echo "<option selected disabled>Pilih NIK Ayah</option>";
		 	foreach($parent as $p){
				echo "<option value='".$p->nik."'>".$p->nik."</option>";
		 	}
		}
		else{
			echo "<option>-</option>";
		}
	}

	public function actionNoKkList($q = null, $id = null)
    {
    	\Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
	    $out = ['results' => ['id' => '', 'text' => '']];
	    if (!is_null($q)) {
	        $query = new \yii\db\Query;
	        $query->select('id, id AS text')
	            ->from('keluarga')
	            ->where(['like', 'id', $q])
	            ->limit(20);
	        $command = $query->createCommand();
	        $data = $command->queryAll();
	        $out['results'] = array_values($data);
	    }
	    elseif ($id > 0) {
	        $out['results'] = ['id' => $id, 'text' => Keluarga::find($id)->id];
	    }
	    return $out;
    }

    public function actionNikAyahList($q = null, $id = null)
    {
    	\Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
	    $out = ['results' => ['id' => '', 'text' => '']];
	    if (!is_null($q)) {
	        $query = new \yii\db\Query;
	        $query->select('base.nik AS id, base.nik AS text')
	            ->from('base')
	            ->innerJoin('base_updatable', 'base.nik = base_updatable.nik')
	            ->andWhere(['base_updatable.status_keluarga' => 1, 'base.jenis_kelamin' => 1])
	            ->andWhere(['like', 'base.nik', $q])
	            ->limit(20);
	        $command = $query->createCommand();
	        $data = $command->queryAll();
	        $out['results'] = array_values($data);
	    }
	    elseif ($id > 0) {
	        $out['results'] = ['id' => $id, 'text' => BaseUpdatable::find($id)->nik];
	    }
	    return $out;
    }

    public function actionNikIbuList($q = null, $id = null)
    {
    	\Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
	    $out = ['results' => ['id' => '', 'text' => '']];
	    if (!is_null($q)) {
	        $query = new \yii\db\Query;
	        $query->select('base.nik AS id, base.nik AS text')
	            ->from('base')
	            ->innerJoin('base_updatable', 'base.nik = base_updatable.nik')
	            ->andWhere(['base_updatable.status_keluarga' => 2, 'base.jenis_kelamin' => 2])
	            ->andWhere(['like', 'base.nik', $q])
	            ->limit(20);
	        $command = $query->createCommand();
	        $data = $command->queryAll();
	        $out['results'] = array_values($data);
	    }
	    elseif ($id > 0) {
	        $out['results'] = ['id' => $id, 'text' => BaseUpdatable::find($id)->nik];
	    }
	    return $out;
    }

    public function actionGetayah()
    {
    	$ayah = ArrayHelper::map(DataManagement::find()->select(['nik'])->where('jenis_kelamin = 1')->all(),'nik','nik');
		if (count($ayah) > 0) {
			foreach($ayah as $a){
				echo "<option value='".$a->nik."'>".$a->nik."</option>";
		 	}
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
		$domisili = new TabelDomisili();
		$lokasi = new \yii\base\DynamicModel(['kelurahan','kecamatan','kabupaten','provinsi']);
		$lokasi->addRule(['kelurahan','kecamatan','kabupaten','provinsi'], 'string', ['max' => 20]);
		
		//$model->jenis_kelamin = $model->getJenisKelamin($model->jenis_kelamin);
        if ($model->load(Yii::$app->request->post()) && $updatable->load(Yii::$app->request->post()) && $lokasi->load(Yii::$app->request->post()) && $domisili->load(Yii::$app->request->post())) {
			if($model->jenis_kelamin == '1'){
				$nik = substr($lokasi->kecamatan,0,strlen($lokasi->kecamatan)-1).Yii::$app->formatter->asDate($model->tanggal_lahir, 'ddMMyy').$model->nik;
			}else{
				$nik = substr($lokasi->kecamatan,0,strlen($lokasi->kecamatan)-1).((integer)Yii::$app->formatter->asDate($model->tanggal_lahir, 'dd')+40).Yii::$app->formatter->asDate($model->tanggal_lahir, 'MMyy').$model->nik;
			}
			$temp = $model->nik;
			$model->nik = $nik;
			$model->tanggal_lahir = Yii::$app->formatter->asDate($model->tanggal_lahir, 'yyyy-MM-dd');
			// $model->tanggal_diterbitkan = date('Y-m-d');
			$model->nik_pencatat = Yii::$app->user->id;
			$updatable->nik = $nik;
			$domisili->nik = $nik;
			$domisili->kelurahan = $lokasi->kelurahan;
			$domisili->nik_pencatat = Yii::$app->user->id;
			$domisili->current = 1;
			if($model->validate() && $model->save() && $updatable->save() && $domisili->save()){
				$this->writeLog('Menambah Data dengan NIK '.$model->nik.' atas Nama '.$model->nama);
				return $this->redirect(['view', 'id' => $model->nik]);
			}else{
				// VarDumper::dump($model->getErrors(),5678,true);
				//VarDumper::dump($updatable->getErrors(),5678,true);
				//VarDumper::dump($domisili->getErrors(),5678,true);
				$alert = ['options' => [
						'class' => 'alert-warning',
					],
					'body' => 'Ada kesalahan, silakan hubungi bagian teknisi',];
				$model->nik = $temp;
				return $this->render('create', [
					'model' => $model,
					'updatable' => $updatable,
					'alert' => $alert,
					'lokasi' => $lokasi,
					'domisili' => $domisili,
				]);
			}
        } else {
            return $this->render('create', [
                'model' => $model,
				'updatable' => $updatable,
				'lokasi' => $lokasi,
				'domisili' => $domisili,
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
		$domisili = new TabelDomisili();
		$currentDomisili = TabelDomisili::find()->where('current = 1 and nik = '.$id)->one();
		$lokasi = new \yii\base\DynamicModel(['kelurahan','kecamatan','kabupaten','provinsi']);
		$lokasi->addRule(['kelurahan','kecamatan','kabupaten','provinsi'], 'string', ['max' => 20]);
		$lokasi->kelurahan = $currentDomisili['kelurahan'];
		$lokasi->kecamatan = substr($lokasi->kelurahan,0,strlen($lokasi->kelurahan)-3);
		$lokasi->kabupaten = substr($lokasi->kecamatan,0,strlen($lokasi->kecamatan)-3);
		$lokasi->provinsi = substr($lokasi->kabupaten,0,strlen($lokasi->kabupaten)-2);
        if ($model->load(Yii::$app->request->post()) && $domisili->load(Yii::$app->request->post()) && $lokasi->load(Yii::$app->request->post()) && $model->save()) {
			$domisili->current = 1;
			$domisili->nik = $id;
			$domisili->nik_pencatat = Yii::$app->user->id;
			$domisili->kelurahan = $lokasi->kelurahan;
			$domisili->save(false);
			$currentDomisili['current'] = 0;
			$currentDomisili->update();
			//VarDumper::dump($domisili->getErrors(),5678,true);
			//VarDumper::dump($model->getErrors(),5678,true);
			//echo var_dump($domisili);
			$this->writeLog('Memperbarui Data dengan NIK '.$model->nik);
            return $this->redirect(['view', 'id' => $model->nik]);
        } else {
            return $this->render('update', [
                'model' => $model,
				'updatable' => $model,
				'domisili' => $currentDomisili,
				'lokasi' => $lokasi,
            ]);
        }
    }

    /**
     * Deletes an existing DataManagement model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }*/
	
	/**
     * Arsip an exiting DataManagement model.
     * If asrip is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionArsip($id)
    {
        $model = new \yii\base\DynamicModel(['jenis','kewargaan','tanggal']);
		$model->addRule(['tanggal'], 'safe');
		$model->addRule(['jenis'], 'integer');
		$model->addRule(['kewargaan'], 'string');
		if($model->load(Yii::$app->request->post())){
			switch($model->jenis){
				case '1':
					$kewarganegaraan = new TabelKewarganegaraan();
					$kewarganegaraan->kewargaan = $model->kewargaan;
					$kewarganegaraan->nik = $id;
					$kewarganegaraan->nik_pencatat = Yii::$app->user->id;
					if($kewarganegaraan->validate()){
						$kewarganegaraan->save(false);
					}
					return $this->redirect(['index']);
				case '2':
					$meninggal = new TabelKematian();
					$meninggal->nik = $id;
					$meninggal->tanggal_kematian = Yii::$app->formatter->asDate($model->tanggal, 'yyyy-MM-dd');
					$meninggal->nik_pencatat = Yii::$app->user->id;
					if($meninggal->validate()){
						$meninggal->save(false);
					}
					return $this->redirect(['index']);
				
			}
		}else{
			return $this->renderAjax('arsip', [
				'model' => $model,
			]);
		}
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
	
	/*
	 * Write to table log
	 * 
	 * @param string $action
	 */
	public function writeLog($action){
		$activity = new UserActivity();
		$activity->nik = Yii::$app->user->id;
		$activity->action = $action;
		$activity->save();
	}
}
