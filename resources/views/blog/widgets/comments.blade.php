@if($post->isDev())
    <div class="markup mb-8">
        {{--<h2 id="comments">
            {{__('blog.comments')}}
            <a href="#comments" class="permalink">#</a>
        </h2>--}}
        <script src="https://utteranc.es/client.js"
                repo="oriononair/mu-comments"
                issue-term="pathname"
                theme="github-light"
                crossorigin="anonymous"
                async>
        </script>
    </div>
@endif
