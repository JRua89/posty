<!DOCTYPE html>
<html>
<head>
<title>Posty</title>
<link href="{{ asset('css/app.css') }}" rel="stylesheet" />
</head>
<body class="bg-gray-200">
    <nav class="p-6 bg-white flex justify-between mb-6">
        <ul class="flex items-center">
        <li><a href="/" class="p-3">Home</a></li>
        <li><a href="{{ route('dashboard') }}" class="p-3">Dashboard</a></li>
        <li><a href="{{ route('posts') }}" class="p-3">Post</a></li>
        </ul>

        <ul class="flex items-center">
            @if(auth()->check())
            
            <li><a href="" class="p-3">{{ auth()->user()->name }}</a></li>
            <form action="{{ route('logout') }}" method="post" class="p-3 inline">
                @csrf
           <button type="submit">Log Out</Out></button>
            </form>
            
            @else

            
            <li><a href="{{ route('register') }}" class="p-3">Register</a></li>
            <li><a href="{{ route('login') }}" class="p-3">Login</a></li> 
            
        @endif
        </ul>
    </nav>
@yield('content')

</body>
</html>