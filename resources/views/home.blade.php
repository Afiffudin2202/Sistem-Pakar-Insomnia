@extends('layouts.main')
@section('content')
    <div class="container my-5 py-5">
        <section>
            <div class="row justify-content-center gap-0  align-items-center">
                <div class="col-lg-6">
                    <img src="{{ asset('/') }}dist/img/home-img.png" alt="">
                </div>
                <div class="col-lg-6 px-3">
                    <h2>Sistem Pakar
                        Diagnosis Penyakit Insomnia</h2>
                    <p class="pt-3 ">Diagnosis diri anda secara mandiri serta ketahui gejala dan saran penyembuhannya.</p>
                </div>
            </div>
        </section>

    </div>
    <div class="container-fluid mx-0 my-3 p-0">
        <section class="bg-success mt-3 ">
            <h3 class="text-center pt-5 my-5">
                Jenis Penyakit Insomnia
            </h3>
            <div class="row m-1 text-dark justify-content-center">
                @foreach ($penyakit as $item)
                <div class="col-lg-8">
                    <div class="card p-3 rounded-0">
                        <h3>{{ $item->nama_penyakit }}</h3>
                     
                    </div>
                </div>
                @endforeach
            </div>
        </section>
    </div>
@endsection
