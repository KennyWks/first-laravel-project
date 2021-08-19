@extends('layouts.main')

@section('content')

<h2 class="text-center mb-3">{{$title}}</h2>

<div class="container">
    <div class="row justify-content-center mb-3">
        <div class="col-md-6">
            <form action="/articles" method="GET">
                <div class="input-group mb-3">
                    @if (request('categoryModel'))
                        <input type="hidden" name="categoryModel" value="{{request('categoryModel')}}">
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
        <img src="https://source.unsplash.com/1200x400?{{$rows[0]->categoryModel->name}}" class="card-img-top" alt="{{$rows[0]->categoryModel->name}}">
        <div class="card-body text-center">
        <h3 class="card-title"><a href="/article/{{$rows[0]->slug}}" class="text-decoration-none text-dark">{{$rows[0]->title}}</a></h3>
        <p>
            <small class="text-muted">By <a class="text-decoration-none" href="/articles?author={{$rows[0]->author->username}}">{{$rows[0]->author->name}}</a> in <a href="/articles?categoryModel={{$rows[0]->categoryModel->slug}}" class="text-decoration-none">{{$rows[0]->categoryModel->name}}</a>  {{$rows[0]->created_at->diffForHumans()}}
            </small>
        </p>
        <p class="card-text">{{$rows[0]->excerpt}}</p>
        <a class="text-decoration-none btn btn-primary" href="/article/{{$rows[0]->slug}}">Read more...</a>

        </div>
    </div>

<div class="container">
    <div class="row">
        @foreach ($rows->skip(1) as $row)
        <div class="col-md-4 mb-3">
            <div class="card">
                <div class="position-absolute px-3 py-3 text-white" style="background-color:rgba(0, 0, 0, 0.7)"><a class="text-decoration-none" href="/articles?categoryModel={{$row->categoryModel->slug}}">{{$row->categoryModel->name}}</a></div>
                <img src="https://source.unsplash.com/500x400?{{$row->categoryModel->name}}" class="card-img-top" alt="{{$row->categoryModel->name}}">
                <div class="card-body">
                  <h5 class="card-title"><a class="text-decoration-none" href="/article/{{$row["slug"]}}">{{$row["title"]}}</a></h5>
                  <p>
                    <small class="text-muted">By <a class="text-decoration-none" href="/articles?author={{$row->author->username}}">{{$row->author->name}}</a> {{$row->created_at->diffForHumans()}}
                    </small>
                </p>
                  <p class="card-text">{{$row["excerpt"]}}</p>
                  <a href="/article/{{$row["slug"]}}" class="btn btn-primary">Read more...</a>
                </div>
              </div>
        </div>
        @endforeach
    </div>
</div>

@else
    <p class="text-center fs-4">No article found.</p>
@endif

<div class="d-flex justify-content-center">
    {{$rows->links()}}
</div>

@endsection
