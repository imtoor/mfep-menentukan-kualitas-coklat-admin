            <div class="preloader flex-column justify-content-center align-items-center">
                <img
                    class="animation__shake"
                    src="{{ asset('template/adminlte') }}/dist/img/AdminLTELogo.png"
                    alt="AdminLTELogo"
                    height="60"
                    width="60"
                />
            </div>

            <!-- Main Sidebar Container -->
            <aside class="main-sidebar sidebar-dark-primary elevation-4">
                <!-- Brand Logo -->
                <a href="#" class="brand-link">
                    <img
                        src="{{ asset('template/adminlte/dist/img/AdminLTELogo.png') }}"
                        alt="AdminLTE Logo"
                        class="brand-image img-circle elevation-3"
                        style="opacity: 0.8"
                    />
                    <span class="brand-text font-weight-light">SHOP | ADMIN</span>
                </a>

                <!-- Sidebar -->
                <div class="sidebar">
                    <!-- Sidebar user panel (optional) -->
                    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                        <div class="image">
                            <img
                                src="{{ asset('template/adminlte/dist/img/avatar5.png') }}"
                                class="img-circle elevation-2"
                                alt="User Image"
                            />
                        </div>
                        <div class="info">
                            <a href="#" class="d-block">{{ Auth::user()->name }}</a>
                        </div>
                    </div>

                    <!-- Sidebar Menu -->
                    <nav class="mt-2">
                        <ul
                            class="nav nav-pills nav-sidebar flex-column"
                            data-widget="treeview"
                            role="menu"
                            data-accordion="false"
                        >
                            <!-- Add icons to the links using the .nav-icon class
                            with font-awesome or any other icon font library -->
                            <li class="nav-item">
                                <a id="dashboard" href="{{ url('/') }}" class="nav-link">
                                    <i class="nav-icon fas fa-tachometer-alt"></i>
                                    <p>
                                        Dashboard
                                    </p>
                                </a>
                            </li>
                            
                            <li class="nav-item">
                                <a id="menu_userpelanggan" 
                                    href="{{ url('/menu-userpelanggan') }}"
                                    class="nav-link"
                                >
                                <i class="nav-icon fas fa-users"></i>
                                <p>User Pelanggan</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a id="menu_produk" 
                                    href="{{ url('/menu-produk') }}"
                                    class="nav-link"
                                >
                                <i class="nav-icon fas fa-shopping-cart"></i>
                                <p>Produk</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a id="menu_transaksi" 
                                    href="{{ url('/menu-transaksi') }}"
                                    class="nav-link"
                                >
                                <i class="nav-icon fas fa-credit-card"></i>
                                <p>Transaksi</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a id="menu_laporan" 
                                    href="{{ url('/menu-laporan') }}"
                                    class="nav-link"
                                >
                                <!-- <i class="nav-icon fas fa-money-check"></i> -->
                                <i class="nav-icon fas fa-money-check"></i>
                                <p>Laporan</p>
                                </a>
                            </li>
                           
                    <!-- /.sidebar-menu -->
                </div>
                <!-- /.sidebar -->
            </aside>

            