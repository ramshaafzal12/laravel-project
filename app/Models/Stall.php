<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stall extends Model
{
    use HasFactory;

    protected $guarded = '';

    CONST STATUSES = [
        0 => 'Inactive',
        1 => 'Active'
    ];

    
    public function agency() {
        return $this->belongsTo(Agency::class);
    }

public function company() {
        return $this->belongsTo(Company::class);
    }

    public static function getStalls() {
        return self::with('agency', 'company')->get();
    }
}
