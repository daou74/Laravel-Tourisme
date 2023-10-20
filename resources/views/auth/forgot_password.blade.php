@extends('base')

@section('title','Forgot password' )

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-4 mx-auto">
            <h1 class="text-center text-muted mb-3 mt-5">Forgot password</h1>
           <p class="text-center text-muted mb-4">Please enter your email address , we'll send you a link to reset your password</p>

           <form action="{{route('app_forgotpassword')}}" method="post">

               @csrf

               {{--on inclus le fichier d'alerts--}}
                 @include('alerts.alert_message')

                 <label for="email-send" class="form-label">Email</label>
                 <input type="email" name="email-send" id="email-send" class="form-control" placeholder="Please enter your email address">

                 <div class="d-grid gap-2 mt-4 mb-5">

                    <button class="btn btn-primary"type="submit">Resend password</button>
                </div>

                <p class="text-center text-muted">Back to <a href="{{route('login')}}">login</a></p>

           </form>
        <div>

    </div>
</div>
@endsection
