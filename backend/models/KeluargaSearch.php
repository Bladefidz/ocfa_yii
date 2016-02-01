<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Keluarga;

/**
 * KeluargaSearch represents the model behind the search form about `common\models\Keluarga`.
 */
class KeluargaSearch extends Keluarga
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'kepala_keluarga', 'jml_anak', 'jml_anggota', 'status'], 'integer'],
            [['tanggal_terbit', 'tanggal_pembaruan'], 'safe'],
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
        $query = Keluarga::find();

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
            'kepala_keluarga' => $this->kepala_keluarga,
            'jml_anak' => $this->jml_anak,
            'jml_anggota' => $this->jml_anggota,
            'tanggal_terbit' => $this->tanggal_terbit,
            'tanggal_pembaruan' => $this->tanggal_pembaruan,
            'status' => $this->status,
        ]);

        return $dataProvider;
    }
}
