@include('blog.layouts.partials.head')
<div class="font-sans text-black">
    <div class="max-w-xl md:max-w-4xl mx-auto">
    @include('blog.layouts.partials.header')
        <div class="md:flex pb-12">
            <nav class="hidden md:block w-1/4 lg:w-1/5 text-right leading-loose">
                <div class="border-r border-gray-200 px-8 mb-16 sticky top-20">
                @include('blog.layouts.partials.menu')
                </div>
            </nav>
            <main class="flex-1 min-w-0 px-4 md:px-12 lg:pl-24 lg:pr-16">
            @yield('content')
            </main>
        </div>
    </div>
</div>
@include('blog.layouts.partials.footer')
