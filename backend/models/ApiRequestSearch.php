<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\ApiLogs;

/**
 * ApiRequestSearch represents the model behind the search form about `common\models\ApiLogs`.
 */
class ApiRequestSearch extends ApiLogs
{
	//public $count;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['count'], 'integer'],
            [['uri_access'], 'safe'],
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
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = ApiLogs::find()->select('uri_access, count(*) as count')->where('nik = '.Yii::$app->user->id)->groupBy('uri_access')->orderBy('count desc');

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
            'count' => $this->count,
        ]);

        $query->andFilterWhere(['like', 'uri_access', $this->uri_access]);

        return $dataProvider;
    }
}
