<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "keluarga".
 *
 * @property string $id
 * @property string $kepala_keluarga
 * @property integer $jml_anak
 * @property integer $jml_anggota
 * @property string $tanggal_terbit
 * @property string $tanggal_pembaruan
 * @property integer $status
 *
 * @property Base $kepalaKeluarga
 */
class Keluarga extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'keluarga';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'kepala_keluarga', 'jml_anggota', 'tanggal_terbit', 'tanggal_pembaruan', 'status'], 'required'],
            [['id', 'kepala_keluarga', 'jml_anak', 'jml_anggota', 'status'], 'integer'],
            [['tanggal_terbit', 'tanggal_pembaruan'], 'safe'],
            [['kepala_keluarga'], 'exist', 'skipOnError' => true, 'targetClass' => DataManagement::className(), 'targetAttribute' => ['kepala_keluarga' => 'nik']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'kepala_keluarga' => 'Kepala Keluarga',
            'jml_anak' => 'Jumlah Anak',
            'jml_anggota' => 'Jumlah Anggota',
            'tanggal_terbit' => 'Tanggal Terbit',
            'tanggal_pembaruan' => 'Tanggal Pembaruan',
            'status' => 'Status',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getKepalaKeluarga()
    {
        return $this->hasOne(DataManagement::className(), ['nik' => 'kepala_keluarga']);
    }
}
