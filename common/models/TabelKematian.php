<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "tabel_kematian".
 *
 * @property string $nik
 * @property string $tanggal_kematian
 * @property string $nik_pencatat
 *
 * @property Base $nik0
 */
class TabelKematian extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tabel_kematian';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nik', 'tanggal_kematian', 'nik_pencatat'], 'required'],
            [['nik', 'nik_pencatat'], 'integer'],
            [['tanggal_kematian'], 'safe'],
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
            'tanggal_kematian' => 'Tanggal Kematian',
            'nik_pencatat' => 'Nik Pencatat',
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
