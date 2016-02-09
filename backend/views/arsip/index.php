<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\UserActivitySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Arsip';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="arsip-index">

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

						'nik',
						'nama',
						'tempat_lahir',
						'tanggal_lahir',
						//'jenis_kelamin',
						 'golongan_darah',
						[
							'attribute' => 'tabelKematian.tanggal_kematian',
							'label' => 'Tanggal Perubahan',
							'value' => function($model){
								return $model->tabelKematian['tanggal_kematian'] != null ? $model->tabelKematian['tanggal_kematian'] : $model->tabelKewarganegaraan['tanggal_imigrasi'];
							}
							,
						],
						[
							'attribute' => 'tabelKematian.tanggal_kematian',
							'label' => 'Status',
							'value' => function($model){
								return $model->tabelKematian['tanggal_kematian'] != null ? 'Meninggal' : 'Pindah Kewarganegaraan';
							}
							,
						],
						// 'nip_pencatat',
						// 'kewarganegaraan',

						[
							'class' => 'yii\grid\ActionColumn',
							'template'=>'{view}',
							/*'buttons' => [
								'take' => function ($url, $model) {
									return Html::a('<span class="fa fa-link"></span>', $url, [
												'title' => Yii::t('app', 'Take'),
									]);
								}
							  ],
							  */
						],
					],
				]); ?>
				<?php Pjax::end() ?>
			</div><!--box footer-->
		</div><!--box-->
    </div>
</div>