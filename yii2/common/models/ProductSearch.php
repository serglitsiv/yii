<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Product;

/**
 * ProductSearch represents the model behind the search form of `common\models\Product`.
 */
class ProductSearch extends Product
{

    public $sklad_name ;
    public $from_date ;
    public $to_date;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'cost', 'type_id','sklad_id','date','from_date','to_date'], 'integer'],
            [['title', 'text','sklad_name'], 'safe'],
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
        $query = Product::find()->joinWith('sklad');

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $dataProvider ->setSort([
            'attributes' => array_merge($dataProvider->getSort()->attributes,[
                'sklad_name' => [
                     'asc' => ['sklad.title' => SORT_ASC],
                     'desc' => ['sklad.title' => SORT_DESC],
                     'default' => SORT_ASC ,
                     'label' => 'Sklad.name' ,
                ]
            ])
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
            'cost' => $this->cost,
            'sklad_id' => $this->sklad_id,
            'type_id' => $this->type_id,

        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'text', $this->text])
            ->andFilterWhere(['like', 'sklad.title', $this->sklad_name]);

            if(!empty($this->from_date) and !empty($this->to_date))
                $query->andFilterWhere(['and', ['>', 'date', $this->from_date], ['<', 'date', $this->to_date]]);

        return $dataProvider;
    }
}
