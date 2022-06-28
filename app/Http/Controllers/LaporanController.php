<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\LaporanRequest;
use App\Models\{DetailLaporan, Laporan, Grup, JenisLaporan};
use Carbon\Carbon;
use App\Services\laporanService;

class LaporanController extends Controller
{
    private $laporanService;

    public function __construct(LaporanService $laporanService)
    {
        $this->laporanService = $laporanService;
    }

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

        $newLaporan = $this->$laporanService->store($validated);

        // if ($request->hasFile('COVER_LAPORAN')) {
        //     $validated['COVER_LAPORAN'] = $this->saveAndCreatePathOfCoverLaporan($validated['COVER_LAPORAN']);

        //     if (!$validated['COVER_LAPORAN']) return back()->withErrors('Gagal menyimpan cover laporan');
        // }

        // $data = Laporan::create($validated);

        // for ($i = 0; $i < count($request->EMBED_CODE) - 1; $i++) {
        //     $name = $this->getNameFromEmbedCode($request->EMBED_CODE[$i]);
        //     DetailLaporan::create([
        //         'M_LAPORAN_ID' => $data->ID,
        //         'NOMOR_HALAMAN' => $i + 1,
        //         'JUDUL_HALAMAN' => $request->JUDUL_HALAMAN[$i],
        //         'EMBED_CODE' => $name,
        //     ]);
        // }

        return redirect()->route('laporan.show', ['id' => $newLaporan->ID]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Laporan $id)
    {
        $laporan = $id;

        $detail = DetailLaporan::where('M_LAPORAN_ID', $id->id)->get();

        return view('laporan.show', compact('laporan', 'detail'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Laporan $id)
    {
        $laporan = $id;

        $detail = DetailLaporan::where('M_LAPORAN_ID', $id->id)->get();

        $grup = Grup::all();

        $jenis = JenisLaporan::all();

        return view('laporan.edit', compact('laporan', 'detail', 'grup', 'jenis'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(LaporanRequest $request, Laporan $id)
    {
        $validated = $request->validated();

        $updatedLaporan = $this->laporanService->update($validated, $id);

        return redirect()->route('laporan.show', ['id' => $id->id]);
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

    public function cutoffFilter(Request $req)
    {
        if ($req->exists('cutoff')) return redirect()->back()->with('date', $req->cutoff);
    }

    
}
