<?php

namespace App\Enums;

enum Role: string
{
    case Admin = 'admin';
    case Editor = 'editor';
    case User = 'user';

    public function label(): string
    {
        return match ($this) {
            self::Admin => 'Admin',
            self::Editor => 'Editor',
            self::User => 'Pengguna',
        };
    }

    public function tone(): string
    {
        return match ($this) {
            self::Admin => 'red',
            self::Editor => 'blue',
            self::User => 'gray',
        };
    }
}
