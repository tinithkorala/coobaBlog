@extends('../layouts.app')

@section('content')
    
    <div class="container">

        @if (session()->has('message'))
            <p>{{ session()->get('message') }}</p>
        @endif

        @if (Auth::check())

            <div class="row mb-2">

                <div class="col-md-3">
                    <a href="{{ route('blog.create') }}" class="btn btn-dark">Create Blog</a>
                </div>

            </div>
                
        @endif

        <div class="row mb-2">

            @foreach ($posts as $post)
            <div class="col-md-6">
                <div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
                    <div class="col p-4 d-flex flex-column position-static">
                        <strong class="d-inline-block mb-2 text-primary">World</strong>
                        <h3 class="mb-0">{{ $post->titile }}</h3>
                        <div class="mb-1 text-muted">Created on {{ date('jS M Y', strtotime($post->updated_at)) }}</div>
                        <div class="mb-1 text-muted">By {{ $post->user->name }}</div>
                        <p class="card-text mb-auto">{{ $post->description }}</p>
                        <a href="/blog/{{ $post->slug }}" class="stretched-link">Continue reading</a>

                        @if (isset(Auth::user()->id) && Auth::user()->id == $post->user_id)
                            <a href="/blog/{{ $post->slug }}/edit" class="stretched-link">Edit</a>    
                        @endif

                    </div>
                    <div class="col-auto d-none d-lg-block">
                        <svg class="bd-placeholder-img" width="200" height="250" xmlns="http://www.w3.org/2000/svg" role="img"
                            aria-label="Placeholder: Thumbnail" preserveAspectRatio="xMidYMid slice" focusable="false">
                            <title>Placeholder</title>
                            <rect width="100%" height="100%" fill="#55595c"></rect><text x="50%" y="50%" fill="#eceeef"
                                dy=".3em">Thumbnail</text>
                        </svg>
        
                    </div>
                </div>
            </div>
            @endforeach
            
        </div>
    </div>
    
@endsection