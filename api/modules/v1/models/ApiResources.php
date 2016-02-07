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
	private $connection;
	private $query;
	public $provinsi;
	public $kota;
	public $kecamatan;
	public $kelurahan;
	public $rt;
	public $rw;
	public $alamat;
	public $tglTerbit;

	public function __construct()
	{
		$this->query = new Query();
		$this->connection = Yii::$app->getDb();
	}

	private function getReqLocations()
	{
		$key = $value = null;

		if (!empty($this->provinsi)) {
			// $locations[':prov'] = $this->provinsi;
			$key = 'base_updatable.provinsi';
			$value = $this->provinsi;
		}
		if (!empty($this->kota)) {
			// $locations[':kab'] = $this->kota;
			$key = 'base_updatable.kabupaten';
			$value = $this->kots;
		}
		if (!empty($this->kecamatan)) {
			// $locations[':kec'] = $this->kecamatan;
			$key = 'base_updatable.kecamatan';
			$value = $this->kecamatan;
		}
		if (!empty($this->kelurahan)) {
			// $locations[':kel'] = $this->kelurahan;
			$key = 'base_updatable.kelurahan';
			$value = $this->kelurahan;
		}

		if (!empty($key) && !empty($value)) {
			return $locations[$key] = $value;
		}
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

	public function searchPenduduk($nama, $rt, $rw, $alamat)
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
		$this->query 	->select(['SUM(case when jenis_kelamin=1 then 1 else 0 end) as jumlah_laki_laki, SUM(case when jenis_kelamin=2 then 1 else 0 end) as jumlah_perempuan, count(*) as total'])
						->from('base')
						->where($this->getReqLocations());
		$command = $this->query->createCommand();
		$data = $command->queryAll();
		return $data;
	}

	public function getStatJmlPddbyYear($year)
	{
		$rawQuery = "SELECT SUM(case when jenis_kelamin=1 then 1 else 0 end) as jml_laki, SUM(case when jenis_kelamin=2 then 1 else 0 end) as jml_perempuan, count(*) as total FROM base WHERE EXTRACT(YEAR FROM tanggal_diterbitkan)=$year";

		$command = Yii::$app->getDb()->createCommand($rawQuery);
		$data = $command->queryAll();
		return $data;
	}

	public function getStatJmlPddbyRangeYear($yearstart, $yearend)
	{
		$rawQuery = "SELECT SUM(case when jenis_kelamin=1 then 1 else 0 end) as jml_laki, SUM(case when jenis_kelamin=2 then 1 else 0 end) as jml_perempuan, count(*) as total, EXTRACT(YEAR FROM tanggal_diterbitkan) AS tahun FROM base WHERE EXTRACT(YEAR FROM tanggal_diterbitkan)>=$yearstart AND EXTRACT(YEAR FROM tanggal_diterbitkan)<=$yearend GROUP BY tahun";

		$rawQuery2 = "SELECT SUM(case when base.jenis_kelamin=1 then 1 else 0 end) as jml_laki, SUM(case when base.jenis_kelamin=2 then 1 else 0 end) as jml_perempuan, count(base.nik) as total, EXTRACT(YEAR FROM base.tanggal_diterbitkan) AS tahun FROM base LEFT JOIN status_kematian ON(base.nik = status_kematian.nik) LEFT JOIN status_domisili WHERE EXTRACT(YEAR FROM tanggal_diterbitkan)>=$yearstart AND EXTRACT(YEAR FROM tanggal_diterbitkan) <=$yearend  AND arsip != 0 GROUP BY tahun";

		$command = Yii::$app->getDb()->createCommand($rawQuery);
		$data = $command->queryAll();
		return $data;
	}

	public function getStatAvgAges()
	{
		$rawQuery = "SELECT COUNT(@age:=YEAR(now())-YEAR(tanggal_lahir)), @age FROM base GROUP BY @age";
		$command = Yii::$app->getDb()->createCommand($rawQuery);
		$data = $command->queryAll();
		return $data;
	}

	public function getFullKK($noKK)
	{
		$rawQuery = "SELECT kk.id as no_kk, kk.kepala_keluarga, (CASE WHEN bu.status_keluarga=1 THEN 'kepala keluarga' WHEN bu.status_keluarga=2 THEN 'istri' ELSE 'anak' END) AS 'status_keluarga', b.nik, b.nama, (CASE WHEN b.jenis_kelamin=1 THEN 'Laki-laki' WHEN b.jenis_kelamin=2 THEN 'Perempuan' END) AS 'jenis_kelamin', DATE_FORMAT(b.tanggal_lahir, '%m-%d-%Y') as 'tanggal_lahir', DATE_FORMAT(kk.tanggal_terbit, '%m-%d-%Y') as 'tanggal_terbit', DATE_FORMAT(kk.tanggal_pembaruan, '%m-%d-%Y') as 'tanggal_pembaruan' FROM keluarga as kk JOIN base_updatable as bu ON(bu.no_kk = kk.id) LEFT JOIN base as b ON(b.nik = bu.nik) WHERE kk.id=$noKK";
		$command = Yii::$app->getDb()->createCommand($rawQuery);
		$data = $command->queryAll();
		return $data;
	}

	public function getInfoKK($nik)
	{
		// $connection = Yii::$app->getDb();
		$rawQuery = "SELECT kk.id as no_kk, kk.kepala_keluarga, (CASE WHEN bu.status_keluarga=1 THEN 'kepala keluarga' WHEN bu.status_keluarga=2 THEN 'istri' ELSE 'anak' END) AS 'status_keluarga', b.nik, b.nama, (CASE WHEN b.jenis_kelamin=1 THEN 'Laki-laki' WHEN b.jenis_kelamin=2 THEN 'Perempuan' END) AS 'jenis_kelamin', DATE_FORMAT(b.tanggal_lahir, '%m-%d-%Y') as 'tanggal_lahir', DATE_FORMAT(kk.tanggal_terbit, '%m-%d-%Y') as 'tanggal_terbit', DATE_FORMAT(kk.tanggal_pembaruan, '%m-%d-%Y') as 'tanggal_pembaruan' FROM keluarga as kk JOIN base_updatable as bu ON(bu.no_kk = kk.id) LEFT JOIN base as b ON(b.nik = bu.nik) WHERE b.nik=$nik";
		$command = Yii::$app->getDb()->createCommand($rawQuery);
		$data = $command->queryOne();
		return $data;
	}
}