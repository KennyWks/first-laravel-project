@extends('dashboard.layouts.main')

@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">My post</h1>
</div>
@if (session()->has('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif
@if($posts->count())

<div class="table-responsive">
    <a href="/dashboard/posts/create" class="btn btn-primary mb-3">Create new post</a>
    <form class="app-search" method="get" action="">
        <div class="app-search-box">
            <div class="input-group">
                <input type="text" name="search" class="form-control" placeholder="Search..." id="top-search">
                <button class="btn input-group-text" type="submit">
                    <i class="fe-search"></i>
                </button>
            </div>
        </div>
    </form>
    <table class="table table-striped table-sm">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Title</th>
                <th scope="col">Category</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($posts as $post)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $post->title }}</td>
                <td>{{ $post->category->name }}</td>
                <td><a href="/dashboard/posts/{{ $post->slug }}" class="badge bg-info"><span
                            data-feather="eye"></span></a>
                    <a href="/dashboard/posts/{{ $post->slug }}/edit" class="badge border-0 bg-warning"><span
                            data-feather="edit"></span></a>
                    <form action="/dashboard/posts/{{ $post->slug }}" method="post" class="d-inline">
                        @method('delete')
                        @csrf
                        <button class="badge bg-danger border-0"
                            onclick="return confirm('Are you sure to remove this data?')">
                            <span data-feather="x-circle">
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @else
    <p class="text-center fs-4">No post found.</p>
    @endif

    <div class="d-flex justify-content-center">
        {{$posts->links()}}
    </div>

</div>
@endsection