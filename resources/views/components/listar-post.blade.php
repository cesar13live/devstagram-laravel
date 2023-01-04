<div>
    <!-- It is never too late to be what you might have been. - George Eliot -->
    @if ($posts->count())
        
<div class="grid md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-5">
    @foreach ($posts as $post)
        <div>
            <a href="{{ route('posts.show', ['post' => $post, 'user' => $post->user]) }}">

                <img src="{{ asset('uploads') . '/' . $post->imagen }}" alt="IMG_POST">
            </a>
        </div>
    @endforeach
</div>
  
@endif

</div>