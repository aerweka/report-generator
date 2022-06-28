<?php

namespace App\Services;

use App\Models\Laporan;

class LaporanService {

	private $laporan;

	public function __construct(Laporan $laporan)
	{
		$this->laporan = $laporan;
	}

	public function store(arrray $data): Laporan
	{
		if(array_key_exists('COVER_LAPORAN', $data)){ 
			$data['COVER_LAPORAN'] = $this->fileUploadHandler($data['COVER_LAPORAN']);
            if (!$data['COVER_LAPORAN']) return back()->withErrors('Gagal menyimpan cover laporan');
		}

        $newLaporan = $this->laporan->create($data);

        // for ($i = 0; $i < count($data->EMBED_CODE) - 1; $i++) {
            // $name = $this->getNameFromEmbedCode($data->EMBED_CODE[$i]);
        for ($i = 0; $i < count($data['EMBED_CODE']) - 1; $i++) {
            $name = $this->getNameFromEmbedCode($data['EMBED_CODE'][$i]);
            DetailLaporan::create([
                'M_LAPORAN_ID' => $newLaporan->ID,
                'NOMOR_HALAMAN' => $i + 1,
                // 'JUDUL_HALAMAN' => $data->JUDUL_HALAMAN[$i],
                'JUDUL_HALAMAN' => $data['JUDUL_HALAMAN'][$i],
                'EMBED_CODE' => $name,
            ]);
        }

		return $newLaporan;
	}

	public function update(array $data, Laporan $laporan): bool
	{
		if(array_key_exists('COVER_LAPORAN', $data)){ 
			$data['COVER_LAPORAN'] = $this->fileUploadHandler($data['COVER_LAPORAN']);
            if (!$data['COVER_LAPORAN']) return back()->withErrors('Gagal menyimpan cover laporan');
		}

		for ($i = 0; $i < count($data['EMBED_CODE']) - 1; $i++) {
            $name = $this->getNameFromEmbedCode($data['EMBED_CODE'][$i]);
            DetailLaporan::updateOrCreate([
                'id' => $data['M_DETAIL_LAPORAN_ID'][$i],
            ], [
                'M_LAPORAN_ID' => $laporan->id,
                'NOMOR_HALAMAN' => $i++,
                'JUDUL_HALAMAN' => $data['JUDUL_HALAMAN'][$i],
                'EMBED_CODE' => $name,
            ]);
        }

        return $laporan->update($data);
	}

	public function fileUploadHandler($file)
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

	public function getNameFromEmbedCode($embed_code)
    {
        if ($embed_code == null) return false;

        $value = $this->getStringBetween($embed_code, "<param name='name' ", " />");

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