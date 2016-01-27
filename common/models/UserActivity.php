<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "user_activity".
 *
 * @property integer $id
 * @property string $nik
 * @property string $action
 * @property string $timestamp
 *
 * @property Base $nik0
 */
class UserActivity extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user_activity';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nik', 'action'], 'required'],
            [['nik'], 'integer'],
            [['timestamp'], 'safe'],
            [['action'], 'string', 'max' => 50],
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
            'nik' => 'Nik',
            'action' => 'Action',
            'timestamp' => 'Timestamp',
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
