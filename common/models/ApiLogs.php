<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "api_logs".
 *
 * @property integer $id
 * @property string $ip
 * @property string $nik
 * @property string $uri_access
 * @property string $timestamp
 * @property string $method
 *
 * @property Base $nik0
 */
class ApiLogs extends \yii\db\ActiveRecord
{
	public $count;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'api_logs';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ip', 'nik', 'uri_access', 'method'], 'required'],
            [['nik','count'], 'integer'],
            [['timestamp'], 'safe'],
            [['ip'], 'string', 'max' => 45],
            [['uri_access'], 'string', 'max' => 512],
            [['method'], 'string', 'max' => 10],
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
            'ip' => 'Ip',
            'nik' => 'Nik',
            'uri_access' => 'Uri Access',
            'timestamp' => 'Timestamp',
            'method' => 'Method',
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
