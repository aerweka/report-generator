<?php

namespace App\Http\Controllers;

use App\Http\Requests\LaporanRequest;
use App\Models\DetailLaporan;
use App\Models\Laporan;
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
        return view('laporan.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('laporan.create');
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
        echo "<script>console.log('" . json_decode($validated) . "')</script>";
        $validated['COVER_LAPORAN'] = $this->saveAndCreatePathOfCoverLaporan($validated['COVER_LAPORAN']);
        echo "<script>console.log('" . $validated['COVER_LAPORAN'] . "')</script>";

        if (!$validated['COVER_LAPORAN']) return back()->withErrors('Gagal menyimpan cover laporan');
        // if ($request->hasFile('COVER_LAPORAN')) {
        //     $file = $request->file('COVER_LAPORAN');
        //     $validated['COVER_LAPORAN'] = $path;
        // }

        $data = Laporan::create($validated);

        $index = 0;
        foreach ($request as $value) {
            DetailLaporan::create([
                'M_LAPORAN_ID' => $data->id,
                'NOMOR_HALAMAN' => $index++,
                'JUDUL_HALAMAN' => $value,
                'EMBED_CODE' => $value,
            ]);
        }

        return redirect()->route('laporan.show', ['id' => $data->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Laporan::where('id', $id)
            ->rightJoin('M_DETAIL_LAPORAN', 'M_DETAIL_LAPORAN.M_LAPORAN_ID', 'M_LAPORAN.id')
            ->pluck('JUDUL_HALAMAN', 'NOMOR_HALAMAN', 'EMBED_CODE', 'COVER_LAPORAN');

        return view('laporan.show', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $dataLaporan = Laporan::where('M_LAPORAN.id', $id)->get();

        $dataDetail = DetailLaporan::where('M_LAPORAN_ID', $id)->get();

        return view('laporan.edit', compact('dataLaporan', 'dataDetail'));
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

        $index = 0;
        foreach ($request as $value) {
            DetailLaporan::updateOrCreate([
                'id' => $value->M_DETAIL_LAPORAN_ID,
            ], [
                'M_LAPORAN_ID' => $data->id,
                'NOMOR_HALAMAN' => $index++,
                'JUDUL_HALAMAN' => $value->JUDUL_HALAMAN,
                'EMBED_CODE' => $value->EMBED_CODE,
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
            return $file->storeAs(
                'laporan',
                $fileName,
                'public'
            );
        }

        return false;
    }
}
