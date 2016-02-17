<?php
use arturoliveira\ExcelView;
use common\models\DataManagement;
use common\models\User;
use common\models\UserActivity;
use common\models\TabelDomisili;
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\bootstrap\Modal;
/* @var $this yii\web\View */

$this->title = 'OCFA System Admin';
?>
<div class="pengaturan-user_index">

    <!-- Main content -->
	<section class="content col-lg-11">
	  <!-- Main row -->
	  <div class="row">
		<!-- Left col -->
		<div class="col-lg-6">
		  <!-- Custom tabs (Charts with tabs)-->
		  <div class="box box-info">
			<div class="box-header with-border">
			  <h3 class="box-title">User Profil</h3>
			</div><!-- /.box-header -->
			<div class="box-body">
			  <div class="row">
				<div class="col-md-3">
					<label class="control-label pull-right">Nama</label>
				</div>
				<div class="col-md-9">
					<?= DataManagement::find()->select('nama')->where(['nik' => $user->id])->one()->nama?>
				</div>
			  </div>
			  <div class="row">
				<div class="col-md-3">
					<label class="control-label pull-right">NIK</label>
				</div>
				<div class="col-md-9">
					<?= $user->id?>
				</div>
			  </div>
			  <div class="row">
				<div class="col-md-3">
					<label class="control-label pull-right">Instansi</label>
				</div>
				<div class="col-md-9">
					<?= $user->instansi?>
				</div>
			  </div>
			  <div class="row">
				<div class="col-md-3">
					<label class="control-label pull-right">Alamat</label>
				</div>
				<div class="col-md-9">
					<?= TabelDomisili::find()->select('alamat')->where(['nik' => $user->id])->one()->alamat?>
				</div>
			  </div>
			</div><!-- /.box-body -->
			<div class="box-footer text-right">
				<p>
					<?= Html::a('Ubah Nama Instansi', ['ubah'], [
						'class' => 'btn btn-success',
						'data-toggle' => 'modal',
						'data-target' => '#edit',
						'data-title' => 'Ubah Nama Instansi'
						]) ?>
				</p>
			</div>
		  </div><!-- /.box -->
		</div><!-- /.Left col -->
		<div class="col-lg-6">
		  <!-- Custom tabs (Charts with tabs)-->
		  <div class="box box-info">
			<div class="box-header with-border">
			  <h3 class="box-title">User Authentification</h3>
			</div><!-- /.box-header -->
			<div class="box-body">
				<div class="row">
					<div class="col-md-3">
						<label class="control-label pull-right">Username</label>
					</div>
					<div class="col-md-7">
						<?= $user->username?>
					</div>
					<div class="col-md-2">
						<button type="button" class="btn-xs btn-default" data-toggle='modal' data-target='#edit-username' data-title='Ubah Username'><span class="glyphicon glyphicon-edit"></span></button>
					</div>
			    </div>
				<div class="row">
					<div class="col-md-3">
						<label class="control-label pull-right">Password</label>
					</div>
					<div class="col-md-7">
						**********
					</div>
					<div class="col-md-2">
						<button type="button" class="btn-xs btn-default" data-toggle='modal' data-target='#edit-username' data-title='Ubah Username'><span class="glyphicon glyphicon-edit"></span></button>
					</div>
			    </div>
				<div class="row">
					<div class="col-md-3">
						<label class="control-label pull-right">Email</label>
					</div>
					<div class="col-md-7">
						<?= $user->email?>
					</div>
					<div class="col-md-2">
						<button type="button" class="btn-xs btn-default" data-toggle='modal' data-target='#edit-username' data-title='Ubah Username'><span class="glyphicon glyphicon-edit"></span></button>
					</div>
			    </div>
				<div class="row">
					<div class="col-md-3">
						<label class="control-label pull-right">API Key</label>
					</div>
					<div class="col-md-9">
						<?= $user->auth_key?>
					</div>
			    </div>
			</div><!-- /.box-body -->
			<div class="box-footer text-right">
				<p>
					<?= Html::a('Deaktivasi', ['deaktivasi'], [
						'class' => 'btn btn-danger',
						'data' =>[
							'confirm' => 'Apakah Anda yakin akan menonaktifkan akun ini?',
							'method' => 'post'
						]
					]) ?>
				</p>
			</div><!-- /.box-body -->
		  </div><!-- /.box -->
		</div>
	  </div><!-- /.row (main row) -->
	<?php
		Modal::begin([
			'id' => 'edit',
			'header' => '<h4 class="modal-title">Ubah Nama Instansi</h4>'
		]);
		
		echo '...';
		
		Modal::end();
	?>
	</section><!-- /.content -->
</div>
<?php
	$this->registerJs("
		$('#edit').on('show.bs.modal', function(event){
			var button = $(event.relatedTarget);
			var modal = $(this);
			var title = button.data('title');
			var href = button.attr('href');
			modal.find('.modal-title').html(title);
			modal.find('.modal-body').html('<i class=\"fa fa-spinner fa-spin\"></i>');
			$.post(href)
				.done(function(data){
					modal.find('.modal-body').html(data);
				});
		});
	");
?>