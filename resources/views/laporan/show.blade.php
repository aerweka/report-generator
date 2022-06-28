<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	@include('partials.styles')
	<title></title>
</head>

<body>
	<div class="wrapper" style="background-color: #eaeaea">
		<div class="container mx-auto d-flex flex-column" style="max-width: 857px;">
			<section class="content-header px-0">
				<div class="row container">
					<div class="col-sm-2">
						<a href="{{ route('laporan.edit', ['id' => $laporan->id]) }}" class="btn btn-primary">Edit</a>
					</div>
					{{-- form input tanggal --}}
					<div class="col-sm-10 d-flex justify-content-end">
						<form action="{{ route('laporan.filter') }}" method="post">
							@csrf
							<input type="date" name="cutoff" id="" class="mr-2">
							<input type="submit" value="Filter">
						</form>
					</div>
				</div>
				{{-- form input tanggal --}}
			</section>
			<section class="content">
				<div class="container-fluid">
					{{-- cover laporan --}}
					<div class="row ">
						<div class="col-sm-12">
							@if ($laporan->COVER_LAPORAN)
								<img src="/storage/{{ $laporan->COVER_LAPORAN }}" alt="Cover Laporan">
							@else
								<img src="{{ asset('cover-default.jpg') }}" class="img-fluid mb-2" alt="Cover Laporan" />
							@endif
						</div>
					</div>
					{{-- covet laporan --}}

					{{-- daftar isi --}}
					<div class="row">
						<div class="col-sm-12">
							<div class="p-4" style="background-color: white; min-height: 1219px;">
								<dl>
									@isset($detail)
										@foreach ($detail as $lap)
											<dt>
												{{ $lap->JUDUL_HALAMAN }}
												<span class="text-right">{{ $lap->NOMOR_HALAMAN }}</span>
											</dt>
										@endforeach
									@endisset
								</dl>
							</div>
						</div>
					</div>
					{{-- daftar isi --}}

					{{-- isi laporan --}}
					@isset($detail)
						@foreach ($detail as $lap)
							<div class="row">
								<div class="col-sm-12">
									<h2>{{ $lap->JUDUL_HALAMAN }}</h2>
									<script type='text/javascript' src='https://bi.pdam-sby.go.id/javascripts/api/viz_v1.js'></script>
									<div class=' tableauPlaceholder' style='width: 827px; height: 1219px;'><object class='tableauViz' width='827'
											height='1219' style='display:none;'>
											<param name='host_url' value='https%3A%2F%2Fbi.pdam-sby.go.id%2F' />
											<param name='embed_code_version' value='3' />
											<param name='site_root' value='' />
											<param name='name' value='{!! $lap->EMBED_CODE !!}' />
											<param name='tabs' value='false' />
											<param name='toolbar' value='false' />
											<param name='showAppBanner' value='false' />
											@if (session()->has('date'))
												<param name="filter" value="Cutoff={{ session('date') }}">
											@endif
										</object></div>
								</div>
							</div>
						@endforeach
					@endisset
					{{-- isi laporan --}}
				</div>
			</section>
		</div>
	</div>
	@include('partials.scripts')
	<script>
	 $(function() {
	  $('input[name="cutoff"]').change(function() {
	   const val = $(this).val();
	   console.log(val);
	   $('param[name="filter"]').attr('value', `Cutoff=${val}`);
	  })
	 })
	</script>
</body>

</html>
