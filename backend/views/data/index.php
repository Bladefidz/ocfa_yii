<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\DataSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Data Managements';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="data-management-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
	
	<div class="col-md-11">
		<div class="box box-info">
			<div class="box-header with-border">
				<h3 class="box-title"><?='Data Penduduk'?></h3>
			</div>
			<div class="box-body">
				<p>
					<?= Html::a('Input Data Penduduk', ['create'], ['class' => 'btn btn-success']) ?>
				</p>
				<?= GridView::widget([
					'dataProvider' => $dataProvider,
					'filterModel' => $searchModel,
					'columns' => [
						['class' => 'yii\grid\SerialColumn'],

						'nik',
						'nama',
						'tempat_lahir',
						'tanggal_lahir',
						//'jenis_kelamin',
						 //'golongan_darah',
						 'tanggal_diterbitkan',
						// 'nip_pencatat',
						// 'kewarganegaraan',

						[
							'class' => 'yii\grid\ActionColumn',
							'template'=>'{view} {update} {arsip}',
							'buttons' => [
								'arsip' => function ($url, $model) {
									return Html::a('<span class="fa fa-file-archive-o"></span>', $url, [
												'title' => Yii::t('app', 'Arsip'),
									]);
								}
							  ],
							  'urlCreator' => function ($action, $model, $key, $index) {
								if ($action === 'arsip') {
									$url ='/arsip?id='.$model->nik;
									return $url;
								}
							  }
						],
					],
				]); ?>
			</div><!--box footer-->
		</div><!--box-->
    </div>
</div>
