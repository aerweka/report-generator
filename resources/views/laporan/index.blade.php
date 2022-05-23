@extends('app')

@section('page_title', 'Laporan')

@section('content_title', 'Daftar Laporan')

@section('content_body')
	<div class="card-body">
		<div class="row">
			@isset($data)
				@foreach ($data as $data)
					<div class="col-sm-2">
						<a href="{{ route('laporan.show', ['id' => $data->id]) }}" data-toggle="lightbox" data-title="sample 1 - white"
							data-gallery="gallery">
							<img src="storage/{{ $data->COVER_LAPORAN }}" class="img-fluid mb-2" alt="{{ $data->JUDUL_LAPORAN }}" />
						</a>
					</div>
				@endforeach
			@else
				<div class="col-sm-12 text-center">
					<h4 class="text-muted">Tidak ada laporan</h4>
				</div>
			@endisset
		</div>
	</div>
@endsection
@section('content_footer')
	<a href="{{ route('laporan.create') }}" class="btn btn-primary float-right">Tambah</a>
@endsection
