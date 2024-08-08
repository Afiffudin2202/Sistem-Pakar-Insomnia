@extends('dashboard.layouts.dashboard')
@section('content')
    <div class="row">
        <div class="col-sm-6 p-3">
            <h3>Data Rules</h3>
        </div>
    </div>
    {{-- main content table --}}
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 p-3">
                    <div class="card">
                        <div class="card-header d-flex justify-content-end">
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-success" data-bs-toggle="modal"
                                data-bs-target="#exampleModal">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                                    fill="none">
                                    <path id="pathPlus" d="M19 13H13V19H11V13H5V11H11V5H13V11H19V13Z" fill="#F8F8F8" />
                                </svg> Data Baru
                            </button>
                            {{-- modal tambah data --}}
                            <form action="{{ url('/dashboard/rule/store') }}" method="post" id="formData">
                                @csrf
                                <!-- Modal -->
                                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                                    aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Data baru</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <!-- form penyakit -->
                                                <div class="mb-3">
                                                    <label for="kd_rule" class="form-label">Kode Rule</label>
                                                    <input type="text" name="kd_rule"
                                                        class="form-control @error('kd_rule')
                                                        is-invalid
                                                    @enderror">
                                                    @error('kd_rule')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                                <div class="mb-3">
                                                    <label for="kd_gejala" class="form-label">Kode
                                                        Gejala</label>
                                                    <select name="kd_gejala" id="kd_gejala" class="form-control">
                                                        <option value="" selected disabled>Pilih Gejala</option>
                                                        @foreach ($gejala as $item)
                                                            <option value="{{ $item->kd_gejala }}">{{ $item->nama_gejala }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    @error('kd_gejala')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>
                                                <div class="mb-3">
                                                    <label for="kd_penyakit" class="form-label">Kode
                                                        penyakit</label>
                                                    <select name="kd_penyakit" id="kd_penyakit" class="form-control">
                                                        <option value="" selected disabled>Pilih kode penyakit
                                                        </option>
                                                        @foreach ($penyakit as $item)
                                                            <option value="{{ $item->kd_penyakit }}">
                                                                {{ $item->nama_penyakit }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('kd_penyakit')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @enderror
                                                </div>

                                                <!-- -->
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary">Save
                                                    changes</button>
                                            </div>
                                        </div>
                                    </div>
                            </form>
                        </div>
                        {{-- modal tambah data --}}
                    </div>

                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example2" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th data-orderable="true">Kode Rule</th>
                                    <th data-orderable="true">Kode Gejala</th>
                                    <th data-orderable="true">Kode Penyakit</th>
                                    <th data-orderable="true" width=3%>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($rule as $item)
                                    <tr>
                                        <td>{{ $item->kd_rule }}</td>
                                        <td>{{ $item->gejala->nama_gejala }}</td>
                                        <td>{{ $item->penyakit->nama_penyakit }}</td>
                                        <td>
                                            <div class="btn-group gap-1">
                                                <button class="btn btn-sm" data-bs-toggle="modal"
                                                    data-bs-target="#modalEdit{{ $item->kd_rule }}">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                        viewBox="0 0 24 24" fill="none">
                                                        <path id="pathEdit"
                                                            d="M7 7H6C5.46957 7 4.96086 7.21071 4.58579 7.58579C4.21071 7.96086 4 8.46957 4 9V18C4 18.5304 4.21071 19.0391 4.58579 19.4142C4.96086 19.7893 5.46957 20 6 20H15C15.5304 20 16.0391 19.7893 16.4142 19.4142C16.7893 19.0391 17 18.5304 17 18V17"
                                                            stroke="#4ECB71" stroke-width="2" stroke-linecap="round"
                                                            stroke-linejoin="round" />
                                                        <path id="pathEdit"
                                                            d="M16 4.99998L19 7.99998M20.385 6.58499C20.7788 6.19114 21.0001 5.65697 21.0001 5.09998C21.0001 4.543 20.7788 4.00883 20.385 3.61498C19.9912 3.22114 19.457 2.99988 18.9 2.99988C18.343 2.99988 17.8088 3.22114 17.415 3.61498L9 12V15H12L20.385 6.58499Z"
                                                            stroke="#4ECB71" stroke-width="2" stroke-linecap="round"
                                                            stroke-linejoin="round" />
                                                    </svg>
                                                </button>
                                                <form id="deleteForm"
                                                    action="{{ url('/dashboard/rule/' . $item->kd_rule) }}" method="post">
                                                    @csrf
                                                    @method('delete')
                                                    <button class="btn btn-sm" onclick="return confirm(event)">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                            height="24" viewBox="0 0 12 12" fill="none">
                                                            <path id="pathDelete"
                                                                d="M5 3H7C7 2.73478 6.89464 2.48043 6.70711 2.29289C6.51957 2.10536 6.26522 2 6 2C5.73478 2 5.48043 2.10536 5.29289 2.29289C5.10536 2.48043 5 2.73478 5 3ZM4 3C4 2.46957 4.21071 1.96086 4.58579 1.58579C4.96086 1.21071 5.46957 1 6 1C6.53043 1 7.03914 1.21071 7.41421 1.58579C7.78929 1.96086 8 2.46957 8 3H10.5C10.6326 3 10.7598 3.05268 10.8536 3.14645C10.9473 3.24021 11 3.36739 11 3.5C11 3.63261 10.9473 3.75979 10.8536 3.85355C10.7598 3.94732 10.6326 4 10.5 4H10.059L9.616 9.17C9.57341 9.66923 9.34499 10.1343 8.97593 10.4732C8.60686 10.8121 8.12405 11.0001 7.623 11H4.377C3.87595 11.0001 3.39314 10.8121 3.02407 10.4732C2.65501 10.1343 2.42659 9.66923 2.384 9.17L1.941 4H1.5C1.36739 4 1.24021 3.94732 1.14645 3.85355C1.05268 3.75979 1 3.63261 1 3.5C1 3.36739 1.05268 3.24021 1.14645 3.14645C1.24021 3.05268 1.36739 3 1.5 3H4ZM7.5 6C7.5 5.86739 7.44732 5.74021 7.35355 5.64645C7.25979 5.55268 7.13261 5.5 7 5.5C6.86739 5.5 6.74021 5.55268 6.64645 5.64645C6.55268 5.74021 6.5 5.86739 6.5 6V8C6.5 8.13261 6.55268 8.25979 6.64645 8.35355C6.74021 8.44732 6.86739 8.5 7 8.5C7.13261 8.5 7.25979 8.44732 7.35355 8.35355C7.44732 8.25979 7.5 8.13261 7.5 8V6ZM5 5.5C5.13261 5.5 5.25979 5.55268 5.35355 5.64645C5.44732 5.74021 5.5 5.86739 5.5 6V8C5.5 8.13261 5.44732 8.25979 5.35355 8.35355C5.25979 8.44732 5.13261 8.5 5 8.5C4.86739 8.5 4.74021 8.44732 4.64645 8.35355C4.55268 8.25979 4.5 8.13261 4.5 8V6C4.5 5.86739 4.55268 5.74021 4.64645 5.64645C4.74021 5.55268 4.86739 5.5 5 5.5ZM3.38 9.085C3.4013 9.3347 3.51558 9.5673 3.70022 9.73676C3.88486 9.90621 4.12639 10.0002 4.377 10H7.623C7.87344 9.9999 8.11472 9.90584 8.29915 9.73642C8.48357 9.56699 8.59771 9.33453 8.619 9.085L9.055 4H2.945L3.38 9.085Z"
                                                                fill="#4ECB71" />
                                                        </svg>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
        </div>
        </div>
    </section>
    {{-- main content table --}}


    {{-- modal edit data --}}
    @foreach ($rule as $rule)
        <form id="editForm" action="{{ url('/dashboard/rule/edit/' . $rule->kd_rule) }}" method="post">
            @csrf
            @method('put')
            <!-- Modal -->
            <div class="modal fade" id="modalEdit{{ $rule->kd_rule }}" tabindex="-1" aria-labelledby="modalEditLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="modalEditLabel">Edit Data</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <!-- form edit -->
                            <div class="mb-3">
                                <label for="kd_rule" class="form-label">Kode Rule</label>
                                <input type="text" id="kd_rule" name="kd_rule"
                                    class="form-control @error('kd_rule')
                                    is-invalid
                                @enderror"
                                    value="{{ $rule->kd_rule }}">
                                @error('kd_rule')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="kd_gejala" class="form-label">Kode
                                    Gejala</label>
                                <select name="kd_gejala" id="kd_gejala" class="form-control">
                                    <option value="{{ $rule->kd_gejala }}" selected>{{ $rule->nama_gejala }}</option>
                                    @foreach ($gejala as $item)
                                        <option value="{{ $item->kd_gejala }}">{{ $item->nama_gejala }}</option>
                                    @endforeach
                                </select>
                                @error('kd_gejala')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="kd_penyakit" class="form-label">Kode
                                    penyakit</label>
                                <select name="kd_penyakit" id="kd_penyakit" class="form-control">
                                    <option value="{{ $rule->kd_penyakit }}" selected>{{ $rule->nama_penyakit }}</option>
                                    @foreach ($penyakit as $item)
                                        <option value="{{ $item->kd_penyakit }}" >
                                            {{ $item->nama_penyakit }}</option>
                                    @endforeach
                                </select>
                                @error('kd_penyakit')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <!-- -->
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    @endforeach
    {{-- modal edit data --}}
@endsection
