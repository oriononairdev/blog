<div class="mb-8 -mx-4 sm:mx-0 p-4 sm:p-6 md:p-8 bg-yellow-50 border-b-5 border-yellow-500 text-sm text-gray-700">
    <!--<div class="markup mb-2">
        <h1>{{ __('blog.contact.title') }}</h1>
    </div>-->
    <form wire:submit.prevent="submitMessage">
        @if(session('success'))
            <div class="bg-green-50 border-l-4 p-4 mb-2">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg class="h-4 w-4 text-green-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div class="ml-3">
                        <p class="text-xs text-green-700">
                            {{session('success')}}
                            <a href="#" class="text-xs font-medium text-green-700 hover:text-green-600">
                                Kaydedilmemiş de olabilir.
                            </a>
                        </p>
                    </div>
                </div>
            </div>
        @endif
        <div class="relative mb-4">
            <label for="name" class="leading-7 text-xs text-gray-600">{{__('blog.contact.name')}}</label>
            <input wire:model="name" type="text" id="name" name="name"
                   class="@error('name') border border-red-300 @enderror w-full bg-white rounded border border-gray-300 focus:border-yellow-500 focus:ring-2 focus:ring-yellow-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
            @error('name') <span class="error text-xxs text-red-600">{{ $message }}</span> @enderror
        </div>
        <div class="relative mb-4">
            <label for="email" class="leading-7 text-xs text-gray-600">{{__('blog.contact.email')}}</label>
            <input wire:model="email" type="email" id="email" name="email"
                   class="@error('email') border border-red-300 @enderror w-full bg-white rounded border border-gray-300 focus:border-yellow-500 focus:ring-2 focus:ring-yellow-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
            @error('email') <span class="error text-xxs text-red-600">{{ $message }}</span> @enderror
        </div>
        <div class="relative mb-4">
            <label for="message" class="leading-7 text-xs text-gray-600">{{__('blog.contact.message')}}</label>
            <textarea wire:model="message" id="message" name="message"
                      class="@error('message') border border-red-300 @enderror w-full bg-white rounded border border-gray-300 focus:border-yellow-500 focus:ring-2 focus:ring-yellow-200 h-32 text-base outline-none text-gray-700 py-1 px-3 resize-none leading-6 transition-colors duration-200 ease-in-out"></textarea>
            @error('message') <span class="error text-xxs text-red-600">{{ $message }}</span> @enderror
        </div>
        <button type="submit" name="submit" id="submit"
                class="px-3 py-2 text-sm text-white items-center bg-yellow-500 font-semibold border-t-3 border-b-3 border-yellow-700 border-t-transparent disabled:opacity-50">
            <svg wire:loading wire:target="submitMessage" class="animate-spin h-5 w-5 mr-3 ..." viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor"
                      d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
            </svg>
            <span>{{__('blog.contact.submit')}}</span>
        </button>
    </form>
</div>
