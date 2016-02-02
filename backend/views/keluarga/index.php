<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\bootstrap\Modal;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\KeluargaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Keluarga';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="keluarga-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
	
	<div class="col-md-11">
		<div class="box box-info">
			<div class="box-header with-border">
				<h3 class="box-title"><?='Data Penduduk'?></h3>
			</div>
			<div class="box-body">
				<p>
					<?= Html::a('Buat KK Baru', ['create'], ['class' => 'btn btn-success','data-toggle' => 'modal', 'data-target' => '#tambahKK', 'data-title' => 'Buat KK Baru']) ?>
				</p>
				<?php Pjax::begin() ?>
				<?= GridView::widget([
					'dataProvider' => $dataProvider,
					'filterModel' => $searchModel,
					'columns' => [
						['class' => 'yii\grid\SerialColumn'],

						'id',
						[
							'attribute' => 'nama',
							'format' => 'raw',
							'value' => function ($data){
								$isi = $data->kepalaKeluarga;
								//var_dump($isi);
								if(!empty($isi)){
									return $isi->nama;
								}else{
									return '-';
								}
							}
						],
						'tanggal_terbit',
						//'tanggal_pembaruan',
						[
							'attribute' => 'status',
							'format' => 'raw',
							'value' => function ($data){
								if($data->status == 1){
									return 'Aktif';
								}else{
									return 'Tidak Aktif';
								} 
							}
						],
						//'status',

						[
							'class' => 'yii\grid\ActionColumn',
							'template'=>'{view} {update} {arsip}',
							/*'buttons' => [
								'arsip' => function ($url, $model) {
									return Html::a('<span class="fa fa-file-archive-o"></span>', '#', [
												'title' => Yii::t('app', 'Arsip'),
												'onclick' => 'arsip("'.$model->nik.'","'.substr($url,0,strlen($url)-20).'")',
									]);
								}
							],*/
						],
					],
				]); ?>
				<?php Pjax::end() ?>
				<?php
					Modal::begin([
						'id' => 'tambahKK',
						'header' => '<h4 class="modal-title">Buat KK Baru</h4>'
					]);
					
					echo '...';
					
					Modal::end();
				?>
			</div><!--box footer-->
		</div><!--box-->
    </div>
</div>
<?php
	$this->registerJs("
		$('#tambahKK').on('show.bs.modal', function(event){
			var button = $(event.relatedTarget);
			var modal = $(this);
			var title = button.data('title');
			var href = button.attr('href');
			modal.find('.modal-title').html(title);
			modal.find('.modal-body').html('<i class=\"fa fa-spinner fa-spin\"></i>');
			$.post(href)
				.done(function(data){
					modal.find('.modal-body').html(data);
				});
		});
	");
?>
