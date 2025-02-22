@if (flash()->message)
    <div class="rounded-md bg-green-50 p-4 mb-4">
        <div class="flex">
            <div class="flex-shrink-0">
                <svg class="h-5 w-5 text-green-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                </svg>
            </div>
            <div class="ml-3 flex-1 md:flex md:justify-between">
                <p class="text-sm text-green-700">
                    {{flash()->message}}
                </p>
                <p class="mt-3 text-sm md:mt-0 md:ml-6">
                    <a target="_blank" href="{{$post->url}}" class="whitespace-nowrap font-medium text-green-700 hover:text-green-600">See the post <span aria-hidden="true">&rarr;</span></a>
                </p>
            </div>
        </div>
    </div>
@endif

