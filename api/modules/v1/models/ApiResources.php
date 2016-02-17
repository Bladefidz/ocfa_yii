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
						->leftjoin('tabel_kematian', 'base.nik = tabel_kematian.nik')
						->leftjoin('tabel_domisili', 'base.nik = tabel_domisili.nik')
						->leftjoin('tabel_kewarganegaraan', 'base.nik = tabel_kewarganegaraan.nik')
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
		$rawQuery = "SELECT $year as 'tahun', SUM(case when base.jenis_kelamin=1 then 1 else 0 end) as 'jumlah_laki', SUM(case when base.jenis_kelamin=2 then 1 else 0 end) as 'jumlah_perempuan', count('jml_laki'+'jml_perempuan') as 'total' FROM base LEFT JOIN tabel_kematian as tk ON(base.nik = tk.nik) LEFT JOIN tabel_kewarganegaraan as tkw ON(base.nik = tkw.nik) WHERE YEAR(base.tanggal_lahir)<=$year AND (CASE WHEN tkw.tanggal_imigrasi IS NULL THEN 9999 ELSE YEAR(tkw.tanggal_imigrasi) END) > $year AND (CASE WHEN tk.tanggal_kematian IS NULL THEN 9999 ELSE YEAR(tk.tanggal_kematian) END) > $year";

		$command = Yii::$app->getDb()->createCommand($rawQuery);
		$data = $command->queryOne();
		return $data;
	}

	public function getStatJmlPddbyRangeYear($yearstart, $yearend)
	{
		// $rawQuery = "SELECT $year as 'tahun', SUM(case when base.jenis_kelamin=1 then 1 else 0 end) as 'jumlah_laki', SUM(case when base.jenis_kelamin=2 then 1 else 0 end) as 'jumlah_perempuan', count('jml_laki'+'jml_perempuan') as 'total' FROM base LEFT JOIN tabel_kematian as tk ON(base.nik = tk.nik) LEFT JOIN tabel_kewarganegaraan as tkw ON(base.nik = tkw.nik) WHERE YEAR(tanggal_diterbitkan)<=$year AND tkw.tanggal_imigrasi IS NULL AND tk.tanggal_kematian IS NULL";

		// $command = Yii::$app->getDb()->createCommand($rawQuery);
		// $data = $command->queryAll();
		
		$data = [];
		while ($yearstart <= $yearend) {
			$data[] = $this->getStatJmlPddbyYear($yearstart);
			$yearstart++;
		}
		return $data;
	}

	public function getStatAges($year)
	{
		$rawQuery = "SELECT @age:=YEAR(now())-YEAR(tanggal_lahir) as umur, COUNT(@age) as jumlah FROM base WHERE YEAR(base.tanggal_lahir)<=$year GROUP BY umur";
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