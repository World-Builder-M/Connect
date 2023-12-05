<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\MembershipPlan;
use App\Enums\MembershipPlan as MembershipPlanEnum;
use App\Constants\MembershipPrice as MembershipPriceConstants;

class MembershipPlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        MembershipPlan::create([
            'name' => MembershipPlanEnum::BASIC,
            'price' => MembershipPriceConstants::BASIC,
        ]);

        MembershipPlan::create([
            'name' => MembershipPlanEnum::STANDARD,
            'price' => MembershipPriceConstants::STANDARD,
        ]);

        MembershipPlan::create([
            'name' => MembershipPlanEnum::PREMIUM,
            'price' => MembershipPriceConstants::PREMIUM,
        ]);
    }
}
