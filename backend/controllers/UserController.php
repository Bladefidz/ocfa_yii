<?php

namespace backend\controllers;

use Yii;
use common\models\User;
use backend\models\UserSearch;
use backend\models\UserCreate;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * UserController implements the CRUD actions for User model.
 */
class UserController extends CoreController
{
    /**
     * Lists all User models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new UserSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
	
	/**
     * Exchange all data
	 * @param User $model
     * @return mixed
     */
    public function exchangeData($model)
    {
		$level ="";
		//echo var_dump($model);
        switch($model->level){
			case '0':
				$level = 'Internal Instansi Non Pemerintah';
				break;
			case '1':
				$level = 'Admin';
				break;
			case '2':
				$level = 'Internal Instansi Pemerintah';
				break;
			case '3':
				$level = 'Eksternal Instansi Non Pemerintah';
				break;
			case '4':
				$level = 'Eksternal Instansi Pemerintah';
				break;
		}
		$model->level = $level;
		return $model;
    }

    /**
     * Displays a single User model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->exchangeData($this->findModel($id)),
        ]);
    }

    /**
     * Creates a new User model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionBuat()
    {
        $model = new UserCreate();
		$userModel = new User();

        if ($model->load(Yii::$app->request->post())) {
			if ($user = $model->signup()) {
                $this->writeLog("Membuat user baru dengan username $model->username");
				return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            return $this->render('create', [
                'model' => $model,
				'userModel' => $userModel,
            ]);
        }
    }

    /**
     * Updates an existing User model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $userModel = $this->findModel($id);
		$model = $this->findCreateModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save() && $userModel->save()) {
            $this->writeLog("Memperbarui informasi user dengan username $userModel->username");
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
				'userModel' => $userModel,
            ]);
        }
    }

    /**
     * Blocks an existing User model.
     * If block is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionBlock($id)
    {
        $user = $this->findModel($id);
		$user->status = 0;
		
        if($user->save())
            $this->writeLog("Memblokir user dengan username $user->username");;

        return $this->redirect(['/user']);
    }

    /**
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
	
	/**
     * Finds the UserCreate model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return UserCreate the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findCreateModel($id)
    {
        if (($model = UserCreate::findUser($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
