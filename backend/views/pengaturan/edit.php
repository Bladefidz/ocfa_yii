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

$this->title = 'Edit';
$this->params['breadcrumbs'][] = ['label' => 'Pengaturan', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pengaturan-edit">

	<?php $form = ActiveForm::begin(['layout' => 'horizontal']); ?>
	
	<?= $form->field($instansi, 'instansi')->textInput()?>
	
	<div class="form-group text-center">
		<?= Html::submitButton('Update', ['class' => 'btn btn-success']) ?>
	</div>

    <?php ActiveForm::end(); ?>
	
</div>
