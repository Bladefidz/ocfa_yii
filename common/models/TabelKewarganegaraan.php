<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "tabel_kewarganegaraan".
 *
 * @property string $nik
 * @property string $tanggal_imigrasi
 * @property string $nik_pencatat
 * @property string $kewargaan
 *
 * @property Base $nik0
 */
class TabelKewarganegaraan extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tabel_kewarganegaraan';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nik', 'nik_pencatat', 'kewargaan'], 'required'],
            [['nik', 'nik_pencatat'], 'integer'],
            [['tanggal_imigrasi'], 'safe'],
            [['kewargaan'], 'string', 'max' => 100],
            [['nik'], 'exist', 'skipOnError' => true, 'targetClass' => DataManagement::className(), 'targetAttribute' => ['nik' => 'nik']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'nik' => 'NIK',
            'tanggal_imigrasi' => 'Tanggal Imigrasi',
            'nik_pencatat' => 'NIK Pencatat',
			'kewargaan' => 'Kewargaan',
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
