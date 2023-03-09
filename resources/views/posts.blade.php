@extends('layouts.main')

@section('content')

<h2 class="text-center mb-3">{{$title}}</h2>

<div class="container">
    <div class="row justify-content-center mb-3">
        <div class="col-md-6">
            <form action="/posts" method="GET">
                <div class="input-group mb-3">
                    @if (request('category'))
                        <input type="hidden" name="category" value="{{request('category')}}">
                    @endif
                    @if (request('author'))
                        <input type="hidden" name="author" value="{{request('author')}}">
                    @endif
                    <input type="text" class="form-control" placeholder="Search..." name="search" value="{{request('search')}}">
                    <button class="btn btn-danger" type="submit" id="button-addon2">Search</button>
                  </div>
            </form>
        </div>
    </div>
</div>

@if($rows->count())
    <div class="card mb-3">

        @if ($rows[0]->image)
        <div style="height: 350px; overflow:hidden">
            <img src="{{ asset('storage/'.$rows[0]->image) }}" alt="{{$rows[0]->category->name}}"
                class="img-fluid card-img-top">
        </div>
        @else
        <img src="https://source.unsplash.com/1200x400?{{$rows[0]->category->name}}"
            alt="{{$rows[0]->category->name}}" class="img-fluid card-img-top">
        @endif
        

        <div class="card-body text-center">
        <h3 class="card-title"><a href="/post/{{$rows[0]->slug}}" class="text-decoration-none text-dark">{{$rows[0]->title}}</a></h3>
        <p>
            <small class="text-muted">By <a class="text-decoration-none" href="/posts?author={{$rows[0]->author->username}}">{{$rows[0]->author->name}}</a> in <a href="/posts?category={{$rows[0]->category->slug}}" class="text-decoration-none">{{$rows[0]->category->name}}</a>  {{$rows[0]->created_at->diffForHumans()}}
            </small>
        </p>
        <p class="card-text">{{$rows[0]->excerpt}}</p>
        <a class="text-decoration-none btn btn-primary" href="/post/{{$rows[0]->slug}}">Read more...</a>

        </div>
    </div>

<div class="container">
    <div class="row">
        @foreach ($rows->skip(1) as $row)
        <div class="col-md-4 mb-3">
            <div class="card">
                <div class="position-absolute px-3 py-3 text-white" style="background-color:rgba(0, 0, 0, 0.7)"><a class="text-decoration-none" href="/posts?category={{$row->category->slug}}">{{$row->category->name}}</a></div>
                
                @if ($row->image)
                <div style="height: 350px; overflow:hidden">
                    <img src="{{ asset('storage/'.$row->image) }}" alt="{{$row->category->name}}"
                        class="img-fluid card-img-top">
                </div>
                @else
                <img src="https://source.unsplash.com/1200x400?{{$row->category->name}}"
                    alt="{{$row->category->name}}" class="img-fluid card-img-top">
                @endif

                <div class="card-body">
                  <h5 class="card-title"><a class="text-decoration-none" href="/post/{{$row["slug"]}}">{{$row["title"]}}</a></h5>
                  <p>
                    <small class="text-muted">By <a class="text-decoration-none" href="/posts?author={{$row->author->username}}">{{$row->author->name}}</a> {{$row->created_at->diffForHumans()}}
                    </small>
                </p>
                  <p class="card-text">{{$row["excerpt"]}}</p>
                  <a href="/post/{{$row["slug"]}}" class="btn btn-primary">Read more...</a>
                </div>
              </div>
        </div>
        @endforeach
    </div>
</div>

@else
    <p class="text-center fs-4">No post found.</p>
@endif

<div class="d-flex justify-content-center">
    {{$rows->links()}}
</div>

@endsection
