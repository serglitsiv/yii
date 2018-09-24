<?php
namespace common\models;

class KartikMenu extends \kartik\tree\models\Tree
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tree';
    }

    public static function getTypeList()
    {
        return [
            'Одежда',
            'Обувь',
            'Товары для спорта',
            'Товары для дома',
        ];
    }
// also change attributes name it's possible in yii2-tree-man/models/TreeTrait.php
    public function attributeLabels()
    {
        $attr = parent::attributeLabels();
        $attr['content_type']= 'Тип товара';
        $attr['name']= 'Названия товара';
        $attr['active']= 'Активный';
        $attr['disabled']= 'Выключенный';
        return $attr;
    }


}


