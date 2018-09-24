<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel common\modules\blog\models\BlogSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Статьи';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="blog-index">


    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Blog', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php Pjax::begin([
]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'title',
           // 'text:ntext',
            ['attribute'=>'url', 'format'=>'raw'],
            ['attribute'=>'status_id','filter'=> common\modules\blog\models\Blog::STATUS_LIST,'value'=>'statusName'],
            'sort',
            'date_create:datetime',
            'date_update',

            ['attribute'=>'tags', 'value'=>'tagsAsString'],

            ['class' => 'yii\grid\ActionColumn',

                'template' => '{view} {update} {delete} {turn_on}',
                'buttons' => [
                    'update'=> function($url, $model, $key){
                     return Html::a('обновить',$url);
                    },
                    'turn_on'=> function($url, $model, $key){
                        return Html::a('<i class="fa fa-toggle-on" aria-hidden="true"></i>',$url);
                    },
                ],

                'visibleButtons' => [
                    'turn_on'=> function ($model, $key, $index) {
                    return $model->status_id === 1;
                }
                ]

            ],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>

<?php Pjax::begin([
        'enablePushState'=> false,
]); ?>
<a href="/blog/blog/tresh" class="btn btn-xss btn-primary">hello coder</a>

<?php Pjax::end(); ?></div>


