<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use backend\libraries\DataExchanger;

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
				<h3 class="box-title"><?='Pending Verification of Registered User'?></h3>
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
						// 'created_at',
						[
							'attribute' => 'created_at',
							'value' => function ($data){
								return $data->created_at;
							},
							'filter' => \yii\jui\DatePicker::widget(['dateFormat' => 'dd-MM-yyyy']),
            				'format' => ['date', 'php:d-m-Y H:i:s'],
						],
						// 'updated_at',
						//'level',

						[
							'class' => 'yii\grid\ActionColumn',
							'template'=>'{view} {accept} {block}',
							'buttons' => [
								'accept' => function ($url, $model) {
									return Html::a('<span class="fa fa-check"></span>', $url, [
												'title' => Yii::t('app', 'Accept'),
												'data-confirm' => Yii::t('app',"Apakah Anda yakin akan memberikan akses API kepada user ".$model->username."?"),
									]);
								},
								'block' => function ($url, $model) {
									return Html::a("<span class='fa fa-ban'></span>", $url, [
												'title' => Yii::t('app', 'Block'),
												'data-confirm' => Yii::t('app',"Apakah Anda yakin akan menolak pendaftaran akses dengan username ".$model->username."?"),
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
