@extends('layouts.main')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6 mt-5">
                <div class="card p-5">
                    <h1 class="text-center">
                        Yuk Diagnosa kondisimu sekarang !
                    </h1>
                    <div class="text-center mt-2">
                        <button class="btn btn-success" onclick="window.location='{{ url('diagnosa/pertanyaan') }}'">
                            Mulai Diagnosa
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
