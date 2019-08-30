<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "movement_log".
 *
 * @property int $id
 * @property int $elevator_id
 * @property int $origin
 * @property int $call
 * @property int $destination
 * @property int $distance
 * @property int $day
 *
 * @property Elevator $elevator
 * @property Building $origin0
 * @property Building $call0
 * @property Building $destination0
 */
class MovementLog extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'movement_log';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['elevator_id', 'origin', 'call', 'destination', 'distance', 'day'], 'required'],
            [['elevator_id', 'origin', 'call', 'destination', 'distance', 'day'], 'integer'],
            [['elevator_id'], 'exist', 'skipOnError' => true, 'targetClass' => Elevator::className(), 'targetAttribute' => ['elevator_id' => 'id']],
            [['origin'], 'exist', 'skipOnError' => true, 'targetClass' => Building::className(), 'targetAttribute' => ['origin' => 'floor']],
            [['call'], 'exist', 'skipOnError' => true, 'targetClass' => Building::className(), 'targetAttribute' => ['call' => 'floor']],
            [['destination'], 'exist', 'skipOnError' => true, 'targetClass' => Building::className(), 'targetAttribute' => ['destination' => 'floor']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'elevator_id' => Yii::t('app', 'Elevator ID'),
            'origin' => Yii::t('app', 'Origin'),
            'call' => Yii::t('app', 'Call'),
            'destination' => Yii::t('app', 'Destination'),
            'distance' => Yii::t('app', 'Distance'),
            'day' => Yii::t('app', 'Day'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getElevator()
    {
        return $this->hasOne(Elevator::className(), ['id' => 'elevator_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrigin0()
    {
        return $this->hasOne(Building::className(), ['floor' => 'origin']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCall0()
    {
        return $this->hasOne(Building::className(), ['floor' => 'call']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDestination0()
    {
        return $this->hasOne(Building::className(), ['floor' => 'destination']);
    }

    /**
     * Metodo que calcula la disancia entre un piso y otro
     * @param int $origin
     * @param int $destination
     * @return int
     */
    public static function calculateDistance(int $origin, int $destination): int
    {
        $distance = abs($origin - $destination);

        return $distance;
    }
}
