<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel common\models\ProductSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Products';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-index">


    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Product', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'id',
            ['attribute' =>'sklad_id', 'value' =>'skladName', 'filter'=>\common\models\Sklad::getList()],
            ['attribute' =>'sklad_name', 'value' =>'skladName'],
            'title',
            'cost',
            ['attribute' =>'date', 'format'=>'date' , 'value' =>'date', 'filter'=>\kartik\field\FieldRange::widget([
                    'type' => \kartik\field\FieldRange::INPUT_WIDGET,
                    'model' => $searchModel,
                    'attribute1' => 'from_date',
                    'attribute2' => 'to_date',
                'widgetClass' => \kartik\datecontrol\DateControl::className(),
                'widgetOptions1' => [
                    'saveFormat' => 'php:U'
                ],
                'widgetOptions2' => [
                    'saveFormat' => 'php:U'
                ],

                ])],
            ['attribute' =>'type_id', 'value' =>'typeName','filter'=>\common\models\Product::getTypeList()],
            //'text:ntext',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
    <div class="modal modal-info " id="modal-info" style="display: none; padding-right: 17px;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span></button>
                    <h4 class="modal-title">Info Modal</h4>
                </div>
                <div class="modal-body">
                    <p>Сервис экспресс-доставки- "Новая почта" </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-outline">Save changes</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

<?php $this->registerJs("
$('.grid-view tbody tr ').on('click', function(){
var data = $(this).data();
     $('#modal-info'). modal('show');
     $('#modal-info'). find('.modal-title').text('id-заказа:'+ data.key);
     $('#modal-info'). find('.modal-body').load('/product/update?id='+ data.key);
});
");
