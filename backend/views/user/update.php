<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\User */

$this->title = 'Update User: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="user-update">

    <div class="col-md-11">
		<div class="box box-info">
			<div class="box-header with-border">
				<h3 class="box-title"><?='Update User'?></h3>
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
