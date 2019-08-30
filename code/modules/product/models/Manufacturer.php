<?php

namespace app\modules\product\models;

use Yii;

/**
 * This is the model class for table "manufacturer".
 *
 * @property int $id
 * @property string $manufacturer
 */
class Manufacturer extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'manufacturer';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['manufacturer'], 'required'],
            [['manufacturer'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'manufacturer' => Yii::t('app', 'Manufacturer'),
        ];
    }

    public static function getManufacturerByName($name)
    {
        $cat = Manufacturer::find()->where(['manufacturer' => $name])->one();
        if (!$cat) {
            $cat = new Manufacturer();
            $cat->manufacturer = $name;
            $cat->save(false);
        }
        return $cat;
    }
}
