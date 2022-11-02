<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
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

    public static function getCategories() {
        return self::with('agency')->get();
    }

    public static function createCategory( $data ) {
        return self::create($data);
    }
}
