<nav class="-mx-3 row  justify-end text-black">
    @auth
    @else
        <hr class="border-b-2 border-gray-300"/>
        <x-responsive-nav-link :href="route('login')" :active="request()->routeIs('login')" wire:navigate>
            {{'Log in'}}
        </x-responsive-nav-link>
        @if (Route::has('register'))
            <x-responsive-nav-link :href="route('register')" :active="request()->routeIs('register')" wire:navigate>
                {{'Registrarse'}}
            </x-responsive-nav-link>
        @endif
    @endauth
</nav>
