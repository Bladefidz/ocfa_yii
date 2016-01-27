<?php
use scotthuangzl\googlechart\GoogleChart;
use common\models\DataManagement;
use common\models\User;
/* @var $this yii\web\View */

$this->title = 'Statistik';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="statistik-index">

    <!-- Main content -->
	<section class="content col-lg-11">
	  <!-- Small boxes (Stat box) -->
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
					<?php
						$dbCommand = Yii::$app->db->createCommand("
						   SELECT tanggal_diterbitkan,COUNT(*) as count FROM base GROUP BY tanggal_diterbitkan
						");

						$query = $dbCommand->queryAll();
						$data = array();
						array_push($data,
								array('Tanggal', 'Jumlah')
							);
						foreach($query as $isi){
							//echo var_dump($isi);
							array_push($data,
								array($isi['tanggal_diterbitkan'], (int)$isi['count'])
							);
							
						}
						echo GoogleChart::widget(array('visualization' => 'LineChart',
						'data' => $data,
						'options' => array('title' => 'Pertumbuhan Penduduk'))); 
					?>
				</div>
			  </div><!-- /.row -->
			</div><!-- /.box-body -->
		  </div><!-- /.box -->


		</div><!-- /.Left col -->
	  </div><!-- /.row (main row) -->

	</section><!-- /.content -->
</div>
