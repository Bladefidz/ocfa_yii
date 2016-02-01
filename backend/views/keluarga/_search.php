<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\KeluargaSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="keluarga-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'kepala_keluarga') ?>

    <?= $form->field($model, 'jml_anak') ?>

    <?= $form->field($model, 'jml_anggota') ?>

    <?= $form->field($model, 'tanggal_terbit') ?>

    <?php // echo $form->field($model, 'tanggal_pembaruan') ?>

    <?php // echo $form->field($model, 'status') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
