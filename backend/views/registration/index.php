<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Registration';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="registration-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

	<div class="col-md-11">
		<div class="box box-info">
			<div class="box-header with-border">
				<h3 class="box-title"><?='Registered User'?></h3>
			</div>
			<div class="box-body">
				<?php Pjax::begin() ?>
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

						[
							'class' => 'yii\grid\ActionColumn',
							'template'=>'{view} {accept}',
							'buttons' => [
								'block' => function ($url, $model) {
									return Html::a('<span class="fa fa-ban"></span>', $url, [
												'title' => Yii::t('app', 'Block'),
												'data-confirm' => Yii::t('app','Apakah Anda yakin ingin memblokir user '.$model->username.'?'),
									]);
								},
								'accept' => function ($url, $model) {
									return Html::a('<span class="fa fa-check"></span>', $url, [
												'title' => Yii::t('app', 'Accept'),
									]);
								}
							],
						],
					],
				]); ?>
				<?php Pjax::end() ?>
			</div><!--box footer-->
		</div><!--box-->
    </div>
</div>
