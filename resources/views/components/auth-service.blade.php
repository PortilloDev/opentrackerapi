<a
    href="{{ route('login') }}"
    class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20]"
>
    Log in
</a>

@if (Route::has('register'))
    <a
        href="{{ route('register') }}"
        class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20]"
    >
        Register
    </a>
@endif
