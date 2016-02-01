<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Keluarga */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="keluarga-form">

    <?php $form = ActiveForm::begin(['layout' => 'horizontal']); ?>

    <?= $form->field($model, 'id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'kepala_keluarga')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'jml_anak')->input('number',['min' => '0']) ?>

    <?= $form->field($model, 'jml_anggota')->input('number',['min' => '0']) ?>

    <?= $form->field($model, 'tanggal_terbit')->textInput() ?>

    <?= $form->field($model, 'tanggal_pembaruan')->textInput() ?>

    <?= $form->field($model, 'status')->textInput() ?>
	
</div><!--box body-->
<div class="box-footer text-center">
    <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
</div>

    <?php ActiveForm::end(); ?>

</div>
