<?php
use yii\helpers\Html; 
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */

$this->title = 'My Yii Application';
?>
<div class="site-index">

    <div class="col-lg-12 white text-center">
        <div class="container">
            <h1>OCFA System</h1>
            <h4>One Code For All System</h4>
            <hr class="star-primary">
            <h2> for the future of indonesian people's identity</h2>
        </div>
    </div>
    <div class="col-lg-12 text-center blue" id="about">
        <div class="container">
            <h2>About Us</h2>
            <hr class="star-light">
            <p class="lead">
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam dictum ipsum ut enim feugiat, ut semper est maximus. Vivamus tempus augue mi, ac aliquam ex egestas at. Morbi laoreet sapien turpis, quis vestibulum nulla mattis vel. Nunc tempus lorem tellus. Suspendisse euismod tempus feugiat. Duis non luctus nisi. Mauris pretium ipsum non sapien egestas ultricies. Vestibulum ut aliquet augue. Cras porttitor lectus eu massa elementum suscipit. Nunc metus felis, aliquet. 
            </p>
        </div>   
    </div>
    <div class="col-lg-12 white" id="registration" style="padding: 15px 0px 0px 0px">
        <div class="container">
            <h2 class="text-center">Registration</h2>
            <hr class="star-primary">
            <?php $form = ActiveForm::begin(['layout' => 'horizontal']); ?>
			
				<?= $form->field($model, 'id')->input('number',['min' => 0])->label('NIK') ?>

                <?= $form->field($model, 'username')->textInput() ?>
				
				<?= $form->field($model, 'corp_name')->label('Nama Instansi') ?>

                <?= $form->field($model, 'email') ?>
				
				<?= $form->field($model, 'no_telp')->label('No Telephone') ?>

                <?= $form->field($model, 'password')->passwordInput() ?>

                <div class="form-group">
					<div class="col-sm-3"></div>
					<div class="col-sm-6 text-center">
						<?= Html::submitButton('Signup', ['class' => 'btn-lg btn-primary', 'name' => 'signup-button']) ?>
					</div>
                </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>

    
</div>
