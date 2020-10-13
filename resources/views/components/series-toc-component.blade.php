<p
      class="-mx-4 mb-8 sm:mx-0 p-4 sm:p-6 md:p-8 bg-gray-100 border-b-5 border-gray-200 text-xs text-gray-700 {{ $class ?? '' }}">
        <div class="pb-4">
            This post is a part of a series where we explore the source code of <a
                href="https://spatie.be">spatie.be</a> which
            you&#39;ll find in <a href="https://github.com/spatie.be">this repo on GitHub</a>/
        </div>
        @foreach($allPostsInSeries as $post)
            <ul class="list-none">
                <li>
                    @if ($post->id === $currentPost->id)
                        {{ $post->series_toc_title }} (you are here)
                    @else
                        <a href="{{ route('post', $post->slug) }}">{{ $post->series_toc_title }}</a>
                    @endif
                </li>
            </ul>
        @endforeach
</p>
