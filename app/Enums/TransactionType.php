<?php

namespace App\Enums;

enum TransactionType: string
{
    case EXPENSE = 'Expense';
    case INCOME = 'Income';
}
