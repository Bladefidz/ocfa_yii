<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\bootstrap\ActiveField;
use common\models\Provinces;
use common\models\Regencies;
use common\models\Districts;
use common\models\Villages;

$this->title = 'Signup';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-signup">
    <div class="col-lg-12 white" id="registration" style="padding-top: 2%">
        <div class="container">
            <h2 class="text-center">Registration</h2>
            <hr class="star-primary">
            
            <?php $form = ActiveForm::begin(['method' => 'get', 'action' => ['controller/action'], 'layout' => 'horizontal']) ?>
                <h4 class="text-center" style="padding: 15px 0px 0px 0px">Informasi Pemohon</h4>
                <hr>
                <?= $form->field($model, 'id')->input('string', ['min' => 16, 'max' => 16])->label('NIK') ?>
                <?= $form->field($model, 'username')->textInput() ?>
                <?= $form->field($model, 'password')->passwordInput() ?>
                <?= $form->field($model, 'email')->input('email') ?>
                <?= $form->field($model, 'no_telp')->textInput() ?>

                <h4 class="text-center" style="padding: 15px 0px 0px 0px">Informasi Detail Instansi / Perusahaan Pemohon</h4>
                <hr>
                <?= $form->field($model, 'app_name')->input('string', ['min' => 16, 'max' => 16])->label('Nama Aplikasi') ?>
                <?= $form->field($model, 'corp_name')->textInput()->label('Nama Instansi/Perusahaan') ?>
                <?= $form->field($model, 'corp_email')->input('email')->label('Email Instansi/Perusahaan') ?>
                <?= $form->field($model, 'corp_telp')->textInput()->label('No Telephone Instansi/Perusahaan') ?>
                <?= $form->field($model, 'corp_prov')->dropDownList(Provinces::find()->select(['name', 'id'])->indexBy('id')->column(), ['prompt'=>'Pilih Provinsi'])->label('Provinsi') ?>
                <?= $form->field($model, 'corp_region')->dropDownList(Provinces::find()->select(['name', 'id'])->indexBy('id')->column(), ['prompt'=>'Pilih Provinsi'])->label('Kabupaten/Kota') ?>
                <?= $form->field($model, 'corp_district')->dropDownList(Provinces::find()->select(['name', 'id'])->indexBy('id')->column(), ['prompt'=>'Pilih Provinsi'])->label('Kecamatan') ?>
                <?= $form->field($model, 'corp_address')->textInput(Provinces::find()->select(['name', 'id'])->indexBy('id')->column(), ['prompt'=>'Pilih Provinsi'])->label('Alamat Instansi/Perusahaan') ?>
            <?php ActiveForm::end(); ?>

            <div class="form-group">
                <div class="col-sm-3"></div>
                <div class="col-sm-6 text-center">
                    <?= Html::submitButton('Register', ['class' => 'btn-lg btn-primary', 'name' => 'register-button']) ?>
                </div>
            </div>
        </div>
    </div>
</div>
