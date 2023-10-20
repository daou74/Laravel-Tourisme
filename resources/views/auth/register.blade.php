@extends('base')

@section('title','Register' )

@section('content')
   
    <div class="contaner">
        <div class="row">
            <div class="col-md-6 mx-auto">
                <h1 class="text-center text-muted mb-3 mt-5">
                    Register
                </h1>
                <p class="text-center text-muted mb-4">Create an count if you don't have one</p>

                <form method='post'action="{{route('register')}}" class="row g-3" id="form-register">
                    @csrf

                    <div class="col-md-6">
                        <label for="firstname" class="form-label">First Name</label>
                        <input type="text" class="form-control" id="firstname" name='firstname' value="{{old('firstname')}}" require autocomplete="firstname" autofocus>

                        <small class="text-danger fw-bold" id="error-register-firstname"></small>
                    </div>
                    <div class="col-md-6">
                        <label for="lastname" class="form-label">Last Name</label>
                        <input type="text" class="form-control" name="lastename" id  ="lastname" value="{{old('lastname')}}" require autocomplete="lastname" autofocus >

                        <small class="text-danger fw-bold" id="error-register-lastname"></small>
                    </div>
                    <div class="col-md-12">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" name="email" id="email" value="{{old('email')}}" require autocomplete="email" url-emailExist="{{ route('app_exist_email')}}" token="{{csrf_token()}}" >

                        <small class="text-danger fw-bold" id="error-register-email"></small>
                    </div>

                    <div class="col-md-6">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" name="password" id="password" value="{{old('password')}}" require autocomplete="password" autofocus >

                        <small class="text-danger fw-bold" id="error-register-password"></small>
                    </div>

                    <div class="col-md-6">
                        <label for="password-confirm" class="form-label">Password Confirmation</label>
                        <input type="password" class="form-control" name="password-confirm" id="password-confirm" value="{{old('password-confirm')}}" require autocomplete="password-confirm" autofocus >

                        <small class="text-danger fw-bold" id="error-register-password-confirm"></small>

                    </div>
                    <div class="col-md-12">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="agreeterms">
                        <label class="form-check-label" for="agreeterms">Agree Terms</label><br>
                        <small class="text-danger fw-bold" id="error-register-agreeterms"></small>

                    </div>

                    </div>
                    <div class="d-grid gap-2">
                          <button class="btn btn-primary" type="button" id="register-user">Register</button>

                    </div>

                    <p class="text-center text-muted mt-5">Alrealy have an account ? <a href="{{route('login')}}">Login</p>
                    
                    
                </form>
            </div>
        </div>
    </div>
@endsection