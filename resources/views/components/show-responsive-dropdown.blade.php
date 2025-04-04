<!-- Responsive Settings Options -->
<div class="pt-4 pb-1 border-t border-gray-200">
    <div class="px-4">
        <div class="font-medium text-base text-gray-800" x-data="{{ json_encode(['name' => auth()->user()->name]) }}" x-text="name" x-on:profile-updated.window="name = $event.detail.name"></div>
        <div class="font-medium text-sm text-gray-500">{{ auth()->user()->email }}</div>
    </div>

    <div class="mt-3 space-y-1">
        <x-responsive-nav-link :href="route('profile')" wire:navigate>
            {{ __('Perfil') }}
        </x-responsive-nav-link>

        <!-- Authentication -->
        <button wire:click="logout" class="w-full text-start">
            <x-responsive-nav-link>
                {{ __('Log Out') }}
            </x-responsive-nav-link>
        </button>
    </div>
</div>
