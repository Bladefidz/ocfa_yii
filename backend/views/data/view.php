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
						'nip_pencatat',
					],
					
				]);
				?>
			</div>
			<div class="box-header with-border">
				<h3 class="box-title">Updateable Data</h3>
			</div>
			<div class="box-body">
				<p>
					<?= Html::a('Update', ['update', 'id' => $model->nik], ['class' => 'btn btn-primary']) ?>
				</p>
				
				<?= DetailView::widget([
					'model' => $updateable,
					'attributes' => [
						[
							'attribute'=>'foto',
							'value'=>$updateable->foto,
							'format' => ['image',['width'=>'320','height'=>'240']],
						],
						'agama',
						'provinsi',
						'kabupaten',
						'kecamatan',
						'kelurahan',
						'rt',
						'rw',
						'alamat',
						'no_kk',
						'status_keluarga',
						'status_perkawinan',
						'pekerjaan',
						'pendidikan_terakhir',
						'kewarganegaraan',
					],
					
				]);
				?>
			</div><!--box footer-->
		</div><!--box-->
    </div>
</div>
