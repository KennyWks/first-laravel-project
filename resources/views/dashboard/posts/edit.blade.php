@extends('dashboard.layouts.main')

@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Update post</h1>
</div>

<div class="col-lg-8">
    <form method="POST" action="/dashboard/posts/{{ $post->slug }}" class="mb-3" enctype="multipart/form-data">
        @method('put')
        @csrf
        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" value="{{old('title', $post->title)}}" name="title"
                class="form-control @error('title') is-invalid @enderror" id="title" autofocus autocomplete="false">
            @error('title')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="slug" class="form-label">Slug</label>
            <input type="text" value="{{old('slug', $post->slug)}}" name="slug"
                class="form-control @error('slug') is-invalid @enderror" id="slug" readonly>
            @error('slug')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="category_id" class="form-label">Categories</label>
            <select value="{{old('category_id', $post->category_id)}}"
                class="form-select @error('category_id') is-invalid @enderror" name='category_id' id="category_id">
                <option value="" selected>Open this select category</option>
                @foreach ($categories as $category)
                @if (old('category_id', $post->category_id) == $category->id)
                <option value="{{ $category->id }}" selected>{{ $category->name }}</option>
                @else
                <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endif
                @endforeach
            </select>
            @error('category_id')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        @if ($post->image)
            <img src="{{ asset('storage/'.$post->image) }}" class="img-preview img-fluid mb-3 col-sm-5">
        @else
            <img class="img-preview img-fluid mb-3 col-sm-5">
        @endif
        <div class="input-group mb-3">
            <input type="hidden" name="oldImage" value="{{ $post->image }}">
            <label class="input-group-text" for="image">Post Image</label>
            <input type="file" onchange="previewImage()" class="form-control @error('image') is-invalid @enderror"
                id="image" name="image">
            @error('image')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="mb-1">
            <label for="body" class="form-label">Body</label>
            @error('body')
            <div id="body" class="text-danger mb-1">
                {{ $message }}
            </div>
            @enderror
            <input id="x" value="{{old('body', $post->body)}}" type="hidden" name="body">
            <trix-editor input="x"></trix-editor>
        </div>

        <button type="submit" class="btn btn-primary">Update post</button>
    </form>
</div>
<script>
    const title = document.querySelector('#title');
    const slug = document.querySelector('#slug');

    title.addEventListener('change', function () {
        fetch('/dashboard/posts/checkSlug?title=' + title.value)
        .then(response => response.json())
        .then(data => {
            slug.setAttribute('value', data.value); 
        })
    })

    document.addEventListener('trix-file-accept', function(e) {
        e.preventDefault();
    })

    function previewImage() {
        const image = document.querySelector('#image');
        const imgPreview = document.querySelector('.img-preview');
                
        imgPreview.style.display = 'block';
               
        const oFReader = new FileReader();
        oFReader.readAsDataURL(image.files[0]);    
        oFReader.onload = function (oFREvent) {
            imgPreview.src = oFREvent.target.result;
        }            
    }
</script>
@endsection