<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\components\AccessRule;
use common\models\User;
use common\models\UserActivity;

/**
* CoreController
*
* Access role for accessing method in backend controllers, except PengaturanController 
*/
class CoreController extends Controller
{
	/**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'ruleConfig' => [
			        'class' => AccessRule::className(),
			    ],
			    'only' => ['create', 'view', 'update', 'delete'],
                'rules' => [
                    [
                        'actions' => ['login', 'error'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout', 'index'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    [
                        'actions' => ['create', 'update', 'delete'],
                        'allow' => true,
                        'roles' => [
                        	User::LEVEL_ADMIN
                        ],
                    ],
                    [
                        'actions' => ['view'],
                        'allow' => true,
                        'roles' => [
                        	User::LEVEL_ADMIN,
                        	User::LEVEL_INTERNAL_PEMERINTAH,
                        	User::LEVEL_INTERNAL_NON_PEMERINTAH,
                        	User::LEVEL_EKSTERNAL_PEMERINTAH,
                        ],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
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