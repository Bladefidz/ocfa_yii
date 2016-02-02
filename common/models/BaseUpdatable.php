<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "base_updatable".
 *
 * @property string $nik
 * @property string $no_kk
 * @property integer $status_keluarga
 * @property string $ayah
 * @property string $ibu
 * @property resource $foto
 * @property integer $agama
 * @property integer $provinsi
 * @property integer $kabupaten
 * @property integer $kecamatan
 * @property string $kelurahan
 * @property integer $rt
 * @property integer $rw
 * @property string $alamat
 * @property integer $status_perkawinan
 * @property string $pekerjaan
 * @property integer $pendidikan_terakhir
 *
 * @property Base $nik0
 */
class BaseUpdatable extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'base_updatable';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nik', 'agama', 'provinsi', 'kabupaten', 'kecamatan', 'kelurahan', 'alamat', 'status_perkawinan', 'pekerjaan', 'pendidikan_terakhir'], 'required'],
            [['nik', 'no_kk', 'status_keluarga', 'ayah', 'ibu', 'agama', 'provinsi', 'kabupaten', 'kecamatan', 'kelurahan', 'rt', 'rw', 'status_perkawinan', 'pendidikan_terakhir'], 'integer'],
            [['foto'], 'string'],
            [['alamat', 'pekerjaan'], 'string', 'max' => 32],
            [['nik'], 'exist', 'skipOnError' => true, 'targetClass' => DataManagement::className(), 'targetAttribute' => ['nik' => 'nik']],
        ];
    }

    /**
     * @inheritdoc
	 * status_keluarga => [1 => Kepala Keluarga, 2 => Istri, 3 => Anak]
     */
    public function attributeLabels()
    {
        return [
            'nik' => 'NIK *',
			'no_kk' => 'Nomor KK',
            'status_keluarga' => 'Status Keluarga',
            'ayah' => 'NIK Ayah',
            'ibu' => 'NIK Ibu',
            'foto' => 'Foto',
            'agama' => 'Agama *',
            'provinsi' => 'Provinsi *',
            'kabupaten' => 'Kabupaten *',
            'kecamatan' => 'Kecamatan *',
            'kelurahan' => 'Kelurahan *',
            'rt' => 'Rt',
            'rw' => 'Rw',
            'alamat' => 'Alamat *',
            'status_perkawinan' => 'Status Perkawinan *',
            'pekerjaan' => 'Pekerjaan *',
            'pendidikan_terakhir' => 'Pendidikan Terakhir *',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNik0()
    {
        return $this->hasOne(DataManagement::className(), ['nik' => 'nik']);
    }
}
