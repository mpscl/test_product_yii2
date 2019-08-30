<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "building".
 *
 * @property int $id
 * @property int $floor
 * @property string $name
 *
 * @property MovementLog[] $movementLogs
 * @property MovementLog[] $movementLogs0
 * @property MovementLog[] $movementLogs1
 */
class Building extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'building';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['floor', 'name'], 'required'],
            [['floor'], 'integer'],
            [['name'], 'string', 'max' => 255],
            [['floor'], 'unique'],
            [['floor', 'name'], 'unique', 'targetAttribute' => ['floor', 'name']],
            [['name'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'floor' => Yii::t('app', 'Floor'),
            'name' => Yii::t('app', 'Name'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMovementLogs()
    {
        return $this->hasMany(MovementLog::className(), ['origin' => 'floor']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMovementLogs0()
    {
        return $this->hasMany(MovementLog::className(), ['call' => 'floor']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMovementLogs1()
    {
        return $this->hasMany(MovementLog::className(), ['destination' => 'floor']);
    }
}
