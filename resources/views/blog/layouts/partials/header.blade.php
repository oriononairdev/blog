<header class="mt-8 md:mt-12 mb-8 sm:mb-12 md:mb-16 px-4 md:px-8 leading-tight">
    <div class="md:flex items-end">
        <figure class="w-12 inline-block mb-1 md:mb-0 md:mr-3">
            <a href="{{route('blog.home')}}" title="Blog">
                <img src="{{ asset('media/me-400-400.webp') }}" class="w-full rounded shadow-md hover:shadow-lg hover:opacity-75 transition duration-1000"
                     alt=""/>
            </a>
        </figure>
        <div>
            <h1 class="text-lg tracking-wider font-extrabold">
                <a href="{{route('blog.home')}}">Mücahit Uğur</a>
            </h1>
            <p class="text-sm font-bold text-gray-600">
                <a href="{{route('blog.home')}}">
                    💻
                    <span class="text-gray-300">/</span>
                    🌟
                    <span class="text-gray-300">/</span>
                    ♫
                </a>
            </p>
        </div>
    </div>
    <nav class="md:hidden relative">
        <input class="hidden" type="checkbox" id="mobile-menu-toggle"/>
        <label for="mobile-menu-toggle"
            class="absolute bg-gray-700 border-b-3 border-gray-900 text-white uppercase tracking-wider font-semibold p-2 pb-1"
            style="top: -6rem; right: 0">
            {{ __('blog.navbar.menu') }}
        </label>
        <div class="mobile-menu | pt-4 mb-4 text-right leading-loose">
            @include('blog.layouts.partials.menu')
        </div>
    </nav>
</header>
