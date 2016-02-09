<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\DataManagement;
use common\models\TabelKematian;
use common\models\TabelKewarganegaraan;

/**
 * ArsipSearch represents the model behind the search form about `common\models\DataManagement`.
 */
class ArsipSearch extends DataManagement
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nik', 'jenis_kelamin', 'nik_pencatat'], 'integer'],
            [['nama', 'tempat_lahir', 'tanggal_lahir', 'golongan_darah', 'tanggal_diterbitkan'], 'safe'],
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
        $query = DataManagement::find()->joinWith(['tabelKematian','tabelKewarganegaraan'])->where('tanggal_imigrasi is not null or tanggal_kematian is not null');

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
            'nik' => $this->nik,
            'tanggal_lahir' => $this->tanggal_lahir,
            'jenis_kelamin' => $this->jenis_kelamin,
            'tanggal_diterbitkan' => $this->tanggal_diterbitkan,
            'nik_pencatat' => $this->nik_pencatat,
        ]);

        $query->andFilterWhere(['like', 'nama', $this->nama])
            ->andFilterWhere(['like', 'tempat_lahir', $this->tempat_lahir])
            ->andFilterWhere(['like', 'golongan_darah', $this->golongan_darah]);

        return $dataProvider;
    }
}
