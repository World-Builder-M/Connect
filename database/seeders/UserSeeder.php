<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\MembershipPlan;
use Illuminate\Support\Facades\Hash;

use Carbon\Carbon;

class UserSeeder extends Seeder
{
    public function run()
    {
        $premiumPlan = MembershipPlan::where('name', 'Premium')->first();
        $basicPlan = MembershipPlan::where('name', 'Basic')->first();

        Create a specific user with the email "connect@test.com" and the premium plan
        $specificUser = User::factory()->create([
            'name' => 'connect@test.com',
            'email' => 'connect@test.com',
            'is_admin' => true,
            'password' => Hash::make('connect@test.com'),
            'membership_plan_id' => $premiumPlan->id,
            'created_at' => Carbon::now()->subDays(rand(1, 365)),
            'email_verified_at' => Carbon::now(),
        ]);

        for ($i = 0; $i < 30; $i++) {
            User::factory()->create([
                'membership_plan_id' => $basicPlan->id,
                'created_at' => Carbon::now()->subDays(rand(1, 365)),
                'email_verified_at' => Carbon::now(),
            ]);
        }
    }
}
