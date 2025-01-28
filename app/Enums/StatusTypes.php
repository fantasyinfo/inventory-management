<?php

namespace App\Enums;

enum StatusTypes: string
{
    case STARTED = 'started';
    case IN_PROGRESS = 'in_progress';
    case DONE = 'done';
}
