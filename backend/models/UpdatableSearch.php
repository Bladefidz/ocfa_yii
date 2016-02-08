<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\BaseUpdatable;

/**
 * DataSearch represents the model behind the search form about `common\models\BaseUpdatable`.
 */
class UpdatableSearch extends BaseUpdatable
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nik', 'no_kk', 'status_keluarga', 'ayah', 'ibu', 'agama', 'provinsi', 'kabupaten', 'kecamatan', 'kelurahan', 'rt', 'rw', 'status_perkawinan', 'pendidikan_terakhir', 'kewarganegaraan', 'arsip'], 'integer'],
            [['foto', 'alamat', 'pekerjaan', 'ket'], 'safe'],
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
        $query = BaseUpdatable::find();

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
            'no_kk' => $this->no_kk,
            'status_keluarga' => $this->status_keluarga,
            'ayah' => $this->ayah,
            'ibu' => $this->ibu,
            'agama' => $this->agama,
            'provinsi' => $this->provinsi,
            'kabupaten' => $this->kabupaten,
            'kecamatan' => $this->kecamatan,
            'kelurahan' => $this->kelurahan,
            'rt' => $this->rt,
            'rw' => $this->rw,
            'status_perkawinan' => $this->status_perkawinan,
            'pendidikan_terakhir' => $this->pendidikan_terakhir,
            'kewarganegaraan' => $this->kewarganegaraan,
            'arsip' => $this->arsip
        ]);

        $query->andFilterWhere(['like', 'foto', $this->foto])
            ->andFilterWhere(['like', 'alamat', $this->alamat])
            ->andFilterWhere(['like', 'pekerjaan', $this->pekerjaan])
            ->andFilterWhere(['like', 'ket', $this->ket]);

        return $dataProvider;
    }
	
	/**
	 * Get Data
	 * @param string $nik
	 * @return BaseUpdatable
	 */
	 public function getData($nik){
		 return BaseUpdatable::findOne($nik);
	 }
}
