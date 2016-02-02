<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;
use common\models\BaseUpdatable;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model common\models\Keluarga */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="keluarga-form">

    <?php $form = ActiveForm::begin(['layout' => 'horizontal']); ?>

    <?= $form->field($model, 'id')->input('number',['min' => 0, 'placeholder' => 'Masukkan Empat Digit Terakhir'])->label('Empat Digit Terakhir') ?>

	<?php $data = ArrayHelper::map(BaseUpdatable::find()->where(['no_kk' => 0])->asArray()->all(),'nik','nik'); ?>
    <?= $form->field($model, 'kepala_keluarga')->widget(Select2::classname(), [
		'data' => $data,
		'language' => 'id',
		'options' => ['placeholder' => 'Masukkan NIK Kepala Keluarga'],
		'pluginOptions' => [
			'allowClear' => true
		],
	])->label('NIK Kepala Keluarga'); ?>
	<div class="form-group">
		<div class="col-md-3"></div>
		<div class="col-md-6">
			<strong>Catatan : </strong>NIK Kepala Keluarga harus sudah terdaftar
		</div>
		<div class="col-md-3"></div>
	</div>
	
	<div class="form-group text-center">
		<?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	</div>

    <?php ActiveForm::end(); ?>

</div>
