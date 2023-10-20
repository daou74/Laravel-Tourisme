<h1>Hi {{ $name }} please confirm your email</h1>
<p> 
    Please activation your account by coping and pasting the activation code.
    <br>activation code : {{ $activation_code}}. <br>
    Or by clicking the following link : <br>
    <a href="{{route('app_activation_account_link', ['token' => $activation_token])}}" target="blank">confirm your account</a>
</p>
<p>
    Tourisme team.
</p>