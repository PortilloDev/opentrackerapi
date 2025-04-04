<nav class="-mx-3 flex flex-1 justify-end text-black space-x-4">
    @auth
    @else
        <x-nav-link :href="route('login')" :active="request()->routeIs('login')" wire:navigate>
            Log in
        </x-nav-link>
        @if (Route::has('register'))
            <x-nav-link :href="route('register')" :active="request()->routeIs('register')" wire:navigate>
                Registrarse
            </x-nav-link>
        @endif
    @endauth
</nav>
