<!--
      ___           ___                       ___           ___
     /  /\         /  /\        ___          /  /\         /__/\
    /  /::\       /  /::\      /  /\        /  /::\        \  \:\
   /  /:/\:\     /  /:/\:\    /  /:/       /  /:/\:\        \  \:\
  /  /:/  \:\   /  /:/~/:/   /__/::\      /  /:/  \:\   _____\__\:\
 /__/:/ \__\:\ /__/:/ /:/___ \__\/\:\__  /__/:/ \__\:\ /__/::::::::\
 \  \:\ /  /:/ \  \:\/:::::/    \  \:\/\ \  \:\ /  /:/ \  \:\~~\~~\/
  \  \:\  /:/   \  \::/~~~~      \__\::/  \  \:\  /:/   \  \:\  ~~~
   \  \:\/:/     \  \:\          /__/:/    \  \:\/:/     \  \:\
    \  \::/       \  \:\         \__\/      \  \::/       \  \:\
     \__\/         \__\/                     \__\/         \__\/


     ...welcomes you
                        -->
<!DOCTYPE html>
<head lang="{{ app()->getLocale() }}">
    @php setlocale(LC_TIME, app()->getLocale());@endphp
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="mobile-web-app-capable" content="yes">
        <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('apple-touch-icon.png') }}">
        <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon-32x32.png') }}">
        <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon-16x16.png') }}">
        <link rel="manifest" href="{{ asset('site.webmanifest') }}">
        @hasSection('title')
            <title>@yield('title') - {{ __('blog.global.title') }}</title>
        @else
            @hasSection('soloTitle')
                <title>@yield('soloTitle')</title>
            @else
                <title>{{ __('blog.global.title') }} </title>
            @endif
        @endif
        @include('blog.layouts.partials.seo')
        <link href="{{asset('css/blog/app.css') }}" rel="stylesheet">
        @yield('page-level-css')
        <link href="https://twitter.com/oriononair" rel="me">
        <link rel="webmention" href="https://webmention.io/blog.mucahitugur.com/webmention"/>
        <link rel="pingback" href="https://webmention.io/blog.mucahitugur.com/xmlrpc"/>
        @production
            <script>
                var _paq = window._paq = window._paq || [];
                _paq.push(["setDocumentTitle", document.domain + "/" + document.title]);
                _paq.push(["setCookieDomain", "*.blog.mucahitugur.com"]);
                _paq.push(["setDomains", ["*.blog.mucahitugur.com", "*.mucahitugur.com"]]);
                _paq.push(['trackPageView']);
                _paq.push(['enableLinkTracking']);
                (function () {
                    var u = "//matomo.tirnakicindedergi.com/";
                    _paq.push(['setTrackerUrl', u + 'matomo.php']);
                    _paq.push(['setSiteId', '2']);
                    var d = document, g = d.createElement('script'), s = d.getElementsByTagName('script')[0];
                    g.async = true;
                    g.src = u + 'matomo.js';
                    s.parentNode.insertBefore(g, s);
                })();
            </script>
        @endproduction
    </head>
