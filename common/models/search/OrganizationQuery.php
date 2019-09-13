<?php

namespace common\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Organization;

/**
 * OrganizationQuery represents the model behind the search form of `common\models\Organization`.
 */
class OrganizationQuery extends Organization
{

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'user_id', 'region_id'], 'integer'],
            [['rating', 'photo', 'gps', 'name_uz', 'name_en', 'name_ru', 'description_uz', 'description_en', 'description_ru', 'catalog'], 'safe'],
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
        $query = Organization::find()->with('region');

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
        $catalog_filter = [];
        if (!empty($this->catalog)){
            $catalog_filter = ['in', 'id',explode(',', $this->catalog)];
        }
        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'user_id' => $this->user_id,
            'region_id' => $this->region_id,
        ]);


        $query->andFilterWhere(['like', 'rating', $this->rating])
            ->andFilterWhere(['like', 'photo', $this->photo])
            ->andFilterWhere(['like', 'gps', $this->gps])
            ->andFilterWhere(['like', 'name_uz', $this->name_uz])
            ->andFilterWhere(['like', 'name_en', $this->name_en])
            ->andFilterWhere(['like', 'name_ru', $this->name_ru])
            ->andFilterWhere(['like', 'description_uz', $this->description_uz])
            ->andFilterWhere(['like', 'description_en', $this->description_en])
            ->andFilterWhere(['like', 'description_en', $this->description_en])
            ->andFilterWhere($catalog_filter);

        return $dataProvider;
    }
}