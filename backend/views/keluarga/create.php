<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Keluarga */

$this->title = 'Buat KK';
$this->params['breadcrumbs'][] = ['label' => 'Keluarga', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="keluarga-create">

	<?= $this->render('_form', [
		'model' => $model,
	]) ?>
	
</div>
