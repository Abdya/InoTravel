Hello <i>{{$user->firstName}} {{$user->firstName}}</i>!
<p>This is link for password reset</p><hr>
<a href="inotravel.local/change-pass/?token={{$user->remember_token}}&user_id={{$user->id}}">Click here</a>