@php
    $user = filament()
        ->auth()
        ->user();

    $membershipPlan = $user->membershipPlan;

    $planName = $membershipPlan->name;

    switch ($planName) {
        case \App\Enums\MembershipPlan::BASIC:
            $colorClass = 'text-gray-500';
            break;
        case \App\Enums\MembershipPlan::STANDARD:
            $colorClass = 'text-gray-50';
            break;
        case \App\Enums\MembershipPlan::PREMIUM:
            $colorClass = 'text-amber-400';
            break;
        default:
            $colorClass = 'text-gray-500';
            break;
    }
@endphp

<x-filament-widgets::widget class="fi-account-widget">
    <x-filament::section>
        <div class="flex items-center gap-x-3">
            <img src="{{ asset('connect.png') }}" alt="Image description" class="h-11 w-11">
            <div class="flex-1 flex items-center">
                <h2 class="text-xl">Connect</h2>
            </div>

            <div class="flex-2">
                <p class="text-xl font-semibold">
                    <span class="text-green-600">$ </span>
                    <span class="{{ $colorClass }}">{{ $planName }}</span>
                </p>
            </div>
        </div>
    </x-filament::section>
</x-filament-widgets::widget>

