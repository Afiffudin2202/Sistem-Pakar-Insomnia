<!-- Site wrapper -->

<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-success navbar-dark">
    <!-- Left navbar links -->
    <ul class="navbar-nav navbar-success">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
    </ul>
</nav>
<!-- /.navbar -->

<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-light-light  elevation-4" >

    <!-- Sidebar -->
    <div class="sidebar sidebar-dark">
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                    with font-awesome or any other icon font library -->
                <li class="nav-item">
                    <a href="../gallery.html" class="nav-link">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 37 37"
                            fill="none">
                            <g clip-path="url(#clip0_215_77)">
                                <path
                                    d="M18.4477 4.75001C15.3005 4.74641 12.2179 5.64355 9.56406 7.33548C6.91024 9.02742 4.79604 11.4435 3.47115 14.2983C2.14625 17.1531 1.66601 20.3275 2.08714 23.4465C2.50827 26.5655 3.81317 29.4988 5.84775 31.9L6.14774 32.25H30.7477L31.0477 31.9C33.0823 29.4988 34.3872 26.5655 34.8084 23.4465C35.2295 20.3275 34.7492 17.1531 33.4243 14.2983C32.0994 11.4435 29.9852 9.02742 27.3314 7.33548C24.6776 5.64355 21.595 4.74641 18.4477 4.75001ZM27.0477 14.23L21.1277 20.04C21.4303 20.6797 21.497 21.4057 21.3161 22.0899C21.1352 22.774 20.7182 23.3721 20.139 23.7786C19.5597 24.185 18.8554 24.3736 18.1506 24.311C17.4457 24.2485 16.7856 23.9387 16.287 23.4366C15.7884 22.9345 15.4834 22.2722 15.4258 21.5669C15.3682 20.8617 15.5618 20.1587 15.9723 19.5823C16.3828 19.006 16.9839 18.5933 17.6693 18.4172C18.3547 18.2411 19.0802 18.3129 19.7177 18.62L25.6277 12.81L27.0477 14.23ZM4.04774 20.4H7.44774V22.4H4.00775C4.00775 22.01 3.95775 21.63 3.95775 21.23C3.95775 20.83 3.97775 20.68 3.99775 20.4H4.04774ZM8.92774 10.4L11.3877 12.86L9.91775 14.24L7.44774 11.79C7.89107 11.2842 8.36888 10.8098 8.87775 10.37L8.92774 10.4ZM19.4477 10.29H17.4477V6.79001H18.4477C18.8177 6.79001 19.1477 6.79001 19.4477 6.84001V10.29ZM32.9377 21.24C32.9377 21.63 32.9377 22.03 32.8877 22.41H29.3677V20.41H32.8977C32.9177 20.68 32.9377 20.96 32.9377 21.24Z"
                                    fill="#565151" />
                            </g>
                            <defs>
                                <clipPath id="clip0_215_77">
                                    <rect width="36" height="36" fill="white"
                                        transform="translate(0.447754 0.5)" />
                                </clipPath>
                            </defs>
                        </svg>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('/dashboard/penyakit') }}" class="nav-link {{ request()->segment(2) == 'penyakit' ? 'active' : '' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>
                            Penyakit
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('/dashboard/gejala') }}" class="nav-link {{ request()->segment(2) == 'gejala' ? 'active' : '' }} ">
                        <i class="far fa-circle nav-icon"></i>
                        <p>
                            Gejala
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('dashboard/rule') }}" class="nav-link {{ request()->segment(2) == 'rule' ? 'active' : '' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>
                            Rule
                        </p>
                    </a>
                </li>
                <li class="nav-item ">
                    <a href="{{ url('/dashboard/riwayat') }}" class="nav-link {{ request()->segment(2) == 'riwayat' ? 'active' : ''  }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>
                            Riwayat Diagnosa Pasien
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('/beranda') }}" class="nav-link">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 32 28"
                            fill="none">
                            <path
                                d="M7.99999 22.0781H12V15.3281H20V22.0781H24V11.9531L16 6.89062L7.99999 11.9531V22.0781ZM5.33333 24.3281V10.8281L16 4.07812L26.6667 10.8281V24.3281H17.3333V17.5781H14.6667V24.3281H5.33333Z"
                                fill="black" />
                        </svg>
                        <p>
                            Beranda
                        </p>
                    </a>
                </li>

            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>


<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
</aside>
<!-- /.control-sidebar -->

<!-- ./wrapper -->
