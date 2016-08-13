<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\SaleProSignages;

/**
 * SaleProSignagesSearch represents the model behind the search form about `app\models\SaleProSignages`.
 */
class SaleProSignagesSearch extends SaleProSignages
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'col_type_id', 'pro_id', 'shop_id'], 'integer'],
            [['job_order', 'height', 'width', 'nos', 'design', 'install_date', 'removal_date', 'status'], 'safe'],
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
        $query = SaleProSignages::find();

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
            'col_type_id' => $this->col_type_id,
            'pro_id' => $this->pro_id,
            'shop_id' => $this->shop_id,
            'install_date' => $this->install_date,
            'removal_date' => $this->removal_date,
        ]);

        $query->andFilterWhere(['like', 'job_order', $this->job_order])
            ->andFilterWhere(['like', 'height', $this->height])
            ->andFilterWhere(['like', 'width', $this->width])
            ->andFilterWhere(['like', 'nos', $this->nos])
            ->andFilterWhere(['like', 'design', $this->design])
            ->andFilterWhere(['like', 'status', $this->status]);

        return $dataProvider;
    }
}
