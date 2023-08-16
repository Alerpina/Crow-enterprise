<?php

namespace App\Services\Bling\Enums;

enum Operation:string
{
    case Balance = "B";
    case Entry = "E";
    case Output = "S";
}