<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Filament\Models\Contracts\HasAvatar;
use Illuminate\Notifications\Notifiable;
use Filament\Models\Contracts\FilamentUser;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Enums\MembershipPlan as MembershipPlanEnum;
use BezhanSalleh\FilamentShield\Traits\HasPanelShield;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements FilamentUser, MustVerifyEmail, HasAvatar
{
    use HasApiTokens;
    use HasRoles;
    use HasPanelShield;
    use HasFactory;
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'membership_plan_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function membershipPlan()
    {
        return $this->belongsTo(MembershipPlan::class);
    }

    /**
     * Boot function to set default values.
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($user) {
            if (!$user->membership_plan_id) {
                $basicPlan = \App\Models\MembershipPlan::where('name', \App\Enums\MembershipPlan::BASIC)->first();
                $user->membership_plan_id = $basicPlan->id ?? null;
            }
        });
    }

    public function canAccessFilament(): bool
    {
        return $this->hasVerifiedEmail();
    }

    public function getFilamentAvatarUrl(): ?string
    {
        // TODO: Configure this
        $customAvatarPath = public_path('customavater.png');

        if (file_exists($customAvatarPath)) {
            return asset('connect.png');
        }

        return $this->avatar_url;
    }

    public function getFilamentName(): string
    {
        return "{$this->first_name} {$this->last_name}";
    }
}
