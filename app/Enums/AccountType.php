<?php

namespace App\Enums;

enum AccountType: string
{
    case GENERAL = 'General';
    case CASH = 'Cash';
    case CREDIT = 'Credit Card';
    case CRYPTO = 'Crypto';
    case SAVING = 'Saving';
    case INVESTMENT = 'Investment';
}
