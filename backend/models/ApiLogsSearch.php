<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\ApiLogs;

/**
 * ApiLogsSearch represents the model behind the search form about `common\models\ApiLogs`.
 */
class ApiLogsSearch extends ApiLogs
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'nik'], 'integer'],
            [['ip', 'uri_access', 'timestamp', 'method'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     * @param string $nik
     *
     * @return ActiveDataProvider
     */
    public function search($params, $nik=null)
    {
        if (!empty($nik)){
            $query = ApiLogs::find()->where(['nik' => $nik]);
        } else {
            $query = ApiLogs::find();
        }

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'nik' => $this->nik,
            'timestamp' => $this->timestamp,
        ]);

        $query->andFilterWhere(['like', 'ip', $this->ip])
            ->andFilterWhere(['like', 'uri_access', $this->uri_access])
            ->andFilterWhere(['like', 'method', $this->method]);

        return $dataProvider;
    }
}
