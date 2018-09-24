<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use vova07\imperavi\Widget;
use kartik\file\FileInput;

/* @var $this yii\web\View */
/* @var $model common\modules\blog\models\Blog */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="blog-form">

    <?php $form = ActiveForm::begin([
            'options'=>['enctype'=> 'multipart/form-data'],

        ]); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'text')->widget(Widget::className(), [
        'settings' => [
            'lang' => 'ru',
            'minHeight' => 200,
            'formatting' => ['p','blockquote', 'h2'],
            'imageUpload' => \yii\helpers\Url::to(['/site/save-redactor-img' , 'sub'=> 'blog']),
            'plugins' => [
                'clips',
                'fullscreen',
            ],
        ],
    ]);?>
    <?=  $form->field($model, 'image')->widget(FileInput::classname(), [
        'options' => ['accept' => 'image/*'],
    ]); ?>
    <?= $form->field($model, 'url')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status_id')->dropDownList(common\modules\blog\models\Blog::STATUS_LIST) ?>

    <?= $form->field($model, 'sort')->textInput() ?>

    <?= $form->field($model, 'tags_array')->widget(\kartik\select2\Select2::classname(), [
    'data' => \yii\helpers\ArrayHelper::map(common\modules\blog\models\Tag::find()->all(),'id','name'),
    'language' => 'ru',
    'options' => ['placeholder' => 'Выбрать автора блога ...', 'multiple' => true],
    'pluginOptions' => [
        'allowClear' => true,
        'tags' => true,
        'maximumInputLength' => 10
    ],
    ]); ?>


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>


