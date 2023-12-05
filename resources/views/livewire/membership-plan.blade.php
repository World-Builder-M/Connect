@php
    $user = filament()
        ->auth()
        ->user();

    $membershipPlan = $user->membershipPlan;

    $planName = $membershipPlan->name;

    // temporary workaround
    switch ($planName) {
        case \App\Enums\MembershipPlan::BASIC:
            $colorClass = '#888888';
            break;
        case \App\Enums\MembershipPlan::STANDARD:
            $colorClass = '#f0f0f0';
            break;
        case \App\Enums\MembershipPlan::PREMIUM:
            $colorClass = '#ffbf00';
            break;
        default:
            $colorClass = '#888888';
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
                    <span style="color: {{ $colorClass }} !important;">{{ $planName }}</span>
                </p>
            </div>
        </div>
    </x-filament::section>
</x-filament-widgets::widget>
