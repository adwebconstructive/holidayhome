<!-- header -->
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
        <a class="navbar-brand" href="{{ asset('plugins/frontend/images/logo.png') }}"><img
                src="{{asset('plugins/frontend/images/logo.png')}}" alt="holiday crown"></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02"
                aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse navbar-right" id="navbarTogglerDemo02">
            <ul class="navbar-nav ml-auto f-color">
                <li><a href="{{ route('home') }}" class="nav-item">Home </a></li>
                <li><a href="" class="nav-item">Rooms & Tariff</a></li>
                @auth
                    @if(auth()->user()->role == 1)
                        <li><a href="{{route('admin.dashboard')}}" class="nav-item">Dashboard</a></li>
                    @else
                        <li><a href="{{route('user.profile')}}" class="nav-item">Profile</a></li>
                        <li><a href="{{route('user.reservation')}}" class="nav-item">My Booking</a></li>
                    @endif

                    <li><a href="{{route('logout')}}" class="nav-item">Logout</a></li>
                @endauth
                @guest
                    <li><a href="{{route('login')}}" class="nav-item">Login</a></li>
                @endguest
            </ul>
        </div>
    </div>
</nav>
