<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "sklad".
 *
 * @property int $id
 * @property string $title
 * @property string $address
 */
class Sklad extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sklad';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['address'], 'required'],
            [['title', 'address'], 'string', 'max' => 255],
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
            'address' => 'Address',
        ];
    }

    public static function getList()
    {
         return \yii\helpers\ArrayHelper::map(self::find()->all(),'id','title');
    }



}
