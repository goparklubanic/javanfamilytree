<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Keluarga;
class ControllerKeluarga extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('index');
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
        //
        Keluarga::create($request->all());
        return redirect()->route('klgUtama')->with('success','Data berhasil disimpan');
    }

    /**
     * Display the specified resource.
     */
    // public function show(string $id)
    // {
    //     //
    // }

    /**
     * Show the form for editing the specified resource.
     */
    // public function edit(string $id)
    // {
    //     //
    // }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // echo $id;
        $klg = Keluarga::find($id);
        $klg->urutKe = $request->urutKe;
        $klg->nama = $request->nama;
        $klg->jnKelamin = $request->jnKelamin;
        $klg->save();
        return redirect()->route('klgUtama')->with('success','Data telah diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $klg = Keluarga::find($id);
        $klg->delete();
        return redirect()->route('klgUtama')->with('success','Data telah dihapus');
    }
}
