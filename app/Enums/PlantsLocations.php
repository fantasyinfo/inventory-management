<?php

namespace App\Enums;

enum PlantsLocations: string
{
    //

    case SECTOR_35 = 'sector 35';

    case DHANKOT = 'dhankot';

    case PUNE = 'pune';


    public static function random(): string
    {
        return array_rand(array_flip([
            self::SECTOR_35->value,
            self::DHANKOT->value,
            self::PUNE->value,
        ]));
    }

}
