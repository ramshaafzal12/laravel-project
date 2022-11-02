<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    protected $guarded = '';

    
    CONST STATUSES = [
        0 => 'Inactive',
        1 => 'Active'
    ];

    public static function getCompanies() {
        return self::get();
    }

    public static function createCompany($data) {
        return self::create([
            "company_name" => $data['company_name'],
            "address" => $data['address'],
            "city_id" => $data['city_id']
        ]);
    }
}
