<?php

namespace common\models;
use paulzi\adjacencyList\AdjacencyListBehavior;
use Yii;
use yii\base\ErrorException;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "menus".
 *
 * @property int $id
 * @property string $title
 * @property string $url
 * @property int $parent_id
 * @property int $sort
 */
class Menus extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'menus';
    }

    public function behaviors() {
        return [
            [
                'class' => AdjacencyListBehavior::className(),
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['parent_id', 'sort'], 'integer'],
            [['title'], 'string', 'max' => 100],
            [['url'], 'string', 'max' => 255],
            [['sort'], 'number'],
            [['url'], 'match', 'pattern' => '/^[a-z0-9_-]+$/', 'message'=> 'Недопустимые символ в url'],
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
            'url' => 'Url',
            'parent_id' => 'Parent ID',
            'sort' => 'Sort',
        ];
    }

   public static function getRootsList()
   {
      return self::find()->roots()->with('children.children.children')->all();
   }

    public static function find()
    {
        return new MenuQuerys(get_called_class());
    }

    public function getTree()
    {
      return ArrayHelper::toArray($this->children,[
          $this->className()=>[
              'label'=>'title',
              'url'=>'url',
              'items'=>function($model) {
                  return ArrayHelper::toArray($model->children, [
                      $this->className() => [
                          'label' => 'title',
                          'url' => 'url',
                          'items' => function ($one) {
                              return ArrayHelper::toArray($one->children, [
                                  $this->className() => [
                                      'label' => 'title',
                                      'url' => 'url',
                                  ]
                              ]);
                          }
                      ]
                  ]);
              }
              ]
          ]);
       }


    public static function getDropDown()
    {
        $list = [];
        $separator = '>';
        foreach (self::getRootsList() as $root) {
            $list[$root->id] = $root->title;
            if ($root->children) {
                foreach ($root->children as $one) {
                    $list[$one->id] = $separator.$one->title;
                    if (isset($one->children)) {
                        foreach ($one->children as $two) {
                            $list[$two->id] = $separator.$separator.$two->title;
                            if (isset($one->children)) {
                                foreach ($two->children as $three) {
                                    $list[$three->id] = $separator.$separator.$separator. $three->title;
                                }
                            }
                        }
                    }
                }
            }
        }
        return $list;
    }



    public function beforeSave($insert)
    {
       if (empty($this->parent_id)){
           $this->makeRoot();
       }else{
           if ($parent = Menus::findOne($this->parent_id) ){
               $this->prependTo($parent);
           }
         }

         if (parent::beforeSave($insert)){
            return true;
         }else{
           return false ;
         }
    }

}
