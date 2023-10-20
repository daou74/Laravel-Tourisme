@extends('base')

@section('title','Change your email address' )

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-4 mx-auto">
        <h2 class="text-center text-muted mb-3 mt-5">Change your email address</h2>

        {{--on inclus le fichier d'alerts--}}
         @include('alerts.alert_message')


        <form action="{{route('app_activation_account_change_email', ['token'=>$token])}}" method="post">
                  
              @csrf
              

              <div class="mb-3">
                  <label for="new email" class="form-label">New email address</label>
                  <input type="email" class="form-control @if(Session::has('danger')) is-invalid @endif" name="new-email" value="@if(Session::has('new_email')){{ Session::get('new_email') }}@endif" placeholder="Enter the new email address" required>
              </div>

              <div class="d-grid gap-2">

                   <button class="btn btn-primary" type="submit">Change</button>

              </div>

        </form>

        

        </div>
    </div>
</div>


@endsection