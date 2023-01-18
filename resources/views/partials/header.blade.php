<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a
                class="nav-link"
                data-widget="pushmenu"
                href="#"
                role="button"
                ><i class="fas fa-bars"></i
            ></a>
        </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <!-- Messages Dropdown Menu -->
        <li class="nav-item dropdown">
            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                {{ Auth::user()->name }}
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <h3 class="dropdown-item-title">
                    <li class="nav-item">
                        <a href="/password/{{ Auth::user()->id }}/edit" class="btn btn-primary dropdown-item"><i class="fa-icon fas fa-key"></i> Ubah Password</a>
                    </li>
                </h3>
                
                <h3 class="dropdown-item-title">
                <li class="nav-item">
                
                    <a class="dropdown-item" href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();"><i class="fas fa-sign-out-alt"></i>
                        {{ __('Logout') }}
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </li>
                </h3>
            </div>
        </li>
    </ul>
</nav>
<!-- /.navbar -->