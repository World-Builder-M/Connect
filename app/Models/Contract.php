<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contract extends Model
{
    protected $fillable = [
        'asset_id',
        'organisation_id',
        'employee_id',
        'start_date',
        'end_date',
        'terms',
        'monthly_rent',
        'deposit',
        'status',
    ];


    public function asset()
    {
        return $this->belongsTo(Asset::class);
    }

    public function organisation()
    {
        return $this->belongsTo(Organisation::class);
    }

    // public function employee()
    // {
    //     return $this->belongsTo(Employee::class);
    // }
}