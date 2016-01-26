<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\DataManagement */

$this->title = 'Create Data Management';
$this->params['breadcrumbs'][] = ['label' => 'Data Managements', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="data-management-create">

    <div class="col-md-11">
		<div class="box box-info">
			<div class="box-header with-border">
				<h3 class="box-title"><?='Input Data'?></h3>
			</div>
			<div class="box-body">
				<?= $this->render('_form', [
					'model' => $model,
					'updatable' => $updatable,
				]) ?>
			</div><!--box footer-->
		</div><!--box-->
    </div>

</div>
