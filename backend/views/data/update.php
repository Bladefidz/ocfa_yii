<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\DataManagement */

$this->title = 'Update Data: ' . ' ' . $model->nik;
$this->params['breadcrumbs'][] = ['label' => 'Data Managements', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->nik, 'url' => ['view', 'id' => $model->nik]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="data-management-update">
	<div class="col-md-11">
		<div class="box box-info">
			<div class="box-header with-border">
				<h3 class="box-title"><?='Update Data'?></h3>
			</div>
			<div class="box-body">
				<?= $this->render('_form', [
					'model' => $model,
				]) ?>
			</div><!--box footer-->
		</div><!--box-->
    </div>
</div>
