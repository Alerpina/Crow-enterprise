<?php

namespace App\Services\Bling\Enums;

enum Format:string
{
    case Simple = "S";
    case WithVariation = "V";
    case WithComposition = "E";
}