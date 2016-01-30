<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\UserActivitySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'User Activities';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-activity-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

	<div class="col-md-11">
		<div class="box box-info">
			<div class="box-header with-border">
				<h3 class="box-title"><?='Data User'?></h3>
			</div>
			<div class="box-body">
				<?= GridView::widget([
					'dataProvider' => $dataProvider,
					'filterModel' => $searchModel,
					'columns' => [
						['class' => 'yii\grid\SerialColumn'],

						//'id',
						'nik',
						[
							'attribute' => 'nama',
							'format' => 'raw',
							'value' => function ($data){
								$isi = $data->nik0;
								if(!empty($isi)){
									return $isi->nama;
								}else{
									return '-';
								}
							}
						],
						'action',
						'timestamp',

						[
							'class' => 'yii\grid\ActionColumn',
							'template'=>'{view} {delete}',
						],
					],
				]); ?>
			</div><!--box footer-->
		</div><!--box-->
    </div>
</div>
