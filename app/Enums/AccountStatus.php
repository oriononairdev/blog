<?php

namespace App\Enums;

enum AccountStatus: string
{
    case ACTIVE = 'Active';
    case ARCHIVED = 'Archived';
}
