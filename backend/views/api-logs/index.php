<?php

use yii\helpers\Html;
use yii\grid\GridView;

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
				<?= GridView::widget([
					'dataProvider' => $dataProvider,
					'filterModel' => $searchModel,
					'columns' => [
						['class' => 'yii\grid\SerialColumn'],

						//'id',
						'ip',
						'nik',
						//'uri_access',
						'timestamp',
						'method',

						[
							'class' => 'yii\grid\ActionColumn',
							'template' => '{view} {delete}'
						],
					],
				]); ?>
			</div><!--box footer-->
		</div><!--box-->
    </div>
</div>
