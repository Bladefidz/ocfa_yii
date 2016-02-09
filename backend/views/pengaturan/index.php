<?php
use arturoliveira\ExcelView;
use common\models\DataManagement;
use common\models\User;
use common\models\UserActivity;
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
/* @var $this yii\web\View */

$this->title = 'OCFA System Admin';
?>
<div class="pengaturan-index">

    <!-- Main content -->
	<section class="content col-lg-11">
	  <!-- Main row -->
	  <div class="row">
		<!-- Left col -->
		<div class="col-lg-6">
		  <!-- Custom tabs (Charts with tabs)-->
		  <div class="box box-info">
			<div class="box-header with-border">
			  <h3 class="box-title">Export Semua Data</h3>
			</div><!-- /.box-header -->
			<?php $form = ActiveForm::begin(['layout' => 'horizontal']); ?>
			<div class="box-body">
			  <div class="row">
				<?= $form->field($model, 'tabel')->dropdownList(['1' => 'Data Penduduk', '2' => 'Data Kartu Keluarga', '3' => 'Data Aktivitas User'],['prompt' => 'Pilih salah satu'])->label('Jenis Data') ?>
			  </div><!-- /.row -->
			</div><!-- /.box-body -->
			<div class="box-footer text-center">	
				<?= Html::submitButton('Export', ['class' => 'btn btn-success']) ?>
				<?php ActiveForm::end(); ?>
			</div>
		  </div><!-- /.box -->
		</div><!-- /.Left col -->
		<div class="col-lg-6">
		  <!-- Custom tabs (Charts with tabs)-->
		  <div class="box box-info">
			<div class="box-header with-border">
			  <h3 class="box-title">Import Semua Data Penduduk</h3>
			</div><!-- /.box-header -->
			<div class="box-body">
			  <div class="row">

				<?php $form = ActiveForm::begin(['layout' => 'horizontal','options' => ['enctype' => 'multipart/form-data']]) ?>

					<?= $form->field($upload, 'file')->fileInput() ?>
					
					<?php if ($upload->file_id): ?>
						<div class="form-group">
							<?= Html::img(['/file', 'id' => $model->file_id]) ?>
						</div>
					<?php endif; ?>
					
			  </div><!-- /.box-body -->
				<div class="box-footer text-center">
					<?= Html::submitButton('Import', ['class' => 'btn btn-success']) ?>

				<?php ActiveForm::end() ?>
			  </div><!-- /.row -->
			</div><!-- /.box-body -->
		  </div><!-- /.box -->
		</div>
	  </div><!-- /.row (main row) -->
	</section><!-- /.content -->
</div>
