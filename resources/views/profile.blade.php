@extends('layouts.app')

@section('title', 'User Profile')

@section('content')

    <div class="row">
      <div class="col-md-4">
        <div class="card card-user">
          <div class="image">
            <img src="{{config('app.url')}}/assets/img/bg/damir-bosnjak.jpg" alt="...">
          </div>
          <div class="card-body">
            <div class="author">
                <img class="avatar border-gray" src="{{config('app.url')}}/assets/img/default-avatar.png" alt="...">
                <h5 class="title">{{ Auth::user()->name }}</h5>
                <p>{{ Auth::user()->email }}</p>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-8">
        <div class="card">
          <div class="card-header">
            <h5 class="title">Edit Profile</h5>
          </div>
          <div class="card-body">
            <form method="POST" action="{{ route('profile.update', $user_profile->id) }}">
                @csrf
                {{Form::hidden ('_method','PUT')}}
                <div class="row">
                    <div class="col-md-6 pr-1">
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{$user_profile->name}}">
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6 pr-1">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Email address</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{$user_profile->email}}">
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>     
                </div>
                <div class="row">
                    <div class="col-md-6 pr-1">
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" class="form-control" name="password">
                        </div>
                    </div>
                    <div class="col-md-6 pr-1">
                        <div class="form-group">
                            <label>Confirm Password</label>
                            <input type="password" class="form-control" name="cpassword">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                      <button class="btn btn-info btn-round">Update</button>
                    </div>
                </div>
            </form>
          </div>
        </div>
      </div>
    </div>

@endsection
