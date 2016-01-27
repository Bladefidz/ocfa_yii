<?php
use scotthuangzl\googlechart\GoogleChart;
use common\models\DataManagement;
use common\models\User;
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
			  <h3>44</h3>
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
				<div class="col-md-11">
					<?= 
						GoogleChart::widget(array('visualization' => 'LineChart',
						'data' => array(
							array('Tanggal', 'Request'),
							array('25-Jan-2016', 4),
							array('26-Jan-2016', 11),
							array(date('d-M-Y'), 2)
						),
						'options' => array('title' => 'Jenis Kelamin'))); 
					?>
				</div>
			  </div><!-- /.row -->
			</div><!-- /.box-body -->
		  </div><!-- /.box -->


		</div><!-- /.Left col -->
	  </div><!-- /.row (main row) -->

	</section><!-- /.content -->
</div>
