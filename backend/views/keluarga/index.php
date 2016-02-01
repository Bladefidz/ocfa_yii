<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

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
					<?= Html::a('Tambah KK', ['create'], ['class' => 'btn btn-success']) ?>
				</p>
				<?php Pjax::begin() ?>
				<?= GridView::widget([
					'dataProvider' => $dataProvider,
					'filterModel' => $searchModel,
					'columns' => [
						['class' => 'yii\grid\SerialColumn'],

						'id',
						'kepala_keluarga',
						'jml_anak',
						'jml_anggota',
						'tanggal_terbit',
						// 'tanggal_pembaruan',
						// 'status',

						['class' => 'yii\grid\ActionColumn'],
					],
				]); ?>
				<?php Pjax::end() ?>
			</div><!--box footer-->
		</div><!--box-->
    </div>
</div>
