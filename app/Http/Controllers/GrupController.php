<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Grup;

class GrupController extends Controller
{
    /**
     * @return [type]
     */
    public function index()
    {
        $grup = Grup::all();
        return view('konfig.grup.index', compact('grup'));
    }

    /**
     * @return [type]
     */
    public function create()
    {
        return view('konfig.grup.create');
    }

    /**
     * @param  Request
     * @return [type]
     */
    public function store(Request $req)
    {
        $data = Grup::create($req->all());

        if ($data) return redirect()->route('grup.index');
    }

    public function edit($id)
    {
        $grup = Grup::findOrFail($id);

        return view('konfig.grup.edit', compact('grup'));
    }

    public function update(Request $req, $id)
    {
        $grup = Grup::findOrFail($id);

        if ($grup->update($req->all())) return redirect()->route('grup.index');
    }

    public function destroy($id)
    {
        $grup = Grup::findOrFail($id);

        if ($grup->delete()) return back()->with('success', 'Data berhasil dihapus');

        return back()->withErrors('Data tidak berhasil dihapus');
    }
}
