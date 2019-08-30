<?php

namespace app\modules\product\models;

use cornernote\linkall\LinkAllBehavior;
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

    public $category_ids;
    public $manufacturer_ids;
    public $product_ids;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['part_number', 'type_id', 'slug','category_ids','manufacturer_ids','product_ids'], 'required'],
            [['type_id', 'quantity', 'price'], 'integer'],
            [['display_image'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg'],
            [['part_number', 'seller', 'condition', 'slug'], 'string', 'max' => 255],
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

    public function behaviors()
    {
        return [
            LinkAllBehavior::className(),
        ];
    }

    public function afterSave($insert, $changedAttributes)
    {
        $cats = [];
        foreach ($this->category_ids as $category_name) {
            $cat = Category::getCategoryByName($category_name);
            if ($cat) {
                $cats[] = $cat;
            }
        }
        $this->linkAll('categories', $cats);

        $cats = [];
        foreach ($this->manufacturer_ids as $manufacturer_name) {
            $cat = Manufacturer::getManufacturerByName($manufacturer_name);
            if ($cat) {
                $cats[] = $cat;
            }
        }
        $this->linkAll('manufacturers', $cats);

        $cats = [];
        foreach ($this->product_ids as $product) {
            $cat = Product::getProductById($product);
            if ($cat) {
                $cats[] = $cat;
            }
        }
        $this->linkAll('products', $cats);

        parent::afterSave($insert, $changedAttributes);
    }

    public function upload()
    {
        if ($this->validate()) {
            $this->display_image->saveAs('/home/vagrant/code/web/ad/' . $this->display_image->baseName . '.' . $this->display_image->extension);
            return true;
        } else {
            return false;
        }
    }

    public function getType()
    {
        return $this->hasOne(AdType::className(), ['id' => 'type_id']);
    }

    public function getCategories()
    {
        return $this->hasMany(Category::className(), ['id' => 'category_id'])
            ->viaTable('ad_to_category', ['ad_id' => 'id']);
    }

    public function getProducts()
    {
        return $this->hasMany(Product::className(), ['id' => 'product_id'])
            ->viaTable('product_to_ad', ['ad_id' => 'id']);
    }

    public function getManufacturers()
    {
        return $this->hasMany(Manufacturer::className(), ['id' => 'manufacturer_id'])
            ->viaTable('ad_to_manufacturer', ['ad_id' => 'id']);
    }
}
