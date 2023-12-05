<x-filament-widgets::widget class="fi-account-widget">
    <x-filament::section>

        <div class="flex items-center gap-x-3">
            <img src="{{ asset('connect.png') }}" alt="Image description" class="h-11 w-11">
            <div class="flex-1 flex items-center">
                <h2 class="text-xl">Connect</h2>
            </div>

            {{-- Membership plan rank goes here --}}
            <div class="flex-2">
                <p class="text-xl font-semibold text-blue-500">
                    <span class="text-green-600">$</span><span class="text-gray-500">Silver </span>
                </p>
            </div>
        </div>

    </x-filament::section>
</x-filament-widgets::widget>
