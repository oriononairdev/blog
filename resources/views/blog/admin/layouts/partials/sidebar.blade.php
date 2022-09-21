@php
use Spatie\Menu\Laravel\Menu;
use Spatie\Menu\Laravel\Link;
use Spatie\Menu\Laravel\Html;
@endphp
<nav class="w-full">
@php
    echo Menu::new()
            ->addItemClass('block text-sm text-gray-800 px-2 py-1')
            ->add(\Spatie\Menu\Laravel\Html::raw('<h3>Admın</h3>')->addParentClass('px-2 text-gray-500 uppercase tracking-wide font-semibold text-xs mt-6 pb-1'))
            ->route('blog.admin.dashboard', 'Dashboard')
            ->setActiveFromRequest('/blog/admin');
@endphp
</nav>
<nav class="mt-8 w-full">
    @php
        echo Menu::new()
            ->addItemClass('py-1 block text-sm text-gray-800  px-2 py-1')
            ->add(\Spatie\Menu\Laravel\Html::raw('<h3>Blog</h3>')->addParentClass('px-2 text-gray-500 uppercase tracking-wide font-semibold text-xs pb-1'))
            ->route('blog.admin.posts.index', 'Posts')
            ->setActiveFromRequest('/blog/admin')
    @endphp
</nav>
<!--<nav class="mt-8 w-full">
    @php
        echo Menu::new()
            ->addItemClass('py-1 block text-sm text-gray-800 px-2 py-1')
            ->add(\Spatie\Menu\Laravel\Html::raw('<h3>Account</h3>')->addParentClass('px-2 text-gray-500 uppercase tracking-wide font-semibold text-xs mt-6 pb-1'))
            ->route('blog.admin.dashboard', 'Profile')
            ->setActiveFromRequest('/blog/admin')
    @endphp
</nav>-->

