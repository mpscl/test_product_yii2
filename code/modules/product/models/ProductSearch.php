<?php

namespace app\modules\product\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\product\models\Product;

/**
 * ProductSearch represents the model behind the search form of `app\modules\product\models\Product`.
 */
class ProductSearch extends Product
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'type_id', 'reference_id'], 'integer'],
            [['part_number', 'display_image', 'description', 'slug'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
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
        $query = Product::find();

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
            'type_id' => $this->type_id,
            'reference_id' => $this->reference_id,
        ]);

        $query->andFilterWhere(['like', 'part_number', $this->part_number])
            ->andFilterWhere(['like', 'display_image', $this->display_image])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'slug', $this->slug])->orderBy('part_number');

        return $dataProvider;
    }
}
