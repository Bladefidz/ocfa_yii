<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\UserActivity */

$this->title = 'NIK '.$model->nik;
$this->params['breadcrumbs'][] = ['label' => 'Arsip', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-activity-view">

    <div class="col-md-11">
		<div class="box box-info">
			<div class="box-header with-border">
				<h1 class="box-title"><?='Detail Arsip Data'?></h1>
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
							'attribute' => 'tabelKematian.tanggal_kematian',
							'label' => 'Tanggal Perubahan',
							'value' => $model->tabelKematian['tanggal_kematian'] != null ? $model->tabelKematian['tanggal_kematian'] : $model->tabelKewarganegaraan['tanggal_imigrasi'],
						],
						[
							'attribute' => 'tabelKematian.tanggal_kematian',
							'label' => 'Status',
							'value' => $model->tabelKematian['tanggal_kematian'] != null ? 'Meninggal' : 'Pindah Kewarganegaraan',
						],
						[
							'attribute' => 'tabelKewarganegaraan.kewargaan',
							'value' => $model->tabelKewarganegaraan['tanggal_imigrasi'] != null ? $model->tabelKewarganegaraan['kewargaan'] : '-',
							'visible' => $model->tabelKewarganegaraan['tanggal_imigrasi'] != null ? true : false,
						],
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
		</div><!--box-->
    </div>
</div>
