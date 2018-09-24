<?php

use yii\helpers\Html;
use yii\widgets\ListView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel common\models\ProductSearchs */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Products';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="products-index">
    <div class="row">
        <div class="col-xs-4">
            <?php echo $this->render('_search', ['model' => $searchModel]); ?>
        </div>
        <div class="col-xs-8">
            <?php Pjax::begin(); ?>
            <?= $dataProvider->sort->link('size') ?>
            <?= $dataProvider->sort->link('price') ?>

            <?= ListView::widget([
                'dataProvider' => $dataProvider,
                'itemOptions' => ['class' => 'item'],
                'itemView' => function ($model, $key, $index, $widget) {
                    return Html::a(Html::encode($model->title), ['view', 'id' => $model->id]);
                },
            ]) ?>
            <?php Pjax::end(); ?>
        </div>
    </div>
</div>
