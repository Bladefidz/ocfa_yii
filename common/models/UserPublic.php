<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "user_public".
 *
 * @property string $nik
 * @property string $nama_aplikasi
 * @property string $nama_instansi
 * @property string $email_instansi
 * @property string $no_telp_instansi
 * @property string $alamat_instansi
 *
 * @property User $nik0
 */
class UserPublic extends \yii\db\ActiveRecord
{
    /** 
     * @inheritdoc 
     */ 
    public static function tableName() 
    { 
        return 'user_public'; 
    } 

    /** 
     * @inheritdoc 
     */ 
    public function rules() 
    { 
        return [
            [['nik', 'nama_aplikasi', 'nama_instansi', 'email_instansi', 'no_telp_instansi', 'alamat_instansi'], 'required'],
            [['nik'], 'integer'],
            [['nama_aplikasi', 'alamat_instansi'], 'string', 'max' => 128],
            [['nama_instansi', 'email_instansi'], 'string', 'max' => 64],
            [['no_telp_instansi'], 'string', 'max' => 18],
            [['nik'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['nik' => 'id']],
        ]; 
    } 

    /** 
     * @inheritdoc 
     */ 
    public function attributeLabels() 
    { 
        return [ 
            'nik' => 'Nik',
            'nama_aplikasi' => 'Nama Aplikasi',
            'nama_instansi' => 'Nama Instansi',
            'email_instansi' => 'Email Instansi',
            'no_telp_instansi' => 'No Telp Instansi',
            'alamat_instansi' => 'Alamat Instansi',
        ]; 
    } 

    /** 
     * @return \yii\db\ActiveQuery 
     */ 
    public function getNik0() 
    { 
        return $this->hasOne(User::className(), ['id' => 'nik']);
    } 
} 