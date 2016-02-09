<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\bootstrap\ActiveField;

$this->title = 'Pendaftaran Sukses';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-registrationsuccess">
    <header>
        <div id="success-registration" style="padding-top: 2%">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="col-lg-2"></div>
                        <div class="col-lg-8">
                            <div class="jumbotron">
                                <h1><span><i class="glyphicon glyphicon-thumbs-up" style="color:#00D463"></i></span></h1>
                                <h2> Registration Successfull</h2>
                                <hr class="star-primary">
                                <h4><span class="name">Your Registration Have Submitted. We send verification to your email.<br> Please Check Your Email Now !</span></h4>
                            </div>
                        </div>
                        <div class="col-lg-2"></div>
                    </div>
                </div>
            </div>
        </div>
    </header>
</div>
