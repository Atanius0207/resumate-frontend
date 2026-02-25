{{-- Navigation Bar Component --}}
<nav>
    <div class="nav-container">
        {{-- Logo --}}
        <a href="{{ url('/') }}" class="logo">
            <svg class="logo-icon" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M6 6C6 3.79086 7.79086 2 10 2H20L28 10V28C28 30.2091 26.2091 32 24 32H10C7.79086 32 6 30.2091 6 28V6Z" fill="var(--primary-color)"/>
                <path d="M20 2V8C20 9.10457 20.8954 10 22 10H28L20 2Z" fill="var(--primary-hover)"/>
                <rect x="10" y="14" width="12" height="2" rx="1" fill="white" fill-opacity="0.9"/>
                <rect x="10" y="19" width="12" height="2" rx="1" fill="white" fill-opacity="0.9"/>
                <rect x="10" y="24" width="8" height="2" rx="1" fill="white" fill-opacity="0.9"/>
            </svg>
            <span>{{ config('app.name', 'ResuMate') }}</span>
        </a>

        {{-- Right Section --}}
        <div class="nav-right">
            {{-- Main Navigation Menu --}}
            <ul class="nav-menu" id="navMenu">
                <li>
                    <a href="{{ url('/') }}" class="{{ request()->is('/') ? 'active' : '' }}">
                        Home
                    </a>
                </li>
                <li>
                    <a href="{{ route('features') }}" class="{{ request()->routeIs('features') ? 'active' : '' }}">
                        Features
                    </a>
                </li>
                <li>
                    <a href="{{ route('templates') }}" class="{{ request()->routeIs('templates') ? 'active' : '' }}">
                        Templates
                    </a>
                </li>
                <li>
                    <a href="{{ route('pricing') }}" class="{{ request()->routeIs('pricing') ? 'active' : '' }}">
                        Pricing
                    </a>
                </li>

                @auth
                    <li>
                        <a href="{{ url('/dashboard') }}" class="{{ request()->is('dashboard*') ? 'active' : '' }}">
                            Dashboard
                        </a>
                    </li>
                @else
                    <li>
                        <a href="{{ route('login') }}" class="{{ request()->routeIs('login') ? 'active' : '' }}">
                            Login
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('register') }}" class="btn-register {{ request()->routeIs('register') ? 'active' : '' }}">
                            Register Now →
                        </a>
                    </li>
                @endauth
            </ul>

            {{-- Theme Toggle Button --}}
            <button class="theme-toggle-btn" id="themeToggle" title="Toggle Theme" aria-label="Toggle Theme">
                <i class="fas fa-moon"></i>
            </button>

            {{-- User Profile Dropdown (for logged-in users) --}}
            @auth
            <div class="nav-profile" id="navProfile">
                <button class="nav-avatar-btn" id="profileToggle" aria-label="User menu" title="{{ auth()->user()->name }}">
                    @if(auth()->user()->avatar)
                        <img src="{{ asset('storage/' . auth()->user()->avatar) }}" alt="{{ auth()->user()->name }}">
                    @else
                        {{-- Use initials if no image --}}
                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                    @endif
                </button>

                <div class="profile-dropdown" id="profileDropdown">
                    <div class="dropdown-header">
                        <div class="dropdown-name">{{ auth()->user()->name }}</div>
                        <div class="dropdown-email">{{ auth()->user()->email }}</div>
                    </div>

                    <ul class="dropdown-menu">
                        <li>
                            <a href="{{ route('profile.show') }}">
                                <i class="fas fa-user"></i> My Profile
                            </a>
                        </li>
                        <li>
                            <a href="{{ url('/dashboard') }}">
                                <i class="fas fa-table-columns"></i> Dashboard
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('cv.index') }}">
                                <i class="fas fa-file-alt"></i> My CV
                            </a>
                        </li>

                        <li class="dropdown-divider" role="separator"></li>

                        <li>
                            <a href="{{ route('profile.edit') }}">
                                <i class="fas fa-gear"></i> Settings
                            </a>
                        </li>

                        <li class="dropdown-divider" role="separator"></li>

                        <li class="logout-item">
                            <form method="POST" action="{{ route('logout') }}" style="margin: 0;">
                                @csrf
                                <button type="submit">
                                    <i class="fas fa-right-from-bracket"></i> Logout
                                </button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
            @endauth

            {{-- Mobile Menu Toggle --}}
            <button class="mobile-menu-toggle" id="mobileMenuToggle" aria-label="Toggle menu">
                <span></span>
                <span></span>
                <span></span>
            </button>
        </div>
    </div>
</nav>

@push('scripts')
<script>
    // Mobile Menu Toggle
    const mobileMenuToggle = document.getElementById('mobileMenuToggle');
    const navMenu = document.getElementById('navMenu');

    if (mobileMenuToggle && navMenu) {
        mobileMenuToggle.addEventListener('click', function() {
            navMenu.classList.toggle('active');
            mobileMenuToggle.classList.toggle('active');
        });

        // Close mobile menu when clicking outside
        document.addEventListener('click', function(event) {
            const isClickInsideNav = event.target.closest('nav');
            if (!isClickInsideNav && navMenu.classList.contains('active')) {
                navMenu.classList.remove('active');
                mobileMenuToggle.classList.remove('active');
            }
        });

        // Close mobile menu when clicking a link
        navMenu.querySelectorAll('a').forEach(link => {
            link.addEventListener('click', () => {
                navMenu.classList.remove('active');
                mobileMenuToggle.classList.remove('active');
            });
        });
    }

    // Theme Toggle
    const themeToggle = document.getElementById('themeToggle');
    const themeIcon = themeToggle?.querySelector('i');
    const htmlElement = document.documentElement;

    // Load saved theme
    const savedTheme = localStorage.getItem('theme') || 'light';
    htmlElement.setAttribute('data-theme', savedTheme);
    updateThemeIcon(savedTheme);

    themeToggle?.addEventListener('click', function() {
        const currentTheme = htmlElement.getAttribute('data-theme');
        const newTheme = currentTheme === 'dark' ? 'light' : 'dark';
        
        htmlElement.setAttribute('data-theme', newTheme);
        localStorage.setItem('theme', newTheme);
        updateThemeIcon(newTheme);
    });

    function updateThemeIcon(theme) {
        if (themeIcon) {
            if (theme === 'dark') {
                themeIcon.classList.remove('fa-moon');
                themeIcon.classList.add('fa-sun');
            } else {
                themeIcon.classList.remove('fa-sun');
                themeIcon.classList.add('fa-moon');
            }
        }
    }

    // Profile Dropdown
    const navProfile = document.getElementById('navProfile');
    const profileToggle = document.getElementById('profileToggle');

    if (navProfile && profileToggle) {
        profileToggle.addEventListener('click', function(e) {
            e.stopPropagation();
            navProfile.classList.toggle('open');
        });

        // Close dropdown when clicking outside
        document.addEventListener('click', function(e) {
            if (!navProfile.contains(e.target)) {
                navProfile.classList.remove('open');
            }
        });

        // Close on Escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                navProfile.classList.remove('open');
            }
        });
    }
</script>
@endpush