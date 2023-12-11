<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Department extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'start_date', 'end_date', 'organisation_id'];

    public function employees(): HasMany
    {
        return $this->hasMany(Employee::class);
    }

    public function organisation(): BelongsTo
    {
        return $this->belongsTo(Organisation::class);
    }

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
