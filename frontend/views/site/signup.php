<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\bootstrap\ActiveField;

$this->title = 'Signup';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-signup">
    <div class="col-lg-12 white" id="registration" style="padding-top: 2%">
        <div class="container">
            <h2 class="text-center">Registration</h2>
            <hr class="star-primary">

            <?php $form = ActiveForm::begin(['layout' => 'horizontal']) ?>
                <h4 class="text-center" style="padding: 15px 0px 0px 0px">Informasi Pemohon</h4>
                <hr>
                <?= $form->field($user, 'id')->textInput(['placeholder' => 'Masukkan NIK Anda']) ?>
                <?= $form->field($user, 'username')->textInput() ?>
                <?= $form->field($user, 'password')->passwordInput() ?>
                <?= $form->field($user, 'email')->input('email') ?>
                <?= $form->field($user, 'telp')->textInput() ?>

                <h4 class="text-center" style="padding: 15px 0px 0px 0px">Informasi Detail Instansi / Perusahaan Pemohon</h4>
                <hr>
                <?= $form->field($userPublic, 'nama_aplikasi')->textInput(['maxlength' => true]) ?>
                <?= $form->field($user, 'instansi')->textInput(['maxlength' => true]) ?>
                <?= $form->field($userPublic, 'email_instansi')->input('email') ?>
                <?= $form->field($userPublic, 'no_telp_instansi')->textInput(['maxlength' => true]) ?>
                <?= $form->field($userPublic, 'alamat_instansi')->textInput(['maxlength' => true]) ?>

                <div class="form-group">
                    <div class="col-sm-3"></div>
                    <div class="col-sm-6 text-center">
                        <?= Html::submitButton('Register', ['class' => 'btn-lg btn-primary', 'name' => 'register-button']) ?>
                    </div>
                </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
