<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Keluarga */

$this->title = 'Create Keluarga';
$this->params['breadcrumbs'][] = ['label' => 'Keluargas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="keluarga-create">

    <div class="col-md-11">
		<div class="box box-info">
			<div class="box-header with-border">
				<h3 class="box-title"><?='Input Data'?></h3>
			</div>
			<div class="box-body">
				<?= $this->render('_form', [
					'model' => $model,
				]) ?>
			</div><!--box footer-->
		</div><!--box-->
    </div>

</div>
