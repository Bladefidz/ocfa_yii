<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\bootstrap\ActiveForm;
use common\models\Provinces;
use common\models\Regencies;
use common\models\Districts;
use common\models\Villages;
use nex\datepicker\DatePicker;

/* @var $this yii\web\View */
/* @var $model common\models\DataManagement */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="data-management-form">

	<?php $form = ActiveForm::begin(['layout' => 'horizontal']); 
	
	if($model->isNewRecord){?>
		<?= $form->field($model, 'nik')->textInput() ?>
		
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

		<?= $form->field($model, 'nip_pencatat')->textInput(['maxlength' => true]) ?>

		<?= $form->field($model, 'kewarganegaraan')->radioList(array('1'=>'WNI','2'=>'WNA')); ?>
		
	<?php 
		//$model = $updatable;
	}?>
	
	
	<?= $form->field($updatable, 'agama')->dropdownList(['1' => 'Islam','2' => 'Kristen','3' => 'Katholik','4' => 'Hindu','5' => 'Budha','6' => 'Konghucu','7' => 'Lainnya'],['prompt'=>'Pilih Agama']) ?>

	<?php
	$provinsi = ArrayHelper::map(Provinces::find()->orderBy('name')->all(),'id','name');
	echo $form->field($updatable, 'provinsi')->dropdownList($provinsi,['prompt'=>'Pilih Provinsi','onchange'=>'$.post( "'.Yii::$app->urlManager->createUrl('data/kabupaten?id=').'"+$(this).val(), function( data ) {$( "select#kabupaten" ).html( data );});'])
	?>

	<?php
	$kabupaten = ArrayHelper::map(Regencies::find()->where(['province_id'=>$updatable->provinsi])->orderBy('name')->all(),'id','name');
	echo $form->field($updatable, 'kabupaten')->dropdownList($kabupaten,['prompt'=>'Pilih Kabupaten','id'=>'kabupaten','onchange'=>'$.post( "'.Yii::$app->urlManager->createUrl('data/kecamatan?id=').'"+$(this).val(), function( data ) {$( "select#kecamatan" ).html( data );});']) ?>
	
	<?php
	$kecamatan = ArrayHelper::map(Districts::find()->where(['regency_id'=>$updatable->kabupaten])->orderBy('name')->all(),'id','name');
	echo $form->field($updatable, 'kecamatan')->dropdownList($kecamatan,['prompt'=>'Pilih Kecamatan','id'=>'kecamatan','onchange'=>'$.post( "'.Yii::$app->urlManager->createUrl('data/kelurahan?id=').'"+$(this).val(), function( data ) {$( "select#kelurahan" ).html( data );});']) ?>
	
	<?php
	$kelurahan = ArrayHelper::map(Villages::find()->where(['district_id'=>$updatable->kecamatan])->orderBy('name')->all(),'id','name');
	echo $form->field($updatable, 'kelurahan')->dropdownList($kelurahan,['prompt'=>'Pilih Kelurahan','id'=>'kelurahan',]) ?>
	
	<?= $form->field($updatable, 'rt')->input('number',['maxlength' => true]) ?>
	
	<?= $form->field($updatable, 'rw')->input('number',['maxlength' => true]) ?>
	
	<?= $form->field($updatable, 'alamat')->textarea(['rows'=>3,'maxlength' => true]) ?>
	
	<?= $form->field($updatable, 'status_perkawinan')->dropdownList(['0' => 'Belum Menikah','1' => 'Menikah', '2' => 'Cerai', '3' => 'Cerai ditinggal mati'],['prompt' => 'Pilih Status Perkawinan']) ?>
	
	<?php
	if($updatable->pekerjaan == 'NULL') $updatable->pekerjaan = '-';
	echo $form->field($updatable, 'pekerjaan')->textInput(['maxlength' => true]) ?>
	
	<?= $form->field($updatable, 'pendidikan_terakhir')->dropdownList(['1' => 'SD', '2' => 'SMP', '3' => 'SMA','4' => 'D 1', '5' => 'D 2', '6' => 'D 3', '7' => 'D 4 / Sarjana (S 1)', '8' => 'Pasca Sarjana (S 2)', '9' => 'Pasca Sarjana (S 3)'],['prompt' => 'Pilih Pendidikan Terakhir']) ?>
	
</div><!--box body-->
<div class="box-footer">
	
	<?= Html::submitButton($updatable->isNewRecord ? 'Create' : 'Update', ['class' => $updatable->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>


    <?php ActiveForm::end(); ?>

</div>
