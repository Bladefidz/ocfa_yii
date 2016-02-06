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
class StatistikController extends \yii\rest\Controller
{
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
		   'index' => ['GET'],
		];
	}

	/**
	 * API to access civil statistic data
	 * @return
	 */
    public function actionIndex()
    {
    	$model = new ApiResources();
    	$logger = new Logger();
    	$user = new User();

    	if ($request->isGet) {
    		$accToken = !empty($_POST['access-token'])?$_POST['access-token']:'';
    		$type = !empty($_GET['type'])?$_GET['type']:'';
    		$yearstart = !empty($_GET['tahun_mulai'])?$_GET['tahun_mulai']:'';
    		$yearend = !empty($_GET['tahun_sampai'])?$_GET['tahun_sampai']:'';

    		$model->provinsi = !empty($_GET['provinsi'])?$_GET['provinsi']:'';
    		$model->kota = !empty($_GET['kota'])?$_GET['kota']:'';
    		$model->kecamatan = !empty($_GET['kecamatan'])?$_GET['kecamatan']:'';
    		$model->kelurahan = !empty($_GET['kelurahan'])?$_GET['kelurahan']:'';

    		if (empty($type) && empty($accToken)) {
    			throw new yii\web\BadRequestHttpException;
    		} else {    			
    			switch ($type) {
	    			case 'jumlah_penduduk':
	    				return [
			    			"name" => "success",
			    			'status' => '200',
				        	'message' => 'found',
				        	'nik_responsible' => $user->findIdentityByAccessToken($accToken)->id,
				        	'data' => $model->getStatJmlPdd()
				      	];
	    				break;
	    			case 'kematian_kelahiran':
	    				# code...
	    				break;
	    			case 'umur':
	    				# code...
	    				break;
	    			
	    			default:
	    				# code...
	    				break;
	    		}
    		}
    	}
    }
}