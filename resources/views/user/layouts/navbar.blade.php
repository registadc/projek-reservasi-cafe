<nav class="navbar-user">
    <div class="nav-container">

        <div class="judul">giee</div>

        <div class="nav-menu">
            <a href="{{ route('user.dashboard') }}">Home</a>
            <a href="#">Reservasi</a>
        </div>

        <div class="nav-icons">

            <a href="">
                <i class="fa-solid fa-book"></i>
            </a>

            @auth
            <div class="user-dropdown">
                <i class="fa-solid fa-user" onclick="toggleDropdown()"></i>

                <div class="dropdown-menu" id="dropdownMenu">

                    <a href="{{ route('user.profile') }}" class="card-btn" 
                    style="background: white;
                        border: 1px solid rgb(193, 193, 193);
                        margin-top: 10px; 
                        text-decoration: none;
                        ">Profil</a>

                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="card-btn" style="background: red;
                        border: 1px solid rgb(193, 193, 193);
                        margin-top: 10px; 
                        text-decoration: none;
                        color: white;
                        ">Logout</button>
                    </form>
                </div>
            </div>
            @endauth

        </div>

    </div>
</nav>