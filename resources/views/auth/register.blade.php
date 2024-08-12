@extends('layouts.app')

@section('content')

<div class="container p-5 ">
    <div class="row">
        <div class="col-md-4 offset-md-4">
            <div class="card form-holder">
                <div class="card-body">
                    <h5 class="card-title text-center">Register</h5>
                    
                    <!-- Display session error messages -->
                    @if(Session::has('error'))
                        <p class="text-danger">{{ Session::get('error') }}</p>
                    @endif
                    
                    <!-- Display session success messages -->
                    @if(Session::has('success'))
                        <p class="text-success">{{ Session::get('success') }}</p>
                    @endif
                    
                    <!-- Registration form -->
                    <form action="{{ route('register') }}" method="post">
                        @csrf
                        @method('post')

                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" name="name" placeholder="Enter name" value="{{ old('name') }}">
                            @if($errors->has('name'))
                                <p class="text-danger">{{ $errors->first('name') }}</p>
                            @endif
                        </div>
                        
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
                        
                        <div class="form-group">
                            <label for="password_confirmation">Confirm Password</label>
                            <input type="password" class="form-control" name="password_confirmation" placeholder="Confirm Password">
                            @if($errors->has('password_confirmation'))
                                <p class="text-danger">{{ $errors->first('password_confirmation') }}</p>
                            @endif
                        </div>
                            <button type="submit" class="btn btn-primary">Register</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
