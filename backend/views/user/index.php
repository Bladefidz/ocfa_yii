<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use common\models\User;

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
					<?= Html::a('Buat User Baru', ['buat'], ['class' => 'btn btn-success']) ?>
				</p>
				<?php Pjax::begin() ?>
				<?= GridView::widget([
					'dataProvider' => $dataProvider,
					'filterModel' => $searchModel,
					'columns' => [
						['class' => 'yii\grid\SerialColumn'],

						'id',
						'username',
						// 'auth_key',
						// [
				  //           'attribute' => 'auth_key',
				  //           'format' => 'raw',
				  //           'value' => function ($data) {
				  //               return substr($data->auth_key, 0, 10).'...';
				  //           },
				  //       ],
						//'password_hash',
						//'password_reset_token',
						'email:email',
						//'status',
						'created_at:datetime',
						'updated_at:datetime',
						[
				            'attribute' => 'status',
				            'format' => 'html',
				            'value' => function ($data) {
				            	$stat = '';
				            	switch ($data->status) {
				            		case '0':
				            			$stat = "<span class='label label-danger'>Tidak Aktif</span>";
				            			break;
				            		case '10':
				            			$stat = "<span class='label label-success'>Aktif</span>";
				            			break;
				            		case '20':
				            			$stat = "<span class='label label-warning'>Pending</span>";
				            			break;
				            		case '30':
				            			$stat = "<span class='label label-danger'>Blocked</span>";
				            			break;
				            	}
				                return $stat;
				            },
				            'filter' => User::isAdmin()?array('10' => 'Aktif', '0' => 'Tidak Aktif', '20' => 'Pending', '30' => 'Blocked'):array('10' => 'Aktif', '0' => 'Tidak Aktif')
				        ],
						//'level',

						[
							'class' => 'yii\grid\ActionColumn',
							'template'=>'{view} {update} {deactivate}',
							'buttons' => [
								'deactivate' => function ($url, $model) {
									$hide = $model->status==0?'hidden':'';
									return Html::a("<span class='fa fa-ban ".$hide."'></span>", $url, [
												'title' => Yii::t('app', 'Deactivate'),
												'data-confirm' => Yii::t('app','Apakah Anda yakin ingin menonaktifkan status user '.$model->username.'?'),
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
