@extends('layouts.main')

@section('content')

<h2>About Page</h2>
<h4>{{$name}}</h4>
<p>{{$email}}</p>
<img src="img/{{$img}}" alt="{{$name}}" width="200">

@endsection
