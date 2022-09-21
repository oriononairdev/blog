@php
    use Spatie\Menu\Laravel\Menu;
    use Spatie\Menu\Laravel\Link;
    use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

    /*
    |--------------------------------------------------------------------------
    | Menu
    |--------------------------------------------------------------------------
    |
    */

    echo Menu::new()
                    ->add(Link::toRoute('blog.home', __('blog.navbar.home')))
                    ->setActiveFromRequest('/'.LaravelLocalization::setLocale())
                    ->addClass('text-gray-700 mb-2 md:mb-6')
                    ->setActiveClass('font-bold text-black');
    /*echo Menu::new()
                    ->add(Link::toRoute('blog.watchlist', 'Watchlist')->addParentClass('mt-2'))
                    ->addClass('space-y-2 text-sm text-gray-700')
                    ->setActiveClass('font-semibold text-black')
                    ->setActiveFromRequest('/');*/
    echo Menu::new()
                    ->addClass('space-y-2 text-xs text-gray-700 mt-4')
                    ->setActiveClass('font-semibold text-black')
                    ->add(Link::toRoute('blog.search', __('blog.navbar.search')))
                    //->add(Link::toRoute('blog.terminal', __('blog.navbar.terminal')))
                    ->add(Link::toRoute('blog.page', __('blog.navbar.contact'),'contact'))
                    ->view('blog.partials.lang-selector', ['lang' => App::isLocale('tr') ? 'en':'tr'])
                    ->setActiveFromRequest('/'.LaravelLocalization::setLocale());
@endphp


