<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\UserActivity;

/**
 * UserActivitySearch represents the model behind the search form about `common\models\UserActivity`.
 */
class UserActivitySearch extends UserActivity
{
	
	public $dari;
	public $sampai;
	public $nama;
	
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'nik'], 'integer'],
			[['dari', 'sampai', 'nama'], 'string'],
            [['action', 'timestamp'], 'safe'],
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
        $query = UserActivity::find()->orderBy('timestamp desc');

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
			'pagination' => [
				'pageSize' => 10,
			]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }
		
		$dataProvider->query->joinWith([
			'nik0' => function($q){
				$q->from('base');
			}
		]);

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            //'nik' => $this->nik,
            'timestamp' => $this->timestamp,
        ]);

		$query->andFilterWhere(['like', 'action', $this->action]);
        $query->andFilterWhere(['like', 'user_activity.nik', $this->nik]);
		$query->andFilterWhere(['like', 'base.nama', $this->nama]);

        return $dataProvider;
    }
}
