<?php

namespace App\Http\Controllers;

use App\Models\Rule;
use App\Models\Gejala;
use App\Models\Penyakit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RuleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $rule = Rule::with('gejala', 'penyakit')->get();
        $gejala = Gejala::all();
        $penyakit = Penyakit::all();
        return view('dashboard.rule.rule', compact('rule', 'gejala', 'penyakit'));
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
            'kd_rule' => 'required|min:3|max:3|unique:rules,kd_rule',
            'kd_gejala' => 'required',
            'kd_penyakit' => 'required'
        ];
        $validated = $request->validate($rules);
        Rule::create($validated);
        return redirect('/dashboard/rule')->with('success', 'Berhasil menambah rule baru');
    }

    /**
     * Display the specified resource.
     */
    public function show(Rule $rule)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Rule $rule)
    {
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $kd_rule)
    {
        $rule = Rule::where('kd_rule', $kd_rule)->first();
        $rules = [
            'kd_rule' => 'required|min:3|max:3',
            'kd_gejala' => 'required',
            'kd_penyakit' => 'required'
        ];

        $validated = $request->validate($rules);

        $rule->update($validated);

        return redirect('/dashboard/rule')->with('success', 'Berhasil edit rule');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($kd_rule)
    {
        $rule = Rule::where('kd_rule', $kd_rule)->first();
        $rule->delete();
        return redirect('/dashboard/rule')->with('success', 'Data berhasil dihapus');
    }
}
