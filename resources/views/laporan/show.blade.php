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
		<div class="content-wrapper" style="background-color: #eaeaea">
			<div class="container">
				<section class="content-header">
					{{-- form input tanggal --}}
					<div class="col-sm-9 d-flex justify-content-end align-items-end">
						<form action="{{ route('laporan.filter') }}" method="post">
							@csrf
							<input type="date" name="cutoff" id="" class="mr-2">
							<input type="submit" value="Filter">
						</form>
					</div>
					{{-- form input tanggal --}}
				</section>
				<section class="content d-flex justify-content-center align-items-center">
					<div class="container-fluid">
						{{-- cover laporan --}}
						<div class="row ">
							<div class="col-sm-6">
								<div width="827" height="1219">
									{{-- <img src="/storage/{{ $data->COVER_LAPORAN }}" alt="Cover Laporan"> --}}
								</div>
							</div>
						</div>
						{{-- covet laporan --}}

						{{-- daftar isi --}}
						<div class="row">
							<div class="col-sm-6">
								<div width="827" height="1219" style="background-color: white">
									<dl>
										@isset($laporan)
											@foreach ($laporan as $lap)
												<dt>{{ $lap->JUDUL_HALAMAN }} <span class="text-right">{{ $lap->NOMOR_HALAMAN }}</span></dt>
											@endforeach
										@endisset
									</dl>
								</div>
							</div>
						</div>
						{{-- daftar isi --}}

						{{-- isi laporan --}}
						{{-- @isset($laporan)
							@foreach ($laporan as $lap) --}}
						<div class="row">
							<div class="col-sm-6">
								{{-- <h2>{{ $lap->JUDUL_HALAMAN }}</h2> --}}
								<script type='text/javascript' src='https://bi.pdam-sby.go.id/javascripts/api/viz_v1.js'></script>
								<div class=' tableauPlaceholder' style='width: 827px; height: 1219px;'><object class='tableauViz' width='827'
										height='1219' style='display:none;'>
										<param name='host_url' value='https%3A%2F%2Fbi.pdam-sby.go.id%2F' />
										<param name='embed_code_version' value='3' />
										<param name='site_root' value='' />
										<param name='name' value='LaporanBulananProdisEksekutifSummmary&#47;Total' />
										<param name='tabs' value='false' />
										<param name='toolbar' value='false' />
										<param name='showAppBanner' value='false' />
										@isset($date)
											<param name="filter" value="Cutoff={{ $date }}">
										@endisset
									</object></div>
							</div>
						</div>
						{{-- @endforeach
						@endisset --}}
						{{-- isi laporan --}}
					</div>
				</section>
			</div>
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
