@include('blog.admin.layouts.partials.head')
<body class="min-h-screen min-w-full">
<div class="min-h-screen flex flex-col" id="app">
    @include('blog.admin.layouts.partials.header')
    <div class="lg:flex lg:flex-1 container">
        <!-- auth -->
            <aside id="asidebar" class="z-50 lg:z-0 fixed lg:block inset-0 mt-16 lg:mt-0 bg-white px-8 py-5 sr-only lg:not-sr-only lg:w-1/6 max-w-none" id="admin-nav" aria-expanded="false">
                <nav class="px-4 h-full overflow-auto">
                    @include('blog.admin.layouts.partials.sidebar')
                </nav>
            </aside>
        <!-- end auth -->
        <main class="w-full flex-1 px-4 py-5">
            @yield('content')
        </main>
    </div>
</div>
@include('blog.admin.layouts.partials.footer')
