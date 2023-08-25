<?php

namespace App\Services\Bling\Enums;

enum PaymentMethod:int
{
    case Money = 1;
    case Check = 2;
    case Credit = 3;
    case Debit = 4;
    case BankSlip = 15;
    case Other = 99;
}