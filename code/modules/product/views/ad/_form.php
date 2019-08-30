<?php

use app\modules\product\models\AdType;
use app\modules\product\models\Category;
use app\modules\product\models\Manufacturer;
use app\modules\product\models\Product;
use app\modules\product\models\Type;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\product\models\Ad */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ad-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]);?>

    <?= $form->field($model, 'part_number')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'type_id')->widget(Select2::classname(), [
        'data' => ArrayHelper::map(AdType::find()->all(), 'id', 'type'),
        'options' => ['placeholder' => 'Select a type ...'],
        'pluginOptions' => [
            'allowClear' => true
        ]]);
    ?>

    <?= $form->field($model, 'category_ids')->widget(Select2::className(), [
        'model' => $model,
        'attribute' => 'category_ids',
        'data' => ArrayHelper::map(Category::find()->all(), 'category', 'category'),
        'options' => [
            'multiple' => true,
        ],
        'pluginOptions' => [
            'tags' => true,
        ],
    ]); ?>

    <?= $form->field($model, 'manufacturer_ids')->widget(Select2::className(), [
        'model' => $model,
        'attribute' => 'manufacturer_ids',
        'data' => ArrayHelper::map(Manufacturer::find()->all(), 'manufacturer', 'manufacturer'),
        'options' => [
            'multiple' => true,
        ],
        'pluginOptions' => [
            'tags' => true,
        ],
    ]); ?>

    <?= $form->field($model, 'product_ids')->widget(Select2::className(), [
        'model' => $model,
        'attribute' => 'product_ids',
        'data' => ArrayHelper::map(Product::find()->all(), 'id', 'part_number'),
        'options' => [
            'multiple' => true,
        ],
        'pluginOptions' => [
            'tags' => true,
        ],
    ]); ?>

    <?= $form->field($model, 'display_image')->fileInput() ?>

    <?= $form->field($model, 'quantity')->textInput() ?>

    <?= $form->field($model, 'seller')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'condition')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'price')->textInput() ?>

    <?= $form->field($model, 'slug')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
