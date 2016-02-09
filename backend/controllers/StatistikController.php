<?php

namespace backend\controllers;

use Yii;
use common\models\DataManagement;
use backend\models\UserActivitySearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * UserActivityController implements the CRUD actions for UserActivity model.
 */
class StatistikController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all UserActivity models.
     * @return mixed
     */
    public function actionIndex()
    {
		$model = new UserActivitySearch;
		$request = Yii::$app->request;
		if ($model->load(Yii::$app->request->post())){
			if (!$model->hasErrors()) {
				$dbCommand = Yii::$app->db->createCommand("SELECT YEAR(tanggal_lahir) as tanggal_diterbitkan,COUNT(*) as count FROM base WHERE YEAR(tanggal_lahir) BETWEEN '".$model->dari."' AND '".$model->sampai."' GROUP BY YEAR(tanggal_lahir)");
		   }
		}else{
			$dbCommand = Yii::$app->db->createCommand("
			   SELECT YEAR(tanggal_lahir) as tanggal_diterbitkan,COUNT(*) as count FROM base WHERE tanggal_lahir BETWEEN '".\Yii::$app->formatter->asDate('-30 year','php:Y-m-d')."' AND '".\Yii::$app->formatter->asDate('now','php:Y-m-d')."' GROUP BY YEAR(tanggal_lahir)
			");
		}

		$query = $dbCommand->queryAll();
        //$dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'query' => $query,
			'model' => $model,
            //'dataProvider' => $dataProvider,
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
        $this->findModel($id)->delete();

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
        if (($model = DataManagement::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
