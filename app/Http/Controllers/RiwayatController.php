<?php

namespace App\Http\Controllers;

use Dompdf\Dompdf;
use App\Models\Gejala;
use App\Models\Diagnosa;
use Barryvdh\DomPDF\PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RiwayatController extends Controller
{
    public function index()
    {
        $riwayat = Diagnosa::with('user', 'rule')->get();
      
        return view('dashboard.riwayat.riwayat', compact('riwayat'));
    }

    public function riwayatPasien()
    {
        $user = Auth::user();
        $riwayat = Diagnosa::with('user', 'rule')->where('kd_user', $user->id)->get();
        // dd($riwayat);
        return view('riwayat.index', compact('riwayat', 'user'));
    }

    public function cetakHasil($id)
    {
        $user = Auth::user();
        $riwayat = Diagnosa::with('user', 'rule')->find($id);
        $gejala = $riwayat->gejala;
        $gejala = explode(',', $gejala);

        // Ubah kode gejala menjadi nama gejala menggunakan map()
        $gejala_filtered = collect($gejala)->map(function ($g) {
            $gejala_obj = Gejala::where('kd_gejala', $g)->first();
            if ($gejala_obj) {
                return $gejala_obj->nama_gejala;
            } else {
                return "Gejala tidak ditemukan";
            }
        });
        // Buat objek PDF
        $dompdf = new Dompdf();
        $pdf = new PDF($dompdf, config(), app('files'), view());
        // // Set margins using the Options object
        $options = $pdf->getOptions();
        $options->set('margin-left', 400);
        $options->set('margin-right', 30);
        $options->set('margin-top', 30);
        $options->set('margin-bottom', 30);
        $pdf->getDompdf()->setPaper('A4', 'portrait');

        $pdf->loadView('diagnosa.printhasil', compact('riwayat', 'gejala_filtered'));
        return $pdf->download('kesimpulan.pdf');
    }

    public function destroy($id)
    {
        $riwayat = Diagnosa::with('user', 'rule')->find($id);

        $riwayat->delete();

        return redirect('/dashboard/riwayat')->with('success', 'Data Riwayat telah di hapus');
    }
}
