@extends('base')

@section('title','Login' )

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-4 mx-auto">
            <h1 class="text-center text-muted mb-3 mt-5">Please sign in</h1>
           <p class="text-center text-muted mb-4">Your articlres are waiting for you</p>
           <form method=post action="{{route('login')}}">
               @csrf

            {{--on inclus le fichier d'alerts--}}
             @include('alerts.alert_message')



               
               @error('email')

                 <div class="alert alert-danger text-center" role="alert">
                       {{$message}}
                  </div>

               @enderror

               @error('password')

                   <div class="alert alert-danger text-center" role="alert">
                       {{$message}}
                   </div>

               @enderror

               <label for="email">Email</label>
               <input type="email" name="email" id="email" class="form-control mb-3 @error('email') is-invalid @enderror" value ="{{old('email')}}" required autocomplete="email" autofocus>


               <label for="password">password</label>
               <input type="password" name="password" id="password" class="form-control mb-3 @error('password') is-invalid @enderror"  required autocomplete="email" autofocus>

               <div class="row mb-3">
                  <div class="col-md-6">
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" role="switch" id="remenber" name="remenber" {{old('remenber') ? 'checked' :'' }}>
                        <label class="form-check-label" for="remenber">Remenber me</label>
                    </div>
                  </div>
                  <div class="col-md-6 text-end">
                       <a href="#">Forgot password?</a>
                  </div>
               </div>
               <div class="d-grid gap-2">

               <button class="btn btn-primary"type="submit">Sign in</button>
               </div>

               <p class="text-center text-muted mt-5">Not register yet ? <a href="{{route('register')}}">Create an count</p>
           </form>

        </div>
    </div>
</div>

@endsection