<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "products".
 *
 * @property int $id
 * @property string $title
 * @property int $shop_id
 * @property string $color
 * @property int $price
 * @property int $size
 */
class Products extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'products';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'shop_id'], 'required'],
            [['shop_id', 'price', 'size'], 'integer'],
            [['title'], 'string', 'max' => 255],
            [['color'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'shop_id' => 'Shop ID',
            'color' => 'Color',
            'price' => 'Price',
            'size' => 'Size',
        ];
    }

    public function getShops(){
        return $this->hasOne(Shop::className(),['id'=>'shop_id']);
    }




}
