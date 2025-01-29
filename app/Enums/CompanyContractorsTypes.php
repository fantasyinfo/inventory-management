<?php

namespace App\Enums;

enum CompanyContractorsTypes: string
{
    case PADMINI_VNA = 'padmini vna';
    case GANPATI_ENTERPRISES = 'ganpati enterprises';
    case EARMARK = 'earmark';
    case VARADA_ENTERPRISES = 'varada enterprises';
    case GREEN_THUMB = 'green thumb';
    case HINDUSTAN = 'hindustan';
    case PVCMT_DHANKOT = 'pvcmt - dhankot';
    case PVCMT_PUNE = 'pvcmt - pune';
    case PVNA_E_DRIVE = 'pvna e-drive';
    case QUADSUN = 'quadsun';
    case ASTER = 'aster';



    public static function random(): string
    {
        return array_rand(array_flip([
            self::PADMINI_VNA->value,
            self::GANPATI_ENTERPRISES->value,
            self::EARMARK->value,
            self::VARADA_ENTERPRISES->value,
            self::GREEN_THUMB->value,
            self::HINDUSTAN->value,
            self::PVCMT_DHANKOT->value,
            self::PVCMT_PUNE->value,
            self::PVNA_E_DRIVE->value,
            self::QUADSUN->value,
            self::ASTER->value,
        ]));
    }
}
