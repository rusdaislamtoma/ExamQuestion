@component('mail::message')
Dear {{$data['name']}},
#Congratulations !!<br>
{{$data['massage']}}<br>

##Credentials
Email : {{$data['email']}}<br>
Password : {{$data['password']}}<br>
@component('mail::button', ['url' => $data['loginUri']])
    Login
@endcomponent

<b>N:B:</b><i>Please update your password as soon as possible.</i><br>
Thanks,<br>
Support Team,<br>
{{ config('app.name') }}
@endcomponent