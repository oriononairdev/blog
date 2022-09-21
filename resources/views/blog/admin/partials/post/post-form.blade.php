@section('page-level-css-initial')
    <link href="{{ asset('css/blog/admin/easymde.css') }}" rel="stylesheet">
@endsection
@section('page-level-css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="{{ asset('css/blog/tagify.css') }}" rel="stylesheet">
@endsection
@include('blog.partials.alerts.error-list')
{{-- color --}}
<datalist id="labels">
    <option>#7DD3FC</option>
    <option>#F87171</option>
    <option>#cbd5e0</option>
    <option>#FDE047</option>
    <option>#FDBA74</option>
    <option>#A5B4FC</option>
    <option>#6EE7B7</option>
    <option>#93C5FD</option>
</datalist>
<div class="mb-4 w-full sm:w-1/6 sm:pr-4">
    <label for="color">{{ __('Color') }}</label>
    <input value="{{ old('title', $post->color) }}"
           class="border-1 pr-3 pl-3 leading-6 border-gray-300 sm:mt-2 w-full rounded-md shadow-sm bg-white focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
           name="color" id="color" type="color" list="labels"
    >
</div>
{{-- title --}}
<div class="mb-4 w-full sm:w-5/6">
    <label for="title">{{ __('Title') }}</label>
    <input
        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
        id="title" type="text" autofocus value="{{ old('title', $post->title) }}" name="title">
</div>
{{-- insert badges or smth like that here --}}
<div class="mb-4 w-full sm:w-1/2 sm:pr-4">
    <label for="category_id">{{ __('Category') }}</label>
    <select
        class="block w-full mt-1 rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
        name="category_id" id="category_id">
        @foreach($categories as $category)
            <option @if ($post->category_id === $category->id) selected
                    @endif value="{{$category->id}}">{{$category->rawname}}</option>
        @endforeach
    </select>
</div>
{{-- Type --}}
<div class="mb-4 w-full sm:w-1/2">
    <label for="type">{{ __('Type') }}</label>
    <select
        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
        id="type" type="text"
        name="type">
        <option @if ($post->type === 'Original') selected @endif>Original</option>
        <option @if ($post->type === 'Link') selected @endif>Link</option>
        <option @if ($post->type === 'Portfolio') selected @endif>Portfolio</option>
    </select>
    <input id="initialType" hidden value="{{$post->type}}">
</div>
{{-- summary --}}
<div class="mb-4 w-full">
    <label for="summary">{{ __('Summary') }}</label>
    <textarea
        name="summary"
        id="summary"
        type="text"
        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 markdown-editor"
        data-upload-url="{{ $post->exists ? route('blog.admin.posts.upload', $post): '' }}"
        data-preview-url="{{ route('blog.admin.posts.preview') }}"
        data-max-size="{{ config('medialibrary.max_file_size') }}"
    >{{ old('summary', $post->summarymarkdown) }}</textarea>
</div>
<div id="local" class="w-full">
    {{-- content --}}
    <div class="mb-4 w-full">
        <label for="content">{{ __('Content') }}</label>
        <textarea
            name="content"
            id="content"
            rows="17"
            type="text"
            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 markdown-editor"
            data-upload-url="{{ $post->exists ? route('blog.admin.posts.upload', $post): '' }}"
            data-preview-url="{{ route('blog.admin.posts.preview') }}"
            data-max-size="{{ config('medialibrary.max_file_size') }}"
        >{{ old('content', $post->markdown) }}</textarea>
    </div>
</div>
<div id="external" class="hidden w-full mb-4">
    <label for="external_url">External URL</label>
    <div class="w-full mt-1 relative rounded-md shadow-sm">
        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" viewBox="0 0 20 20"
                 fill="currentColor">
                <path
                    d="M11 3a1 1 0 100 2h2.586l-6.293 6.293a1 1 0 101.414 1.414L15 6.414V9a1 1 0 102 0V4a1 1 0 00-1-1h-5z"/>
                <path d="M5 5a2 2 0 00-2 2v8a2 2 0 002 2h8a2 2 0 002-2v-3a1 1 0 10-2 0v3H5V7h3a1 1 0 000-2H5z"/>
            </svg>
        </div>
        <input type="text" value="{{ old('external_url', $post->external_url) }}" name="external_url" id="external_url"
               class="block w-full rounded-md border-gray-300 shadow-sm sm:text-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 pl-10"
               placeholder="https://">
    </div>
</div>
{{-- tags --}}
<div class="mb-4 w-full">
    <label for="tags">{{ __('Tags') }}</label>
    <input id="tags" name='tags' value='{{ old('tags',$post->alltags) }}'
           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
</div>
{{-- tweet_url --}}
<div class="mb-4 w-full">
    <label for="tweet_url">{{ __('Twitter URL') }}</label>
    <input type="text" id="tweet_url" name="tweet_url" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" value='{{ old('tweet_url', $post->tweet_url) }}'>
</div>
{{-- status --}}
<div class="mb-4 w-full sm:pr-3 sm:w-3/6">
    <label for="status">{{ __('Status') }}</label>
    <select
        class="block w-full mt-1 rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
        name="status" id="status">
        <option @if ($post->status === 'Published') selected @endif>{{__('Published')}}</option>
        <option @if ($post->status === 'Draft') selected @endif>{{__('Draft')}}</option>
        <option @if ($post->status === 'Archived') selected @endif>{{__('Archived')}}</option>
    </select>
</div>
{{-- publish date --}}
<div class="mb-4 w-full sm:w-3/6">
    <label for="published_at">{{ __('Publish Date') }}</label>
    <input
        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
        id="published_at" type="date" value="{{$post->published_at->format('Y-m-d')}}" name="published_at">
</div>
{{-- pinned --}}
<div class="mb-4 w-full sm:w-1/6">
    <label for="is_pinned">{{ __('Is pinned?') }}</label>
    <input id="is_pinned" name="is_pinned" value='1' @if($post->is_pinned) checked
           @endif class="rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
           type="checkbox">
</div>
{{-- delete --}}{{--
<div class="mb-4 sm:w-1/5 mt-4 ml-auto mr-auto">
    <form action="{{ route('blog.admin.posts.destroy', $post) }}" method="post">
        @csrf
        @method('DELETE')
        <button type="submit"
                class="block w-full h-10 mt-1 rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 btn bg-red-500 hover:bg-red-400 w-full rounded-sm">
            Delete
        </button>
    </form>
</div>--}}
{{-- submit --}}
<div class="mb-4 sm:w-1/5 mt-4 ml-auto">
    <button type="submit"
            class="block w-full h-10 mt-1 rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 btn bg-green-400 hover:bg-green-400/75 w-full rounded-sm">{{ $submitText }}</button>
</div>

@section('page-level-js')
    <script src="{{asset('js/blog/admin/tagify.min.js')}}"></script>
    <script src="{{asset('js/blog/admin/tagify.polyfills.min.js')}}"></script>
    <script>
        let initialType = document.getElementById('initialType');
        let type = document.getElementById('type');
        if (initialType.value === 'Link') {
            updateTo('external')
        }
        type.addEventListener('change', (event) => {
            if (event.target.value === 'Link') {
                updateTo('external');
                return
            }
            updateTo('local');
        });

        function updateTo(type, cm) {
            document.getElementById(type).classList.remove('hidden');
            if (type === 'external') {
                document.getElementById('local').classList.add('hidden');
                return;
            }
            document.getElementById('external').classList.add('hidden');
        }

        var tags = document.querySelector('input[name=tags]');
        new Tagify(tags)
    </script>
    <script src="{{ mix('js/blog/admin/text-editor.js')}}" charset="utf-8"></script>
@endsection
