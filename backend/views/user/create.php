<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\User */

$this->title = 'Create User';
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-create">

    <div class="col-md-11">
		<div class="box box-info">
			<div class="box-header with-border">
				<h3 class="box-title"><?='Input User'?></h3>
			</div>
			<div class="box-body">
				<?= $this->render('_form', [
					'model' => $model,
					'userModel' => $userModel,
				]) ?>
			</div><!--box footer-->
		</div><!--box-->
    </div>
</div>
