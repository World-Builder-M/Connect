<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Country extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'code', 'phonecode'];

    public function provinces(): HasMany
    {
        return $this->hasMany(Province::class);
    }

    public function employees(): HasMany
    {
        return $this->hasMany(Employee::class);
    }
}
