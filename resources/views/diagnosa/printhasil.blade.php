<div >
  <div >
    <div >
      <h1 style="text-align: center">Kesimpulan Diagnosa</h1>
    </div>
  </div>

  <div class="row">
    <div class="col-lg-12">
      <div class="card my-3">
        <div class="row p-5">
          <div class="col-lg-6">
            <div class="border p-3 rounded-0">
              <h3>Data pasien</h3>
              <p>Nama: {{ $riwayat->user->nama }}</p>
              <p>Jenis kelamin: {{ $riwayat->user->jns_kelamin }}</p>
              <p>Tanggal lahir: {{ $riwayat->user->tgl_lahir }}</p>
            </div>
          </div>
        </div>

        <div class="row p-5">
          <div class="col-lg-12 p-3 border rounded-0">
            <p>Berdasarkan hasil diagnosa sistem pakar insomnia dengan mengambil kesimpulan dari gejala-gejala yang di rasakan oleh pasien, pasien dengan data di atas terdiagnosa penyakit <b>{{ $riwayat->rule->penyakit->nama_penyakit }}</b>. </p>
            <p>dengan gejala-gejala berikut:</p>

            <table style="border: 1px solid">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Nama gejala</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($gejala_filtered as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item }}</td>
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

<style>
  body {
    font-family: Arial;
    font-size: 12pt;
  }

  table {
    border-collapse: collapse;
    border: 1px solid;
  }

  th, td {
    border: 1px solid;
    padding: 5px;
  }

  h1 {
    font-size: 16pt;
  }

  h3 {
    font-size: 14pt;
  }
</style>