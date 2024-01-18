<?php

namespace App\Http\Controllers;

use Dompdf\Dompdf;
use App\Models\Rule;
use App\Models\User;
use App\Models\Gejala;
use App\Models\Diagnosa;
use Barryvdh\DomPDF\PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class DiagnosaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $rule = Gejala::all();
        return view('diagnosa.pertanyaan', compact('rule'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    // rule penyakit berdasarkan gejala
    protected $penyakit = [
        // 'P01' => ["G01", "G02", "G03", "G04", "G05"],
        // 'P02' => [1, 2, 3,  6, 7, 8, 9, 10],
        // 'P03' => [1, 2, 11, 12]
    ];



    public function store(Request $request)
    {
        $insomniaAkut = 'P01';
        $insomniaKronic = 'P02';
        $insomniaTemporer = 'P03';
        $test = Rule::with('gejala', 'penyakit')->first();

        $akut = $test->where('kd_penyakit', $insomniaAkut)->get();
        $kronic = $test->where('kd_penyakit', $insomniaKronic)->get();
        $temporer = $test->where('kd_penyakit', $insomniaTemporer)->get();

        $akutArray = [];
        foreach ($akut as $key) {
            $akutArray[] =  $key->kd_gejala;
        }
        $this->penyakit[$insomniaAkut] = $akutArray;

        $kronicArray = [];
        foreach ($kronic as $key) {
            $kronicArray[] = $key->kd_gejala;
        }
        $this->penyakit[$insomniaKronic] = $kronicArray;

        $temporerArray = [];
        foreach ($temporer as $key) {
            $temporerArray[] = $key->kd_gejala;
        }
        $this->penyakit[$insomniaTemporer] = $temporerArray;

        // mengambil inputan dari user
        $gejala_dipilih = $request->input('gejala');
        // dd($gejala_dipilih);

        // Akses daftaran array penyakit
        $daftar_penyakit = $this->penyakit;
        $penyakit = "tidak ada";
        // mencari penyakit sesuai gejala-gejala yang dipilih
        foreach ($this->penyakit as $kd_penyakit => $array_gejala) {
            if ($array_gejala == $gejala_dipilih) {
                $penyakit = $kd_penyakit;
                break;
            }
        }

        $user = Auth::user();
        // $user = $user->id;
        $gejalaUser = implode(',', $gejala_dipilih);

        // dd($user);
        $diagnosa = new Diagnosa();
        $diagnosa->kd_user = $user->id;
        $diagnosa->kd_penyakit = $penyakit;
        $diagnosa->gejala = $gejalaUser;
        // dd($user);

        // dd($penyakit);
        $diagnosa->save();
        return redirect('/detailhasil?penyakit=' . $penyakit . '&user=' . $user->id . '&gejala=' . $gejalaUser)->with('success', 'Diagnosa Selesai');
    }

    public function detailHasil(Request $request)
    {
        $penyakit = $request->query('penyakit');
        $gejala_dipilih = explode(',', $request->query('gejala'));
        $user = $request->query('user');

        $gejalaArray[] = $gejala_dipilih;
        $dataGejala = [];
        // Loop melalui array gejala
        foreach ($gejalaArray as $gejalaGroup) {
            foreach ($gejalaGroup as $kodeGejala) {
                // Ambil data gejala dari database
                $gejala = Gejala::where('kd_gejala', $kodeGejala)->first();

                if ($gejala) {
                    $dataGejala[] = [
                        'kode' => $kodeGejala,
                        'nama' => $gejala->nama_gejala,
                    ];
                }
            }
        }
        // dd($gejalaArray);
        $hasil = Diagnosa::with('user', 'rule')->where('kd_penyakit', $penyakit)->first();
        // dd($hasil);
        $hasilPenyakit = $hasil->rule->penyakit->nama_penyakit;
        if ($penyakit == $hasil->kd_penyakit && $user == $hasil->kd_user) {
            $penyakit = $hasilPenyakit;
        }
        $gejala = Rule::with('gejala', 'penyakit')->where('kd_penyakit', $penyakit);
        $user = User::where('id', $user)->first();
        // dd($user);
        // Buat objek PDF
        $dompdf = new Dompdf();
        $pdf = new PDF($dompdf, config(), app('files'), view());
        $pdf->loadView('diagnosa.detailHasil', compact('penyakit', 'gejala_dipilih', 'hasil', 'user', 'dataGejala'));


        // // Download PDF
        // Cek apakah tombol download diklik
        if ($request->has('download')) {
            // Download file
            // $url = url('/detailhasil', [
            //     'penyakit' => $penyakit,
            //     'user' => $user,
            //     'gejala' => $gejala,
            // ]);
            return $pdf->download('kesimpulan.pdf');
        } else {
            // Tampilkan halaman detail hasil
            return view('diagnosa.detailHasil', compact('penyakit', 'gejala_dipilih', 'hasil', 'user', 'dataGejala'));
        }
    }
    /**
     * Display the specified resource.
     */
    public function show(Diagnosa $diagnosa)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Diagnosa $diagnosa)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Diagnosa $diagnosa)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Diagnosa $diagnosa)
    {
        //
    }

    public function cetak(Request $request)
    {
        $penyakit = $request->query('penyakit');
        $gejala_dipilih = explode(',', $request->query('gejala'));
        $user = $request->query('user');

        dd($penyakit);
        $gejalaArray[] = $gejala_dipilih;

        $dataGejala = [];
        // Loop melalui array gejala
        foreach ($gejalaArray as $gejalaGroup) {
            foreach ($gejalaGroup as $kodeGejala) {
                // Ambil data gejala dari database
                $gejala = Gejala::where('kd_gejala', $kodeGejala)->first();

                if ($gejala) {
                    $dataGejala[] = [
                        'kode' => $kodeGejala,
                        'nama' => $gejala->nama_gejala,
                    ];
                }
            }
        }
        // dd($gejalaArray);
        $hasil = Diagnosa::with('user', 'rule')->where('kd_penyakit', $penyakit)->first();
        // dd($hasil);

        $hasilPenyakit = $hasil->rule->penyakit->nama_penyakit;

        if ($penyakit == $hasil->kd_penyakit && $user == $hasil->kd_user) {
            $penyakit = $hasilPenyakit;
        }
        $gejala = Rule::with('gejala', 'penyakit')->where('kd_penyakit', $penyakit);
        $user = User::where('id', $user)->first();
        // dd($user);
        // Buat objek PDF
        // Buat objek PDF
        $dompdf = new Dompdf();
        $pdf = new PDF($dompdf, config(), app('files'), view());
        $pdf->loadView('diagnosa.printHasil', compact('penyakit', 'gejala_dipilih', 'hasil', 'user', 'dataGejala'));

        // Set nama file PDF
        // Download PDF
        return $pdf->download('Laporan-Kesimpulan.pdf');
    }
}


 // $gejala_pilih = $request->input('gejala');


        // $data = DB::table('rules')
        //     ->join('gejalas', 'rules.kd_gejala', '=', 'gejalas.kd_gejala')
        //     ->join('penyakits', 'rules.kd_penyakit', '=', 'penyakits.kd_penyakit')
        //     ->select('rules.*', 'gejalas.nama_gejala', 'penyakits.nama_penyakit')
        //     ->whereIn('gejalas.kd_gejala', $gejala_pilih)->get();

        // $data = DB::table('rules')
        //     ->whereIn('kd_gejala', $gejala_pilih)->get();

        //     // dd($data);

        // if ($data->count() > 0) {
        //     $penyakit = $data[0];
        //     $diagnosa = $penyakit->kd_penyakit;
        // } else {
        //     $diagnosa = 'Tidak diketahui';
        // }


        // percobaan 2
        // $gejala_dipilih = $request->input('gejala');

        // $data = DB::table('rules')
        //     ->whereIn('kd_gejala', $gejala_dipilih)
        //     ->get();

        // $penyakit = null;
        // $jumlah_gejala = 0;

        // foreach ($data as $rule) {
        //     $jumlah_gejala++;

        //     if ($rule->kd_penyakit == 'P01' && $jumlah_gejala >= 3) {
        //         $penyakit = 'P01';
        //         break;
        //     } elseif ($rule->kd_penyakit == 'P02' && $jumlah_gejala >= 5) {
        //         $penyakit = 'P02';
        //     } elseif ($rule->kd_penyakit == 'P03' && $jumlah_gejala >= 4) {
        //         $penyakit = 'P03';
        //     } else {
        //         $penyakit = 'Anda Tidak terkena insomnia';
        //     }
        // }


        // per 3
        // $gejala_dipilih = $request->input('gejala');

        // $gejala_array = explode(',', $gejala_dipilih);

        // $penyakit = null;

        // foreach ($this->penyakit as $nama_penyakit => $array_gejala) {
        //     if ($gejala_array == $array_gejala) {
        //         $penyakit = $nama_penyakit;
        //         break;
        //     }
        // }