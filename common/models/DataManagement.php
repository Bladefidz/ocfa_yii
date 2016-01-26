<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "base".
 *
 * @property string $nik
 * @property string $nama
 * @property string $tempat_lahir
 * @property string $tanggal_lahir
 * @property integer $jenis_kelamin
 * @property string $golongan_darah
 * @property string $tanggal_diterbitkan
 * @property string $nip_pencatat
 * @property integer $kewarganegaraan
 *
 * @property BaseUpdatable $baseUpdatable
 */
class DataManagement extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'base';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nik', 'nama', 'tempat_lahir', 'tanggal_lahir', 'jenis_kelamin', 'golongan_darah', 'nip_pencatat', 'kewarganegaraan'], 'required'],
            [['nik', 'jenis_kelamin', 'nip_pencatat', 'kewarganegaraan'], 'integer'],
            [['tanggal_lahir', 'tanggal_diterbitkan'], 'safe'],
            [['nama', 'tempat_lahir'], 'string', 'max' => 255],
            [['golongan_darah'], 'string', 'max' => 2],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'nik' => 'Empat digit terakhir',
            'nama' => 'Nama',
            'tempat_lahir' => 'Tempat Lahir',
            'tanggal_lahir' => 'Tanggal Lahir',
            'jenis_kelamin' => 'Jenis Kelamin',
            'golongan_darah' => 'Golongan Darah',
            'tanggal_diterbitkan' => 'Tanggal Diterbitkan',
            'nip_pencatat' => 'NIP Pencatat',
            'kewarganegaraan' => 'Kewarganegaraan',
        ];
    }
	
	/**
     * getJenisKelamin
	 * @param $jenis_kelamin
	 * @return string
     */
    public function getJenisKelamin($jenis_kelamin)
    {
        if($jenis_kelamin == "1"){
			return 'Laki-laki';
		}else{
			return 'Perempuan';
		}
    }
	
	/**
     * getKewarganegaraan
	 * @param $kewarganegaraan
	 * @return string
     */
    public function getKewarganegaraan($kewarganegaraan)
    {
        if($kewarganegaraan == "1"){
			return 'WNI';
		}else{
			return 'WNA';
		}
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBaseUpdatable()
    {
        return $this->hasOne(BaseUpdatable::className(), ['nik' => 'nik']);
    }
}
