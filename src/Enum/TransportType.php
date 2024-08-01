<?php

declare(strict_types=1);

namespace App\Enum;

enum TransportType: string
{
    case Car = 'Car';
    case Bus = 'Bus';
    case Bike = 'Bike';
    case Train = 'Train';
}
