@extends('layouts.main')
@section('content')
    <div class="container">
        <div class="row mb-3">
            <div class="col-md-12">
                <h1>Kesimpulan Diagnosa</h1>
            </div>
        </div>
        <div class="row justify-content-end">
            <button onclick="window.location='{{ url('/riwayatdiagnosa') }}'" class="btn btn-success mx-2">riwayat &
                Download</button>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card my-3">
                    {{-- hasil dan data diri --}}
                    <div class="row p-5">
                        <div class="col-lg-6">
                            <div class="border p-3 rounded-0">
                                <h3>hasil Diagnosa :</h3>
                                <p>Diagnosa : @if ($penyakit != 'tidak ada')
                                        Insomnia
                                    @else
                                        -
                                    @endif
                                </p>
                                <p>Jenis : {{ $penyakit }}</p>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="border p-3 rounded-0">
                                <h3>Data pasien :</h3>
                                <p>Nama : {{ $user->nama }}</p>
                                <p>Tanggal Lahir : {{ $user->tgl_lahir }}</p>
                            </div>
                        </div>
                    </div>

                    {{-- gejala yang di alami --}}
                    <div class="row p-5">
                        <div class="col-lg-12 p-3 border rounded-0">
                            <p>Gejala yang dialami :</p>

                            <table class="table table-bordered table-hover">
                                <thead class="text-center">
                                    <tr>
                                        <th>No</th>
                                        <th>Nama gejala</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    {{-- <td>{{ implode(', ', $gejala_dipilih) }}</td>
                                    <td>{{ implode(', ', $gejala_dipilih) }}</td> --}}
                                    @foreach ($dataGejala as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item['nama'] }}</td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                            @if ($penyakit != 'tidak ada')
                                <p><b> Saran</b> : {{ $penyembuhan->penyembuhan }}</p>
                            @endif
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
