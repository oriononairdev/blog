@if ($errors->any())
    <div
        class="w-full rounded-md flex relative overflow-hidden shadow-md border-l-4 border-red-500 p-4 bg-opacity-100 mb-6 text-sm">
        <div class="text-red-500 w-5 h-6 mr-3 leading-5">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" fit="" height="100%"
                 width="100%" preserveAspectRatio="xMidYMid meet" focusable="false">
                <path fill-rule="evenodd"
                      d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                      clip-rule="evenodd"></path>
            </svg>
        </div>
        <div class="flex flex-col justify-center text-sm">
            <ul>
                @foreach ($errors->all() as $error)
                    <li class="text-gray-600 mt-1">{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    </div>
@endif
