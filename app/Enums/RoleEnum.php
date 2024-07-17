<?php

namespace App\Enums;

enum RoleEnum: string
{
    case ADMIN = 'admin';
    case PROVIDER = 'provider';
    case USER = 'user';

    public function description(): string
    {
        return match($this)
        {
            self::ADMIN => 'He\'s got full powers',
            self::PROVIDER => 'Furniture building service provider',
            self::USER => 'Oh, a guest, be nice to him!',
        };
    }

}
