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

    CONST STATUSES_KEY = [
        'inactive' => 0,
        'active' => 1  
    ];

    public function company() {
        return $this->belongsTo(Company::class);
    }

    public static function getAgencies( $filters = [] ) {
        $agencies = Agency::with('company');

        if( $filters ) {
            // if( !empty($filters['status']) ) {
            //     $agencies = $agencies->where('status', $filters['status']);
            // } 

            if( !empty($filters['company_id']) ) {
                $agencies = $agencies->where('company_id', $filters['company_id']);
            }
        }

        $agencies = $agencies->get();

        return $agencies;
    }
}
