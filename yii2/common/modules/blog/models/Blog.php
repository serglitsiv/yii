<?php

namespace common\modules\blog\models;

use common\components\behaviors\StatusBehavior;
use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;
use \yii\db\ActiveRecord;
use yii\helpers\FileHelper;
use yii\image\drivers\Image_Imagick;
use yii\web\UploadedFile;
use common\models\User;
/**
 * This is the model class for table "blog".
 *
 * @property integer $id
 * @property string $title
 * @property string $text
 * @property string $image
 * @property string $url
 * @property integer $status_id
 * @property integer $sort
 * @property integer $date_create
 * @property integer $date_update
 */

class Blog extends ActiveRecord
{

    const STATUS_LIST = ['off','on'];
    public $tags_array;
    public $file;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'blog';
    }


    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'date_create',
                'updatedAtAttribute' => 'date_update',
                'value' => new Expression('NOW()'),
            ],
            'statusBehavior'=> [
                'class' => StatusBehavior::className(),
                'statusList' => self::STATUS_LIST,
            ]

        ];
    }


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'url'], 'required'],
            [['text'], 'string'],
            [['url'], 'unique'],
            [['status_id', 'sort'], 'integer'],
            [['sort'], 'integer','max'=>99,'min'=>1 ],
            [['title', 'url'], 'string', 'max' => 100],
            [['image'], 'string', 'max' => 100],
            [['file'], 'image'],
            [['tags_array','date_create','date_update '], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Заголовок',
            'text' => 'Текст',
            'url' => 'Адрес',
            'status_id' => 'Статус',
            'sort' => 'Сортировка',
            'tags_array' => 'ФИО Автора',
            'image' => 'Картинка',
            'file' => 'Картинка',
            'tagsAsString' => 'Автора статьи',
            'author.username'=> 'Логин автора',
            'author.email'=> 'Почта автора',
            'date_update'=> 'Обновлено',
            'date_create'=> 'Создано',

        ];
    }
    public function getAuthor ()
    {
       return $this->hasOne(User::className(),['id' => 'user_id']);

    }

    public function getBlogTag ()
    {
        return $this->hasMany(BlogTag::className(),['blog_id' => 'id']);

    }

    public function getTags ()
    {
        return $this->hasMany(Tag::className(),['id' => 'tag_id'])->via('blogTag');

    }

    public function getTagsAsString()
    {
        $arr = \yii\helpers\ArrayHelper::map($this->tags, 'id','name');
        return implode(', ',  $arr);

    }

    public function afterFind()
{
    parent::afterFind();
   $this->tags_array = $this->tags;

}

    public function beforeSave($insert){

        if($file = UploadedFile::getInstance($this, 'file')){
            $dir = Yii::getAlias('@images').'/blog/';

            $this->image = strtotime('now').'_'.Yii::$app->getSecurity()->generateRandomString(6) . '.' . $file->extension;
            $file->saveAs($dir.$this->image);
            $imag = Yii::$app->image->load($dir.$this->image);
            $imag->background('#fff', 0);
            $imag->resize('50','50',Image_Imagick::INVERSE);
            $imag->crop('50','50');
            if(!file_exists($dir.'50x50/')){
                FileHelper::createDirectory($dir.'50x50/');
            }
            $imag->save($dir.'50x50/'.$this->image, 90);
            $imag = Yii::$app->image->load($dir.$this->image);
            $imag->background('#fff', 0);
            $imag->resize('800', null, Image_Imagick::INVERSE);
            if(!file_exists($dir.'800x/')){
                FileHelper::createDirectory($dir.'800x/');
            }
            $imag->save($dir.'800x/'.$this->image, 90);
        }
        return parent::beforeSave($insert);
    }



public function afterSave($insert, $changedAttributes)
{
    parent::afterSave($insert, $changedAttributes);

    $arr = \yii\helpers\ArrayHelper::map($this->tags, 'id','id');
    foreach ($this->tags_array as $one) {
        if (!in_array($one,$arr)){
            $model= new BlogTag();
            $model->blog_id = $this->id;
            $model->tag_id = $one;
            $model->save();
        }
       if (isset($arr[$one])){
           unset($arr[$one]) ;

        }
     }

    BlogTag::deleteAll(['tag_id'=>$arr, 'blog_id' => $this->id]);

   }















 }
