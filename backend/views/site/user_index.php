<?php
use scotthuangzl\googlechart\GoogleChart;
use common\models\DataManagement;
use common\models\User;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\BaseStringHelper;
/* @var $this yii\web\View */

$this->title = 'OCFA System User';
?>
<div class="site-user_index">

    <!-- Main content -->
	<section class="content col-lg-11">
	  <!-- Main row -->
	  <div class="row">
		<!-- Left col -->
		<div class="col-lg-12">
		  <!-- Custom tabs (Charts with tabs)-->
		  <div class="box box-info">
			<div class="box-header with-border">
			  <h3 class="box-title">Api Information</h3>
			</div><!-- /.box-header -->
			<div class="box-body">
			  <div class="row">
				<div class="col-md-6">
					<div class="col-md-3 text-right">
						<h4><strong>API Key</strong></h4>
					</div>
					<div class="col-md-9 text-center">
						<div class="alert alert-success">
							<?= User::findOne(Yii::$app->user->id)->getAuthKey()?>
						</div>
					</div>
				</div>
				<div class="col-md-6">
					<div class="col-md-5 text-right">
						<h4><strong>Recent IP Address</strong></h4>
					</div>
					<div class="col-md-7 text-center">
						<div class="alert alert-success">
							<?= $ipAddress?>
						</div>
					</div>
				</div>
			  </div><!-- /.row -->
			</div><!-- /.box-body -->
		  </div><!-- /.box -->
		</div><!-- /.Left col -->
	  </div><!-- /.row (main row) -->
	  <div class="row">
		<!-- Left col -->
		<div class="col-lg-12">
		  <!-- Custom tabs (Charts with tabs)-->
		  <div class="box box-info">
			<div class="box-header with-border">
			  <h3 class="box-title">Statistik</h3>
			</div><!-- /.box-header -->
			<div class="box-body">
			  <div class="row">
				<div class="col-md-11">
					<?php
					// {{tanngal,count},{tanngal,count},{tanngal,count}}
						$data = array();
						array_push($data,
								array('Tanggal', 'Aktivitas User')
							);
						foreach($userAct as $key => $isi){
							// echo var_dump($userAct);
							array_push($data,
								array($isi['tanggal'], (int)$isi['count'])
							);
						}
						echo GoogleChart::widget(array('visualization' => 'LineChart',
						'data' => $data,
						'options' => array('title' => 'Jenis Kelamin'))); 
					?>
				</div>
			  </div><!-- /.row -->
			</div><!-- /.box-body -->
		  </div><!-- /.box -->
		</div><!-- /.Left col -->
	  </div><!-- /.row (main row) -->
	  <div class="row">
		<!-- Left col -->
		<div class="col-lg-6">
		  <!-- Custom tabs (Charts with tabs)-->
		  <div class="box box-info">
			<div class="box-header with-border">
			  <h3 class="box-title">Top URI Request</h3>
			</div><!-- /.box-header -->
			<div class="box-body">
			  <div class="row">
				<div class="col-md-11">
					<?php Pjax::begin() ?>
					<?= GridView::widget([
						'dataProvider' => $dataProviderApi,
						'filterModel' => $searchModelApi,
						'columns' => [
							['class' => 'yii\grid\SerialColumn'],
							[
								'attribute' => 'uri_access',
								'value' => function($model){
									return BaseStringHelper::truncate($model->uri_access,45,' ... ',null,true);
								}
							],
							'count',
							// [
								// 'label' => 'Count',
								// 'value' => function($model){
									// var_dump($model);
								// }
							// ],
						],
					]); ?>
					<?php Pjax::end(); ?>
				</div>
			  </div><!-- /.row -->
			</div><!-- /.box-body -->
		  </div><!-- /.box -->
		</div><!-- /.Left col -->
		<div class="col-lg-6">
		  <!-- Custom tabs (Charts with tabs)-->
		  <div class="box box-info">
			<div class="box-header with-border">
			  <h3 class="box-title">Used IP Address</h3>
			</div><!-- /.box-header -->
			<div class="box-body">
			  <div class="row">
				<div class="col-md-11">
					<?php Pjax::begin() ?>
					<?= GridView::widget([
						'dataProvider' => $dataProvider,
						'filterModel' => $searchModel,
						'columns' => [
							['class' => 'yii\grid\SerialColumn'],
							'ip',
							'timestamp',
							// [
								// 'label' => 'Count',
								// 'value' => function($model){
									// var_dump($model);
								// }
							// ],
						],
					]); ?>
					<?php Pjax::end(); ?>
				</div>
			  </div><!-- /.row -->
			</div><!-- /.box-body -->
		  </div><!-- /.box -->
		</div><!-- /.Left col -->
	  </div><!-- /.row (main row) -->

	</section><!-- /.content -->
</div>
