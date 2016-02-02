<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Keluarga */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Keluarga', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="keluarga-view">

    <div class="col-md-11">
		<div class="box box-info">
			<div class="box-header with-border">
				<h1 class="box-title"><?='Detail Data'?></h1>
			</div>
			<div class="box-body">
				<p>
					<?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
					<?= Html::a('Delete', ['delete', 'id' => $model->id], [
						'class' => 'btn btn-danger',
						'data' => [
							'confirm' => 'Are you sure you want to delete this item?',
							'method' => 'post',
						],
					]) ?>
				</p>

				<?= DetailView::widget([
					'model' => $model,
					'attributes' => [
						'id',
						'kepala_keluarga',
						'tanggal_terbit',
						'tanggal_pembaruan',
						'status',
					],
				]) ?>
			</div><!--box footer-->
		</div><!--box-->
    </div>
</div>
