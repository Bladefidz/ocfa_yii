<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\bootstrap\ActiveForm;
use common\models\Provinces;
use common\models\Regencies;
use common\models\Districts;
use common\models\Villages;
use common\models\Keluarga;
use common\models\DataManagement;
use nex\datepicker\DatePicker;
use yii\web\View;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model common\models\DataManagement */
/* @var $form yii\widgets\ActiveForm */

?>

<div class="data-management-form">

	<?php $form = ActiveForm::begin(['layout' => 'horizontal', 'options' => ['enctype'=>'multipart/form-data']]); 
	
	if($model->isNewRecord){?>
		<?= $form->field($model, 'nik')->input('number', ['min' => '0'])->label('Empat Digit Terakhir *') ?>
		
		<?= $form->field($model, 'nama')->textInput() ?>
		
		<?= $form->field($model, 'tempat_lahir')->textInput() ?>
		
		<?= $form->field($model, 'tanggal_lahir')->widget(
			DatePicker::className(), [
				'clientOptions' => [
					'format' => 'DD-MM-YYYY',
				],
		]);?>
		
		<?= $form->field($model, 'jenis_kelamin')->radioList(array('1'=>'Laki-laki','2'=>'Perempuan')); ?>

		<?= $form->field($model, 'golongan_darah')->radioList(array('o'=>'O','a'=>'A','b'=>'B','ab'=>'AB')); ?>

		<?= $form->field($model, 'tanggal_diterbitkan')->input('hidden')->label(false) ?>
		
	<?php 
		//$model = $updatable;
	}?>
	
	<div class="form-group">
		<div class="col-md-3"></div>
		<div class="col-md-3">
			<div class="text-center">
				<h3>Foto Baru</h3>
			</div>
			<div id="my_camera"></div><br>
		</div>
		<div class="col-md-1"></div>
		<div class="col-md-3">
		<?php if(!$model->isNewRecord){ ?>
			<div class="text-center">
				<h3>Foto Lama</h3>
			</div>
			<img src="<?=$updatable->foto?>" style="max-width:320px;max-height:240px"/>
		<?php } ?>
		</div>
	</div>
	
	<?= $form->field($updatable, 'foto')->input('button',['class' => 'btn btn-primary', 'onclick'=>'take_snapshot()', 'value' => 'Ambil Foto', 'id' => 'foto']) ?>
	
	<div id="results"></div>
	
	<?= $form->field($updatable, 'agama')->dropdownList(['1' => 'Islam','2' => 'Kristen','3' => 'Katholik','4' => 'Hindu','5' => 'Budha','6' => 'Konghucu','7' => 'Lainnya'],['prompt'=>'Pilih Agama']) ?>

	<?php
	$provinsi = ArrayHelper::map(Provinces::find()->orderBy('name')->all(),'id','name');
	echo $form->field($lokasi, 'provinsi')->widget(Select2::classname(), [
		'data' => $provinsi,
		'language' => 'id',
		'options' => ['prompt'=>'Pilih Provinsi','onchange'=>'$.post( "'.Yii::$app->urlManager->createUrl('data/kabupaten?id=').'"+$(this).val(), function( data ) {$( "select#kabupaten" ).html( data );});'],
		'theme' => Select2::THEME_BOOTSTRAP,
	])
	?>

	<?php
	$kabupaten = ArrayHelper::map(Regencies::find()->where(['province_id'=>$lokasi->provinsi])->orderBy('name')->all(),'id','name');
	echo $form->field($lokasi, 'kabupaten')->widget(Select2::classname(), [
		'data' => $kabupaten,
		'language' => 'id',
		'options' => ['prompt'=>'Pilih Kabupaten','id'=>'kabupaten','onchange'=>'$.post( "'.Yii::$app->urlManager->createUrl('data/kecamatan?id=').'"+$(this).val(), function( data ) {$( "select#kecamatan" ).html( data );});'],
		'theme' => Select2::THEME_BOOTSTRAP,
	]) ?>
	
	<?php
	$kecamatan = ArrayHelper::map(Districts::find()->where(['regency_id'=>$lokasi->kabupaten])->orderBy('name')->all(),'id','name');
	echo $form->field($lokasi, 'kecamatan')->widget(Select2::classname(), [
		'data' => $kecamatan,
		'language' => 'id',
		'options' => ['prompt'=>'Pilih Kecamatan','id'=>'kecamatan','onchange'=>'$.post( "'.Yii::$app->urlManager->createUrl('data/kelurahan?id=').'"+$(this).val(), function( data ) {$( "#kelurahan" ).html( data );});'],
		'theme' => Select2::THEME_BOOTSTRAP,
	]) ?>
	
	<?php
	$kelurahan = ArrayHelper::map(Villages::find()->where(['district_id'=>$lokasi->kecamatan])->orderBy('name')->all(),'id','name');
	echo $form->field($lokasi, 'kelurahan')->widget(Select2::classname(), [
		'data' => $kelurahan,
		'language' => 'id',
		'options' => ['prompt' => 'Pilih Kelurahan', 'id' => 'kelurahan'],
		'theme' => Select2::THEME_BOOTSTRAP,
	]) ?>
	
	<?= $form->field($domisili, 'alamat')->textarea(['rows'=>3,'maxlength' => true]) ?>
	
	<?= $form->field($domisili, 'rt')->input('number',['min' => 1,'maxlength' => true]) ?>
	
	<?= $form->field($domisili, 'rw')->input('number',['min' => 1,'maxlength' => true]) ?>
	
	<?php $data = ArrayHelper::map(Keluarga::find()->asArray()->all(),'id','id'); ?>
	<?= $form->field($updatable, 'no_kk')->widget(Select2::classname(), [
		'data' => $data,
		'language' => 'id',
		'options' => ['prompt' => 'Masukkan No KK','onchange'=>'$.post( "'.Yii::$app->urlManager->createUrl('data/statkk?id=').'"+$(this).val(), function( data ) {$( "#kelurahan" ).html( data );});'],
		'theme' => Select2::THEME_BOOTSTRAP,
	])->label('No KK'); ?>
	
	<?= $form->field($updatable, 'status_keluarga')->dropdownList(['2' => 'Istri','3' => 'Anak'],['prompt'=>'Pilih Status Keluarga', 'id' => 'status_keluarga']) ?>
	
	<div class="form-group">
		<div class="col-md-3"></div>
		<div class="col-md-8">
			<p><strong>Catatan : </strong>Untuk mengganti Kepala Keluarga, silakan diganti di menu Data Keluarga</p>
		</div>
	</div>
	
	<?php
		if(!$model->isNewRecord){
			$ayah = ArrayHelper::map(DataManagement::find()->select(['nik'])->where('nik != '.$model->nik.' and jenis_kelamin = 1')->all(),'nik','nik');
			$ibu = ArrayHelper::map(DataManagement::find()->select(['nik'])->where('nik != '.$model->nik.' and jenis_kelamin = 2')->all(),'nik','nik');
		}else{
			$ayah = ArrayHelper::map(DataManagement::find()->select(['nik'])->where('jenis_kelamin = 1')->all(),'nik','nik');
			$ibu = ArrayHelper::map(DataManagement::find()->select(['nik'])->where('jenis_kelamin = 2')->all(),'nik','nik');
		}
	?>
	
	<?= $form->field($updatable, 'ayah')->widget(Select2::classname(), [
		'data' => $ayah,
		'language' => 'id',
		'options' => ['prompt' => 'Pilih NIK Ayah','onchange'=>'$.post( "'.Yii::$app->urlManager->createUrl('data/statkk?id=').'"+$(this).val(), function( data ) {$( "#kelurahan" ).html( data );});'],
		'theme' => Select2::THEME_BOOTSTRAP,
	]) ?>
	
	<?= $form->field($updatable, 'ibu')->widget(Select2::classname(), [
		'data' => $ibu,
		'language' => 'id',
		'options' => ['prompt' => 'Pilih NIK Ibu','onchange'=>'$.post( "'.Yii::$app->urlManager->createUrl('data/statkk?id=').'"+$(this).val(), function( data ) {$( "#kelurahan" ).html( data );});'],
		'theme' => Select2::THEME_BOOTSTRAP,
	]) ?>
	
	<?= $form->field($updatable, 'status_perkawinan')->dropdownList(['0' => 'Belum Menikah','1' => 'Menikah', '2' => 'Cerai', '3' => 'Cerai ditinggal mati'],['prompt' => 'Pilih Status Perkawinan']) ?>
	
	<?php
	if($updatable->pekerjaan == 'NULL') $updatable->pekerjaan = '-';
	echo $form->field($updatable, 'pekerjaan')->textInput(['maxlength' => true]) ?>
	
	<?= $form->field($updatable, 'pendidikan_terakhir')->dropdownList(['1' => 'SD', '2' => 'SMP', '3' => 'SMA','4' => 'D 1', '5' => 'D 2', '6' => 'D 3', '7' => 'D 4 / Sarjana (S 1)', '8' => 'Pasca Sarjana (S 2)', '9' => 'Pasca Sarjana (S 3)'],['prompt' => 'Pilih Pendidikan Terakhir']) ?>
	
	<div class="form-group">
		<div class="col-md-3"></div>
		<div class="col-md-6">
			<h4><strong>* Harus diisi</strong></h4>
		</div>
	</div>
	
</div><!--box body-->
<div class="box-footer text-center">
	
	<?= Html::submitButton($updatable->isNewRecord ? 'Create' : 'Update', ['class' => $updatable->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>


    <?php ActiveForm::end(); ?>

</div>

<?=$this->registerJs('
	
	Webcam.set({
			width: 320,
			height: 240,
			image_format: \'jpeg\',
			jpeg_quality: 90
		});
	Webcam.attach( \'#my_camera\' );
	function take_snapshot() {
		if(document.getElementById(\'foto\').value == \'Ulangi\'){
			Webcam.unfreeze();
			document.getElementById(\'hasilFoto\').value = 
					null;
			document.getElementById(\'foto\').value = 
					\'Ambil Foto\';

		}else{
			//Webcam.loaded = true;
			// take snapshot and get image data
			Webcam.snap( function(data_uri) {
				// display results in page
				document.getElementById(\'results\').innerHTML = 
					\'<input type="hidden" id="hasilFoto" name="BaseUpdatable[foto]" value="\'+data_uri+\'">\';
				
			} );
			Webcam.freeze();
			document.getElementById(\'foto\').value = 
					\'Ulangi\';
		}
	}', View::POS_END); ?>
