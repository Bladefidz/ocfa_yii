<?php
use scotthuangzl\googlechart\GoogleChart;
use common\models\DataManagement;
use common\models\User;
use common\models\UserActivity;
/* @var $this yii\web\View */

$this->title = 'OCFA System Admin';
?>
<div class="site-index">

    <!-- Main content -->
	<section class="content col-lg-11">
	  <!-- Small boxes (Stat box) -->
	  <div class="row ">
		<div class="col-lg-4 col-xs-6">
		  <!-- small box -->
		  <div class="small-box bg-aqua">
			<div class="inner">
			  <p>Jumlah Penduduk</p>
			  <h3><?=DataManagement::find()->count() ?></h3>
			</div>
			<div class="icon">
			  <i class="fa fa-users"></i>
			</div>
		  </div>
		</div><!-- ./col -->
		<div class="col-lg-4 col-xs-6">
		  <!-- small box -->
		  <div class="small-box bg-green">
			<div class="inner">
			  <p>Jumlah User</p>
			  <h3><?=User::find()->count() ?></h3>
			</div>
			<div class="icon">
			  <i class="fa fa-user"></i>
			</div>
		  </div>
		</div><!-- ./col -->
		<div class="col-lg-4 col-xs-6">
		  <!-- small box -->
		  <div class="small-box bg-yellow">
			<div class="inner">
			  <p>Aktivitas User Hari Ini</p>
			  <h3><?=UserActivity::find()->where('timestamp like "'.\Yii::$app->formatter->asDate('now','php:Y-m-d').'%"')->count()?></h3>
			</div>
			<div class="icon">
			  <i class="fa fa-bar-chart"></i>
			</div>
		  </div>
		</div><!-- ./col -->
	  </div><!-- /.row -->
	  <!-- Main row -->
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
				<div class="col-md-4">
					<?= 
						GoogleChart::widget(array('visualization' => 'PieChart',
						'data' => array(
							array('Jenis Kelamin', 'Jumlah'),
							array('Laki-laki', 11),
							array('Perempuan', 2)
						),
						'options' => array('title' => 'Jenis Kelamin'))); 
					?>
				</div>
				<div class="col-md-4">
					<?= 
						GoogleChart::widget(array('visualization' => 'PieChart',
						'data' => array(
							array('Status', 'Jumlah'),
							array('Lahir', 11),
							array('Meninggal', 2)
						),
						'options' => array('title' => 'Jumlah Kematian dan Kelahiran'))); 
					?>
				</div>
				<div class="col-md-4">
					<?= 
						GoogleChart::widget(array('visualization' => 'PieChart',
						'data' => array(
							array('Range', 'Jumlah'),
							array('0 - 5', 11),
							array('6 - 12', 2),
							array('13 - 20', 2),
							array('21 - 50', 2),
							array('51 - 65', 7),
							array('66 - ...', 7)
						),
						'options' => array('title' => 'Umur rata-rata'))); 
					?>
				</div>
			  </div><!-- /.row -->
			</div><!-- /.box-body -->
		  </div><!-- /.box -->


		</div><!-- /.Left col -->
	  </div><!-- /.row (main row) -->

	</section><!-- /.content -->
</div>
