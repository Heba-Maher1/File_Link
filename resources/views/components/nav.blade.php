<div class="row">
    <div class="col-6">
        <div class="navbar-brand text-start">
            <img src="{{ asset('assets/logo.png') }}" width="100" height="100" class=""
                alt="">
        </div>
    </div>

    <div class="col-6">
        <nav class="navbar navbar-expand-lg navbar-light bg-white px-3 py-2 rounded" style="position: absolute; top: 22px; right: 20px;">
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link mx-3 {{ request()->is('plans') ? 'active' : '' }}" href="{{ route('plans') }}">Pricing</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link me-3 {{ request()->is('company') ? 'active' : '' }}" href="https://wetransfer.com/explore" target="_blank">Company</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link me-3 {{ request()->is('help') ? 'active' : '' }}" href="https://wetransfer.com/help">Help</a>
                    </li>
    
                    @auth <!-- Check if the user is authenticated -->
                        <li class="nav-item">
                            <a class="nav-link me-3" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                        </li>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
    
                        <li class="nav-item">
                            <span class="nav-link me-3 text-white rounded" style="background: #456991">{{ auth()->user()->name }}</span>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link me-3" href="{{ route('register') }}">Sign up</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link me-3" href="{{ route('login') }}">Log in</a>
                        </li>
                    @endauth
                </ul>
            </div>
        </nav>
    </div>   
</div>

