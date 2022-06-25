@extends('app')

@section('page_title', 'Jenis Laporan')

@section('content_title', 'Daftar Jenis Laporan')

@section('content_body')
	<div class="card-body p-0">
		@if(isset($jenis) && count($jenis) > 0)
			<table class="table table-sm">
        <thead>
          <tr>
            <th style="width: 10px">No</th>
            <th>Jenis</th>
            <th>Keterangan</th>
            <th style="width: 150px">#</th>
          </tr>
        </thead>
        <tbody>
        	@php $i=1; @endphp
      		@foreach($jenis as $jenis)	
          	<tr>
							<td>{{ $i++ }}</td>
							<td>{{ $jenis->JENIS_LAPORAN }}</td>
							<td>{{ $jenis->KETERANGAN_LAPORAN }}</td>
							<td>
								<a href="{{ route('jenis-laporan.edit', ['id' => $jenis->id]) }}" class="btn btn-sm btn-primary">Edit</a>
								<a href="{{ route('jenis-laporan.destroy', ['id' => $jenis->id]) }}" class="btn btn-sm btn-danger">Hapus</a>
							</td>
            </tr>
          @endforeach
        </tbody>
      </table>
		@else
			<div class="col-sm-12 text-center py-4">
				<h4 class="text-muted">Tidak ada jenis</h4>
			</div>
		@endif
	</div>
@endsection
@section('content_footer')
	<a href="{{ route('jenis-laporan.create') }}" class="btn btn-primary float-right">Tambah</a>
@endsection
