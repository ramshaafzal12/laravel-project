<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agency extends Model
{
    use HasFactory;

    protected $guarded = '';

    CONST STATUSES = [
        0 => 'Inactive',
        1 => 'Active'
    ];

    public function company() {
        return $this->belongsTo(Company::class);
    }

    public static function getAgencies() {
        return Agency::with('company')->get();
    }
}
