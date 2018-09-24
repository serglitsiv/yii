<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model common\models\ProductSearchs */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="products-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'title') ?>

    <?= $form->field($model, 'shop_id')->dropDownList(ArrayHelper::map(\common\models\Shop::find()->all(),
        'id','title'),['prompt' => 'Выбирете магазин']) ?>

    <?= $form->field($model, 'color') ?>

    <?= $form->field($model, 'min_price') ?>
    <?= $form->field($model, 'max_price') ?>
    <?= $form->field($model, 'size') ?>
    <?= $form->field($model, 'address') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
