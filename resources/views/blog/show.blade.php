@extends('../layouts.app')

@section('content')

    <div class="container">

        <div class="row mb-2">

            <div class="col-md-3">
                <h2>{{ $post->title }}</h2>
            </div>

        </div>

        <div class="row">

            <div class="col-md-12">
                <div class="mb-1 text-muted">Created on {{ date('jS M Y', strtotime($post->updated_at)) }}</div>
                <div class="mb-1 text-muted">By {{ $post->user->name }}</div>
                <p class="card-text mb-auto">{{ $post->description }}</p>
            </div>
           
        </div>


    </div>

@endsection