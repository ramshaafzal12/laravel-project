<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Hash;
use Illuminate\Notifications\Notifiable;
use PHPUnit\TextUI\XmlConfiguration\Constant;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded;

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    CONST STATUSES = [
        0 => 'Inactive',
        1 => 'Active'
    ];

    CONST USER_TYPES = [
        1 => 'Admin',
        2 => 'Company'
    ];

    CONST DEFAULT_PASSWORD = 'password';

    public static function getUser() {
        return self::get();
    }

    public static function createUser($data) {
        return self::create([
            "type" => $data['user_type'],
            "company_id" => $data['company_id'] ?? null,
            "name" => $data['name'],
            "phone" => $data['phone_number'],
            "email" => $data['email'],
            "password" => !empty($data['password']) ?  Hash::make($data['password']) : Hash::make(self::DEFAULT_PASSWORD)
        ]);
    }
}
