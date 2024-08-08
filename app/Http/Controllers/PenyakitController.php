<?php

namespace App\Http\Controllers;

use App\Models\Penyakit;
use Illuminate\Http\Request;

class PenyakitController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (auth()->guest()) {
            abort(403);
        }
        $penyakit = Penyakit::all();
        return view('dashboard.penyakit.penyakit', compact('penyakit'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rules = [
            'kd_penyakit' => 'required|max:3|min:3',
            'nama_penyakit' => 'required',
            'penyembuhan' => 'required'
        ];

        $validated = $request->validate($rules);

        Penyakit::create($validated);

        return redirect('/dashboard/penyakit')->with('success', 'Data penyakit baru ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Penyakit $penyakit)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Penyakit $penyakit)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $kd_penyakit)
    {
       $penyakit = Penyakit::where('kd_penyakit', $kd_penyakit)->first();
        $penyakit->kd_penyakit = $request->kd_penyakit;
        $penyakit->nama_penyakit = $request->nama_penyakit;
        $penyakit->penyembuhan = $request->penyembuhan;
        $penyakit->save();
        return redirect('/dashboard/penyakit')->with('success', 'Data penyakit berhasil di edit');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Penyakit $penyakit, $kd_penyakit)
    {
        $penyakit = Penyakit::where('kd_penyakit', $kd_penyakit)->first();

        $penyakit->delete();

        return redirect('dashboard/penyakit')->with('success', 'Data penyakit berhasil dihapus');
    }
}
