<?php

namespace app\modules\product\models;
use cornernote\linkall\LinkAllBehavior;
use Yii;

/**
 * This is the model class for table "product".
 *
 * @property int $id
 * @property string $part_number
 * @property int $type_id
 * @property string $display_image
 * @property int $reference_id
 * @property string $description
 * @property string $slug
 */
class Product extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'product';
    }

    public $category_ids;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['part_number', 'type_id', 'reference_id', 'slug', 'category_ids'], 'required'],
            [['display_image'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg'],
            [['type_id', 'reference_id'], 'integer'],
            [['part_number', 'description', 'slug'], 'string', 'max' => 255],
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
        parent::afterSave($insert, $changedAttributes);
    }

    public function upload()
    {
        if ($this->validate()) {
            $this->imageFile->saveAs('uploads/' . $this->imageFile->baseName . '.' . $this->imageFile->extension);
            return true;
        } else {
            return false;
        }
    }

    public function getCategories()
    {
        return $this->hasMany(Category::className(), ['id' => 'category_id'])
            //->via('postToTag');
            ->viaTable('product_to_category', ['product_id' => 'id']);
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
            'reference_id' => Yii::t('app', 'Reference ID'),
            'description' => Yii::t('app', 'Description'),
            'slug' => Yii::t('app', 'Slug'),
        ];
    }
}
