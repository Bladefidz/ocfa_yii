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
            [['nik', 'nama', 'tempat_lahir', 'tanggal_lahir', 'jenis_kelamin', 'golongan_darah', 'nik_pencatat'], 'required'],
            ['tanggal_diterbitkan', 'default', 'value' => date('Y-m-d')],
            [['nik', 'jenis_kelamin', 'nik_pencatat'], 'integer'],
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
            'nik_pencatat' => 'Nik Pencatat',
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
    public function getTabelDomisilis()
    {
        return $this->hasMany(TabelDomisili::className(), ['nik' => 'nik']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTabelKematian()
    {
        return $this->hasOne(TabelKematian::className(), ['nik' => 'nik']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTabelKewarganegaraan()
    {
        return $this->hasOne(TabelKewarganegaraan::className(), ['nik' => 'nik']);
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
