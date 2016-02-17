<?php

namespace api\modules\v1\controllers;

use yii;
use api\common\models\User;
use api\modules\v1\models\ApiResources;
use api\common\libraries\Logger;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\Response;
use yii\filters\VerbFilter;

/**
 * ApiControoler class
 * localhost/ocfa_yii/api/<method>
 */
class PendudukController extends \api\common\libraries\RestReactor
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
	 * [$domisili description]
	 * @var array
	 */
	private $domisiliCols = array();

	/**
	 * Yii default to call all object 
	 * @return 
	 */
	public function init()
	{
	    parent::init();

	    $this->setBaseCols();
	    $this->setUpdatableCols();
	    $this->setDomisili();
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
			'status_perkawinan',
			'pekerjaan',
			'pendidikan_terakhir',
		);
	}

	/**
	 * [setDomisili description]
	 */
	private function setDomisili()
	{
		$this->domisiliCols = array(
			'kelurahan',
			'alamat',
			'rt',
			'rw',
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
			} elseif (in_array($col, $this->domisiliCols)) {
				$selectedCols .= "`tabel_domisili`.`$col`".",";
			} elseif ($col == 'kewarganegaraan') {
				$selectedCols .= "`tabel_kewarganegaraan`.`kewargaan`".",";
			} else {
				continue;
			}
		}

		return substr_replace($selectedCols, '', -1);
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
    	$logger = new Logger();
    	$user = new User();

    	if ($request->isPost) {
    		$nik = !empty($_POST['nik'])?$_POST['nik']:'';
    		$accToken = !empty($_POST['access-token'])?$_POST['access-token']:'';
    	} elseif($request->isGet) {
    		$nik = !empty($_GET['nik'])?$_GET['nik']:'';
    		$field = isset($_GET['field'])?$_GET['field']:"nama-jenis_kelamin-tempat_lahir-tanggal_lahir";
    		$search = !empty($_GET['search'])?$_GET['search']:'';
    		$accToken = !empty($_GET['access-token'])?$_GET['access-token']:'';

    		if (empty($accToken)) {
    			throw new yii\web\UnauthorizedHttpException;
    		}

    		if(empty($nik)){
		      	throw new yii\web\BadRequestHttpException;
		    } else {
		    	$accNIK = User::findIdentityByAccessToken($accToken)->id;
		    	$data = $this->getPenduduk($nik, $field);
		    	
		    	Logger::write($accNIK);

		    	if(!empty($data)) {
		    		return [
		    			"name" => "success",
		    			'status' => '200',
			        	'message' => 'found',
			        	'nik_responsible' => $accNIK,
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