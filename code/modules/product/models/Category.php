<?php

namespace app\modules\product\models;

use Yii;

/**
 * This is the model class for table "category".
 *
 * @property int $id
 * @property string $category
 *
 * @property ProductToCategory[] $productToCategories
 * @property Product[] $products
 */
class Category extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'category';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['category'], 'required'],
            [['category'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'category' => Yii::t('app', 'Category'),
        ];
    }

    public static function getCategoryByName($name)
    {
        $cat = Category::find()->where(['category' => $name])->one();
        if (!$cat) {
            $cat = new Category();
            $cat->category = $name;
            $cat->save(false);
        }
        return $cat;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductToCategories()
    {
        return $this->hasMany(ProductToCategory::className(), ['category_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProducts()
    {
        return $this->hasMany(Product::className(), ['id' => 'product_id'])->viaTable('product_to_category', ['category_id' => 'id']);
    }
}
