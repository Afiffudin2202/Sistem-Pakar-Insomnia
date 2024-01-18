@extends('layouts.main')
@section('content')
    <div class="container" style="height: 100vh; display: flex; align-items: center;">
        <div class="row w-100 justify-content-center ">
            <div class="card shadow-lg  d-flex flex-row">
                <div class="col-lg-6 bg-insom p-5 d-flex align-items-center">
                    <h1>Sistem Pakar Diagnosa Insomnia</h1>
                </div>
                <div class="col-lg-6 p-5">
                    <form action="{{ url('register') }}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="nama" class="form-label">Nama </label>
                                    <input type="text" name="nama" class="form-control @error('nama')
                                        is-invalid
                                    @enderror">
                                    @error('nama')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="tgl_lahir" class="form-label">Tanggal Lahir</label>
                                    <input type="date" name="tgl_lahir" class="form-control @error('tgl_lahir')
                                        is-invalid
                                    @enderror">
                                    @error('tgl_lahir')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="jns_kelamin" class="form-label">Jenis Kelamin </label>
                                    <select name="jns_kelamin" id="jns_kelamin" class="form-control">
                                        <option value="" selected disabled> Pilih</option>
                                        <option value="laki-laki"> Laki-Laki</option>
                                        <option value="perempuan"> Perempuan</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="alamat" class="form-label">Alamat</label>
                                    <input type="text"  name="alamat" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email </label>
                                    <input type="email" name="email" class="form-control">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="password" class="form-label">Password</label>
                                    <input type="password" name="password" class="form-control">
                                </div>
                            </div>
                        </div>
                        <button type="submit" class=" btn btn-success">Register</button>
                    </form>
                    <p class="mt-3 ">Sudah punya akun ? klik <a href="{{ url('/login') }}"
                            class="text-black">Login</a></p>
                </div>
            </div>
        </div>
    </div>
@endsection
