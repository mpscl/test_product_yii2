<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "sequence".
 *
 * @property int $id
 * @property int $period
 * @property string $start
 * @property string $end
 * @property array $call
 * @property array $destination
 */
class Sequence extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'sequence';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['period', 'start', 'end', 'call', 'destination'], 'required'],
            [['period'], 'integer'],
            [['call', 'destination'], 'safe'],
            [['start', 'end'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'period' => Yii::t('app', 'Period'),
            'start' => Yii::t('app', 'Start'),
            'end' => Yii::t('app', 'End'),
            'call' => Yii::t('app', 'Call'),
            'destination' => Yii::t('app', 'Destination'),
        ];
    }
}
