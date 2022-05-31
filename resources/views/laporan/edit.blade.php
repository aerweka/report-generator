@extends('app')

@section('page_title', 'Laporan')

@section('content_title', 'Ubah Laporan')

@section('content_body')
	<form method="POST" action="{{ route('laporan.update', ['id' => $laporan->id]) }}" class="form-horizontal" enctype="multipart/form-data"
		id="laporan_form">
		@csrf
		<input type="hidden" name="id" value="{{ $laporan->id }}">
		<div class="card-body">
			<div class="form-group row">
				<label for="grup_laporan" class="col-sm-2 col-form-label">Grup</label>
				<div class="col-sm-10">
					<select name="M_GRUP_ID" class="custom-select @error('M_GRUP_ID') is-invalid @enderror" id="grup_laporan">
						<option selected disabled>Pilih Grup</option>
						@isset($grup)
							@foreach ($grup as $grup)
								<option value="{{ $grup->id }}" {{ $laporan->M_GRUP_ID == $grup->id && 'selected' }}>
									{{ $grup->NAMA_GRUP }}</option>
							@endforeach
						@endisset
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
						@isset($jenis_laporan)
							@foreach ($jenis_laporan as $jenis)
								<option value="{{ $jenis->id }}" {{ $laporan->M_GRUP_ID == $jenis->id && 'selected' }}>
									{{ $jenis->NAMA_JENIS }}</option>
							@endforeach
						@endisset
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
						value="{{ $laporan->JUDUL_LAPORAN }}" name="JUDUL_LAPORAN" placeholder="Judul Laporan">
					@error('JUDUL_LAPORAN')
						<span class="invalid-feedback">{{ $message }}</span>
					@enderror
				</div>
			</div>
			<div class="form-group row">
				<label for="keterangan_laporan" class="col-sm-2 col-form-label">Keterangan Laporan</label>
				<div class="col-sm-10">
					<input type="text" class="form-control @error('KETERANGAN_LAPORAN') is-invalid @enderror"
						id="keterangan_laporan" value=" {{ $laporan->KETERANGAN_LAPORAN }} " placeholder="Keterangan Laporan"
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

			@foreach ($detail as $item)
				<input type="hidden" name="M_DETAIL_LAPORAN_ID[]" value="{{ $item->id }}">
				<div class="form-group row embed-code">
					<label for="cover_laporan" class="col-sm-2 col-form-label">Report</label>
					<div class="col-sm-3">
						<input type="text" class="form-control" id="keterangan_laporan" placeholder="Judul Halaman "
							name="JUDUL_HALAMAN[]" value="{{ $item->JUDUL_HALAMAN }}">
						<small class="text-red">*Perhatikan format penulisan</small>
					</div>
					<div class="col-sm-6">
						<input type="text" class="form-control" id="keterangan_laporan" placeholder="Tableau Embed Code"
							name="EMBED_CODE[]" value="{{ $item->EMBED_CODE }}">
					</div>
					<div class="col-sm-1 text-right d-flex justify-content-around align-items-start">
						<span class="btn btn-danger delete"><i class="fas fa-times"></i></span>
					</div>
				</div>
			@endforeach
			<div class="dynamic-form">

			</div>
			<div class="text-center">
				<span class="btn btn-primary add-one"><i class="far fa-plus-square"></i></span>
			</div>
		</div>
		<!-- /.card-body -->

		<div class="form-group row embed-code d-none">
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
				<span class="btn btn-primary add-one"><i class="far fa-plus-square"></i></span>
			</div>
		</div>
	@endsection

	@section('content_footer')

		<button type="submit" class="btn btn-default">Cancel</button>
		<button type="submit" class="btn btn-info  float-right">Simpan</button>
		<!-- /.card-footer -->
	</form>
@endsection

@section('page_scripts')
	<script>
	 $('.add-one').click(function() {
	  $('.embed-code').first().clone().appendTo('.dynamic-form').show();
	  attach_delete();
	 });
	 //Attach functionality to delete buttons
	 function attach_delete() {
	  $('.delete').off();
	  $('.delete').click(function() {
	   if ($('.embed-code').length > 1) {
	    $(this).closest('.form-group').remove();
	   }
	  });
	 }
	</script>
@endsection
