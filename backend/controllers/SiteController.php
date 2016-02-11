<?php
namespace backend\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use common\models\LoginForm;
use common\models\User;
use common\models\UserActivity;
use common\models\ApiLogs;
use yii\filters\VerbFilter;
use backend\models\ApiRequestSearch;
use backend\models\ApiLogsSearch;

/**
 * Site controller
 */
class SiteController extends Controller
{	
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
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
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
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

    public function actionIndex()
    {
		// get user from class User by id
		$getUser = User::findIdentity(Yii::$app->user->id);
		// check user level, if level equals 1 then user is an admin, he can through frontend or backend, if else user is a user, he only can through frontend
		if($getUser->level == 1){
			$dbCommand = Yii::$app->db->createCommand("
			   SELECT COUNT(*) as count FROM base WHERE jenis_kelamin = 1
			");
			$laki = $dbCommand->queryOne();
			$dbCommand = Yii::$app->db->createCommand("
			   SELECT COUNT(*) as count FROM base WHERE jenis_kelamin = 0
			");
			$pr = $dbCommand->queryOne();
			$dbCommand = Yii::$app->db->createCommand("
			   SELECT COUNT(*) as count FROM base
			");
			$hidup = $dbCommand->queryOne();
			$dbCommand = Yii::$app->db->createCommand("
			   SELECT COUNT(*) as count FROM tabel_kematian
			");
			$mati = $dbCommand->queryOne();
			$dbCommand = Yii::$app->db->createCommand("
			   SELECT COUNT(*) as count FROM base WHERE tanggal_lahir BETWEEN '".\Yii::$app->formatter->asDate('-5 year','php:Y-m-d')."' AND '".\Yii::$app->formatter->asDate('now','php:Y-m-d')."'
			");
			$balita = $dbCommand->queryOne();
			$dbCommand = Yii::$app->db->createCommand("
			   SELECT COUNT(*) as count FROM base WHERE tanggal_lahir BETWEEN '".\Yii::$app->formatter->asDate('-12 year','php:Y-m-d')."' AND '".\Yii::$app->formatter->asDate('-6 year','php:Y-m-d')."'
			");
			$anak = $dbCommand->queryOne();
			$dbCommand = Yii::$app->db->createCommand("
			   SELECT COUNT(*) as count FROM base WHERE tanggal_lahir BETWEEN '".\Yii::$app->formatter->asDate('-20 year','php:Y-m-d')."' AND '".\Yii::$app->formatter->asDate('-13 year','php:Y-m-d')."'
			");
			$remaja = $dbCommand->queryOne();
			$dbCommand = Yii::$app->db->createCommand("
			   SELECT COUNT(*) as count FROM base WHERE tanggal_lahir BETWEEN '".\Yii::$app->formatter->asDate('-50 year','php:Y-m-d')."' AND '".\Yii::$app->formatter->asDate('-21 year','php:Y-m-d')."'
			");
			$dewasa = $dbCommand->queryOne();
			$dbCommand = Yii::$app->db->createCommand("
			   SELECT COUNT(*) as count FROM base WHERE tanggal_lahir BETWEEN '".\Yii::$app->formatter->asDate('-65 year','php:Y-m-d')."' AND '".\Yii::$app->formatter->asDate('-51 year','php:Y-m-d')."'
			");
			$tua = $dbCommand->queryOne();
			$dbCommand = Yii::$app->db->createCommand("
			   SELECT COUNT(*) as count FROM base WHERE tanggal_lahir < '".\Yii::$app->formatter->asDate('-66 year','php:Y-m-d')."'
			");
			$lansia = $dbCommand->queryOne();
			return $this->render('index',[
				'laki' => $laki,
				'pr' => $pr,
				'hidup' => $hidup,
				'mati' => $mati,
				'balita' => $balita,
				'anak' => $anak,
				'remaja' => $remaja,
				'dewasa' => $dewasa,
				'tua' => $tua,
				'lansia' => $lansia,
			]);
		}else{
			$nik = Yii::$app->user->id;
			$dbCommand = Yii::$app->db->createCommand("
			   SELECT date(timestamp) as tanggal, COUNT(*) as count FROM user_activity WHERE nik = $nik group by date(timestamp)");
			$userAct = $dbCommand->query();
			$searchModelApi = new ApiRequestSearch();
			$dataProviderApi = $searchModelApi->search(Yii::$app->request->queryParams);
			$searchModel = new ApiLogsSearch();
			$dataProvider = $searchModel->search(Yii::$app->request->queryParams, $nik);
			// $ipAddress = ApiLogs::find()->where(['nik' => $nik])->orderBy('timestamp desc')->one()->ip;
			// $ipAddress = Yii::$app->db->createCommand("
			//    SELECT ip FROM api_logs WHERE nik = $nik ORDER BY timestamp desc");
			// $ipAddress = $ipAddress->queryOne();
			$ipAddress = $_SERVER['REMOTE_ADDR'];
			return $this->render('user_index',[
				'userAct' => $userAct,
				'searchModelApi' => $searchModelApi,
				'dataProviderApi' => $dataProviderApi,
				'searchModel' => $searchModel,
				'dataProvider' => $dataProvider,
				'ipAddress' => $ipAddress,
			]);
		}
    }

    public function actionLogin()
    {
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }

		//$modelUser = new User();
        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
			//if($model->getUserLevel() == 1){
				$this->writeLog('Melakukan Login');
				return $this->goBack();
			//}else{
				//return $this->redirect(['../../frontend/web/', 'id' => $modelUser->id]);
			//}
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }
	
	public function actionInputPenduduk(){
		// get user from class User by id
		$getUser = User::findIdentity(Yii::$app->user->id);
		// check user level, if level equals 1 then user is an admin, he can through frontend or backend, if else user is a user, he only can through frontend
		if($getUser->level == 1){
			return $this->render('input_penduduk');
		}else{
			return $this->redirect(['../../frontend/web/', 'id' => Yii::$app->user->id]);
		}
	}

    public function actionLogout()
    {
		$this->writeLog('Melakukan Logout');
        Yii::$app->user->logout();
        return $this->redirect('../../');
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
