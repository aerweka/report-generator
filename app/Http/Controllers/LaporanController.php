<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\LaporanRequest;
use App\Models\DetailLaporan;
use App\Models\Laporan;
use App\Models\Grup;
use App\Models\JenisLaporan;
use Carbon\Carbon;

class LaporanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Laporan::all();
        return view('laporan.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $grup = Grup::all();
        $jenis = JenisLaporan::all();
        return view('laporan.create', compact('grup', 'jenis'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(LaporanRequest $request)
    {
        $validated = $request->validated();

        if ($request->hasFile('COVER_LAPORAN')) {
            $validated['COVER_LAPORAN'] = $this->saveAndCreatePathOfCoverLaporan($validated['COVER_LAPORAN']);

            if (!$validated['COVER_LAPORAN']) return back()->withErrors('Gagal menyimpan cover laporan');
        }
        
        $data = Laporan::create($validated);

        for ($i=0; $i < count($request->EMBED_CODE) - 1; $i++) { 
            $name = $this->getNameFromEmbedCode($request->EMBED_CODE[$i]);
            DetailLaporan::create([
                'M_LAPORAN_ID' => $data->ID,
                'NOMOR_HALAMAN' => $i+1,
                'JUDUL_HALAMAN' => $request->JUDUL_HALAMAN[$i],
                'EMBED_CODE' => $name,
            ]);
        }

        return redirect()->route('laporan.show', ['id' => $data->ID]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $laporan = Laporan::findOrFail($id);

        $detail = DetailLaporan::where('M_LAPORAN_ID', $id)->get();

        return view('laporan.show', compact('laporan', 'detail'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $laporan = Laporan::where('M_LAPORAN.id', $id)->get();

        $detail = DetailLaporan::where('M_LAPORAN_ID', $id)->get();

        $grup = Grup::all();
        
        $jenis = Grup::all();

        return view('laporan.edit', compact('laporan', 'detail', 'grup', 'jenis'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(LaporanRequest $request, $id)
    {
        $validated = $request->validated();

        $validated['COVER_LAPORAN'] = $this->saveAndCreatePathOfCoverLaporan($validated['COVER_LAPORAN']);

        if (!$validated['COVER_LAPORAN']) return back()->withErrors('Gagal menyimpan cover laporan');
        // if ($request->hasFile('COVER_LAPORAN')) {
        //     $file = $request->file('COVER_LAPORAN');
        //     $validated['COVER_LAPORAN'] = $path;
        // }

        $data = Laporan::where('id', $id)->get();

        $data->update($validated);

        // foreach ($request as $value) {
        for ($i=0; $i < count($request->EMBED_CODE) - 1; $i++) { 
            $name = $this->getNameFromEmbedCode($request->EMBED_CODE[$i]);
            DetailLaporan::updateOrCreate([
                'id' => $request->M_DETAIL_LAPORAN_ID[$i],
            ], [
                'M_LAPORAN_ID' => $data->ID,
                'NOMOR_HALAMAN' => $index++,
                'JUDUL_HALAMAN' => $request->JUDUL_HALAMAN[$i],
                'EMBED_CODE' => $name,
            ]);
        }

        return redirect()->route('laporan.show', ['id' => $data->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function saveAndCreatePathOfCoverLaporan($file)
    {
        if ($file) {
            $fileName = Carbon::now() . '_cover_' . $file->getClientOriginalName();
            $path = $file->storeAs(
                'laporan',
                $fileName,
                'public'
            );
            return $path;
        }

        return false;
    }

    public function cutoffFilter(Request $req)
    {
        if ($req->exists('cutoff')) return redirect()->back()->with('date', $req->cutoff);
    }

    public function getNameFromEmbedCode($embed_code)
    {
        if ($embed_code == null) return false;

        $value = $this->getStringBetween($embed_code, "name='site_root' value='' />", "<param name='tabs'");
        // $value = $this->getStringBetween($embed_code, "<param name='name' ", " />");
        // $value = $this->getStringBetween($value, "value='", "'");

        return $value;
    }

    public function getStringBetween($value, $start, $end)
    {
        $string = ' ' . $value;
        $init = strpos($string, $start);
        if ($init == 0) return false;
        $init += strlen($start);
        $len = strpos($string, $end, $init) - $init;
        return substr($string, $init, $len);
    }
}
