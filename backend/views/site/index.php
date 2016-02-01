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
		  <a href="admin/data">
			  <div class="small-box bg-aqua">
				<div class="inner">
				  <p>Jumlah Penduduk</p>
				  <h3><?=DataManagement::find()->count() ?></h3>
				</div>
				<div class="icon">
				  <i class="fa fa-users"></i>
				</div>
			  </div>
		  </a>
		</div><!-- ./col -->
		<div class="col-lg-4 col-xs-6">
		  <!-- small box -->
		  <a href="admin/user">
			  <div class="small-box bg-green">
				<div class="inner">
				  <p>Jumlah User</p>
				  <h3><?=User::find()->count() ?></h3>
				</div>
				<div class="icon">
				  <i class="fa fa-user"></i>
				</div>
			  </div>
		  </a>
		</div><!-- ./col -->
		<div class="col-lg-4 col-xs-6">
		  <!-- small box -->
		  <a href="admin/user-activity">
			  <div class="small-box bg-yellow">
				<div class="inner">
				  <p>Aktivitas User Hari Ini</p>
				  <h3><?=UserActivity::find()->where('timestamp like "'.\Yii::$app->formatter->asDate('now','php:Y-m-d').'%"')->count()?></h3>
				</div>
				<div class="icon">
				  <i class="fa fa-bar-chart"></i>
				</div>
			  </div>
		  </a>
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
							array('Laki-laki', $laki['count'] != 0 ? (int)$laki['count'] : 0),
							array('Perempuan', $pr['count'] != 0 ? (int)$pr['count'] : 0)
						),
						'options' => array('title' => 'Jenis Kelamin', 'sliceVisibilityThreshold' => '0', 'is3D' => true))); 
					?>
				</div>
				<div class="col-md-4">
					<?= 
						GoogleChart::widget(array('visualization' => 'PieChart',
						'data' => array(
							array('Status', 'Jumlah'),
							array('Hidup', $hidup['count'] != 0 ? (int)$hidup['count'] : 0),
							array('Meninggal', $mati['count'] != 0 ? (int)$mati['count'] : 0)
						),
						'options' => array('title' => 'Jumlah Kematian dan Kelahiran', 'sliceVisibilityThreshold' => '0', 'is3D' => true))); 
					?>
				</div>
				<div class="col-md-4">
					<?= 
						GoogleChart::widget(array('visualization' => 'PieChart',
						'data' => array(
							array('Range', 'Jumlah'),
							array('0 - 5', (int)$balita['count']),
							array('6 - 12', (int)$anak['count']),
							array('13 - 20', (int)$remaja['count']),
							array('21 - 50', (int)$dewasa['count']),
							array('51 - 65', (int)$tua['count']),
							array('66 - ...', (int)$lansia['count'])
						),
						'options' => array('title' => 'Umur rata-rata', 'sliceVisibilityThreshold' => '0', 'is3D' => true))); 
					?>
				</div>
			  </div><!-- /.row -->
			</div><!-- /.box-body -->
		  </div><!-- /.box -->


		</div><!-- /.Left col -->
	  </div><!-- /.row (main row) -->

	</section><!-- /.content -->
</div>
