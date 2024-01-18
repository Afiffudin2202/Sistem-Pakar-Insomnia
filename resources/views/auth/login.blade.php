@extends('layouts.main')
@section('content')

    <div class="session w-50 my-3 mx-auto">
        {{-- session register --}}
        @if (session()->has('success'))
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong>{{ session('success') }}</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        {{-- session gagal login --}}
        @if (session()->has('loginError'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>{{ session('loginError') }}</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
    </div>
    <div class="container" style="height: 80vh; display: flex; align-items: center;">
        <div class="row w-100 justify-content-center ">
            <div class="card shadow-lg  d-flex flex-row">
                <div class="col-lg-6 bg-insom p-5 d-flex align-items-center">
                    <h1>Sistem Pakar Diagnosa Insomnia</h1>
                </div>
                <div class="col-lg-6 p-5">
                    <form action="{{ url('/login') }}" method="post">
                        @csrf
                        <div class="mb-3">
                            <label for="email" class="form-label">Email </label>
                            <input type="email" name="email" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" name="password" class="form-control">
                        </div>
                        <button type="submit" class=" btn btn-success">Login</button>
                    </form>

                    <p class="mt-3 ">Belum punya akun ? klik <a href="{{ url('/register') }}"
                            class="text-black">Register</a></p>
                </div>
            </div>
        </div>
    </div>
@endsection
