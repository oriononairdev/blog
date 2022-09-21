<a href="{{ Mcamara\LaravelLocalization\Facades\LaravelLocalization::getLocalizedURL($lang, null, [], true) }}"
   hreflang="{{ $lang }}"
   title="{{ $lang === 'tr' ? 'Türkçe':'English'}}"
   class="text-gray-500 hover:text-gray-600 text-xxs flex items-end justify-end mt-6">
    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 pb-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"
         stroke-width="2">
        <path stroke-linecap="round" stroke-linejoin="round"
              d="M3 5h12M9 3v2m1.048 9.5A18.022 18.022 0 016.412 9m6.088 9h7M11 21l5-10 5 10M12.751 5C11.783 10.77 8.07 15.61 3 18.129"/>
    </svg>
    {{ mb_strtoupper($lang) }}
</a>
