@extends('app')

@section('page_title', 'Grup')

@section('content_title', 'Tambah Grup')

@section('content_body')
	<form method="POST" action="{{ route('grup.store') }}" class="form-horizontal" enctype="multipart/form-data"
		id="laporan_form">
		@csrf
		<div class="card-body">
			<div class="form-group row">
				<label for="NAMA_GRUP" class="col-sm-2 col-form-label">Nama Grup</label>
				<div class="col-sm-10">
					<input type="text" class="form-control @error('NAMA_GRUP') is-invalid @enderror" id="NAMA_GRUP" value="{{ old('NAMA_GRUP') }}" name="NAMA_GRUP" placeholder="Nama Grup" required autofocus>
					@error('NAMA_GRUP')
						<span class="invalid-feedback">{{ $message }}</span>
					@enderror
				</div>
			</div>
			<div class="form-group row">
				<label for="KETERANGAN_GRUP" class="col-sm-2 col-form-label">Keterangan GRUP</label>
				<div class="col-sm-10">
					<input type="text" class="form-control @error('KETERANGAN_GRUP') is-invalid @enderror"
						id="KETERANGAN_GRUP" value="{{ old('KETERANGAN_GRUP') }}" placeholder="Keterangan GRUP"
						name="KETERANGAN_GRUP">
					@error('KETERANGAN_GRUP')
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
