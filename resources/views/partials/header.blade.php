<header class="shadow-sm">
    <nav id="main-navbar" class="navbar navbar-expand-lg navbar-light bg-white">
        <!-- Container wrapper -->
        <div class="container-fluid">
            <!-- Right links -->
            <ul class="navbar-nav ms-auto d-flex flex-row align-items-center">
                <li class="nav-item">
                    <a class="nav-link me-3 me-lg-0" href="#">
                        <i class="fas fa-bell"></i>
                        <span class="badge rounded-pill badge-notification bg-danger">1</span>
                    </a>
                </li>
                <!-- Icon -->
                <li class="nav-item me-3 me-lg-0">
                    <a class="nav-link" href="#">
                        <i class="fab fa-github"></i>
                    </a>
                </li>
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        <img class="rounded-circle profile-picture"
                            src="https://avatarfiles.alphacoders.com/373/373447.jpg"
                            alt="{{ Auth::user()->name }} profile picture">
                        {{ Auth::user()->name }}
                    </a>

                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ url('admin/dashboard') }}">{{ __('Dashboard') }}</a>
                        <a class="dropdown-item" href="{{ url('profile') }}">{{ __('Profile') }}</a>
                        <a class="dropdown-item" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                </li>
            </ul>
        </div>
    </nav>
</header>
