@extends('layouts.main')
@section('content')
    <div class="container">
        <div class="row mb-3">
            <div class="col-md-12">
                <h1>Riwayat Diagnosa</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card my-1">
                    {{--  data diri --}}
                    <div class="row px-5 pt-3">
                        <div class="col-lg-6">
                            <div class="border p-3 rounded-0">
                                <h3>Data pasien :</h3>
                                <p>Nama : {{ $user->nama }}</p>
                                <p>Tanggal Lahir : {{ date('d F Y', strtotime($user->tgl_lahir)) }}</p>
                                {{-- <p>Tanggal Lahir : {{ $user->tgl_lahir}}</p> --}}
                            </div>
                        </div>
                    </div>

                    {{-- riwayat --}}
                    <div class="row p-5">
                        <div class="col-lg-12 p-3 border rounded-0">
                            <p>Riwayat :</p>
                            <table id="example2" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th data-orderable="true">Nama pasien</th>
                                        <th data-orderable="true">Terdiagnosa</th>
                                        <th data-orderable="true">Tanggal Diagnosa</th>
                                        <th data-orderable="true" width=3%>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($riwayat as $item)
                                        <tr>
                                            <td>{{ $item->user->nama }}</td>
                                            <td>
                                                @if ($item->kd_penyakit == 'tidak ada')
                                                    tidak ada
                                                @else
                                                    {{ $item->rule->penyakit->nama_penyakit }}
                                                @endif
                                            </td>
                                            <td>{{ $item->created_at->format('d-m-Y') }}</td>
                                            <td>
                                                <div class="btn-group gap-1">
                                                    <button class="btn btn-sm"
                                                        onclick="window.location='{{ url('cetak-detailhasil/' . $item->id) }}'">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                            height="24" viewBox="0 0 24 24" fill="none">
                                                            <path
                                                                d="M18 7H6V3H18V7ZM18 12.5C18.2833 12.5 18.521 12.404 18.713 12.212C18.905 12.02 19.0007 11.7827 19 11.5C19 11.2167 18.904 10.9793 18.712 10.788C18.52 10.5967 18.2827 10.5007 18 10.5C17.7167 10.5 17.4793 10.596 17.288 10.788C17.0967 10.98 17.0007 11.2173 17 11.5C17 11.7833 17.096 12.021 17.288 12.213C17.48 12.405 17.7173 12.5007 18 12.5ZM16 19V15H8V19H16ZM18 21H6V17H2V11C2 10.15 2.29167 9.43767 2.875 8.863C3.45833 8.28833 4.16667 8.00067 5 8H19C19.85 8 20.5627 8.28767 21.138 8.863C21.7133 9.43833 22.0007 10.1507 22 11V17H18V21Z"
                                                                fill="#65B741" />
                                                        </svg>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
