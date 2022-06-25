@extends('app')

@section('page_title', 'Grup')

@section('content_title', 'Daftar Grup')

@section('content_body')
	<div class="card-body p-0">
		@if(isset($grup) && count($grup) > 0)
			<table class="table table-sm">
        <thead>
          <tr>
            <th style="width: 10px">No</th>
            <th>Nama</th>
            <th>Keterangan</th>
            <th style="width: 150px">#</th>
          </tr>
        </thead>
        <tbody>
      	@php $i=1; @endphp
      	@foreach($grup as $grup)	
          	<tr>
							<td>{{ $i++ }}</td>
							<td>{{ $grup->NAMA_GRUP }}</td>
							<td>{{ $grup->KETERANGAN_GRUP }}</td>
							<td>
								<a href="{{ route('grup.edit', ['id' => $grup->id]) }}" class="btn btn-sm btn-primary">Edit</a>
								<a href="{{ route('grup.destroy', ['id' => $grup->id]) }}" class="btn btn-sm btn-danger">Hapus</a>
							</td>
            </tr>
          @endforeach
        </tbody>
      </table>
		@else
			<div class="col-sm-12 text-center py-4">
				<h4 class="text-muted">Tidak ada grup</h4>
			</div>
		@endif
	</div>
@endsection
@section('content_footer')
	<a href="{{ route('grup.create') }}" class="btn btn-primary float-right">Tambah</a>
@endsection
