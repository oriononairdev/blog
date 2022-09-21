@if (flash()->message)
    <div
        class="rounded-md flex relative overflow-hidden shadow-md border-l-4 border-green-500 p-4 bg-opacity-100 mt-4 mb-4">
        <div class="text-green-500 w-5 h-6 mr-3 leading-5">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" fit="" height="100%"
                 width="100%" preserveAspectRatio="xMidYMid meet" focusable="false">
                <path fill-rule="evenodd"
                      d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                      clip-rule="evenodd"></path>
            </svg>
        </div>
        <div class="flex flex-col justify-center text-sm">
            <div class="text-green-500 font-semibold leading-5">{{flash()->message}}</div>
        </div>
    </div>
@endif

