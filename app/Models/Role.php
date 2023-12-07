<?php
namespace App\Models;
use App\Models\User;
use App\Models\Organisation;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Permission\Models\Role as SpatieRole;

class Role extends SpatieRole
{
    protected static bool $isScopedToTenant = false;

    // public function organisation(): BelongsTo
    // {
    //     return $this->belongsTo(Organisation::class);
    // }

}