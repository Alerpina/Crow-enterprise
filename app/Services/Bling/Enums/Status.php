<?php

namespace App\Services\Bling\Enums;

enum Status:string
{
    case Active = "A";
    case Inactive = "I";
    case Deleted = "E";
}