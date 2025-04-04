<?php

use App\Livewire\Actions\Logout;
use Livewire\Volt\Component;

new class extends Component
{
    /**
     * Log the current user out of the application.
     */
    public function logout(Logout $logout): void
    {
        $logout();

        $this->redirect('/', navigate: true);
    }
};
?>
@php
  $nav_links = [
     [
      'name' => 'Home',
      'route' => route('home'),
      'active' => true,
      'isPublic' => true,
    ],
    [
      'name' => 'Servicios',
      'route' => route('services'),
      'active' => true,
      'isPublic' => true,
    ],
    [
      'name' => 'Productos',
      'route' => route('product'),
      'active' => true,
       'isPublic' => true,
    ],
    [
      'name' => 'Podcast',
      'route' => route('podcast'),
      'active' => true,
      'isPublic' => true,
    ],
    [
      'name' => 'Detrás de Artesanos',
      'route' => route('about'),
      'active' => true,
      'isPublic' => true,
     ],
     [
      'name' => 'Mi Área',
      'route' => route('dashboard'),
      'active' => true,
      'isPublic' => false,
     ]
  ];
 $media_links = [
    [
      'href' => "https://www.facebook.com/profile.php?id=61556931680867",
      'icon' => "fab fa-facebook fa-1x",
    ],
    [
      'href' => "https://www.instagram.com/artesanosdelcodigo/",
      'icon' => "fab fa-instagram fa-1x",
    ],
    [
      'href' => "https://www.linkedin.com/in/ivan-portillo-perez/",
      'icon' => "fab fa-linkedin fa-1x",
    ],
    [
      'href' => "https://notasweb.me",
      'icon' => "fab fa-blogger-b fa-1x",
    ],
    [
      'href' => "https://open.spotify.com/show/1TqvkZRtIpTTdEus9i2l7j",
      'icon' => "fab fa-spotify fa-1x",
    ],
    [
      'href' => "https://www.ivoox.com/podcast-artesanos-del-codigo_sq_f12479098_1.html",
      'icon' => "fas fa-podcast fa-1x",
    ],
  ];
@endphp

<nav x-data="{ open: false }" id="menu" class="bg-secondary border-b border-gray-100 text-black shadow-lg sticky top-0 z-50 w-full">
    <div class="w-full px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-14 items-center">
            <!-- Logo -->
            <div class="flex items-center">
                <a href="{{ route('home') }}" wire:navigate>
                    <x-application-logo class="block h-9 w-auto fill-current text-gray-800" />
                </a>
            </div>
            <!-- Navigation Links (Desktop) -->
            <div class="hidden sm:flex space-x-8 ms-10">
                @foreach($nav_links as $link)
                    @auth
                        @if (!$link['isPublic'])
                            <x-nav-link :href="$link['route']" :active="request()->routeIs($link['route'])" wire:navigate>
                                {{ $link['name'] }}
                            </x-nav-link>
                        @endif
                    @endauth
                    @if ($link['isPublic'])
                        <x-nav-link :href="$link['route']" :active="request()->routeIs($link['route'])" wire:navigate>
                            {{ $link['name'] }}
                        </x-nav-link>
                    @endif
                @endforeach
            </div>
            <!-- Login/Register (Desktop) -->
            <div class="hidden sm:flex items-center space-x-4">
                @if (auth()->check())
                    <x-show-dropdown />
                @else
                    @if (Route::has('login'))
                        <a href="{{ route('login') }}" class="text-gray-700 hover:text-gray-900">Log in</a>
                        <a href="{{ route('register') }}" class="text-gray-700 hover:text-gray-900">Registrarse</a>
                    @endif
                @endif
            </div>
            <!-- Hamburger Button (Mobile) -->
            <div class="sm:hidden flex items-center">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>
    <!-- Responsive Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            @foreach($nav_links as $link)
                @auth
                    @if (!$link['isPublic'])
                        <x-responsive-nav-link :href="$link['route']" :active="request()->routeIs($link['route'])" wire:navigate>
                            {{ $link['name'] }}
                        </x-responsive-nav-link>
                    @endif
                @endauth
                @if ($link['isPublic'])
                    <x-responsive-nav-link :href="$link['route']" :active="request()->routeIs($link['route'])" wire:navigate>
                        {{ $link['name'] }}
                    </x-responsive-nav-link>
                @endif
            @endforeach
        </div>
        <!-- Login/Register (Mobile) -->
        @if (Route::has('login'))
            <div class="border-t border-gray-200 pt-4 pb-1">
                @if (auth()->check())
                    <x-show-responsive-dropdown />
                @else
                    <x-responsive-nav-link href="{{ route('login') }}" :active="request()->routeIs('login')">
                        Log in
                    </x-responsive-nav-link>
                    <x-responsive-nav-link href="{{ route('register') }}" :active="request()->routeIs('register')">
                        Registrarse
                    </x-responsive-nav-link>
                @endif
            </div>
        @endif
    </div>
</nav>

