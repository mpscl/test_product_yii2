<?php
/**
 * Variable que indica el ascensor, su identificador y la posición en la que se encuentra (damos por posición inicial
 * de los ascensores  la "Planta Baja")
 * @var array $elevators
 * name: nombre del ascensor
 * position: posición actual del ascensor
 */
$elevators = [
    1 => [
        'name' => 'Ascensor A',
        'position' => 1
    ],
    2 => [
        'name' => 'Ascensor B',
        'position' => 1
    ],
    3 => [
        'name' => 'Ascensor C',
        'position' => 1
    ],
];

/**
 * Variable que indica el número de pisos que hay en el edificio y su idenificador
 * @var array $floors
 */
$floors = [
    1 => 'Planta Baja',
    2 => 'Piso 1',
    3 => 'Piso 2',
    4 => 'Piso 3',
];

/**
 * Variable que indica el principio y final del día de funcionamiento del ascensor
 * @var array $day
 * start: inicio del día de funcionamiento del ascensor
 * end: fin del día de funcionamiento del ascensor
 */
$day = [
    'start' => hourToMinutes('00:00'),
    'end' => hourToMinutes('23:59')
];

/**
 * Generamos las secuencias de funcionamiento de los ascensores seteando sus campos:
 * @var array $sequences
 * period: periodo de repetición en minutos
 * start: inicio de la secuencia de movimientos en minutos
 * end: fin de la secuencia de movimientos en minutos
 * call: piso desde el que se llama al ascensor en formato array para poder indicar si se llama desde varios piso o desde un piso único
 * destination: piso al que se dirige al ascensor en formato array para poder indicar si se dirige a varios pisos o a un piso único
 */
$sequences[1] = [
    'period' => 5,
    'start' => hourToMinutes('9:00'),
    'end' => hourToMinutes('11:00'),
    'call' => [1],
    'destination' => [3]
];
$sequences[2] = [
    'period' => 5,
    'start' => hourToMinutes('9:00'),
    'end' => hourToMinutes('11:00'),
    'call' => [1],
    'destination' => [4]
];
$sequences[3] = [
    'period' => 10,
    'start' => hourToMinutes('9:00'),
    'end' => hourToMinutes('10:00'),
    'call' => [1],
    'destination' => [2]
];
$sequences[4] = [
    'period' => 20,
    'start' => hourToMinutes('11:00'),
    'end' => hourToMinutes('18:20'),
    'call' => [1],
    'destination' => [2, 3, 4]
];
$sequences[5] = [
    'period' => 4,
    'start' => hourToMinutes('14:00'),
    'end' => hourToMinutes('15:00'),
    'call' => [2, 3, 4],
    'destination' => [1]
];

$sequences[6] = [
    'period' => 7,
    'start' => hourToMinutes('15:00'),
    'end' => hourToMinutes('16:00'),
    'call' => [3, 4],
    'destination' => [1]
];

$sequences[7] = [
    'period' => 7,
    'start' => hourToMinutes('15:00'),
    'end' => hourToMinutes('16:00'),
    'call' => [1],
    'destination' => [2, 4]
];
$sequences[8] = [
    'period' => 3,
    'start' => hourToMinutes('18:00'),
    'end' => hourToMinutes('20:00'),
    'call' => [2,3,4],
    'destination' => [1]
];

/**
 * Definimos las cabecerad de los campos del Log de movimientos para la cabecera de l tabla a mostrar:
 * @var array $movementLog
 * elevator_id: Id del ascensor que realiza el movimiento
 * elevator: Nombre del ascensor que realiza el movimiento
 * hour: Hora a la que se realiza el movimiento
 * origin: Piso desde el que se empieza a mover el ascensor
 * origin_name: nombre del piso desde el que se empieza a mover el ascensor
 * call: Piso desde el que se llama el ascensor
 * call_name: Nombre del piso desde el que se llama el ascensor
 * destination: Piso al que se dirige el ascensor
 * destination_name: Nombre del piso al que se dirige el ascensor
 * distance: Distancia recorrida por el ascensor en el movimiento
 * day: Día en que se ha realizado el movimiento
 */
$movementLog[] = [
    'elevator_id' => 'Id Ascensor',
    'elevator' => 'Ascensor',
    'hour' => 'Hora',
    'origin' => 'Origen',
    'origin_name' => 'Piso de Origen',
    'call' => 'Llamada',
    'call_name' => 'Piso de Llamada',
    'destination' => 'Destino',
    'destination_name' => 'Piso de Destino',
    'distance' => 'Distancia',
    'day' => 'Día'
];

/**
 * Definimos las cabecerad de los campos del Sumario de movimientos para la tabla a mostrar:
 * @var array $sumaryElevators
 * elevator: Nombre del ascensor que realiza el movimiento
 * total_distance: Distancia total recorrida por el ascensor en el movimiento
 * day: Día en que se han realizado los movimientos
 */
$sumaryElevators[] = [
    'elevator' => 'Ascensor',
    'total_distance' => 'Distanci Total',
    'day' => 'Día'
];

