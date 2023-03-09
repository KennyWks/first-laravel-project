@extends('layouts.main')

@section('content')

<div class="container">
    <div class="row justify-content-center mb-5">
        <div class="col-md-8">
            <article class="mt-3">
                <h3 class="mb-3">{{$row["title"]}}</h3>
                <p>By <a class="text-decoration-none" href="/posts?author={{$row->author->username}}">{{$row->author->name}}</a> in <a class="text-decoration-none" href="/posts?category={{$row->category->slug}}">{{$row->category->name}}</a> </p>
                {{-- <p>{{$row["body"]}}</p> --}}
                
                @if ($row->image)
                <div style="height: 350px; overflow:hidden">
                    <img src="{{ asset('storage/'.$row->image) }}" alt="{{$row->category->name}}"
                        class="img-fluid card-img-top">
                </div>
                @else
                <img src="https://source.unsplash.com/1200x400?{{$row->category->name}}"
                    alt="{{$row->category->name}}" class="img-fluid card-img-top">
                @endif

                <article class="my-3 fs-5">
                    {!! $row["body"] !!}
                </article>
                <a class="d-block mt-3 text-decoration-none" href="/posts">Back to Posts</a>
            </article>
        </div>
    </div>
</div>

@endsection
