<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Menus */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="menus-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title',['options'=>['class'=>'col-xs-12']] )->textInput() ?>

    <?= $form->field($model, 'url')->textInput(['maxlength' => true]) ?>


    <?= $form->field($model, 'parent_id',['options'=>['class'=>'col-xs-12']])->dropDownList(
            $model::getDropDown(),['prompt'=>'добавить новое меню']
    ) ?>

    <?= $form->field($model, 'sort')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Добавить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
