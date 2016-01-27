<?php
use scotthuangzl\googlechart\GoogleChart;
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
			  <h3>150</h3>
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
			  <h3>53</h3>
			</div>
			<div class="icon">
			  <i class="ion ion-person-stalker"></i>
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
			  <i class="ion ion-clipboard"></i>
			</div>
		  </div>
		</div><!-- ./col -->
	  </div><!-- /.row -->
	  <!-- Main row -->
	  <div class="row">
		<!-- Left col -->
		<div class="col-lg-12">
		  <!-- Custom tabs (Charts with tabs)-->
		  <div class="box box-default">
			<div class="box-header with-border">
			  <h3 class="box-title">Browser Usage</h3>
			  <div class="box-tools pull-right">
				<button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
				<button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
			  </div>
			</div><!-- /.box-header -->
			<div class="box-body">
			  <div class="row">
				<div class="col-md-4">
					<?= 
						GoogleChart::widget(array('visualization' => 'PieChart',
						'data' => array(
							array('Task', 'Hours per Day'),
							array('Work', 11),
							array('Eat', 2),
							array('Commute', 2),
							array('Watch TV', 2),
							array('Sleep', 7)
						),
						'options' => array('title' => 'My Daily Activity'))); 
					?>
				</div>
				<div class="col-md-4">
					<?= 
						GoogleChart::widget(array('visualization' => 'PieChart',
						'data' => array(
							array('Task', 'Hours per Day'),
							array('Work', 11),
							array('Eat', 2),
							array('Commute', 2),
							array('Watch TV', 2),
							array('Sleep', 7)
						),
						'options' => array('title' => 'My Daily Activity'))); 
					?>
				</div>
				<div class="col-md-4">
					<?= 
						GoogleChart::widget(array('visualization' => 'PieChart',
						'data' => array(
							array('Task', 'Hours per Day'),
							array('Work', 11),
							array('Eat', 2),
							array('Commute', 2),
							array('Watch TV', 2),
							array('Sleep', 7)
						),
						'options' => array('title' => 'My Daily Activity'))); 
					?>
				</div>
			  </div><!-- /.row -->
			</div><!-- /.box-body -->
		  </div><!-- /.box -->


		</div><!-- /.Left col -->
	  </div><!-- /.row (main row) -->

	</section><!-- /.content -->
</div>
