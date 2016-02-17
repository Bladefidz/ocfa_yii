<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\DataManagement */

$this->title = 'NIK '.$model->nik;
$this->params['breadcrumbs'][] = ['label' => 'Data Managements', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="data-management-view">
	<div class="col-md-11">
		<div class="box box-info">
			<div class="box-header with-border">
				<h1 class="box-title"><?='Detail Data'?></h1>
			</div>
			<div class="box-body">
				<p>
					<?php /*Html::a('Delete', ['delete', 'id' => $model->nik], [
						'class' => 'btn btn-danger',
						'data' => [
							'confirm' => 'Are you sure you want to delete this item?',
							'method' => 'post',
						],
					])*/ ?>
				</p>

				<?= DetailView::widget([
					'model' => $model,
					'attributes' => [
						'nik',
						'nama',
						'tempat_lahir',
						'tanggal_lahir',
						'jenis_kelamin',
						'golongan_darah',
						'tanggal_diterbitkan',
						'nik_pencatat',
						[
							'attribute' => 'tabelDomisili.kelurahan',
							'label' => 'Provinsi',
							'value' => $lokasi->provinsi,
						],
						[
							'attribute' => 'tabelDomisili.kelurahan',
							'label' => 'Kabupaten/Kota',
							'value' => $lokasi->kabupaten,
						],
						[
							'attribute' => 'tabelDomisili.kelurahan',
							'label' => 'Kecamatan',
							'value' => $lokasi->kecamatan,
						],
						[
							'attribute' => 'tabelDomisili.kelurahan',
							'label' => 'Kelurahan',
							'value' => $lokasi->kelurahan,
						],
						'baseUpdatable.agama',
						'baseUpdatable.no_kk',
						'baseUpdatable.status_keluarga',
						'baseUpdatable.status_perkawinan',
						'baseUpdatable.pekerjaan',
						'baseUpdatable.pendidikan_terakhir',
						[
							'attribute'=>'baseUpdatable.foto',
							'value'=>$model->baseUpdatable->foto,
							'format' => ['image',['width'=>'320','height'=>'240']],
						],
					],
					
				]);
				?>
			</div>
			<div class="box-footer text-center">
				<p>
					<?= Html::a('Update', ['update', 'id' => $model->nik], ['class' => 'btn btn-primary']) ?>
				</p>
			</div><!--box footer-->
		</div><!--box-->
    </div>
</div>
