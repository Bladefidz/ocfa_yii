<?php

namespace backend\controllers;

use Yii;
use common\models\Keluarga;
use common\models\BaseUpdatable;
use common\models\DataManagement;
use common\models\Provinces;
use common\models\Regencies;
use common\models\Districts;
use common\models\Villages;
use backend\models\KeluargaSearch;
use backend\models\DataExportSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\VarDumper;

/**
 * KeluargaController implements the CRUD actions for Keluarga model.
 */
class PengaturanController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Show Pengaturan view.
     * @return mixed
     */
    public function actionIndex()
    {
		$this->redirect('pengaturan/export');
    }
	
	public function actionExport()
    {
		$model = new \yii\base\DynamicModel(['tabel']);
		$model->addRule(['tabel'], 'string', ['max' => 20]);
		if ($model->load(Yii::$app->request->post()) && $model->validate()) {
			switch($model->tabel){
				case '1':
					$this->exportPenduduk();
					//return $this->redirect('export');
					break;
				case '2':
					
			}
		}else{
		
		return $this->render('index',[
			'model' => $model
		]);
		}
    }
	
	function exportPenduduk(){
		$isi = DataManagement::find()->asArray()->all();
		$filename = 'Data Penduduk-'.Date('YmdGis').'.xls';
		header("Content-type: application/vnd-ms-excel");
		header("Content-Disposition: attachment; filename=".$filename);
		echo "<style> .str{ mso-number-format:\@; } </style>";
		echo '<table border="1" width="100%">
			<thead>
				<tr>
					<th>NIK</th>
					<th>Nama</th>
					<th>Tempat Lahir</th>
					<th>Tanggal lahir</th>
					<th>Jenis Kelamin</th>
					<th>Golongan Darah</th>
					<th>Tanggal Diterbitkan</th>
					<th>NIP Pencatat</th>
					<th>Kewarganegaraan</th>
					<th>Nomor KK</th>
					<th>Status Keluarga</th>
					<th>NIK Ayah</th>
					<th>NIK Ibu</th>
					<th>Agama</th>
					<th>Provinsi</th>
					<th>Kabupaten</th>
					<th>Kecamatan</th>
					<th>Kelurahan</th>
					<th>RT</th>
					<th>RW</th>
					<th>Alamat</th>
					<th>Status Perkawinan</th>
					<th>Pekerjaan</th>
					<th>Pendidikan Terakhir</th>
					<th>Foto</th>
				</tr>
			</thead>';
			foreach($isi as $data){
				$subData = BaseUpdatable::findOne($data['nik']);
				//echo var_dump($data);
				//echo var_dump($subData);
				$data['kewarganegaraan'] == 1 ? $kewarganegaraan = 'WNI' : $kewarganegaraan = 'WNA';
				$data['jenis_kelamin'] == 1 ? $jk = 'Laki-laki' : $jk = 'Perempuan';
				switch($subData->pendidikan_terakhir){
					case '1':
						$pend = 'SD';
						break;
					case '2':
						$pend = 'SMP';
						break;
					case '3':
						$pend = 'SMA';
						break;
					case '4':
						$pend = 'D 1';
						break;
					case '5':
						$pend = 'D 2';
						break;
					case '6':
						$pend = 'D 3';
						break;
					case '7':
						$pend = 'Sarjana S 1/D 4';
						break;
					case '8':
						$pend = 'Pasca Sarjana S 2';
						break;
					case '9':
						$pend = 'Pasca Sarjana S 3';
						break;
				}
				echo '
					<tr>
						<td class="str">'.$data['nik'].'</td>
						<td>'.$data['nama'].'</td>
						<td>'.$data['tempat_lahir'].'</td>
						<td>'.$data['tanggal_lahir'].'</td>
						<td>'.$jk.'</td>
						<td>'.$data['golongan_darah'].'</td>
						<td>'.$data['tanggal_diterbitkan'].'</td>
						<td class="str">'.$data['nip_pencatat'].'</td>
						<td>'.$kewarganegaraan.'</td>
						<td class="str">'.$subData->no_kk.'</td>
						<td>';
							if($subData->status_keluarga == 1){
								echo 'Kepala Keluarga';
							}elseif($subData->status_keluarga == 2){
								echo 'Istri';
							}elseif($subData->status_keluarga == 3){
								echo 'Anak';
							}
						echo '</td>
						<td class="str">'.$subData->ayah.'</td>
						<td class="str">'.$subData->ibu.'</td>
						<td>';
							switch($subData->agama){
								case '1':
									echo 'Islam';
									break;
								case '2':
									echo 'Kristen';
									break;
								case '3':
									echo 'Katholik';
									break;
								case '4':
									echo 'Hindu';
									break;
								case '5':
									echo 'Budha';
									break;
								case '6':
									echo 'Konghucu';
									break;
								case '7':
									echo 'Lainnya';
									break;
							}
						echo '</td>
						<td>'.Provinces::findOne($subData->provinsi)->name.'</td>
						<td>'.Regencies::findOne($subData->kabupaten)->name.'</td>
						<td>'.Districts::findOne($subData->kecamatan)->name.'</td>
						<td>'.Villages::findOne($subData->kelurahan)->name.'</td>
						<td>'.$subData->rt.'</td>
						<td>'.$subData->rw.'</td>
						<td>'.$subData->alamat.'</td>
						<td>';
							if($subData->status_perkawinan == 0){
								echo 'Belum Menikah';
							}elseif($subData->status_perkawinan == 1){
								echo 'Menikah';
							}elseif($subData->status_perkawinan == 2){
								echo 'Cerai';
							}elseif($subData->status_perkawinan == 3){
								echo 'Cerai Ditinggal Mati';
							}
						echo '</td>
						<td>'.$subData->pekerjaan.'</td>
						<td>'.$pend.'</td>
						<td>http://localhost/ocfa_yii/site/user?id='.$data['nik'].'</td>
					</tr>
				';
			}
		echo '</table>';
		return true;
	}
	
	function exportKeluarga(){
		$isi = Keluarga::find()->asArray()->all();
		$filename = 'Data Keluarga-'.Date('YmdGis').'.xls';
		header("Content-type: application/vnd-ms-excel");
		header("Content-Disposition: attachment; filename=".$filename);
		echo "<style> .str{ mso-number-format:\@; } </style>";
		echo '<table border="1" width="100%">
			<thead>
				<tr>
					<th>Nomor KK</th>
					<th>Nama Kepala Keluarga</th>
					<th>Alamat</th>
					<th>RT</th>
					<th>RW</th>
					<th>Desa/Kelurahan</th>
					<th>Kecamatan</th>
					<th>Kabupaten/Kota</th>
					<th>Kode Pos</th>
					<th>Provinsi</th>
					<th>Nama Lengkap</th>
					<th>NIK</th>
					<th>Jenis Kelamin</th>
					<th>Tempat Lahir</th>
					<th>Tanggal Lahir</th>
					<th>Agama</th>
					<th>Pendidikan Terakhir</th>
					<th>Pekerjaan</th>
					<th>Status Perkawinan</th>
					<th>Status Hubungan Dalam Keluarga</th>
					<th>Kewarganegaraan</th>
					<th>Nama Ayah</th>
					<th>Nama Ibu</th>
					<th>Dikeluarkan Tanggal</th>
				</tr>
			</thead>';
			foreach($isi as $data){
				$subData = BaseUpdatable::findOne($data['nik']);
				//echo var_dump($data);
				//echo var_dump($subData);
				$data['kewarganegaraan'] == 1 ? $kewarganegaraan = 'WNI' : $kewarganegaraan = 'WNA';
				$data['jenis_kelamin'] == 1 ? $jk = 'Laki-laki' : $jk = 'Perempuan';
				switch($subData->pendidikan_terakhir){
					case '1':
						$pend = 'SD';
						break;
					case '2':
						$pend = 'SMP';
						break;
					case '3':
						$pend = 'SMA';
						break;
					case '4':
						$pend = 'D 1';
						break;
					case '5':
						$pend = 'D 2';
						break;
					case '6':
						$pend = 'D 3';
						break;
					case '7':
						$pend = 'Sarjana S 1/D 4';
						break;
					case '8':
						$pend = 'Pasca Sarjana S 2';
						break;
					case '9':
						$pend = 'Pasca Sarjana S 3';
						break;
				}
				echo '
					<tr>
						<td class="str">'.$data['nik'].'</td>
						<td>'.$data['nama'].'</td>
						<td>'.$data['tempat_lahir'].'</td>
						<td>'.$data['tanggal_lahir'].'</td>
						<td>'.$jk.'</td>
						<td>'.$data['golongan_darah'].'</td>
						<td>'.$data['tanggal_diterbitkan'].'</td>
						<td class="str">'.$data['nip_pencatat'].'</td>
						<td>'.$kewarganegaraan.'</td>
						<td class="str">'.$subData->no_kk.'</td>
						<td>';
							if($subData->status_keluarga == 1){
								echo 'Kepala Keluarga';
							}elseif($subData->status_keluarga == 2){
								echo 'Istri';
							}elseif($subData->status_keluarga == 3){
								echo 'Anak';
							}
						echo '</td>
						<td class="str">'.$subData->ayah.'</td>
						<td class="str">'.$subData->ibu.'</td>
						<td>';
							switch($subData->agama){
								case '1':
									echo 'Islam';
									break;
								case '2':
									echo 'Kristen';
									break;
								case '3':
									echo 'Katholik';
									break;
								case '4':
									echo 'Hindu';
									break;
								case '5':
									echo 'Budha';
									break;
								case '6':
									echo 'Konghucu';
									break;
								case '7':
									echo 'Lainnya';
									break;
							}
						echo '</td>
						<td>'.Provinces::findOne($subData->provinsi)->name.'</td>
						<td>'.Regencies::findOne($subData->kabupaten)->name.'</td>
						<td>'.Districts::findOne($subData->kecamatan)->name.'</td>
						<td>'.Villages::findOne($subData->kelurahan)->name.'</td>
						<td>'.$subData->rt.'</td>
						<td>'.$subData->rw.'</td>
						<td>'.$subData->alamat.'</td>
						<td>';
							if($subData->status_perkawinan == 0){
								echo 'Belum Menikah';
							}elseif($subData->status_perkawinan == 1){
								echo 'Menikah';
							}elseif($subData->status_perkawinan == 2){
								echo 'Cerai';
							}elseif($subData->status_perkawinan == 3){
								echo 'Cerai Ditinggal Mati';
							}
						echo '</td>
						<td>'.$subData->pekerjaan.'</td>
						<td>'.$pend.'</td>
						<td>http://localhost/ocfa_yii/site/user?id='.$data['nik'].'</td>
					</tr>
				';
			}
		echo '</table>';
		return true;
	}

    /**
     * Displays a single Keluarga model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Keluarga model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Keluarga();

        if ($model->load(Yii::$app->request->post())) {
			$no_kk = substr($model->kepala_keluarga,0,6).Yii::$app->formatter->asDate('now', 'ddMMyy').$model->id;
			$model->id = $no_kk;
			$model->tanggal_terbit = date('Y-m-d');
			$model->tanggal_pembaruan = date('Y-m-d');
			$model->status = 1;
			$updatable = BaseUpdatable::findOne($model->kepala_keluarga);
			$updatable->no_kk = $no_kk;
			$updatable->status_keluarga = 1;
			//echo var_dump($model);
			if($model->save() && $updatable->save()){
				return $this->redirect(['view', 'id' => $model->id]);
			}else{
				VarDumper::dump($model->getErrors(),5678,true);
				//return $this->actionIndex();
			}
        } else {
            return $this->renderAjax('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Keluarga model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Keluarga model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Keluarga model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Keluarga the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Keluarga::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
