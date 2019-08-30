<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "day".
 *
 * @property int $id
 * @property string $start
 * @property string $end
 */
class Day extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'day';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['start', 'end'], 'required'],
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
            'start' => Yii::t('app', 'Start'),
            'end' => Yii::t('app', 'End'),
        ];
    }
    /**
     * Metodo que convierte la hora de format HH:mm en el formato mm para poder realizar calculos con mayor comodidad
     * @param string $fullHour Hora en formato HH:mm
     * @return int
     */
    public static function hourToMinutes(string $fullHour): int
    {
        $dividedHour = explode(':', $fullHour);
        $minutes = ($dividedHour[0] * 60) + $dividedHour[1];

        return $minutes;
    }

    /**
     * Metodo que convierte la hora de format mm en el formato HH:mm para facilitar la lectura del usuario
     * @param int $minutes
     * @return string
     */
    public static function minutesToFullHour(int $time): string
    {
        $hour = (int)($time / 60);
        $minutes = $time % 60;
        $fullHour = str_pad($hour, 2, 0, STR_PAD_LEFT) . ':' . str_pad($minutes, 2, 0, STR_PAD_LEFT);

        return $fullHour;
    }
}
