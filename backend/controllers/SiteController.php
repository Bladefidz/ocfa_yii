<?php
namespace backend\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use common\models\LoginForm;
use common\models\User;
use yii\filters\VerbFilter;

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
			return $this->render('index');
		}else{
			return $this->render('user_index');
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
        Yii::$app->user->logout();

        return $this->goHome();
    }
}
