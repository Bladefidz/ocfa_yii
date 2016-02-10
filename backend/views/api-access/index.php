<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Access Control';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="api-access-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

	<div class="col-md-11">
		<div class="box box-info">
			<div class="box-header with-border">
				<h3 class="box-title"><?='Access Control'?></h3>
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
						// 'auth_key',
						//'password_hash',
						//'password_reset_token',
						// 'email:email',
						//'status',
						// 'created_at',
						// 'updated_at',
						// 'level',
						[
							'attribute' => 'level',
							'format' => 'raw',
							'value' => function ($data){
								$level = 'unidentified';
								switch($data->level){
									case '3':
										$level = 'Instansi Non Pemerintah';
										break;
									case '4':
										$level = 'Instansi Pemerintah';
										break;
								}
								return $level;
							},
							'filter' => array('3' => 'Instansi Non Pemerintah', '4' => 'Instansi Pemerintah')
						],
						[
							'attribute' => 'status',
							'format' => 'raw',
							'value' => function ($data){
								switch($data->status){
									case '30':
										$status = "<span class='label label-danger'>Blocked</span>";
										break;
									default:
										$status = "<span class='label label-success'>Allowed</span>";
										break;
								}
								return $status;
							},
							'filter' => array(10 => 'Allowed', 30 => 'Blocked')
						],

						[
							'class' => 'yii\grid\ActionColumn',
							'template'=>'{block} {allow}',
							'buttons' => [
								'block' => function ($url, $model) {
									$hide1 = $model->status==30?'hidden':'';
									return Html::a("<span class='fa fa-ban ".$hide1."'></span>", $url, [
												'title' => Yii::t('app', 'Block'),
												'data-confirm' => Yii::t('app','Apakah Anda yakin ingin memblokir user '.$model->username.'?'),
									]);
								},
								'allow' => function ($url, $model) {
									$hide2 = $model->status==10?'hidden':'';
									return Html::a("<span class='fa fa-check ".$hide2."'></span>", $url, [
												'title' => Yii::t('app', 'Allow'),
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