//Bucle para recorrer loas horas el dia de minuto en minuto par evaluar los movimientos de los ascensores del edificio
for ($currentTime = $day['start']; $currentTime <= $day['end']; $currentTime++) {
    /**
     * Variable que determina si el ascensor se ha movido ya en el lapso de tiempo actual para revisar que el ascensor no se mueva varias veces en el mismo instante
     * @var array $movementLog
     */
    $movedElevatorOnSequence = [];
    //Recorremos todas las secuencias definidas previamente
    foreach ($sequences as $key => $sequence) {
        //Comprobamos si el momento actual pertenence a la secuencia que estamos recorriendo
        if ($sequence['start'] <= $currentTime && $sequence['end'] >= $currentTime && (($currentTime - $sequence['start']) % $sequence['period']) == 0) {
            //Mediante dos iteraciones generamos todas las trayectorias que realizaran los ascensores
            foreach ($sequence['call'] as $call) {
                foreach ($sequence['destination'] as $destination) {
                    $shortestDistance = null;
                    //En caso de que todos los ascensores se hayan movido en el lapso actual de tiempo reiniciamos la restriccion de movimientos por lapos de tiempo
                    if (count($movedElevatorOnSequence) == count($elevators)) {
                        $movedElevatorOnSequence = [];
                    }
                    //Revisamos para la trayectoria actual de la secuencial actual es el ascensor a menos distancia y que no se acabe de mover en el lapso actual de tiempo
                    foreach ($elevators as $elevator_id => $elevator) {
                        $distance = calculateDistance($elevator['position'], $call);
                        if ((empty($shortestDistance) || $distance < $shortestDistance['distance']) && !in_array($elevator_id, $movedElevatorOnSequence)) {
                            $shortestDistance['elevator'] = $elevator_id;
                            $shortestDistance['distance'] = $distance;
                        }
                    }

                    $movementDistance = calculateDistance($elevators[$shortestDistance['elevator']]['position'], $call) + calculateDistance($call, $destination);

                    //Registramos en el Log de movimientos los datos del movimiento acutual
                    $movementLog[] = [
                        'elevator_id' => $shortestDistance['elevator'],
                        'elevator' => $elevators[$shortestDistance['elevator']]['name'],
                        'hour' => minutesToFullHour($currentTime),
                        'origin' => $elevators[$shortestDistance['elevator']]['position'],
                        'origin_name' => $floors[$elevators[$shortestDistance['elevator']]['position']],
                        'call' => $call,
                        'call_name' => $floors[$call],
                        'destination' => $destination,
                        'destination_name' => $floors[$destination],
                        'distance' => $movementDistance,
                        'day' => date('d/m/Y')
                    ];
                    // Si no existe  el Sumario de distancias, lo creamos nuevo, en caso contrario actualizamos el campo de distancia total
                    if (isset($sumaryElevators[$shortestDistance['elevator']])) {
                        $sumaryElevators[$shortestDistance['elevator']]['distance'] = $sumaryElevators[$shortestDistance['elevator']]['distance'] + $movementDistance;
                    } else {
                        $sumaryElevators[$shortestDistance['elevator']] = [
                            'elevator' => $elevators[$shortestDistance['elevator']]['name'],
                            'distance' => $movementDistance,
                            'day' => date('d/m/Y')
                        ];
                    }

                    $movedElevatorOnSequence[] = $shortestDistance['elevator'];
                    $elevators[$shortestDistance['elevator']]['position'] = $destination;
                }
            }
        }
    }
}
//var_dump($movementLog);

?>
    <style>
        table, tr, th, td {
            border: solid 1px black;
            border-collapse: collapse;
        }
    </style>

<?php
echo '<table>';
foreach ($sumaryElevators as $key => $row) {
    if ($key == 0) {
        echo '<thead><tr><th>' . implode('</th><th>', $row) . '</th></tr></thead>';
    } else {
        echo '<tbody><tr><td>' . implode('</td><td>', $row) . '</td></tr></tbody>';
    }
}
echo '</table>';
echo '<br><br>';
echo '<table>';
foreach ($movementLog as $key => $row) {
    if ($key == 0) {
        echo '<thead><tr><th>' . implode('</th><th>', $row) . '</th></tr></thead>';
    } else {
        echo '<tbody><tr><td>' . implode('</td><td>', $row) . '</td></tr></tbody>';
    }
}
echo '</table>';


/**
 * Función que convierte la hora de format HH:mm en el formato mm para poder realizar calculos con mayor comodidad
 * @param string $fullHour Hora en formato HH:mm
 * @return int
 */
function hourToMinutes(string $fullHour): int
{
    $dividedHour = explode(':', $fullHour);
    $minutes = ($dividedHour[0] * 60) + $dividedHour[1];

    return $minutes;
}

/**
 * Función que convierte la hora de format mm en el formato HH:mm para facilitar la lectura del usuario
 * @param int $minutes
 * @return string
 */
function minutesToFullHour(int $time): string
{
    $hour = (int)($time / 60);
    $minutes = $time % 60;
    $fullHour = str_pad($hour, 2, 0, STR_PAD_LEFT) . ':' . str_pad($minutes, 2, 0, STR_PAD_LEFT);

    return $fullHour;
}

/**
 * Función que calcula la disancia entre un piso y otro
 * @param int $origin
 * @param int $destination
 * @return int
 */
function calculateDistance(int $origin, int $destination): int
{
    $distance = abs($origin - $destination);

    return $distance;
}
