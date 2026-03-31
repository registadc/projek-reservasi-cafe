<nav class="navbar">
    <div class="nav-container">

        <div class="judul">giee</div>

        <div class="nav-menu">
            <a href="">Home</a>
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
                    <p><strong>{{ Auth::user()->name }}</strong></p>

                    <a href="#">Profil</a>

                    <form action="" method="POST">
                        @csrf
                        <button type="submit">Logout</button>
                    </form>
                </div>
            </div>
            @endauth

        </div>

    </div>
</nav>