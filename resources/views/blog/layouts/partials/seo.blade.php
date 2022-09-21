@hasSection('seo')
    @yield('seo')
@else
    <meta name="description" content="Mücahit Uğur'un Kişisel Bloğu.">
    <meta property="og:description" content="Mücahit Uğur'un Kişisel Bloğu">
    <meta property="og:url" content="{{ request()->fullUrl() }}">
    <meta property="og:image" content="https://blog.mucahitugur.com/media/me.jpg"/>
    <link rel="canonical" href="https://blog.mucahitugur.com"/>
@endif
    <meta property="og:site_name" content="mucahitugur.com">
    <meta property="og:locale" content="tr_TR">
    <script type='application/ld+json'>
    {
        "@context":"http:\/\/schema.org",
        "@type":"WebSite",
        "@id":"#website",
        "url":"https:\/\/mucahitugur.com\/",
        "name":"mucahitugur.com",
        "alternateName":"Mücahit Uğur'un Kişisel Bloğu"
    }


</script>
    <script type='application/ld+json'>
    {
        "@context":"http:\/\/schema.org",
        "@type":"Person",
        "sameAs":["https:\/\/twitter.com\/oriononair"],
        "@id":"#person",
        "name":"Mücahit Uğur"
    }

</script>
