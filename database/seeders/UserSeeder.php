<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\MembershipPlan;

use Carbon\Carbon;

class UserSeeder extends Seeder
{
    public function run()
    {
        $membershipPlans = MembershipPlan::all();

        User::factory(100)->create()->each(function ($user) use ($membershipPlans) {
            $randomPlan = $membershipPlans->random();
            $user->membership_plan_id = $randomPlan->id;

            $user->created_at = Carbon::now()->subDays(rand(1, 365));

            if (rand(0, 1)) {
                $user->email_verified_at = Carbon::now();
            }

            $user->save();
        });
    }
}
