<?php
use nex\datepicker\DatePicker;
use scotthuangzl\googlechart\GoogleChart;
use common\models\DataManagement;
use common\models\User;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
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
				<?php
					$form = ActiveForm::begin(['layout' => 'horizontal']);
				?>
				<?= $form->field($model, 'dari')->widget(
					DatePicker::className(), [
						'size' => 'sm',
						'readonly' => true,
						'value' => \Yii::$app->formatter->asDate('-1 month','php:d-M-Y'),
						'language' => 'id',
						'clientOptions' => [
							'format' => 'YYYY',
						],
				]);?>
				
				<?= $form->field($model, 'sampai')->widget(
					DatePicker::className(), [
						'size' => 'sm',
						'readonly' => true,
						'value' => \Yii::$app->formatter->asDate('-1 month','php:d-M-Y'),
						'language' => 'id',
						'clientOptions' => [
							'format' => 'YYYY',
						],
				]);?>
				<div class="col-md-12">
					<div class="col-sm-3"></div>
					<div class="col-sm-6">
						<div class="form-group">
							<?= Html::submitButton('OK', ['class' => 'btn btn-primary']) ?>
						</div>
					</div>
				</div>
				<?php ActiveForm::end() ?>
			  </div>
			  <div class="row">
				<div class="col-md-11">
					<?php
						$data = array();
						array_push($data,
								array('Tanggal', 'Jumlah')
							);
						foreach($query as $isi){
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
