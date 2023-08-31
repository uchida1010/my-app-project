<header class="header">
    <div class="header-container">
        <div class="logo-wrap">
        <div class="logo-text">
        <a href="{{ url('todolist')}}">
        Laravel TODOアプリ
        </a>
        </div>
        </div>
        
        <div class="navbar-wrap" >
            <ul class="navbar-box">
                <li class="nav-item">
                    <a class="nav-link" href="#">Home
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">About</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Services</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Contact</a>
                </li>
                <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button class="btn-logout nav-link">
                Logout
                </button>
                </form>
            </ul>
        </div>
    </div>
</header>