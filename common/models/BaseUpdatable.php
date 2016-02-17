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
            [['nik', 'agama', 'status_perkawinan', 'pekerjaan', 'pendidikan_terakhir'], 'required'],
            [['nik', 'no_kk', 'status_keluarga', 'ayah', 'ibu', 'agama', 'status_perkawinan', 'pendidikan_terakhir'], 'integer'],
            [['no_kk', 'status_keluarga', 'ayah', 'ibu'], 'default', 'value' => 0],
            [['foto'], 'string'],
            [['pekerjaan'], 'string', 'max' => 32],
            [['nik'], 'exist', 'skipOnError' => true, 'targetClass' => DataManagement::className(), 'targetAttribute' => ['nik' => 'nik']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'nik' => 'Nik *',
            'no_kk' => 'No Kk',
            'status_keluarga' => 'Status Keluarga',
            'ayah' => 'Ayah',
            'ibu' => 'Ibu',
            'foto' => 'Foto',
            'agama' => 'Agama *',
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
        return $this->hasOne(Base::className(), ['nik' => 'nik']);
    }
}
