@extends('layouts.main')

@section('content')

<div class="container">
    <div class="row justify-content-center mb-5">
        <div class="col-md-8">
            <article class="mt-3">
                <h3 class="mb-3">{{$row["title"]}}</h3>
                <p>By <a class="text-decoration-none" href="/articles?author={{$row->author->username}}">{{$row->author->name}}</a> in <a class="text-decoration-none" href="/articles?categoryModel={{$row->categoryModel->slug}}">{{$row->categoryModel->name}}</a> </p>
                {{-- <p>{{$row["body"]}}</p> --}}
                <img src="https://source.unsplash.com/1200x400?{{$row->categoryModel->name}}" class="card-img-top" alt="{{$row->categoryModel->name}}" class="img-fluid">
                <article class="my-3 fs-5">
                    {!! $row["body"] !!}
                </article>
                <a class="d-block mt-3 text-decoration-none" href="/articles">Back to articles</a>
            </article>
        </div>
    </div>
</div>

@endsection
