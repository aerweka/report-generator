@extends('app')

@section('page_title', 'Jenis Laporan')

@section('content_title', 'Tambah Jenis Laporan')

@section('content_body')
	<form method="POST" action="{{ route('jenis-laporan.store') }}" class="form-horizontal" enctype="multipart/form-data"
		id="laporan_form">
		@csrf
		<div class="card-body">
			<div class="form-group row">
				<label for="JENIS_LAPORAN" class="col-sm-2 col-form-label">Nama Jenis</label>
				<div class="col-sm-10">
					<input type="text" class="form-control @error('JENIS_LAPORAN') is-invalid @enderror" id="JENIS_LAPORAN" value="{{ old('JENIS_LAPORAN') }}" name="JENIS_LAPORAN" placeholder="Nama Jenis" required autofocus>
					@error('JENIS_LAPORAN')
						<span class="invalid-feedback">{{ $message }}</span>
					@enderror
				</div>
			</div>
			<div class="form-group row">
				<label for="KETERANGAN_LAPORAN" class="col-sm-2 col-form-label">Keterangan Jenis</label>
				<div class="col-sm-10">
					<input type="text" class="form-control @error('KETERANGAN_LAPORAN') is-invalid @enderror"
						id="KETERANGAN_LAPORAN" value="{{ old('KETERANGAN_LAPORAN') }}" placeholder="Keterangan Jenis"
						name="KETERANGAN_LAPORAN">
					@error('KETERANGAN_LAPORAN')
						<span class="invalid-feedback">{{ $message }}</span>
					@enderror
				</div>
			</div>
		</div>
		<!-- /.card-body -->
	@endsection

	@section('content_footer')

		<button type="submit" class="btn btn-default">Cancel</button>
		<button type="submit" class="btn btn-info  float-right">Simpan</button>
		<!-- /.card-footer -->
	</form>
@endsection
