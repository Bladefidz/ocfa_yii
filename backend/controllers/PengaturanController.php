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
use common\models\TabelDomisili;
use common\models\UserActivity;
use common\models\User;
use common\models\TabelKewarganegaraan;
use backend\libraries\Exchanger;
use backend\models\KeluargaSearch;
use backend\models\DataExportSearch;
use backend\models\UploadForm;
use backend\models\UploadXlsForm;
use backend\models\UploadCsvForm;
use yii\web\UploadedFile;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\VarDumper;
use m35\thecsv\theCsv;
use arogachev\excel\import\basic\Importer;

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
		// get user level from class User by id
		$getUser = User::findIdentity(Yii::$app->user->id);
		// check user level, if level equals 1 then user is an admin, he can through frontend or backend, if else user is a user, he only can through frontend
		if($getUser['status'] != 0){
			if($getUser->level == 1){
				$this->redirect('pengaturan/export');
			}else{
				$user = User::find()->select(['id','instansi','username','email','auth_key'])->where(["id" => Yii::$app->user->id])->one();
				return $this->render('user_index',[
					'user' => $user,
				]);
			}
		}else{
			Yii::$app->user->logout();
			return $this->redirect('../../');
		}
		
    }
	
	/**
     * Edit Instansi in User Model.
     * @return mixed
     */
    public function actionUbah()
    {
		// get user instansi from class User by id
		$instansi = User::find(Yii::$app->user->id)->one();
		
		if($instansi->load(Yii::$app->request->post())){
			$instansi->save();
			// VarDumper::dump($instansi,5678,true);
		}else{
			return $this->renderAjax('edit',[
				'instansi' => $instansi,
			]);
		}
		
    }
	
	/**
     * Deaktivasi User.
     * @return mixed
     */
    public function actionDeaktivasi()
    {
		// get user instansi from class User by id
		$status = User::findIdentity(Yii::$app->user->id);
		$status->status = '0';
		if($status->update()){
			$this->actionIndex();
		}
		VarDumper::dump($status->id,5678,true);
    }
	
	public function actionExport()
    {
    	$render = null;
    	$exchanger = new Exchanger();

		$model = new \yii\base\DynamicModel(['tabel']);
		$model->addRule(['tabel'], 'string', ['max' => 30]);
		if ($model->load(Yii::$app->request->post()) && $model->validate()) {
			switch($model->tabel){
				case '1':
					$this->exportPenduduk();
					die();
					break;
				case '2':
					$this->exportKeluarga();
					die();
					break;
				case '3':
					$this->exportAktivitasUser();
					die();
					break;
				default:
					break;
			}
		} 

		$xlsModel = new UploadXlsForm();
		if ($xlsModel->load(Yii::$app->request->post())) {
			libxml_use_internal_errors(true);
			$file = UploadedFile::getInstance($xlsModel, 'file');
			$filename = 'Data_Penduduk'.Date('YmdGis').'.'.$file->extension;
			define('XLS_PATH', '../runtime/upload/');
			$upload = $file->saveAs(XLS_PATH.$filename);

			if($upload) {
				$xlsFile = XLS_PATH . $filename;

				try {
					$inputFT = \PHPExcel_IOFactory::identify($xlsFile);
					$objReader = \PHPExcel_IOFactory::createReader($inputFT);
					$objPHPExcel = $objReader->load($xlsFile);
				} catch (Exception $e) {
					die('Error');
				}

				$sheet = $objPHPExcel->getSheet(0);
				$highestRow = $sheet->getHighestRow();
				$highestColumn = $sheet->getHighestColumn();

				for ($row=0; $row <=$highestRow ; $row++) { 
					$rowData = $sheet->rangeToArray('A'.$row.':'.$highestColumn.$row, NULL, True, False);
					// VarDumper::dump($rowData);

					if($row == 1) {
						continue;
					}

					$baseModel = new DataManagement();
					$subModel = new BaseUpdatable();
					$domisili = new TabelDomisili();
					
					$baseModel->nik = $rowData[0][0];
					$baseModel->nama = $rowData[0][1];
					$baseModel->tempat_lahir = $rowData[0][2];
					$baseModel->tanggal_lahir = $rowData[0][3];
					$baseModel->jenis_kelamin = Exchanger::getKodeJK($rowData[0][4]);
					$baseModel->golongan_darah = $rowData[0][5];
					$baseModel->tanggal_diterbitkan = $rowData[0][6];
					$baseModel->nik_pencatat = $rowData[0][7];

					$subModel->nik = $baseModel->nik;
					$subModel->no_kk = $rowData[0][8];
					$subModel->status_keluarga = Exchanger::getKodeStatusKeluarga($rowData[0][9]);
					$subModel->ayah = $rowData[0][10];
					$subModel->ibu = $rowData[0][11];
					$subModel->agama = Exchanger::getKodeAgama($rowData[0][12]);

					$domisili->kelurahan = $rowData[0][16];
					$domisili->rt = $rowData[0][17];
					$domisili->rw = $rowData[0][18];
					$domisili->alamat = $rowData[0][19];
					$subModel->status_perkawinan = Exchanger::getKodeStatusPerkawinan($rowData[0][20]);
					$subModel->pekerjaan = $rowData[0][21];
					$subModel->pendidikan_terakhir = Exchanger::getKodePendidikan($rowData[0][22]);
					// $subModel->foto = BaseUpdatable::findOne($baseModel->nik)->foto;

					$baseModel->save();
					$subModel->save();
					$domisili->save();
				}
				unlink(XLS_PATH.$filename);
				die();
				$render = $this->redirect('export');
			}
		}

		$modelCsv = new \yii\base\DynamicModel(['tabelcsv']);
		$modelCsv->addRule(['tabelcsv'], 'string', ['max' => 30]);
		if ($modelCsv->load(Yii::$app->request->post())) {
			switch($modelCsv->tabelcsv){
				case '1':
					$this->exportPendudukCsv();
					die();
					break;
				case '2':
					$this->exportKeluargaCsv();
					die();
					break;
				case '3':
					$this->exportAktivitasUserCsv();
					die();
					break;
			}
		}

		$uploadCsv = new UploadCsvForm();
		if ($uploadCsv->load(Yii::$app->request->post())) {
			$file = UploadedFile::getInstance($uploadCsv, 'file');
			$filename = 'Data_Penduduk'.Date('YmdGis').'.'.$file->extension;
			$upload = $file->saveAs('../runtime/upload/'.$filename);
			if($upload) {
				define('CSV_PATH', '../runtime/upload/');
				$csvFile = CSV_PATH . $filename;
				$csv = file($csvFile);
				unset($csv[0]); // Remove headers
				foreach ($csv as $data) {
					$baseModel = new DataManagement();
					$in = explode(",", $data);
					$baseModel->nik = $in[0];
					$baseModel->nama = $in[1];
					$baseModel->tempat_lahir = $in[2];
					$baseModel->tanggal_lahir = $in[3];
					$baseModel->jenis_kelamin = $in[4];
					$baseModel->golongan_darah = $in[5];
					$baseModel->tanggal_diterbitkan = $in[6];
					$baseModel->nik_pencatat = $in[7];
					$baseModel->save();
				}
				unlink('../runtime/upload/'.$filename);
				$render = $this->redirect('export');
			}
		}
		
		if (empty($render)) {
			return $this->render('index',[
				'modelCsv' => $modelCsv,
				'uploadCsv' => $uploadCsv,
				'model' => $model,
				'upload' => $xlsModel,
			]);
		} else {
			return $render;
		}
    }
	
	private function exportPendudukCsv()
    {
		$isi = DataManagement::find()->asArray()->all();
		$filename = 'Data_Penduduk-'.Date('YmdGis').'.csv';
		header("Content-Type: application/csv");
		header("Content-Disposition: attachment; filename=".$filename);
		// Disable caching
		header("Cache-Control: no-cache, no-store, must-revalidate"); // HTTP 1.1
		header("Pragma: no-cache"); // HTTP 1.0
		header("Expires: 0"); // Proxies
		
		$csv = '';
		$i = 0;
		$len = count($isi[0]);
		foreach ($isi[0] as $k => $v) {
			if ($i == $len-1) {
				echo $k."\n";
			} else {
				echo $k.",";
			}
			$i++;
		}

		$csv = substr($csv, 0, -1)."\r\n";
		foreach ($isi as $key => $val) {
			$tmp = '';
			$ii = 0;
			foreach ($val as $v) {
				$tmp .= $v.",";
				if ($ii < $len-1) {
					echo (string)$v.",";
				} else {
					echo (string)$v."\n";
				}
				$ii++;
			}
			$csv .= substr($tmp, 0, -1)."\r\n";
		}

		// echo $csv;
		return true;
    }

    private function exportKeluargaCsv() {
    	$isi = Keluarga::find()->asArray()->all();
    	$filename = 'Data_Keluarga-'.date('YmdGis').'.csv';

    	header("Content-Type: application/csv");
		header("Content-Disposition: attachment; filename=".$filename);
		// Disable caching
		header("Cache-Control: no-cache, no-store, must-revalidate"); // HTTP 1.1
		header("Pragma: no-cache"); // HTTP 1.0
		header("Expires: 0"); // Proxies

		echo "Nomor KK,Nama Kepala Keluarga,Alamat,RT,RW,Desa/Kelurahan,Kecamatan,Kabupaten/Kota,Provinsi,Dikeluarkan Tanggal,Nama Lengkap,NIK,Jenis Kelamin,Tempat Lahir,Tanggal Lahir,Agama,Pendidikan Terakhir,Pekerjaan,Status Perkawinan,Status Hubungan Dalam Keluarga,Kewarganegaraan,Nama Ayah,Nama Ibu";
		echo "\n";

		foreach ($isi as $data) {
			$subData = BaseUpdatable::find()->where('status_keluarga = "1" and no_kk = "'.$data['id'].'"')->one();
			$base = DataManagement::findOne($subData['nik']);
			$domisili = TabelDomisili::find()->where('nik = '.$subData['nik'])->one();
			$rawNikKeluarga = BaseUpdatable::find()->where('no_kk = '.$data['id'])->asArray()->all();
			$nikKeluarga = "";
			foreach($rawNikKeluarga as $val){
				if($nikKeluarga != null){
					$nikKeluarga .= ",";
				}
				$nikKeluarga .= $val['nik'];
			}
			$dataKeluarga = DataManagement::find()->joinWith('baseUpdatable')->where('base.nik in ('.$nikKeluarga.')')->asArray()->all();
			$count = count($dataKeluarga);

			foreach($dataKeluarga as $value){
				echo $data['id'].",";
				echo $base['nama'].",";
				echo $domisili['alamat'].",";
				echo $domisili['rt'].",";
				echo $domisili['rw'].",";
				$kel = Villages::findOne($domisili['kelurahan'])->name;
				$kec = Districts::findOne(substr($domisili['kelurahan'],0,strlen($domisili['kelurahan'])-3))->name;
				$kot = Regencies::findOne(substr($domisili['kelurahan'],0,strlen($domisili['kelurahan'])-6))->name;
				$pro = Provinces::findOne(substr($domisili['kelurahan'],0,strlen($domisili['kelurahan'])-8))->name;
				echo substr($kel, 0, -1).",".substr($kec, 0, -1).",".substr($kot, 0, -1).",".substr($pro, 0, -1).",";
				echo Keluarga::findOne($data['id'])->tanggal_terbit.",";
				echo $value['nama'].",";
				echo $value['nik'].",";
				echo $value['jenis_kelamin'] == 1 ? "Laki-laki," : "Perempuan,";
				echo $value['tempat_lahir'].",";
				echo $value['tanggal_lahir'].",";
				switch($value['baseUpdatable']['agama']){
					case '1':
						$agama = 'Islam';
						break;
					case '2':
						$agama = 'Kristen';
						break;
					case '3':
						$agama = 'Katholik';
						break;
					case '4':
						$agama = 'Hindu';
						break;
					case '5':
						$agama = 'Budha';
						break;
					case '6':
						$agama = 'Konghucu';
						break;
					case '7':
						$agama = 'Lainnya';
						break;
				}
				echo $agama.",";
				switch($value['baseUpdatable']['pendidikan_terakhir']){
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
				echo $pend.",";
				echo $value['baseUpdatable']['pekerjaan'].",";
				if($value['baseUpdatable']['status_perkawinan'] == 0){
					$status_perkawinan = 'Belum Menikah';
				}elseif($value['baseUpdatable']['status_perkawinan'] == 1){
					$status_perkawinan = 'Menikah';
				}elseif($value['baseUpdatable']['status_perkawinan'] == 2){
					$status_perkawinan = 'Cerai';
				}elseif($value['baseUpdatable']['status_perkawinan'] == 3){
					$status_perkawinan = 'Cerai Ditinggal Mati';
				}
				echo $status_perkawinan.",";
				$status_keluarga = $value['baseUpdatable']['status_keluarga'];
				if($status_keluarga == 1){
					$statusKeluarga = 'Kepala Keluarga';
				}elseif($status_keluarga == 2){
					$statusKeluarga = 'Istri';
				}elseif($status_keluarga == 3){
					$statusKeluarga = 'Anak';
				}
				echo $statusKeluarga.",";
				if(TabelKewarganegaraan::findOne($value['nik']) !== null){
					$kewarganegaraan = 'WNA';
				}else{
					$kewarganegaraan = 'WNI';
				}
				echo $kewarganegaraan.",";
				echo DataManagement::findOne(BaseUpdatable::findOne($value['nik'])->ayah)['nama'].",";
				echo DataManagement::findOne(BaseUpdatable::findOne($value['nik'])->ibu)['nama'];
				echo "\n";
			}
		}
		return true;
    }

    private function exportAktivitasUserCsv() {
    	$isi = UserActivity::find()->orderBy('timestamp desc')->asArray()->all();
    	$filename = 'Data_Aktivitas_User-'.Date('YmdGis').'.csv';
		//VarDumper::dump($isi,5678);
		header("Content-Type: application/csv");
		header("Content-Disposition: attachment; filename=".$filename);
		// Disable caching
		header("Cache-Control: no-cache, no-store, must-revalidate"); // HTTP 1.1
		header("Pragma: no-cache"); // HTTP 1.0
		header("Expires: 0"); // Proxies

		$head = '';
		foreach ($isi[0] as $k => $v) {
			$head .= $k.",";
		}

		echo substr($head, 0, -1);
		echo "\n";

		foreach($isi as $data){
			$nama = DataManagement::findOne($data['nik'])->nama;
			echo $data['nik'].",";
			echo $nama.",";
			echo $data['action'].",";
			echo $data['timestamp'];
			echo "\n";
		}
		return true;
    }
	
	private function exportPenduduk()
	{
		$isi = DataManagement::find()->asArray()->all();
		$filename = 'Data_Penduduk-'.date('YmdGis').'.xls';
		header("Content-type: application/vnd.ms-excel; charset=utf-8");
		header("Content-Disposition: attachment; filename=\"$filename\"");
		header("Pragma: no-cache");
		header("Expires: 0");
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
					<th>NIK Pencatat</th>
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
			</thead>
			<tbody>';
			foreach($isi as $data){
				$subData = BaseUpdatable::findOne($data['nik']);
				$domisili = TabelDomisili::find()->where('current = 1 and nik = '.$data['nik'])->one();
				// echo var_dump($data);
				// echo "<br><br>";
				// echo var_dump($subData);
				// echo "<br><br>";
				// echo var_dump($domisili);
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
						<td class="str">'.$data['nik_pencatat'].'</td>
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
						<td>'.Provinces::findOne(substr($domisili->kelurahan,0,strlen($domisili->kelurahan)-8))['name'].'</td>
						<td>'.Regencies::findOne(substr($domisili->kelurahan,0,strlen($domisili->kelurahan)-6))['name'].'</td>
						<td>'.Districts::findOne(substr($domisili->kelurahan,0,strlen($domisili->kelurahan)-3))['name'].'</td>
						<td>'.Villages::findOne($domisili->kelurahan)['name'].'</td>
						<td>'.$domisili['rt'].'</td>
						<td>'.$domisili['rw'].'</td>
						<td>'.$domisili['alamat'].'</td>
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
				</tbody>';
			}
		echo '</table>';
		return true;
	}
	
	private function exportKeluarga(){
		$isi = Keluarga::find()->asArray()->all();
		
		$filename = 'Data_Keluarga-'.date('YmdGis').'.xls';
		header("Content-type: application/vnd.ms-excel");
		header("Content-Disposition: attachment; filename=\"$filename\"");
		header("Pragma: no-cache");
		header("Expires: 0");
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
					<th>Provinsi</th>
					<th>Dikeluarkan Tanggal</th>
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
				</tr>
			</thead>
			<tbody>';
			$i = 0;
			foreach($isi as $data){
				$subData = BaseUpdatable::find()->where('status_keluarga = "1" and no_kk = "'.$data['id'].'"')->one();
				$base = DataManagement::findOne($subData['nik']);
				$domisili = TabelDomisili::find()->where('nik = '.$subData['nik'])->one();
				//echo var_dump($subData->nik);
				//echo var_dump($subData);
				$rawNikKeluarga = BaseUpdatable::find()->where('no_kk = '.$data['id'])->asArray()->all();
				$nikKeluarga = "";
				foreach($rawNikKeluarga as $val){
					if($nikKeluarga != null){
						$nikKeluarga .= ",";
					}
					$nikKeluarga .= $val['nik'];
				}
				$dataKeluarga = DataManagement::find()->joinWith('baseUpdatable')->where('base.nik in ('.$nikKeluarga.')')->asArray()->all();
				$count = count($dataKeluarga);
				echo '
					<tr>
						<td class="str" rowspan="'.$count.'">'.$data['id'].'</td>
						<td rowspan="'.$count.'">'.$base['nama'].'</td>
						<td rowspan="'.$count.'">'.$domisili['alamat'].'</td>
						<td rowspan="'.$count.'">'.$domisili['rt'].'</td>
						<td rowspan="'.$count.'">'.$domisili['rw'].'</td>
						<td rowspan="'.$count.'">'.Villages::findOne($domisili['kelurahan'])->name.'</td>
						<td rowspan="'.$count.'">'.Districts::findOne(substr($domisili['kelurahan'],0,strlen($domisili['kelurahan'])-3))->name.'</td>
						<td rowspan="'.$count.'">'.Regencies::findOne(substr($domisili['kelurahan'],0,strlen($domisili['kelurahan'])-6))->name.'</td>
						<td rowspan="'.$count.'">'.Provinces::findOne(substr($domisili['kelurahan'],0,strlen($domisili['kelurahan'])-8))->name.'</td>
						<td rowspan="'.$count.'">'.Keluarga::findOne($data['id'])->tanggal_terbit.'</td>';
						foreach($dataKeluarga as $value){
							$jk = $value['jenis_kelamin'] == 1 ? 'Laki-laki' : 'Perempuan';
							//echo var_dump($value['baseUpdatable']['agama']);
							switch($value['baseUpdatable']['agama']){
								case '1':
									$agama = 'Islam';
									break;
								case '2':
									$agama = 'Kristen';
									break;
								case '3':
									$agama = 'Katholik';
									break;
								case '4':
									$agama = 'Hindu';
									break;
								case '5':
									$agama = 'Budha';
									break;
								case '6':
									$agama = 'Konghucu';
									break;
								case '7':
									$agama = 'Lainnya';
									break;
							}
							switch($value['baseUpdatable']['pendidikan_terakhir']){
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
							if($value['baseUpdatable']['status_perkawinan'] == 0){
								$status_perkawinan = 'Belum Menikah';
							}elseif($value['baseUpdatable']['status_perkawinan'] == 1){
								$status_perkawinan = 'Menikah';
							}elseif($value['baseUpdatable']['status_perkawinan'] == 2){
								$status_perkawinan = 'Cerai';
							}elseif($value['baseUpdatable']['status_perkawinan'] == 3){
								$status_perkawinan = 'Cerai Ditinggal Mati';
							}
							$status_keluarga = $value['baseUpdatable']['status_keluarga'];
							//echo var_dump($status_keluarga);
							if($status_keluarga == 1){
								$statusKeluarga = 'Kepala Keluarga';
							}elseif($status_keluarga == 2){
								$statusKeluarga = 'Istri';
							}elseif($status_keluarga == 3){
								$statusKeluarga = 'Anak';
							}
							if(TabelKewarganegaraan::findOne($value['nik']) !== null){
								$kewarganegaraan = 'WNA';
							}else{
								$kewarganegaraan = 'WNI';
							}
							echo '
								<td>'.$value['nama'].'</td>
								<td>'.$value['nik'].'</td>
								<td>'.$jk.'</td>
								<td>'.$value['tempat_lahir'].'</td>
								<td>'.$value['tanggal_lahir'].'</td>
								<td>'.$agama.'</td>
								<td>'.$pend.'</td>
								<td>'.$value['baseUpdatable']['pekerjaan'].'</td>
								<td>'.$status_perkawinan.'</td>
								<td>'.$statusKeluarga.'</td>
								<td>'.$kewarganegaraan.'</td>
								<td>'.DataManagement::findOne(BaseUpdatable::findOne($value['nik'])->ayah)['nama'].'</td>
								<td>'.DataManagement::findOne(BaseUpdatable::findOne($value['nik'])->ibu)['nama'].'</td>
							';
							if($i < $count-1){
								echo '</tr><tr>';
							}else{
								echo '</tr>';
							}
							$i++;
						}
						echo '</tbody>';
					
			}
		echo '</table>';
		return true;
	}
	
	private function exportAktivitasUser(){
		$isi = UserActivity::find()->orderBy('timestamp desc')->asArray()->all();
		//VarDumper::dump($isi,5678);
		$filename = 'Data_Aktivitas_User-'.Date('YmdGis').'.xls';
		header("Content-type: application/msexcel");
		header("Content-Disposition: attachment; filename=".$filename);
		header("Pragma: no-cache");
		header("Expires: 0");
		echo "<style> .str{ mso-number-format:\@; } </style>";
		echo '<table border="1" width="100%">
			<thead>
				<tr>
					<th>NIK</th>
					<th>Nama</th>
					<th>Aksi</th>
					<th>Timestamp</th>
				</tr>
			</thead>';
		foreach($isi as $data){
			$nama = DataManagement::findOne($data['nik'])->nama;
			echo '
			<tr>
				<td>'.$data['nik'].'</td>
				<td>'.$nama.'</td>
				<td>'.$data['action'].'</td>
				<td>'.$data['timestamp'].'</td>
			</tr>
			';
		}
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
