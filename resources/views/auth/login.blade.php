@extends('layouts.app')
@section('content')

<div class="container p-5 ">
    <div class="row">
        <div class="col-md-4 offset-md-4">
            <div class="card form-holder">
                <div class="card-body">
                    <h5 class="card-title text-center">Login</h5>
                    @if(Session::has('error'))
                        <p class="text-danger">{{ Session::get('error') }}</p>
                    @endif
                    @if(Session::has('success'))
                        <p class="text-success">{{ Session::get('success') }}</p>
                    @endif
                    <form action="{{ route('login') }}" method="post">
                        @csrf
                        @method('post')

                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" name="email" placeholder="Enter email" value="{{ old('email') }}">
                            @if($errors->has('email'))
                                <p class="text-danger">{{ $errors->first('email') }}</p>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" name="password" placeholder="Password">
                            @if($errors->has('password'))
                                <p class="text-danger">{{ $errors->first('password') }}</p>
                            @endif
                        </div>
                          <button type="submit" class="btn btn-primary">Login</button>  
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
