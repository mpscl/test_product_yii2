<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "elevator".
 *
 * @property int $id
 * @property string $name
 *
 * @property MovementLog[] $movementLogs
 * @property MovementSumary[] $movementSumaries
 */
class Elevator extends \yii\db\ActiveRecord
{
    public $position;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'elevator';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 255],
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
            'name' => Yii::t('app', 'Name'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMovementLogs()
    {
        return $this->hasMany(MovementLog::className(), ['elevator_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMovementSumaries()
    {
        return $this->hasMany(MovementSumary::className(), ['elevator_id' => 'id']);
    }
}
