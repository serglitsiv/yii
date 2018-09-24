<?php
namespace frontend\controllers;
use Codeception\Exception\ElementNotFound;
use \common\modules\blog\models\Blog;
use Yii;
use yii\data\ActiveDataProvider;
use yii\web\Controller;


class BlogController extends Controller
{

    public function actionIndex()
    {

        $blogs = Blog::find()->with('author')->andWhere(['status_id'=>1])->orderBy('sort');
        $dataProvider = new ActiveDataProvider([
            'query' => $blogs,
            'pagination' => [
                'pageSize' => 2,
            ],
        ]);

        return $this->render('all',['dataProvider'=> $dataProvider]);
    }


    public function actionOne($url)
    {
        if($blog = Blog::find()->andWhere(['url'=>$url])->one()){
        return $this->render('one',['blog'=> $blog]);
    }
    throw new ElementNotFound('нет такого блога');

    }

}