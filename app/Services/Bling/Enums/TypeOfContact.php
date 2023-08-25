<?php

namespace App\Services\Bling\Enums;

enum TypeOfContact:string
{
    case Enterprise = "J";
    case Physical = "F";
    case Foreign = "E";
}