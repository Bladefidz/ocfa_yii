<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use common\models\DataManagement;
use common\models\BaseUpdatable;

/* @var $this yii\web\View */
/* @var $model common\models\Keluarga */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Keluarga', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="keluarga-view">

    <div class="col-md-11">
		<div class="box box-info">
			<div class="box-header with-border">
				<h1 class="box-title"><?='Detail Data'?></h1>
			</div>
			<div class="box-body">
				<p>
					<?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
					<?= Html::a('Delete', ['delete', 'id' => $model->id], [
						'class' => 'btn btn-danger',
						'data' => [
							'confirm' => 'Are you sure you want to delete this item?',
							'method' => 'post',
						],
					]) ?>
				</p>

				<?php 
				$data = BaseUpdatable::find()->select('nik')->where(['no_kk' => $model->id,'status_keluarga' => 3])->asArray()->all();
				$istri = BaseUpdatable::find()->select('nik')->where(['no_kk' => $model->id,'status_keluarga' => 2])->one()['nik'];
				$nik = "";
				foreach($data as $val){
					if($nik != ""){
						$nik .= ",";
					}
					$nik .= $val['nik'];
				}
				if (!empty($nik)) {
					$dataNama = DataManagement::find()->select('nama')->where('nik in ('.$nik.')')->asArray()->all();
				} else {
					$dataNama = [];
				}
 				
				$namaIstri = DataManagement::findOne($istri)['nama'];
				$nama = "";
				foreach($dataNama as $val){
					if($nama != ""){
						$nama .= ", ";
					}
					$nama .= $val['nama'];
				}
				?>
				<?= DetailView::widget([
					'model' => $model,
					'attributes' => [
						'id',
						[
							'attribute' => 'kepala_keluarga',
							'value' => DataManagement::findOne($model->kepala_keluarga)->nama,
						],
						'tanggal_terbit',
						'tanggal_pembaruan',
						[
							'label' => 'Status',
							'value' => $model->status == 1 ? 'Aktif' : 'Tidak Aktif',
						],
						[
							'label' => 'Anak',
							'value' => $nama,
						],
						[
							'label' => 'Istri',
							'value' => $namaIstri,
						],
					],
				]) ?>
			</div><!--box footer-->
		</div><!--box-->
    </div>
</div>
