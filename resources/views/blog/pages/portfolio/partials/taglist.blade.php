@if($project->tags->first())
    <div
        class="flex flex-wrap -ml-1 leading-relaxed mt-12 bg-gradient-to-r from-gray-100 via-gray-200 to-gray-50 rounded-lg">
        @foreach($project->tags as $tag)
            <a href="{{route('portfolio.tag', $tag->slug)}}" class="cursor-pointer text-xs mr-2 p-2 leading-6 text-gray-500 hover:text-sky-900/50 font-semibold tracking-wide py-1 rounded-lg uppercase hover:bg-gray-200/50 transition ease-in-out duration-150">
                {{$tag->name}}
            </a>
        @endforeach
    </div>
@endif
