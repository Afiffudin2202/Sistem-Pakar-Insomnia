@extends('layouts.main')
@section('content')
    <div class="container">
        <div class="row mb-5">
            <div class="col-md-12">
                <h1>Diagnosa Penyakit Insomnia</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card p-5">
                    <div class="card-header">
                        <h3>Pilih gejala-gejala di bawah sesuai dengan yang anda rasakan !!</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ url('/diagnosa/pertanyaan/store') }}" method="post">
                            @csrf
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Nama Gejala</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($rule as $item)
                                        <tr>
                                            <td><input type="checkbox" name="gejala[]" value="{{ $item->kd_gejala }}">
                                            </td>
                                            <td> {{ $item->nama_gejala }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <button type="submit" class="btn btn-primary">Diagnosa</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
