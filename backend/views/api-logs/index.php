<?php

use yii\helpers\Html;
use yii\helpers\BaseStringHelper;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\ApiLogsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Api Logs';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="api-logs-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

	<div class="col-md-11">
		<div class="box box-info">
			<div class="box-header with-border">
				<h3 class="box-title"><?='Data Arsip'?></h3>
			</div>
			<div class="box-body">
				<?php Pjax::begin() ?>
				<?= GridView::widget([
					'dataProvider' => $dataProvider,
					'filterModel' => $searchModel,
					'columns' => [
						['class' => 'yii\grid\SerialColumn'],
						'ip',
//<<<<<<< HEAD
						//'nik',
						[
							'attribute' => 'uri_access',
							'value' => function($model){
								return BaseStringHelper::truncate($model->uri_access,50,' ..... ',null,true);
							}
						],
						
						//'method',
						//'timestamp',
//=======
						'timestamp',
						// 'method',
						[
							'attribute' => 'method',
							'format' => 'raw',
							'value' => function ($data){
								return $data->method;
							},
							'filter' => array('GET' => 'GET', 'POST' => 'POST', 'PUT' => 'PUT', 'DELETE' => 'DELETE', 'OPTION' => 'OPTION')
						],
//>>>>>>> origin/master
						[
							'class' => 'yii\grid\ActionColumn',
							'template' => '{view}',
							'header' => 'Actions'
						],
					],
				]); ?>
				<?php Pjax::end() ?>
			</div><!--box footer-->
		</div><!--box-->
    </div>
</div>
