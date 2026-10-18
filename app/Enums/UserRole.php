<?php

namespace App\Enums;

enum UserRole: string
{
    case SuperAdmin = 'super_admin';
    case Admin = 'admin';
    case OperationStaff = 'operation_staff';
    case Dealer = 'dealer';

    public function adminAccess(): bool
    {
        return in_array($this, [self::SuperAdmin, self::Admin], true);
    }
}
