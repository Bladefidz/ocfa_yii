<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "base_updatable".
 *
 * @property string $nik
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
 * @property string $pendidikan_terakhir
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
            [['nik', 'foto', 'agama', 'provinsi', 'kabupaten', 'kecamatan', 'kelurahan', 'alamat', 'status_perkawinan', 'pekerjaan', 'pendidikan_terakhir'], 'required'],
            [['nik', 'agama', 'provinsi', 'kabupaten', 'kecamatan', 'kelurahan', 'rt', 'rw', 'status_perkawinan','pendidikan_terakhir'], 'integer'],
            [['foto'], 'string'],
            [['alamat', 'pekerjaan'], 'string', 'max' => 32],
            [['nik'], 'exist', 'skipOnError' => true, 'targetClass' => DataManagement::className(), 'targetAttribute' => ['nik' => 'nik']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'nik' => 'Nik',
            'foto' => 'Foto',
            'agama' => 'Agama',
            'provinsi' => 'Provinsi',
            'kabupaten' => 'Kabupaten',
            'kecamatan' => 'Kecamatan',
            'kelurahan' => 'Kelurahan',
            'rt' => 'Rt',
            'rw' => 'Rw',
            'alamat' => 'Alamat',
            'status_perkawinan' => 'Status Perkawinan',
            'pekerjaan' => 'Pekerjaan',
            'pendidikan_terakhir' => 'Pendidikan Terakhir',
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
