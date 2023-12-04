<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Department extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'active', 'start_date', 'end_date'];

    public function getActiveAttribute()
    {
        $now = Carbon::now();

        if ($this->attributes['start_date'] <= $now && $this->attributes['end_date'] >= $now) {
            return 1;
        }

        if ($this->attributes['end_date'] <= $now) {
            return 1;
        }

        return 0;
    }
}
