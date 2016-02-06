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
	public $provinsi;
	public $kota;
	public $kecamatan;
	public $kelurahan;
	public $tglTerbit;

	public function __construct()
	{
		$this->query = new Query();
	}

	private function getReqLocations()
	{
		$locations = [];
		if (!empty($this->provinsi)) {
			// $locations[':prov'] = $this->provinsi;
			$locations['base_updatable.provinsi'] = $this->provinsi;
		}
		if (!empty($this->kota)) {
			// $locations[':kab'] = $this->kota;
			$locations['base_updatable.kabupaten'] = $this->kots;
		}
		if (!empty($this->kecamatan)) {
			// $locations[':kec'] = $this->kecamatan;
			$locations['base_updatable.kecamatan'] = $this->kecamatan;
		}
		if (!empty($this->kelurahan)) {
			// $locations[':kel'] = $this->kelurahan;
			$locations['base_updatable.kelurahan'] = $this->kelurahan;
		}

		return $locations;
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
						->where( array_merge(['base.name' => $nama], $this->getReqLocations()) );
		$command = $this->query->createCommand();
		$data = $command->queryOne();
		return $data;
	}

	public function getStatJmlPddbyLocation()
	{
		$this->query 	->select(['SUM(case when jenis_kelamin=1 then 1 else 0 end) as jml_laki, SUM(case when jenis_kelamin=2 then 1 else 0 end) as jml_perempuan, count(*) as total'])
						->from('base')
						->where($this->getReqLocations());
		$command = $this->query->createCommand();
		$data = $command->queryAll();
		return $data;
	}

	public function getStatJmlPddbyYear($yearstart, $yearend)
	{
		$rawQuery = "SELECT SUM(case when jenis_kelamin=1 then 1 else 0 end) as jml_laki, SUM(case when jenis_kelamin=2 then 1 else 0 end) as jml_perempuan, count(*) as total, EXTRACT(YEAR FROM tanggal_diterbitkan) AS tahun FROM base WHERE tanggal_diterbitkan BETWEEN '$yearstart-01-01' AND '$yearend-01-01' AND arsip != 0 GROUP BY tahun";
		$command = $this->query->createCommand($rawQuery);
		$data = $command->queryAll();
		return $data;
	}

	public function getStatAvgAges()
	{
		$rawQuery = "SELECT COUNT(@age:=YEAR(now())-YEAR(tanggal_lahir)), @age FROM base GROUP BY @age";
		$command = $this->query->createCommand($rawQuery);
		$data = $command->queryAll();
		return $data;
	}

	public function getKK()
	{

	}
}