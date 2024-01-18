@extends('layouts.main')
@section('content')
    <div class="container mt-5 py-5">
        <section>
            <div class="row justify-content-center gap-0  align-items-center">
                <div class="col-lg-6">
                    <img src="{{ asset('/') }}dist/img/home-img.png" alt="">
                </div>
                <div class="col-lg-6 px-3">
                    <h2 >Sistem Pakar
                        Diagnosis Penyakit Insomnia</h2>
                        <p class="pt-3 ">Diagnosis diri anda secara mandiri serta ketahui gejala dan saran penyembuhannya.</p>
                </div>
            </div>
        </section>
    </div>
@endsection
