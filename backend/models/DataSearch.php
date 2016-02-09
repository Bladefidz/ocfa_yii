<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\DataManagement;

/**
 * DataSearch represents the model behind the search form about `common\models\DataManagement`.
 */
class DataSearch extends DataManagement
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
		/*$tabelMeninggal = TabelKematian::find()->asArray->all();
		$meninggal = "";
		foreach($tabelMeninggal as $satuan){
			$meninggal = $meninggal.",".$satuan['nik'];
		}*/
		
		$query = DataManagement::find()->joinWith(['tabelKematian','tabelKewarganegaraan'])->where('tabel_kematian.tanggal_kematian is null and tabel_kewarganegaraan.tanggal_imigrasi is null');

        // add conditions that should always apply here
		$cache = Yii::$app->cache;   
		$totalCount = $cache->get('countData');
		if ($totalCount === false) {
			$dependency = new \yii\caching\DbDependency(['sql' => 'SELECT MAX(nik) FROM base']);
			$cache->set('countData', $query->count(), 0, $dependency);
			$totalCount = $cache->get('countData');
		}

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
			'totalCount' => (int)$totalCount,
			'pagination' => ['pageSize' => 20],
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
