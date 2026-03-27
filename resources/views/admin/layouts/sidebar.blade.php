<!-- Sidebar -->
        <aside class="sidebar" id="sidebar">
            <div class="sidebar-header">
                <div class="logo">G</div>
                <span class="logo-text">Giee Cafe</span>
            </div>

            <ul class="nav-menu">
                <li class="nav-section">
                    <span class="nav-section-title">Main Menu</span>
                    <ul>
                        <li class="nav-item">
                            <a href="index.html" class="nav-link active">
                                <svg class="nav-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <rect x="3" y="3" width="7" height="7" rx="1"/>
                                    <rect x="14" y="3" width="7" height="7" rx="1"/>
                                    <rect x="3" y="14" width="7" height="7" rx="1"/>
                                    <rect x="14" y="14" width="7" height="7" rx="1"/>
                                </svg>
                                Dashboard
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.reservasi.index') }}" class="nav-link">
                                <i class="fa-solid fa-calendar-check nav-icon"></i>
                                Reservasi
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.menu.index') }}" class="nav-link">
                                <i class="fa-solid fa-utensils nav-icon"></i>
                                Menu
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.meja.index') }}" class="nav-link">
                                <i class="fa-solid fa-chair nav-icon"></i>
                                Meja
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.users.index') }}" class="nav-link">
                                <i class="fa-solid fa-users nav-icon"></i>
                                Users
                            </a>
                        </li>
                        
                    </ul>
                </li>

                <li class="nav-section">
                    <span class="nav-section-title">Account</span>
                    <ul>
                        <li class="nav-item">
                            <a href="#" class="nav-link" 
                             onclick="event.preventDefault(); document.getElementById('form-logout').submit();">
                                <svg class="nav-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/>
                                    <polyline points="16 17 21 12 16 7"/>
                                    <line x1="21" y1="12" x2="9" y2="12"/>
                                </svg>
                                Logout
                            </a>
                             <form id="form-logout" action="{{ route('logout') }}" method="POST" class="d-none">
                          @csrf
                        </form>
                        </li>
                    </ul>
                </li>
            </ul>
        </aside>