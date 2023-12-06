<?php

namespace App\Enums;

use Illuminate\Support\Facades\Lang;

enum MembershipPlan
{
    const BASIC = 'Basic';
    const STANDARD = 'Standard';
    const PREMIUM = 'Premium';

    public static function translatedValue(string $value): string
    {
        return Lang::get('enums.membership_plan.' . $value);
    }
}