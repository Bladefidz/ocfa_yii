<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\DataSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Data Managements';
$this->params['breadcrumbs'][] = $this->title;
$gridColumns = [
    'nik',
	'nama',
	'tempat_lahir',
	'tanggal_lahir',
	//'jenis_kelamin',
	 //'golongan_darah',
	 'tanggal_diterbitkan',
	// 'nip_pencatat',
	// 'kewarganegaraan',
];
$gridHeader = [
    'nik' => 'NIK',
	'nama' => 'Nama',
	'tempat_lahir' => 'Tempat Lahir',
	'tanggal_lahir' => 'Tanggal Lahir',
	//'jenis_kelamin',
	 //'golongan_darah',
	 'tanggal_diterbitkan' => 'Tanggal Diterbitkan',
	// 'nip_pencatat',
	// 'kewarganegaraan',
];
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
				<?php /*Excel::widget([
					'models' => \common\models\DataManagement::find(),
					'mode' => 'export', //default value as 'export'
					'columns' => $gridColumns, //without header working, because the header will be get label from attribute label. 
					'headers' => $gridHeader,
				]); FAILLL*/ ?>
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
						 //'golongan_darah',
						 'tanggal_diterbitkan',
						// 'nip_pencatat',
						// 'kewarganegaraan',

						[
							'class' => 'yii\grid\ActionColumn',
							'template'=>'{view} {update} {arsip}',
							'buttons' => [
								'arsip' => function ($url, $model) {
									return Html::a('<span class="fa fa-file-archive-o"></span>', '#', [
												'title' => Yii::t('app', 'Arsip'),
												'onclick' => 'arsip("'.$model->nik.'","'.substr($url,0,strlen($url)-20).'")',
									]);
								}
							  ],
						],
					],
				]); ?>
				<?php Pjax::end() ?>
			</div><!--box footer-->
		</div><!--box-->
    </div>
	<script>
function arsip(nik,url) {
    var ket = prompt("Isikan keterangan", "");
    
    if (ket != null) {
		window.open(url+'?id='+nik+'&ket='+encodeURI(ket),"_self");
    }
}
</script>
</div>
