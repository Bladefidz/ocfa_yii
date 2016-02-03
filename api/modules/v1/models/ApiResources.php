<?php

namespace api\modules\v1\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use yii\db\Query;

/**
 * DataController implements the CRUD actions for DataManagement model.
 */
class ApiResources extends Model
{
	private $query;

	public function __construct()
	{
		$this->query = new Query();
	}

	public function getPenduduk($nik, $field)
	{
		$this->query 	->select([$field])
						->from('base')
						->leftjoin('base_updatable', 'base.nik = base_updatable.nik')
						->where('base.nik=:nik', array(':nik'=>$nik));
		$command = $this->query->createCommand();
		$data = $command->queryOne();
		return $data;
	}

	public function searchPenduduk($nama, $provinsi, $kota, $kecamatan, $kelurahan, $rt, $rw, $alamat)
	{
		$this->query 	->select([$field])
						->from('base')
						->leftjoin('base_updatable', 'base.nik = base_updatable.nik')
						->where(
								'base.nama=:nama',
								'base_updatable.provinsi=:prov',
								'base_updatable.kabupaten=:kab',
								'base_updatable.kecamatan=:kec',
								'base_updatable.kelurahan=:kel',
								'base_updatable.rt=:rt',
								'base_updatable.rw=:rw',
								'base_updatable.alamat=:almt',
								array(
									':nama'=>$nama,
									':prov'=>$provinsi,
									':kab'=>$kota,
									':kec'=>$kecamatan,
									':kel'=>$kelurahan,
									':rt'=>$rt,
									':rw'=>$rw,
									':almt'=>$alamat
								)
							);
		$command = $this->query->createCommand();
		$data = $command->queryOne();
		return $data;
	}

	public function getStatistic()
	{
		
	}
}