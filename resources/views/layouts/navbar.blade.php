<nav class="navbar navbar-dark navbar-expand-lg bg-success p-2 ">
    <div class="container">
        <a class="navbar-brand " href="{{ url('/') }}">SPPI</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link {{ request()->segment(1) == '' || request()->segment(1) == 'beranda' ? 'active' : '' }}"
                        aria-current="page" href="{{ url('beranda') }}">Beranda</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->segment(1) == 'diagnosa' ? 'active' : '' }}"
                        href="{{ url('/diagnosa') }}">Diagnosa</a>
                </li>

                @auth
                    <li class="nav-item">
                        <a class="nav-link {{ request()->segment(1) == 'riwayatdiagnosa' ? 'active' : '' }}"
                            href="{{ url('/riwayatdiagnosa') }}">Riwayat Diagnosa</a>
                    </li>
                    @if (auth()->user()->level == 1)
                        <li class="nav-item">
                            <a class="nav-link {{ request()->segment(1) == 'dashboard' ? 'active' : '' }}"
                                href="{{ url('/dashboard') }}">Manager Data</a>
                        </li>
                    @endif
                @endauth
                <li class="nav-item">
                    <a class="nav-link {{ request()->segment(1) == 'informasi' ? 'active' : '' }}"
                        href="{{ url('/informasi') }}">Informasi penyakit</a>
                </li>
            </ul>
        </div>
        @auth
            <div class="login-regis">
                <button class="btn btn-outline-light" onclick="window.location='{{ url('/logout') }}'">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                        fill="none">
                        <path
                            d="M12 21V19H19V5H12V3H19C19.55 3 20.021 3.196 20.413 3.588C20.805 3.98 21.0007 4.45067 21 5V19C21 19.55 20.804 20.021 20.412 20.413C20.02 20.805 19.5493 21.0007 19 21H12ZM10 17L8.625 15.55L11.175 13H3V11H11.175L8.625 8.45L10 7L15 12L10 17Z"
                            fill="#F8F8F8" />
                    </svg>
                    Logout</button>
            </div>
        @else
            <div class="login-regis">
                <button class="btn btn-outline-light" onclick="window.location='{{ url('/login') }}'">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                        fill="none">
                        <path
                            d="M12 21V19H19V5H12V3H19C19.55 3 20.021 3.196 20.413 3.588C20.805 3.98 21.0007 4.45067 21 5V19C21 19.55 20.804 20.021 20.412 20.413C20.02 20.805 19.5493 21.0007 19 21H12ZM10 17L8.625 15.55L11.175 13H3V11H11.175L8.625 8.45L10 7L15 12L10 17Z"
                            fill="#F8F8F8" />
                    </svg>
                    Masuk/Daftar</button>
            </div>
        @endauth

    </div>
</nav>


{{-- <nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
        <a class="navbar-brand " href="{{ url('/') }}">SPPI</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link {{ request()->segment(1) == '' || request()->segment(1) == 'beranda' ? 'active' : '' }}"
                        aria-current="page" href="{{ url('beranda') }}">Beranda</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->segment(1) == 'diagnosa' ? 'active' : '' }}"
                        href="{{ url('/diagnosa') }}">Diagnosa</a>
                </li>

                @auth
                    <li class="nav-item">
                        <a class="nav-link {{ request()->segment(1) == 'riwayatdiagnosa' ? 'active' : '' }}"
                            href="{{ url('/riwayatdiagnosa') }}">Riwayat Diagnosa</a>
                    </li>
                    @if (auth()->user()->level == 1)
                        <li class="nav-item">
                            <a class="nav-link {{ request()->segment(1) == 'dashboard' ? 'active' : '' }}"
                                href="{{ url('/dashboard') }}">Manager Data</a>
                        </li>
                    @endif
                @endauth
                <li class="nav-item">
                    <a class="nav-link {{ request()->segment(1) == 'informasi' ? 'active' : '' }}"
                        href="{{ url('/informasi') }}">Informasi penyakit</a>
                </li>
            </ul>
            @auth
                <div class="login-regis">
                    <button class="btn btn-outline-light" onclick="window.location='{{ url('/logout') }}'">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                            fill="none">
                            <path
                                d="M12 21V19H19V5H12V3H19C19.55 3 20.021 3.196 20.413 3.588C20.805 3.98 21.0007 4.45067 21 5V19C21 19.55 20.804 20.021 20.412 20.413C20.02 20.805 19.5493 21.0007 19 21H12ZM10 17L8.625 15.55L11.175 13H3V11H11.175L8.625 8.45L10 7L15 12L10 17Z"
                                fill="#F8F8F8" />
                        </svg>
                        Logout</button>
                </div>
            @else
                <div class="login-regis">
                    <button class="btn btn-outline-light" onclick="window.location='{{ url('/login') }}'">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                            fill="none">
                            <path
                                d="M12 21V19H19V5H12V3H19C19.55 3 20.021 3.196 20.413 3.588C20.805 3.98 21.0007 4.45067 21 5V19C21 19.55 20.804 20.021 20.412 20.413C20.02 20.805 19.5493 21.0007 19 21H12ZM10 17L8.625 15.55L11.175 13H3V11H11.175L8.625 8.45L10 7L15 12L10 17Z"
                                fill="#F8F8F8" />
                        </svg>
                        Masuk/Daftar</button>
                </div>
            @endauth
        </div>
    </div>
</nav> --}}
