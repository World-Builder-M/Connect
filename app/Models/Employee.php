<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $fillable = ['first_name', 'last_name', 'team_id', 'department_id', 'country_id', 'city_id', 'province_id'];

    public function setFullNameAttribute($value)
    {
        $this->attributes['full_name'] = $this->first_name . ' ' . $this->last_name;
    }
}