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
* Kartu Keluarga
* Format: No. KK
* Nama kepala keluarga, alamat, rt/rw, desa/kelurahan, kecamatan, kabupaten/kota, kodepos, provinsi
* Tabel 1
* Nama lengkap, NIK, jenis_kelamin, tempat_lahir, tanggal_lahir, agama, pendidikan, jenis_pekerjaan
* Tabel 2
*  
*/
class KartukeluargaController extends \api\common\libraries\RestReactor
{
	/**
	 * Yii default to call all object 
	 * @return 
	 */
	public function init()
	{
	    parent::init();
	}

	/**
     * Verb to controll allowed action method
     * @return array key is controller's name dan value is method
     */
    public function verbs()
	{
		return [
		   'index' => ['POST', 'GET'],
		];
	}

	/**
	 * [getKK description]
	 * @return [type] [description]
	 */
	private function getKK($noKK)
	{
		$model = new ApiResources();
		$data = $model->getFullKK($noKK);

		$dataKK = [];
		foreach ($data as $kk) {
			if (!isset($dataKK[0]['no_kk'])) {
				$dataKK[0]['no_kk'] = $kk['no_kk'];
			}

			if (!isset($dataKK[0]['kepala_keluarga'])) {
				$dataKK[0]['kepala_keluarga'] = $kk['kepala_keluarga'];
			}

			if (!isset($dataKK[0]['tanggal_terbit'])) {
				$dataKK[0]['tanggal_terbit'] = $kk['tanggal_terbit'];
			}

			if (!isset($dataKK[0]['tanggal_pembaruan'])) {
				$dataKK[0]['tanggal_pembaruan'] = $kk['tanggal_pembaruan'];
			}

			if (!isset($dataKK[0]['detail'])) {
				$dataKK[0]['detail'] = [];
			}

			array_push(
				$dataKK[0]['detail'],
				[
					'status_keluarga' => $kk['status_keluarga'],
					'nik' => $kk['nik'],
					'nama' => $kk['nama'],
					'jenis_kelamin' => $kk['jenis_kelamin'],
					'tanggal_lahir' => $kk['tanggal_lahir']
				]
			);
		}

		return $dataKK;
	}

	/**
	 * [getInfoKK description]
	 * @param  [type] $nik [description]
	 * @return [type]      [description]
	 */
	private function getInfoKK($nik)
	{
		$model = new ApiResources();
		$data = $model->getInfoKK($nik);
		return $this->exchangeData($data);
	}

	/**
	 * API to access data kartu keluarga
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
    		$accToken = !empty($_GET['access-token'])?$_GET['access-token']:'';
    		$noKK = !empty($_GET['no_kk'])?$_GET['no_kk']:'';
    		$nik = !empty($_GET['nik'])?$_GET['nik']:'';

    		if (empty($accToken)) {
    			throw new yii\web\BadRequestHttpException;
    		} else {
    			$data = null;

    			if (!empty($noKK) && empty($nik)) {
    				$data = $this->getKK($noKK);
    			} elseif (empty($noKK) && !empty($nik)) {
    				$data = $this->getInfoKK($nik);
    			}
		    	
		    	if(!empty($data)) {
		    		return [
		    			"name" => "success",
		    			'status' => '200',
			        	'message' => 'found',
			        	'nik_responsible' => $user->findIdentityByAccessToken($accToken)->id,
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