<?php

use kartik\grid\GridView;
//use kartik\icons\Icon;
use yii\helpers\Html;

use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\modules\product\models\ProductSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

//$this->title = 'Products';
$this->params['breadcrumbs'][] = 'Products';
?>
<div class="product-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?=     GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'resizableColumns' => false,
        'condensed' => true,
        'floatHeader' => false,
        'pjax' => true,
        'pjaxSettings' => [
            'options' => [
                'timeout' => false,
                'enablePushState' => false,
                'clientOptions' => [
                    'method' => 'GET'
                ]
            ]
        ],
        'toolbar' => [
            [
                'content' => Html::a('Create Product', ['create'], ['class' => 'btn btn-success', 'data' => [
                            'pjax' => 0,
                            'tooltip' => true,
                        ]]
                    ) . ' ' . Html::a('Clean', ['index'], [
                        'class' => 'btn btn-default',
                        'title' => 'Resetear grid'
                    ]),
            ],
//            '{export}',

            '{toggleData}',
        ],
        'panel' => [
            'heading' => 'Products',
            'type' => GridView::TYPE_PRIMARY,
        ],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'part_number',
            'type_id',
            'display_image',
            'reference_id',
            //'description',
            //'slug',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
