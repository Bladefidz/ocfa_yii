<?php

namespace api\modules\v1\controllers;

use yii;
use common\models\DataManagement;
use common\models\BaseUpdatable;
use common\models\Provinces;
use common\models\Regencies;
use common\models\Districts;
use common\models\Villages;
use api\modules\v1\models\ApiResources;
use backend\controllers\DataController;
use backend\models\UpdatableSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\Response;
use yii\filters\VerbFilter;
use yii\filters\auth\QueryParamAuth;

/**
 * ApiControoler class
 * localhost/ocfa_yii/api/<method>
 */
class PendudukController extends \yii\rest\Controller
{
	/**
	 * List of base table column name.
	 * @var array
	 */
	private $baseCols = array();

	/**
	 * List of base_updatable table column name.
	 * @var array
	 */
	private $baseUpdatableCols = array();

	/**
	 * Yii default to call all object 
	 * @return 
	 */
	public function init()
	{
	    parent::init();

	    $this->setBaseCols();
	    $this->setUpdatableCols();
	}

	/**
	 * Yii class behavior
	 * @return
	 */
	public function behaviors(){
      	$behaviors = parent::behaviors();
      	$behaviors['authenticator'] = [
        	'class' => QueryParamAuth::className(),
      	];
      	return $behaviors;
    }

    /**
     * Verb to controll allowed action method
     * @return array key is controller's name dan value is method
     */
	protected function verbs()
	{
		return [
		   'index' => ['POST', 'GET'],
		];
	}

	/**
	 * Set list of column name from base table
	 */
	private function setBaseCols()
	{
		$this->baseCols = array(
			'nama',
			'tempat_lahir',
			'tanggal_lahir',
			'jenis_kelamin',
			'golongan_darah',
			'tanggal_diterbitkan',
			'nip_pencatat',
			'kewarganegaraan'
		);
	}

	/**
	 * Set list of column name from base_updatable table
	 */
	private function setUpdatableCols()
	{
		$this->baseUpdatableCols = array(
			'nik',
			'agama',
			'foto',
			'alamat',
			'rt',
			'rw',
			'kecamatan',
			'kelurahan',
			'kabupaten',
			'provinsi',
			'status_perkawinan',
			'pekerjaan',
			'pendidikan_terakhir'
		);
	}

	/**
	 * Get requested parameter identified by column's name
	 * @param  String $field request parameter separated by '-'
	 * @return array        list of requested column's name
	 */
	private function getSelectedCols($field)
	{
		$selectedCols = null;
    	$cols = explode('-', $field);

    	if(in_array('alamat_advanced', $cols)) {
			array_push($cols, 'rt', 'rw', 'kelurahan', 'kecamatan', 'kabupaten', 'provinsi');
		}

		foreach ($cols as $col) {
			if (in_array($col, $this->baseCols)) {
				$selectedCols .= "`base`.`$col`".",";
			} elseif (in_array($col, $this->baseUpdatableCols)) {
				$selectedCols .= "`base_updatable`.`$col`".",";
			} else {
				continue;
			}
		}

		return substr_replace($selectedCols, '', -1);
	}

	/**
	 * Nomalize requested civil data to be human readable
	 * @param  array $data civil data
	 * @return array       normalized civil data
	 */
	public static function exchangeData($data)
	{
		if(isset($data['jenis_kelamin'])) {
    		$data['jenis_kelamin'] = DataManagement::getJenisKelamin($data['jenis_kelamin']);
    	}

    	if(isset($data['kewarganegaraan'])) {
    		$data['kewarganegaraan'] = DataManagement::getKewarganegaraan($data['kewarganegaraan']);
    	}

    	if(isset($data['provinsi'])) {
    		$data['provinsi'] = Provinces::findOne($data['provinsi'])->name;
    	}

    	if(isset($data['kabupaten'])) {
			$data['kabupaten'] = Regencies::findOne($data['kabupaten'])->name;
		}

		if(isset($data['kecamatan'])) {
			$data['kecamatan'] = Districts::findOne($data['kecamatan'])->name;
		}

		if(isset($data['kelurahan'])) {
			$data['kelurahan'] = Villages::findOne($data['kelurahan'])->name;
		}

		if(isset($data['agama'])) {
			switch($data['agama']){
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
			$data['agama'] = $agama;
		}

		if(isset($data['status_perkawinan'])) {
			switch($data['status_perkawinan']){
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
			$data['status_perkawinan'] = $status_perkawinan;
		}

		if(isset($data['pekerjaan'])) {
			if($data['pekerjaan'] == 'NULL'){
				$data['pekerjaan'] = '-';
			}
		}

		if(isset($data['pendidikan_terakhir'])) {
			switch($data['pendidikan_terakhir']){
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
			$data['pendidikan_terakhir'] = $pend_terakhir;
		}

		return $data;
	}

	/**
	 * Get civil data
	 * @param  integer $nik   civil unique indentity
	 * @param  string $field requested column name
	 * @return array        normalized civil data
	 */
	private function getPenduduk($nik, $field)
	{
		$reqCols = $this->getSelectedCols($field);

		if(!empty($reqCols)) {
    		$model = new ApiResources();
    		$data = $model->getPenduduk($nik, $reqCols);
    		return $this->exchangeData($data);
		}
	}

	/**
	 * API to access civil data
	 * @return
	 */
    public function actionIndex()
    {
    	$request = Yii::$app->request;

    	if ($request->isPost) {
    		$nik = !empty($_POST['nik'])?$_POST['nik']:'';
    	} elseif($request->isGet) {
    		$nik = !empty($_GET['nik'])?$_GET['nik']:'';
    		$field = isset($_GET['field'])?$_GET['field']:"nama-jenis_kelamin-tempat_lahir-tanggal_lahir";
    		$search = !empty($_GET['search'])?$_GET['search']:'';

    		if(empty($nik)){
		      	throw new yii\web\BadRequestHttpException;
		    } else {
		    	$data = $this->getPenduduk($nik, $field);
		    	
		    	if(!empty($data)) {
		    		return [
		    			"name" => "success",
		    			'status' => '200',
			        	'message' => 'found',
			        	'data' => $data
			      	];
		    	} else {
		    		throw new yii\web\NotAcceptableHttpException;
		    	}
		    }
    	} else {
    		throw new yii\web\MethodNotAllowedHttpException;
    	}
    }
}