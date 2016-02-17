<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use common\models\Provinces;
use common\models\Regencies;
use common\models\Districts;
use common\models\Villages;
use kartik\select2\Select2;
use nex\datepicker\DatePicker;
use yii\helpers\ArrayHelper;


/* @var $this yii\web\View */
/* @var $model common\models\Keluarga */

$this->title = 'Buat KK';
$this->params['breadcrumbs'][] = ['label' => 'Keluarga', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="data-arsip">

	<?php $form = ActiveForm::begin(['layout' => 'horizontal']); ?>

    <?= $form->field($model, 'jenis')->dropdownList(['1' => 'Pindah Kewarganegaraan','2' => 'Meninggal'],['prompt'=>'Pilih Jenis Arsip','onchange'=>'jenis(this.value);']) ?>
	
	<div id="kewargaan">
		<?= $form->field($model, 'kewargaan')->textInput()?>
	</div>
	
	<div id="meninggal">
		<?= $form->field($model, 'tanggal')->widget(
			DatePicker::className(), [
				'clientOptions' => [
					'format' => 'DD-MM-YYYY',
				],
		]);?>
	</div>
	
	<div class="form-group text-center">
		<?= Html::submitButton('Arsipkan', ['class' => 'btn btn-success']) ?>
	</div>

    <?php ActiveForm::end(); ?>
	
</div>
<?php
$this->registerJs('
	$("#kewargaan").hide();
	$("#meninggal").hide();
	function jenis(id){
		switch(id){
			case "1":
				$("#kewargaan").show();
				$("#domisili").hide();
				$("#meninggal").hide();
				break;
			case "2":
				$("#kewargaan").hide();
				$("#domisili").hide();
				$("#meninggal").show();
				break;
			
		}
	}
');
?>
