<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Enums\MembershipPlan as MembershipPlanEnum;
use App\Constants\MembershipPrice as MembershipPriceConstants;

class MembershipPlan extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'price'];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->attributes['name'] = $this->attributes['name'] ?? MembershipPlanEnum::BASIC;
        $this->attributes['price'] = $this->attributes['price'] ?? MembershipPriceConstants::BASIC;
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }
}
