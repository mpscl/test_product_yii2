<?php

namespace app\modules\product\models;

use Yii;

/**
 * This is the model class for table "ad".
 *
 * @property int $id
 * @property string $part_number
 * @property int $type_id
 * @property string $display_image
 * @property int $quantity
 * @property string $seller
 * @property string $condition
 * @property int $price
 * @property string $slug
 */
class ad extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ad';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['part_number', 'type_id', 'slug'], 'required'],
            [['type_id', 'quantity', 'price'], 'integer'],
            [['part_number', 'display_image', 'seller', 'condition', 'slug'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'part_number' => Yii::t('app', 'Part Number'),
            'type_id' => Yii::t('app', 'Type ID'),
            'display_image' => Yii::t('app', 'Display Image'),
            'quantity' => Yii::t('app', 'Quantity'),
            'seller' => Yii::t('app', 'Seller'),
            'condition' => Yii::t('app', 'Condition'),
            'price' => Yii::t('app', 'Price'),
            'slug' => Yii::t('app', 'Slug'),
        ];
    }
}
