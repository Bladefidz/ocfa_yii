<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "tabel_domisili".
 *
 * @property integer $id
 * @property string $nik
 * @property string $kelurahan
 * @property string $alamat
 * @property integer $rt
 * @property integer $rw
 * @property string $tanggal_catat
 * @property string $nik_pencatat
 * @property integer $current
 *
 * @property Base $nik0
 */
class TabelDomisili extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tabel_domisili';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nik', 'kelurahan', 'alamat', 'rt', 'rw', 'nik_pencatat', 'current'], 'required'],
            [['nik', 'rt', 'rw', 'nik_pencatat', 'current'], 'integer'],
            [['tanggal_catat'], 'safe'],
            [['kelurahan'], 'string', 'max' => 10],
            [['alamat'], 'string', 'max' => 255],
            [['nik'], 'exist', 'skipOnError' => true, 'targetClass' => DataManagement::className(), 'targetAttribute' => ['nik' => 'nik']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
			'id' => 'ID',
            'nik' => 'NIK',
            'kelurahan' => 'Kelurahan',
            'alamat' => 'Alamat',
            'rt' => 'Rt',
            'rw' => 'Rw',
            'tanggal_catat' => 'Tanggal Catat',
            'nik_pencatat' => 'NIK Pencatat',
            'current' => 'Current',
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
