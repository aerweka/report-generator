<aside class="main-sidebar sidebar-dark-primary elevation-4">
	<!-- Brand Logo -->
	<a href="/laporan" class="brand-link">
		<img src="{{ asset('logo-pdam.png') }}" alt="PDAM Surabaya Logo" class="brand-image img-circle elevation-1">
		<span class="brand-text font-weight-light">PDAM Surabaya</span>
	</a>

	<!-- Sidebar -->
	<div class="sidebar">

		<!-- Sidebar Menu -->
		<nav class="mt-2">
			<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
				<!-- Add icons to the links using the .nav-icon class
													with font-awesome or any other icon font library -->
				<li class="nav-item">
					<a href="/laporan" class="nav-link">
						<i class="nav-icon fas fa-book"></i>
						<p>
							Laporan
						</p>
					</a>
				</li>
				<li class="nav-item">
					<a href="#" class="nav-link">
		              <i class="nav-icon fas fa-tachometer-alt"></i>
		              <p>
		                Konfig
		                <i class="right fas fa-angle-left"></i>
		              </p>
		            </a>
		            <ul class="nav nav-treeview">
		              <li class="nav-item">
		                <a href="{{ route('grup.index') }}" class="nav-link">
		                  <i class="far fa-circle nav-icon"></i>
		                  <p>Grup</p>
		                </a>
		              </li>
		              <li class="nav-item">
		                <a href="{{ route('jenis-laporan.index') }}" class="nav-link">
		                  <i class="far fa-circle nav-icon"></i>
		                  <p>Jenis Laporan</p>
		                </a>
		              </li>
		            </ul>
				</li>
			</ul>
		</nav>
		<!-- /.sidebar-menu -->
	</div>
	<!-- /.sidebar -->
</aside>
