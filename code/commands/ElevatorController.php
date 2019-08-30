<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\commands;

use app\models\Day;
use app\models\Elevator;
use app\models\MovementLog;
use app\models\Sequence;
use yii\console\Controller;
use yii\console\ExitCode;
use yii\db\Expression;

/**
 * This command echoes the first argument that you have entered.
 *
 * This command is provided as an example for you to learn how to create console commands.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class ElevatorController extends Controller
{
    /**
     * This command echoes what you have entered as the message.
     * @param string $message the message to be echoed.
     * @return int Exit code
     */
    public function actionIndex($message = 'hello world')
    {
        echo $message . "\n";

        return ExitCode::OK;
    }

    public function actionDayLogGenerate()
    {
        $day = Day::findOne(1);
        $sequences = Sequence::find()->all();
        $elevators = Elevator::find()->select(['id', 'name', new Expression('0 AS position')])->all();

        //Bucle para recorrer loas horas el dia de minuto en minuto par evaluar los movimientos de los ascensores del edificio
        for ($currentTime = Day::hourToMinutes($day->start); $currentTime <= Day::hourToMinutes($day->end); $currentTime++) {
            /**
             * Variable que determina si el ascensor se ha movido ya en el lapso de tiempo actual para revisar que el ascensor no se mueva varias veces en el mismo instante
             * @var array $movementLog
             */
            $movedElevatorOnSequence = [];
            //Recorremos todas las secuencias definidas previamente
            foreach ($sequences as $key => $sequence) {
                $sequenceStart = Day::hourToMinutes($sequence->start);
                $sequenceEnd = Day::hourToMinutes($sequence->end);
                //Comprobamos si el momento actual pertenence a la secuencia que estamos recorriendo
                if ($sequenceStart <= $currentTime && $sequenceEnd >= $currentTime && (($currentTime - $sequenceStart) % $sequence->period) == 0) {
                    //Mediante dos iteraciones generamos todas las trayectorias que realizaran los ascensores
                    foreach (explode(',', $sequence->call) as $call) {
                        foreach (explode(',', $sequence->destination) as $destination) {
                            $shortestDistance = null;
                            //En caso de que todos los ascensores se hayan movido en el lapso actual de tiempo reiniciamos la restriccion de movimientos por lapos de tiempo
                            if (count($movedElevatorOnSequence) == count($elevators)) {
                                $movedElevatorOnSequence = [];
                            }
                            //Revisamos para la trayectoria actual de la secuencial actual es el ascensor a menos distancia y que no se acabe de mover en el lapso actual de tiempo
                            foreach ($elevators as $elevator_id => $elevator) {
                                $distance = MovementLog::calculateDistance($elevator->position, $call);
                                if ((empty($shortestDistance) || $distance < $shortestDistance['distance']) && !in_array($elevator_id, $movedElevatorOnSequence)) {
                                    $shortestDistance['elevator'] = $elevator->id;
                                    $shortestDistance['distance'] = $distance;
                                }
                            }
                            $movementDistance = MovementLog::calculateDistance($elevators[$shortestDistance['elevator']]['position'], $call) + MovementLog::calculateDistance($call, $destination);


                        }
                    }


                }


            }


        }


        var_dump($elevators);


    }
}
