<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'User Management';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

	<div class="col-md-11">
		<div class="box box-info">
			<div class="box-header with-border">
				<h3 class="box-title"><?='Data User'?></h3>
			</div>
			<div class="box-body">
				<p>
					<?= Html::a('Buat User Baru', ['create'], ['class' => 'btn btn-success']) ?>
				</p>
				<?= GridView::widget([
					'dataProvider' => $dataProvider,
					'filterModel' => $searchModel,
					'columns' => [
						['class' => 'yii\grid\SerialColumn'],

						'id',
						'username',
						'auth_key',
						//'password_hash',
						//'password_reset_token',
						'email:email',
						//'status',
						'created_at',
						'updated_at',
						//'level',

						['class' => 'yii\grid\ActionColumn'],
					],
				]); ?>
			</div><!--box footer-->
		</div><!--box-->
    </div>
</div>
