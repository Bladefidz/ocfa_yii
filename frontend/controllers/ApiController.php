<?php

namespace frontend\controllers;

use yii;

class ApiController extends \yii\rest\Controller
{
	public function behaviors(){
      	$behaviors = parent::behaviors();
      	$behaviors['authenticator'] = [
        	'class' => QueryParamAuth::className(),
      	];
      	return $behaviors;
    }

	protected function verbs()
	{
		return [
		   'data' => ['GET'],
		];
	}

    public function actionData()
    {
    	
    }
}