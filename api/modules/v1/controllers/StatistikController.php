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
class StatistikController extends \api\common\libraries\RestReactor
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
	protected function verbs()
	{
		return [
		   'index' => ['GET'],
		];
	}

	/**
	 * [getAllStat description]
	 * @return [type] [description]
	 */
	public function getAllStat()
	{

	}

	/**
	 * [getStatbyLoc description]
	 * @return [type] [description]
	 */
	private function getStatbyLoc()
	{
		$model = new ApiResources();

		$model->provinsi = !empty($_GET['provinsi'])?$_GET['provinsi']:'';
		$model->kota = !empty($_GET['kota'])?$_GET['kota']:'';
		$model->kecamatan = !empty($_GET['kecamatan'])?$_GET['kecamatan']:'';
		$model->kelurahan = !empty($_GET['kelurahan'])?$_GET['kelurahan']:'';

		return $model->getStatJmlPddbyLocation();
	}

	/**
	 * [getStatbyYear description]
	 * @return [type] [description]
	 */
	private function getStatbyYear()
	{
		$yearstart = !empty($_GET['mulai_tahun'])?$_GET['mulai_tahun']:'';
		$yearend = !empty($_GET['sampai_tahun'])?$_GET['sampai_tahun']:'';
		$year = !empty($_GET['tahun'])?$_GET['tahun']:'';

		$model = new ApiResources();
		if (!empty($yearstart) && !empty($yearend) && empty($year)) {
			return $model->getStatJmlPddbyRangeYear($yearstart, $yearend);
		} elseif (!empty($year) && empty($yearstart) && empty($yearend)) {
			return $model->getStatJmlPddbyYear($year);
		} else {
			throw new yii\web\BadRequestHttpException;
			exit();
		}
	}

	/**
	 * API to access civil statistic data
	 * @return
	 */
    public function actionIndex()
    {
    	$request = Yii::$app->request;
    	$logger = new Logger();
    	$user = new User();

    	if ($request->isGet) {
    		$accToken = !empty($_GET['access-token'])?$_GET['access-token']:'';
    		$type = !empty($_GET['type'])?$_GET['type']:'';

    		if (empty($type)) {
    			throw new yii\web\BadRequestHttpException;
    		} else {    			
    			switch ($type) {
	    			case 'lokasi':
	    				$data = $this->getStatbyLoc();
	    				break;
	    			case 'tahun':
			    		$data = $this->getStatbyYear();
	    				break;	    			
	    			default:
	    				throw new yii\web\BadRequestHttpException;
	    				break;
	    		}

	    		return [
	    			"name" => "success",
	    			'status' => '200',
		        	'message' => empty($data)?'found':'not found',
		        	'nik_responsible' => $user->findIdentityByAccessToken($accToken)->id,
		        	'data' => $data
		      	];
    		}
    	} else {
    		throw new yii\web\MethodNotAllowedHttpException;
    	}
    }
}