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
					$this->export();
					return $this->redirect('pengaturan/export');
			}
		}
		
		return $this->render('index',[
			'model' => $model
		]);
    }
	
	function export(){
		$isi = DataManagement::find()->asArray()->all();
		$filename = 'Data-'.Date('YmdGis').'-Data Penduduk.xls';
		header("Content-type: application/vnd-ms-excel");
		header("Content-Disposition: attachment; filename=".$filename);
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
				</tr>
			</thead>';
			foreach($isi as $data){
				$subData = BaseUpdatable::findOne($data['nik']);
				//echo var_dump($data);
				//echo var_dump($subData);
				echo '
					<tr>
						<td>'.$data['nik'].'</td>
						<td>'.$data['nama'].'</td>
						<td>'.$data['tempat_lahir'].'</td>
						<td>'.$data['tanggal_lahir'].'</td>
						<td>'.$data['jenis_kelamin'] == 1 ? 'Laki-laki' : 'Perempuan' .'</td>
						<td>'.$data['golongan_darah'].'</td>
						<td>'.$data['tanggal_diterbitkan'].'</td>
						<td>'.$data['nip_pencatat'].'</td>
						<td>'.$data['kewarganegaraan'] == 1 ? 'WNI' : 'WNA' .'</td>
						<td>'.$subData->no_kk.'</td>
						<td>';
							if($subData->status_keluarga == 1){
								echo 'Kepala Keluarga';
							}elseif($subData->status_keluarga == 2){
								echo 'Istri';
							}elseif($subData->status_keluarga == 3){
								echo 'Anak';
							}
						echo '</td>
						<td>'.$subData->ayah.'</td>
						<td>'.$subData->ibu.'</td>
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
						<td>'.$subData->pendidikan_terakhir.'</td>
						<td><img src='.$subData->foto.' width="100px"/></td>
					</tr>
				';
			}
		echo '</table>';
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
