@extends('../layouts.app')

@section('content')

    <div class="container">

        <div class="row mb-2">

            <div class="col-md-3">
                <h2>Update Blog</h2>
            </div>

        </div>

        <div class="row">

            <form action="/blog/{{ $post->slug }}" method="POST" enctype="multipart/form-data"> 
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="title" class="form-label">Title</label>
                    <input type="text" name="title" id="title" class="form-control" value="{{ $post->titile }}">
                    @error('title')
                        <small class="fw-bold text-danger">{{ $message }}</small>    
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea name="description" id="description" cols="30" rows="10" class="form-control">{{ $post->description }}</textarea>
                    @error('description')
                        <small class="fw-bold text-danger">{{ $message }}</small>    
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="image" class="form-label">Image</label>
                    <input type="file" name="image" id="image" class="form-control">
                    @error('image')
                        <small class="fw-bold text-danger">{{ $message }}</small>    
                    @enderror
                </div>

                <button type="submit" class="btn btn-success">Submit Post</button>

            </form>

        </div>


    </div>

@endsection