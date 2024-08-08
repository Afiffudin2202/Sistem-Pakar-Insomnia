<?php

namespace App\Http\Controllers;

use Dompdf\Dompdf;
use App\Models\Rule;
use App\Models\User;
use App\Models\Gejala;
use App\Models\Diagnosa;
use App\Models\Penyakit;
use Barryvdh\DomPDF\PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class DiagnosaController extends Controller
{

    public function index()
    {
        $rule = Gejala::all();
        return view('diagnosa.pertanyaan', compact('rule'));
    }

    // rule penyakit berdasarkan gejala
    protected $penyakit = [];
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
        if ($gejala_dipilih < 1) {
            return redirect('diagnosa/pertanyaan')->with('error', 'kolom gejala tidak boleh kosong, Pilih minimal 1 gejala');
        } else {
            // Akses daftaran array penyakit
            // $daftar_penyakit = $this->penyakit;
            $penyakit = "tidak ada";
            // mencari penyakit sesuai gejala-gejala yang dipilih
            foreach ($this->penyakit as $kd_penyakit => $array_gejala) {
                if ($array_gejala == $gejala_dipilih) {
                    $penyakit = $kd_penyakit;
                    break;
                }
            }

            $user = Auth::user();

            $gejalaUser = implode(',', $gejala_dipilih);

            $diagnosa = new Diagnosa();
            $diagnosa->kd_user = $user->id;
            $diagnosa->kd_penyakit = $penyakit;
            $diagnosa->gejala = $gejalaUser;

            $diagnosa->save();
            return redirect('/detailhasil?penyakit=' . $penyakit . '&user=' . $user->id . '&gejala=' . $gejalaUser)->with('success', 'Diagnosa Selesai');
        }
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

        if ($penyakit != 'tidak ada') {
            $hasil = Diagnosa::with('user', 'rule')->where('kd_penyakit', $penyakit)->first();

            $hasilPenyakit = $hasil->rule->penyakit->nama_penyakit;
            // if ($penyakit == $hasil && $user == $hasil->kd_user) {
            //     $penyakit == $hasilPenyakit;
            // }
            $penyakit = $hasilPenyakit;
            $penyembuhan = Penyakit::where('nama_penyakit', $penyakit)->first();
            // dd($hasilPenyakit);
            // dd($penyakit);
            $gejala = Rule::with('gejala', 'penyakit')->where('kd_penyakit', $penyakit);
            $user = User::where('id', $user)->first();
            return view('diagnosa.detailHasil', compact('penyakit', 'gejala_dipilih', 'hasil', 'user', 'dataGejala', 'penyembuhan'));
        } else {
            $penyakit = $penyakit;
            $penyembuhan = Penyakit::where('nama_penyakit', $penyakit)->get();
            // dd($hasilPenyakit);
            // dd($penyakit);
            $hasil = $penyakit;
            $gejala = Rule::with('gejala', 'penyakit')->where('kd_penyakit', $penyakit);
            $user = User::where('id', $user)->first();
            return view('diagnosa.detailHasil', compact('penyakit', 'gejala_dipilih', 'hasil', 'user', 'dataGejala', 'penyembuhan'));
        }
    }

    public function diagnose(Request $request)
    {
        $insomniaKronic = 'P01';
        $insomniaAkut = 'P02';
        $insomniaTemporer = 'P03';
        $insomniaPsychophysiologicalt = 'P04';
        $insomniaKomorbid = 'P05';
        $insomniaPrimer = 'P06';
        $test = Rule::with('gejala', 'penyakit')->first();

        $akut = $test->where('kd_penyakit', $insomniaAkut)->get();
        $kronic = $test->where('kd_penyakit', $insomniaKronic)->get();
        $temporer = $test->where('kd_penyakit', $insomniaTemporer)->get();
        $psycho = $test->where('kd_penyakit', $insomniaPsychophysiologicalt)->get();
        $komorbid = $test->where('kd_penyakit', $insomniaKomorbid)->get();
        $primer = $test->where('kd_penyakit', $insomniaPrimer)->get();

        $akutArray = [];
        foreach ($akut as $key) {
            $akutArray[] = $key->kd_gejala;
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

        $psychoArray = [];
        foreach ($psycho as $key) {
            $psychoArray[] = $key->kd_gejala;
        }
        $this->penyakit[$insomniaPsychophysiologicalt] = $psychoArray;

        $komorbidArray = [];
        foreach ($komorbid as $key) {
            $komorbidArray[] = $key->kd_gejala;
        }
        $this->penyakit[$insomniaKomorbid] = $komorbidArray;


        $primerArray = [];
        foreach ($primer as $key) {
            $primerArray[] = $key->kd_gejala;
        }
        $this->penyakit[$insomniaPrimer] = $primerArray;


        // mengambil inputan dari user
        $gejala_dipilih = $request->input('gejala');

        if (count($gejala_dipilih) < 1) {
            return redirect('diagnosa/pertanyaan')->with('error', 'kolom gejala tidak boleh kosong, Pilih minimal 1 gejala');
        } else {
            $penyakitTerbaik = null;
            $jumlahCocokTerbaik = 0;

            $penyakitTepat = null;

            // Jika tidak ditemukan penyakit dengan gejala persis sama, cari penyakit yang gejalanya paling mendekati
            if ($penyakitTepat === null) {
                foreach ($this->penyakit as $kd_penyakit => $array_gejala) {
                    $jumlahCocok = count(array_intersect($array_gejala, $gejala_dipilih));

                    if ($jumlahCocok > $jumlahCocokTerbaik) {
                        $jumlahCocokTerbaik = $jumlahCocok;
                        $penyakitTerbaik = $kd_penyakit;
                    }
                }

                $penyakitTepat = $penyakitTerbaik;
            }

            if ($penyakitTepat === null) {
                $penyakitTepat = "tidak ada";
            }


            $user = Auth::user();

            $gejalaUser = implode(',', $gejala_dipilih);

            $diagnosa = new Diagnosa();
            $diagnosa->kd_user = $user->id;
            $diagnosa->kd_penyakit = $penyakitTerbaik;
            $diagnosa->gejala = $gejalaUser;

            $diagnosa->save();
            return redirect('/detailhasil?penyakit=' . $penyakitTerbaik . '&user=' . $user->id . '&gejala=' . $gejalaUser)->with('success', 'Diagnosa Selesai');
        }
    }
    
}
