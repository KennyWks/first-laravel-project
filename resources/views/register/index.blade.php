@extends('layouts.main')

@section('content')

<div class="row justify-content-center">
  <div class="col-lg-5">    
    <main class="form-registration">
      <h1 class="h3 mb-3 fw-normal text-center">Registration Form</h1>
      <form action="/register" method="POST">
        @csrf
        <div class="form-floating">
          <input type="text" name="name" class="form-control rounded-top @error('name') is-invalid @enderror" id="name" placeholder="Your name" value="{{old('name')}}">
          <label for="name">Name</label>
          @error('name')
          <div id="name" class="invalid-feedback">
            {{$message}}
          </div>
          @enderror
        </div>
        <div class="form-floating">
          <input type="text" name="username" class="form-control @error('username') is-invalid @enderror" id="username" placeholder="Your username" value="{{old('username')}}">
          <label for="username">Username</label>
          @error('username')
          <div id="username" class="invalid-feedback">
            {{$message}}
          </div>
          @enderror
        </div>
        <div class="form-floating">
          <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" name="email" id="email" placeholder="name@example.com" value="{{old('email')}}">
          <label for="email">Email address</label>
          @error('email')
          <div id="email" class="invalid-feedback">
            {{$message}}
          </div>
          @enderror
        </div>
        <div class="form-floating">
          <input type="password" name="password" class="form-control rounded-bottom @error('password') is-invalid @enderror" id="password" placeholder="Your password">
          <label for="password">Password</label>
          @error('password')
          <div id="password" class="invalid-feedback">
            {{$message}}
          </div>
          @enderror
        </div>
    
        <button class="w-100 btn btn-lg btn-danger mt-3" type="submit">Login</button>
      </form>
      <small class="d-block text-center mt-3">Already Registered? <a href="/login">Login</a></small>
    </main>
  
  </div>
</div>

@endsection
