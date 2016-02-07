<?php

namespace api\common\libraries;

use yii;
use yii\filters\auth\QueryParamAuth;
use common\models\DataManagement;
use common\models\BaseUpdatable;
use common\models\Provinces;
use common\models\Regencies;
use common\models\Districts;
use common\models\Villages;

/**
 * ApiControoler class
 * localhost/ocfa_yii/api/<method>
 */
class RestReactor extends \yii\rest\Controller
{
	/**
	 * Yii class behavior
	 * @return
	 */
	public function behaviors(){
      	$behaviors = parent::behaviors();
      	$behaviors['authenticator'] = [
        	'class' => QueryParamAuth::className(),
      	];
      	return $behaviors;
    }

	/**
	 * Nomalize requested civil data to be human readable
	 * @param  array $data civil data
	 * @return array       normalized civil data
	 */
	public static function exchangeData($data)
	{
		if(isset($data['jenis_kelamin'])) {
    		$data['jenis_kelamin'] = DataManagement::getJenisKelamin($data['jenis_kelamin']);
    	}

    	if(isset($data['kewarganegaraan'])) {
    		$data['kewarganegaraan'] = DataManagement::getKewarganegaraan($data['kewarganegaraan']);
    	}

    	if(isset($data['provinsi'])) {
    		$data['provinsi'] = Provinces::findOne($data['provinsi'])->name;
    	}

    	if(isset($data['kabupaten'])) {
			$data['kabupaten'] = Regencies::findOne($data['kabupaten'])->name;
		}

		if(isset($data['kecamatan'])) {
			$data['kecamatan'] = Districts::findOne($data['kecamatan'])->name;
		}

		if(isset($data['kelurahan'])) {
			$data['kelurahan'] = Villages::findOne($data['kelurahan'])->name;
		}

		if(isset($data['agama'])) {
			switch($data['agama']){
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
			$data['agama'] = $agama;
		}

		if(isset($data['status_perkawinan'])) {
			switch($data['status_perkawinan']){
				case '0':
					$status_perkawinan = 'Belum Menikah';
					break;
				case '1':
					$status_perkawinan = 'Menikah';
					break;
				case '2':
					$status_perkawinan = 'Cerai';
					break;
				case '3':
					$status_perkawinan = 'Cerai ditinggal mati';
					break;
			}
			$data['status_perkawinan'] = $status_perkawinan;
		}

		if(isset($data['pekerjaan'])) {
			if($data['pekerjaan'] == 'NULL'){
				$data['pekerjaan'] = '-';
			}
		}

		if(isset($data['pendidikan_terakhir'])) {
			switch($data['pendidikan_terakhir']){
				case '1':
					$pend_terakhir = 'SD';
					break;
				case '2':
					$pend_terakhir = 'SMP';
					break;
				case '3':
					$pend_terakhir = 'SMA';
					break;
				case '4':
					$pend_terakhir = 'D 1';
					break;
				case '5':
					$pend_terakhir = 'D 2';
					break;
				case '6':
					$pend_terakhir = 'D 3';
					break;
				case '7':
					$pend_terakhir = 'D 4 / Sarjana (S 1)';
					break;
				case '8':
					$pend_terakhir = 'Pasca Sarjana (S 2)';
					break;
				case '9':
					$pend_terakhir = 'Pasca Sarjana (S 3)';
					break;
			}
			$data['pendidikan_terakhir'] = $pend_terakhir;
		}

		if(isset($data['tanggal_lahir'])) {
			$data['tanggal_lahir'] = date("d-m-Y", strtotime($data['tanggal_lahir']));
		}

		return $data;
	}
}