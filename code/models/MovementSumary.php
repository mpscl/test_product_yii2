<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "movement_sumary".
 *
 * @property int $id
 * @property int $elevator_id
 * @property int $total_disance
 * @property string $day
 *
 * @property Elevator $elevator
 */
class MovementSumary extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'movement_sumary';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['elevator_id', 'total_disance', 'day'], 'required'],
            [['elevator_id', 'total_disance'], 'integer'],
            [['day'], 'safe'],
            [['elevator_id'], 'exist', 'skipOnError' => true, 'targetClass' => Elevator::className(), 'targetAttribute' => ['elevator_id' => 'id']],
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
            'total_disance' => Yii::t('app', 'Total Disance'),
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
}
