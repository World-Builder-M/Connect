<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Employee extends Model
{
    protected $fillable = ['first_name', 'last_name', 'team_id', 'department_id', 'country_id', 'city_id', 'province_id', 'contact_email', 'zip_code','address', 'date_of_birth', 'hired_at'];


    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class);
    }

    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class);
    }

    public function province(): BelongsTo
    {
        return $this->belongsTo(Province::class);
    }

    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class);
    }

    public function setFullNameAttribute($value)
    {
        $this->attributes['full_name'] = $this->first_name . ' ' . $this->last_name;
    }
}
