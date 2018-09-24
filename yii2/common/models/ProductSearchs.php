<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Products;

/**
 * ProductSearchs represents the model behind the search form of `common\models\Products`.
 */
class ProductSearchs extends Products
{
      public  $min_price;
      public  $max_price;
      public  $address;




    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'shop_id', 'price', 'size','min_price','max_price'], 'integer'],
            [['title', 'color','address'], 'safe'],
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
        $query = Products::find()->joinWith('shops');

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $dataProvider->sort->attributes['address'] = [
             'asc' => ['shop.address'=> SORT_ASC],
             'desc' =>['shop.address'=> SORT_DESC],
        ];
        $dataProvider->sort->defaultOrder['address']= SORT_ASC;
            $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'shop_id' => $this->shop_id,
            'size' => $this->size,
            'color' => $this->color,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'shop.address', $this->address])
            ->andFilterWhere(['and',
                ['>=','price' , $this->min_price],
                ['<=','price' , $this->max_price]
            ]);

        return $dataProvider;
    }
}
