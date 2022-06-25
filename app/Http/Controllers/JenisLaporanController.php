<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JenisLaporan;

class JenisLaporanController extends Controller
{
    public function index()
    {
        $jenis = JenisLaporan::all();
        return view('konfig.jenis_laporan.index', compact('jenis'));
    }

    public function create()
    {
        return view('konfig.jenis_laporan.create');
    }

    public function store(Request $req)
    {
        $data = JenisLaporan::create($req->all());

        if ($data) return redirect()->route('jenis-laporan.index');
    }

    public function edit($id)
    {
        $jenis = JenisLaporan::findOrFail($id);

        return view('konfig.jenis_laporan.edit', compact('jenis'));
    }

    public function update(Request $req, $id)
    {
        $jenis = JenisLaporan::findOrFail($id);

        if ($jenis->update($req->all())) return redirect()->route('jenis-laporan.index');
    }

    public function destroy($id)
    {
        $jenis = JenisLaporan::findOrFail($id);

        if ($jenis->delete()) return back()->with('success', 'Data berhasil dihapus');

        return back()->withErrors('Data tidak berhasil dihapus');
    }

}
