<?php

namespace backend\controllers;

use Yii;
use common\models\User;
use common\models\UserActivity;
use backend\models\UserActivitySearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * UserActivityController implements the CRUD actions for UserActivity model.
 */
class UserActivityController extends CoreController
{
    /**
     * Lists all UserActivity models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new UserActivitySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single UserActivity model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Deletes an existing UserActivity model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $userActv = $this->findModel($id);
        if($userActv->delete())
            $this->writeLog("Menghapus catatan aktivitas user dengan username ".User::findOne($id)->username." dan catatan ".$userActv->action);

        return $this->redirect(['index']);
    }

    /**
     * Finds the UserActivity model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return UserActivity the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = UserActivity::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
