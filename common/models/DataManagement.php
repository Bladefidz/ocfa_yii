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
 *
 * @property ApiLogs[] $apiLogs
 * @property BaseUpdatable $baseUpdatable
 * @property UserActivity[] $userActivities
 */
class DataManagement extends \yii\db\ActiveRecord
{
	public $jml;
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
            [['nik', 'nama', 'tempat_lahir', 'tanggal_lahir', 'jenis_kelamin', 'golongan_darah', 'tanggal_diterbitkan', 'nip_pencatat'], 'required'],
            [['nik', 'jenis_kelamin', 'nip_pencatat'], 'integer'],
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
            'nik' => 'Nik',
            'nama' => 'Nama',
            'tempat_lahir' => 'Tempat Lahir',
            'tanggal_lahir' => 'Tanggal Lahir',
            'jenis_kelamin' => 'Jenis Kelamin',
            'golongan_darah' => 'Golongan Darah',
            'tanggal_diterbitkan' => 'Tanggal Diterbitkan',
            'nip_pencatat' => 'Nip Pencatat',
        ]; 
    }
	
	/**
     * getJenisKelamin
	 * @param string $jenis_kelamin
	 * @return string
     */
    public static function getJenisKelamin($jenis_kelamin)
    {
        if($jenis_kelamin == "1"){
			return 'Laki-laki';
		}else{
			return 'Perempuan';
		}
    }
	
	/**
     * @return \yii\db\ActiveQuery
     */
    public function getApiLogs()
    {
        return $this->hasMany(ApiLogs::className(), ['nik' => 'nik']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBaseUpdatable()
    {
        return $this->hasOne(BaseUpdatable::className(), ['nik' => 'nik']);
    }
	
	/**
     * @return \yii\db\ActiveQuery
     */
    public function getUserActivities()
    {
        return $this->hasMany(UserActivity::className(), ['nik' => 'nik']);
    }
	
	/**
     * @return \yii\db\ActiveQuery
     */
    public function getKeluargas()
    {
        return $this->hasMany(Keluarga::className(), ['kepala_keluarga' => 'nik']);
    }
}
