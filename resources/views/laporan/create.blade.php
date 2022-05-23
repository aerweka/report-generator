@extends('app')

@section('page_title', 'Laporan')

@section('content_title', 'Tambah Laporan')

@section('content_body')
	<form method="POST" action="{{ route('laporan.store') }}" class="form-horizontal" enctype="multipart/form-data"
		id="laporan_form">
		@csrf
		<div class="card-body">
			<div class="form-group row">
				<label for="grup_laporan" class="col-sm-2 col-form-label">Grup</label>
				<div class="col-sm-10">
					<select name="M_GRUP_ID" class="custom-select @error('M_GRUP_ID') is-invalid @enderror" id="grup_laporan">
						<option selected disabled>Pilih Grup</option>
						<option>Value 1</option>
					</select>
					@error('M_GRUP_ID')
						<span class="invalid-feedback">{{ $message }}</span>
					@enderror
				</div>
			</div>
			<div class="form-group row">
				<label for="jenis_laporan" class="col-sm-2 col-form-label">Jenis Laporan</label>
				<div class="col-sm-10">
					<select name="JENIS_LAPORAN" class="custom-select @error('JENIS_LAPORAN') is-invalid @enderror" id="jenis_laporan">
						<option selected disabled>Pilih Jenis Laporan</option>
						<option>Value 1</option>
					</select>
					@error('JENIS_LAPORAN')
						<span class="invalid-feedback">{{ $message }}</span>
					@enderror
				</div>
			</div>
			<div class="form-group row">
				<label for="judul_laporan" class="col-sm-2 col-form-label">Judul Laporan</label>
				<div class="col-sm-10">
					<input type="text" class="form-control @error('JUDUL_LAPORAN') is-invalid @enderror" id="judul_laporan"
						value="{{ old('JUDUL_LAPORAN') }}" name="JUDUL_LAPORAN" placeholder="Judul Laporan">
					@error('JUDUL_LAPORAN')
						<span class="invalid-feedback">{{ $message }}</span>
					@enderror
				</div>
			</div>
			<div class="form-group row">
				<label for="keterangan_laporan" class="col-sm-2 col-form-label">Keterangan Laporan</label>
				<div class="col-sm-10">
					<input type="text" class="form-control @error('KETERANGAN_LAPORAN') is-invalid @enderror"
						id="keterangan_laporan value=" {{ old('KETERANGAN_LAPORAN') }}"" placeholder="Keterangan Laporan"
						name="KETERANGAN_LAPORAN">
					@error('KETERANGAN_LAPORAN')
						<span class="invalid-feedback">{{ $message }}</span>
					@enderror
				</div>
			</div>
			<div class="form-group row">
				<label for="cover_laporan" class="col-sm-2 col-form-label">Sampul Laporan</label>
				<div class="input-group col-sm-10">
					<div class="custom-file">
						<input type="file" accept="image/*" class="custom-file-input @error('COVER_LAPORAN') is-invalid @enderror"
							id="cover_laporan" name="COVER_LAPORAN">
						<label class="custom-file-label" for="cover_laporan">Pilih sampul</label>
					</div>
					<div class="input-group-append">
						<span class="input-group-text">Upload</span>
					</div>
					@error('COVER_LAPORAN')
						<span class="invalid-feedback">{{ $message }}</span>
					@enderror
				</div>
			</div>

			<div class="form-group row embed-code">
				<label for="cover_laporan" class="col-sm-2 col-form-label">Report</label>
				<div class="col-sm-3">
					<input type="text" class="form-control" id="keterangan_laporan" placeholder="Judul Halaman "
						name="JUDUL_HALAMAN[]">
					<small class="text-red">*Perhatikan format penulisan</small>
				</div>
				<div class="col-sm-6">
					<input type="text" class="form-control" id="keterangan_laporan" placeholder="Tableau Embed Code"
						name="EMBED_CODE[]">
				</div>
				<div class="col-sm-1 text-right">
					<span class="btn btn-primary"><i class="far fa-plus-square"></i></span>
				</div>
			</div>
		</div>
		<!-- /.card-body -->
	@endsection

	@section('content_footer')

		<button type="submit" class="btn btn-default">Cancel</button>
		<button type="submit" class="btn btn-info  float-right">Sign in</button>
		<!-- /.card-footer -->
	</form>
@endsection
