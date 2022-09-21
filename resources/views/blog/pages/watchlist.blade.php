@extends('blog.layouts.master')
@section('title'){{ __('blog.watchlist.title') }}@endsection
@section('content')
    <div class="bg-gray-100 rounded-md md:rounded-none">
        <div class="max-w-7xl mx-auto py-2 mb-12 px-2 md:py-3 md:px-3">
            <div class="max-w-3xl mx-auto">

                <div class="bg-white shadow sm:rounded-lg">
                    <div class="px-4 py-5 sm:p-6">
                        <div class="bg-white mb-4">
                            <div class="max-w-7xl mx-auto">

                                <div>
                                    <div class="sm:hidden">
                                        <label for="tabs" class="sr-only">Select a tab</label>
                                        <select id="tabs" name="tabs"
                                                class="block w-full focus:ring-indigo-500 focus:border-indigo-500 border-gray-300 rounded-md">

                                            <option selected="">Öner</option>

                                            <option>Öneri al</option>

                                        </select>
                                    </div>
                                    <div class="hidden sm:block">
                                        <nav class="flex space-x-4" aria-label="Tabs">

                                            <a href="#"
                                               class="bg-indigo-100 text-indigo-600 hover:text-indigo-500 px-1 font-medium text-xs rounded-sm"
                                               aria-current="page"
                                               x-state-description="undefined: &quot;bg-indigo-100 text-indigo-700&quot;, undefined: &quot;text-gray-500 hover:text-gray-700&quot;">
                                                Öner
                                            </a>

                                            <a href="#"
                                               class="text-gray-500 hover:text-gray-400 px-1 font-medium text-xs rounded-sm"
                                               x-state:on="Current" x-state:off="Default"
                                               x-state-description="Current: &quot;bg-indigo-100 text-indigo-700&quot;, Default: &quot;text-gray-500 hover:text-gray-700&quot;">
                                                Öneri Al
                                            </a>

                                        </nav>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <h3 class="text-md leading-6 font-medium text-gray-900">
                            Bana film veya dizi önerin
                        </h3>
                        <div class="mt-2 max-w-xl text-xs text-gray-500">
                            <p>
                                Change the email address you want associated with your account.
                            </p>
                        </div>
                        <form class="mt-5 sm:flex sm:items-center">
                            <div class="w-full sm:max-w-xs">
                                <label for="email" class="sr-only">Email</label>
                                <input type="text" name="email" id="email"
                                       class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-xs border-gray-300 rounded-md"
                                       placeholder="you@example.com">
                            </div>
                            <button type="submit"
                                    class="mt-3 w-full inline-flex items-center justify-center px-4 py-2 border border-transparent shadow-sm font-medium rounded-md text-white bg-indigo-400 hover:bg-indigo-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-xs">
                                Öner
                            </button>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <div class="grid grid-cols-2 gap-8">
        <div>
            <div class="bg-white">
                <div class="max-w-sm mx-auto">
                    <h2 class="text-center text-sm italic">Bekleyenler</h2>
                    <ul class="divide-y divide-gray-200">

                        <li class="relative bg-white rounded-sm py-5 px-4 hover:bg-gray-50 focus-within:ring-2 focus-within:ring-inset focus-within:ring-gray-200">
                            <div class="flex justify-between space-x-3">
                                <div class="min-w-0 flex-1">
                                    <a href="#" class="block focus:outline-none">
                                        <span class="absolute inset-0" aria-hidden="true"></span>
                                        <p class="text-xs font-medium text-gray-900 truncate">Gloria Roberston</p>
                                        <p class="text-xs text-gray-500 truncate">Velit placeat sit ducimus non sed</p>
                                    </a>
                                </div>
                                <time datetime="2021-01-27T16:35"
                                      class="flex-shrink-0 whitespace-nowrap text-xs text-gray-500">1d ago
                                </time>
                            </div>
                            <div class="mt-1">
                                <p class="line-clamp-2 text-xs text-gray-600">
                                    Doloremque dolorem maiores assumenda dolorem facilis. Velit vel in a rerum natus
                                    facere.
                                </p>
                            </div>
                        </li>

                        <li class="relative bg-white rounded-sm py-5 px-4 hover:bg-gray-50 focus-within:ring-2 focus-within:ring-inset focus-within:ring-gray-200">
                            <div class="flex justify-between space-x-3">
                                <div class="min-w-0 flex-1">
                                    <a href="#" class="block focus:outline-none">
                                        <span class="absolute inset-0" aria-hidden="true"></span>
                                        <p class="text-xs font-medium text-gray-900 truncate">Virginia Abshire</p>
                                        <p class="text-xs text-gray-500 truncate">Nemo mollitia repudiandae adipisci
                                            explicabo optio consequatur tempora ut nihil</p>
                                    </a>
                                </div>
                                <time datetime="2021-01-27T16:35"
                                      class="flex-shrink-0 whitespace-nowrap text-xs text-gray-500">1d ago
                                </time>
                            </div>
                            <div class="mt-1">
                                <p class="line-clamp-2 text-xs text-gray-600">
                                    Doloremque dolorem maiores assumenda dolorem facilis. Velit vel in a rerum natus
                                    facere. Enim rerum eaque qui facilis.
                                </p>
                            </div>
                        </li>

                        <li class="relative bg-white rounded-sm py-5 px-4 hover:bg-gray-50 focus-within:ring-2 focus-within:ring-inset focus-within:ring-gray-200">
                            <div class="flex justify-between space-x-3">
                                <div class="min-w-0 flex-1">
                                    <a href="#" class="block focus:outline-none">
                                        <span class="absolute inset-0" aria-hidden="true"></span>
                                        <p class="text-xs font-medium text-gray-900 truncate">Kyle Gulgowski</p>
                                        <p class="text-xs text-gray-500 truncate">Doloremque reprehenderit et harum quas
                                            explicabo nulla architecto dicta voluptatibus</p>
                                    </a>
                                </div>
                                <time datetime="2021-01-27T16:35"
                                      class="flex-shrink-0 whitespace-nowrap text-xs text-gray-500">1d ago
                                </time>
                            </div>
                            <div class="mt-1">
                                <p class="line-clamp-2 text-xs text-gray-600">
                                    Doloremque dolorem maiores assumenda dolorem facilis. Velit vel in a rerum natus
                                    facere. Enim rerum eaque qui facilis.
                                </p>
                            </div>
                        </li>

                        <li class="relative bg-white rounded-sm py-5 px-4 hover:bg-gray-50 focus-within:ring-2 focus-within:ring-inset focus-within:ring-gray-200">
                            <div class="flex justify-between space-x-3">
                                <div class="min-w-0 flex-1">
                                    <a href="#" class="block focus:outline-none">
                                        <span class="absolute inset-0" aria-hidden="true"></span>
                                        <p class="text-xs font-medium text-gray-900 truncate">Hattie Haag</p>
                                        <p class="text-xs text-gray-500 truncate">Eos sequi et aut ex impedit</p>
                                    </a>
                                </div>
                                <time datetime="2021-01-27T16:35"
                                      class="flex-shrink-0 whitespace-nowrap text-xs text-gray-500">1d ago
                                </time>
                            </div>
                            <div class="mt-1">
                                <p class="line-clamp-2 text-xs text-gray-600">
                                    Doloremque dolorem maiores assumenda dolorem facilis. Velit vel in a rerum natus
                                    facere. Enim rerum eaque qui facilis.
                                </p>
                            </div>
                        </li>

                        <li class="relative bg-white rounded-sm py-5 px-4 hover:bg-gray-50 focus-within:ring-2 focus-within:ring-inset focus-within:ring-gray-200">
                            <div class="flex justify-between space-x-3">
                                <div class="min-w-0 flex-1">
                                    <a href="#" class="block focus:outline-none">
                                        <span class="absolute inset-0" aria-hidden="true"></span>
                                        <p class="text-xs font-medium text-gray-900 truncate">Wilma Glover</p>
                                        <p class="text-xs text-gray-500 truncate">Quisquam veniam explicabo</p>
                                    </a>
                                </div>
                                <time datetime="2021-01-27T16:35"
                                      class="flex-shrink-0 whitespace-nowrap text-xs text-gray-500">1d ago
                                </time>
                            </div>
                            <div class="mt-1">
                                <p class="line-clamp-2 text-xs text-gray-600">
                                    Doloremque dolorem maiores assumenda dolorem facilis. Velit vel in a rerum natus
                                    facere. Enim rerum eaque qui facilis.
                                </p>
                            </div>
                        </li>

                    </ul>

                </div>
            </div>
        </div>
        <div>
            <div class="bg-white">
                <div class="max-w-sm mx-auto">
                    <h2 class="text-center text-sm italic">İzlediklerim</h2>
                    <ul class="divide-y divide-gray-200">

                        <li class="relative bg-white rounded-sm py-5 px-4 hover:bg-gray-50 focus-within:ring-2 focus-within:ring-inset focus-within:ring-gray-200">
                            <div class="flex justify-between space-x-3">
                                <div class="min-w-0 flex-1">
                                    <a href="#" class="block focus:outline-none">
                                        <span class="absolute inset-0" aria-hidden="true"></span>
                                        <p class="text-xs font-medium text-gray-900 truncate">Gloria Roberston</p>
                                        <p class="text-xs text-gray-500 truncate">Velit placeat sit ducimus non sed</p>
                                    </a>
                                </div>
                                <time datetime="2021-01-27T16:35"
                                      class="flex-shrink-0 whitespace-nowrap text-xs text-gray-500">1d ago
                                </time>
                            </div>
                            <div class="mt-1">
                                <p class="line-clamp-2 text-xs text-gray-600">
                                    Doloremque dolorem maiores assumenda dolorem facilis. Velit vel in a rerum natus
                                    facere.
                                </p>
                            </div>
                        </li>

                        <li class="relative bg-white rounded-sm py-5 px-4 hover:bg-gray-50 focus-within:ring-2 focus-within:ring-inset focus-within:ring-gray-200">
                            <div class="flex justify-between space-x-3">
                                <div class="min-w-0 flex-1">
                                    <a href="#" class="block focus:outline-none">
                                        <span class="absolute inset-0" aria-hidden="true"></span>
                                        <p class="text-xs font-medium text-gray-900 truncate">Virginia Abshire</p>
                                        <p class="text-xs text-gray-500 truncate">Nemo mollitia repudiandae adipisci
                                            explicabo optio consequatur tempora ut nihil</p>
                                    </a>
                                </div>
                                <time datetime="2021-01-27T16:35"
                                      class="flex-shrink-0 whitespace-nowrap text-xs text-gray-500">1d ago
                                </time>
                            </div>
                            <div class="mt-1">
                                <p class="line-clamp-2 text-xs text-gray-600">
                                    Doloremque dolorem maiores assumenda dolorem facilis. Velit vel in a rerum natus
                                    facere. Enim rerum eaque qui facilis.
                                </p>
                            </div>
                        </li>

                        <li class="relative bg-white rounded-sm py-5 px-4 hover:bg-gray-50 focus-within:ring-2 focus-within:ring-inset focus-within:ring-gray-200">
                            <div class="flex justify-between space-x-3">
                                <div class="min-w-0 flex-1">
                                    <a href="#" class="block focus:outline-none">
                                        <span class="absolute inset-0" aria-hidden="true"></span>
                                        <p class="text-xs font-medium text-gray-900 truncate">Kyle Gulgowski</p>
                                        <p class="text-xs text-gray-500 truncate">Doloremque reprehenderit et harum quas
                                            explicabo nulla architecto dicta voluptatibus</p>
                                    </a>
                                </div>
                                <time datetime="2021-01-27T16:35"
                                      class="flex-shrink-0 whitespace-nowrap text-xs text-gray-500">1d ago
                                </time>
                            </div>
                            <div class="mt-1">
                                <p class="line-clamp-2 text-xs text-gray-600">
                                    Doloremque dolorem maiores assumenda dolorem facilis. Velit vel in a rerum natus
                                    facere. Enim rerum eaque qui facilis.
                                </p>
                            </div>
                        </li>

                        <li class="relative bg-white rounded-sm py-5 px-4 hover:bg-gray-50 focus-within:ring-2 focus-within:ring-inset focus-within:ring-gray-200">
                            <div class="flex justify-between space-x-3">
                                <div class="min-w-0 flex-1">
                                    <a href="#" class="block focus:outline-none">
                                        <span class="absolute inset-0" aria-hidden="true"></span>
                                        <p class="text-xs font-medium text-gray-900 truncate">Hattie Haag</p>
                                        <p class="text-xs text-gray-500 truncate">Eos sequi et aut ex impedit</p>
                                    </a>
                                </div>
                                <time datetime="2021-01-27T16:35"
                                      class="flex-shrink-0 whitespace-nowrap text-xs text-gray-500">1d ago
                                </time>
                            </div>
                            <div class="mt-1">
                                <p class="line-clamp-2 text-xs text-gray-600">
                                    Doloremque dolorem maiores assumenda dolorem facilis. Velit vel in a rerum natus
                                    facere. Enim rerum eaque qui facilis.
                                </p>
                            </div>
                        </li>

                        <li class="relative bg-white rounded-sm py-5 px-4 hover:bg-gray-50 focus-within:ring-2 focus-within:ring-inset focus-within:ring-gray-200">
                            <div class="flex justify-between space-x-3">
                                <div class="min-w-0 flex-1">
                                    <a href="#" class="block focus:outline-none">
                                        <span class="absolute inset-0" aria-hidden="true"></span>
                                        <p class="text-xs font-medium text-gray-900 truncate">Wilma Glover</p>
                                        <p class="text-xs text-gray-500 truncate">Quisquam veniam explicabo</p>
                                    </a>
                                </div>
                                <time datetime="2021-01-27T16:35"
                                      class="flex-shrink-0 whitespace-nowrap text-xs text-gray-500">1d ago
                                </time>
                            </div>
                            <div class="mt-1">
                                <p class="line-clamp-2 text-xs text-gray-600">
                                    Doloremque dolorem maiores assumenda dolorem facilis. Velit vel in a rerum natus
                                    facere. Enim rerum eaque qui facilis.
                                </p>
                            </div>
                        </li>

                    </ul>

                </div>
            </div>
        </div>
    </div>
@endsection
@section('seo')
    <meta property="og:title" content="Watchlist | mucahitugur.com"/>
    <meta property="og:description" content=""/>
    <meta name="twitter:card" content="summary_large_image"/>
    <meta name="twitter:description" content=""/>
    <meta name="twitter:title" content=" | mucahitugur.com"/>
    <meta name="twitter:site" content="@oriononair"/>
    <meta name="twitter:creator" content="@oriononair"/>
@endsection
