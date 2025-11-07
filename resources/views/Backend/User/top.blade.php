<a href="{{route('about')}}">About</a> <br> <a href="{{route('home')}}">Home</a>


@if (Auth::guard('web')->check())
    <a href="{{route('dashboard')}}">dashboard</a>
    <a href="{{route('profile')}}">profile</a>
    <a href="{{route('logout')}}">logout</a>
@else
    <br> <a href="{{route('login')}}">Login</a> | <a href="{{route('register')}}">register</a>
@endif
