<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\User */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-form">

    <?php $form = ActiveForm::begin();?>

    <?= $form->field($model, 'username')->textInput(['autofocus' => true, 'placeholder' => 'Masukkan username Anda']) ?>
	
	<?= $form->field($model, 'id')->input('number',['placeholder' => 'Masukkan NIK Anda']) ?>

	<?= $form->field($model, 'email')->input('email',['placeholder' => 'Masukkan Email Anda']) ?>

	<?php if($userModel->isNewRecord) echo $form->field($model, 'password')->passwordInput(['placeholder' => 'Masukkan Password Anda']) ?>

    <div class="form-group">
        <?= Html::submitButton($userModel->isNewRecord ? 'Create' : 'Update', ['class' => $userModel->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
