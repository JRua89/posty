<!DOCTYPE html>
<html>
<head>
<title>Posty</title>
<link href="{{ asset('css/app.css') }}" rel="stylesheet" />
</head>
<body class="bg-gray-200">
    <nav class="p-6 bg-white flex justify-between mb-6">
        <ul class="flex items-center">
        <li><a href="" class="p-3">Home</a></li>
        <li><a href="" class="p-3">Dashboard</a></li>
        <li><a href="" class="p-3">Post</a></li>
        </ul>

        <ul class="flex items-center">
            @if(auth()->user())
            <li><a href="" class="p-3">{{ auth()->user()->name }}</a></li>
            <li><a href="" class="p-3">Log Out</Out></a></li>
            @else
            <li><a href="{{ route('register') }}" class="p-3">Register</a></li>
            <li><a href="" class="p-3">Login</a></li>
            @endif

    
        
       
        
        </ul>
    </nav>
@yield('content')

</body>
</html>