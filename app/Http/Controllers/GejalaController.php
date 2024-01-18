<?php

namespace App\Http\Controllers;

use App\Models\Gejala;
use Illuminate\Http\Request;

class GejalaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $gejala = Gejala::all();

        return view('dashboard.gejala.gejala', compact('gejala'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rules = [
            'kd_gejala' => 'required|min:3|max:3|unique:gejalas,kd_gejala',
            'nama_gejala' => 'required'
        ];

        $validated = $request->validate($rules);

        Gejala::create($validated);

        return redirect('/dashboard/gejala')->with('success', 'Berhasil menambah data Gejala');
    }

    /**
     * Display the specified resource.
     */
    public function show(Gejala $gejala)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Gejala $gejala, $kd_gejala)
    {
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $kd_gejala)
    {
        $gejala = Gejala::where('kd_gejala', $kd_gejala);

        $rules = [
            'kd_gejala' => 'required|min:3|max:3',
            'nama_gejala' => 'required'
        ];

        $validated = $request->validate($rules);
        $gejala->update($validated);


        return redirect('/dashboard/gejala')->with('success', 'Berhasil edit Gejala');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($kd_gejala)
    {
        $gejala = Gejala::where('kd_gejala', $kd_gejala);

        $gejala->delete();

        return redirect('/dashboard/gejala')->with('success', 'Data berhasil dihapus');
    }
}
