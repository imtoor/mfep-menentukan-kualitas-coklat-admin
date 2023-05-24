@extends('layouts.main')

@section('title')
Menu User Pelanggan
@endsection


@section('myCss')
  <!-- DataTables -->
  <link rel="stylesheet" href="{{ asset('template/adminlte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
  <link rel="stylesheet" href="{{ asset('template/adminlte/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
  <link rel="stylesheet" href="{{ asset('template/adminlte/plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">
@endsection

@section('content')
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<div class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1 class="m-0">User Pelanggan</h1>
				</div>
				<!-- /.col -->
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item">
							<a href="#">Home</a>
						</li>
						<li class="breadcrumb-item active">
						User Pelanggan
						</li>
					</ol>
				</div>
				<!-- /.col -->
			</div>
			<!-- /.row -->
		</div>
		<!-- /.container-fluid -->
	</div>
	<!-- /.content-header -->
	<!-- Main content -->
	<section class="content">
		<div class="container-fluid">
			<div class="row">
				<div class="col-12">
					<div class="card">
						<div class="card-header">
							<a href="/menu-userpelanggan/create"><button class="btn btn-primary btn-sm"><i class="fa-icon fas fa-plus"></i> Tambah Data User Pelanggan</button></a>
						</div>
						<!-- /.card-header -->
						<div class="card-body">
							@if ($message = Session::get('sukses'))
								<div class="alert alert-success alert-block">
								<button type="button" class="close" data-dismiss="alert">×</button>
								<strong>{{ $message }}</strong>
								</div>
							@elseif($message = Session::get('error_email'))
								<div class="alert alert-danger alert-block">
								<button type="button" class="close" data-dismiss="alert">×</button>
								<strong>{{ $message }}</strong>
								</div>
							@elseif($message = Session::get('error'))
								<div class="alert alert-danger alert-block">
								<button type="button" class="close" data-dismiss="alert">×</button>
								<strong>{{ $message }}</strong>
								</div>
							@endif
							<table id="data_userpelanggan" class="table table-bordered table-striped">
							<thead>
							<tr>
								<th>No.</th>
								<th>Nama Lengkap</th>
								<th>Email</th>
								<th>Phone</th>
								<th>Address</th>
								<th>Aksi</th>
							</tr>
							</thead>
							<tbody>
								<?php $no = 1; ?>
								@foreach($user as $data)
								<tr>
									<td><?= $no++ ?></td>
									<td>{{ $data->name }}</td> 
									<td>{{ $data->email }}</td> 
									<td>{{ $data->phone }}</td>
									<td>{{ $data->address }}</td>
									<td>
									<button 
										class="btn btn-sm btn-danger" title="Hapus"
										onclick="confirm_del('{{ $data->name }} ', '{{ route('menu-userpelanggan.destroy', $data->id) }}')">
										<i class="fa-icon fas fa-trash"></i>
									</button>
										<a href="/menu-userpelanggan/{{ $data->id }}/edit" class="btn btn-sm btn-warning"><i class="fa-icon fas fa-pen"></i></a>
									<button
										class="btn btn-sm btn-primary" title="reset" 
										onclick="confirm_resetpass('{{ $data->name }} ', '{{ url("password-reset/".$data->id) }}')">
										<i class="fa-icon fas fa-key"></i>
									</button>
									</td>
								</tr>
								@endforeach
							</tbody>
							</tfoot>
							</table>

						</div>
						<!-- /.card-body -->
					</div>					

				</div>
			</div>
		</div>
		<!-- /.container-fluid -->
	</section>
	<form action="" method="POST" style="display:none" id="form_reset">
		@method('PUT')
		@csrf
		<button class="btn btn-danger btn-sm" id='btn-reset' type="submit">
		<i class="fa-icon fas fa-trash"></i></button>
    </form>
	<form action="" method="POST" style="display:none" id="form_delete">
		@method('DELETE')
		@csrf
		<button class="btn btn-danger btn-sm" id='btn-hapus' type="submit">
		<i class="fa-icon fas fa-trash"></i></button>
    </form>
	<!-- /.content -->
</div>
@endsection


@section('myLib')
	<!-- DataTables  & Plugins -->
	<script src="{{ asset('template/adminlte/plugins/datatables/jquery.dataTables.min.js')}}"></script>
	<script src="{{ asset('template/adminlte/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
	<script src="{{ asset('template/adminlte/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
	<script src="{{ asset('template/adminlte/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
	<script src="{{ asset('template/adminlte/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
	<script src="{{ asset('template/adminlte/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
	<script src="{{ asset('template/adminlte/plugins/jszip/jszip.min.js') }}"></script>
	<script src="{{ asset('template/adminlte/plugins/pdfmake/pdfmake.min.js') }}"></script>
	<script src="{{ asset('template/adminlte/plugins/pdfmake/vfs_fonts.js') }}"></script>
	<script src="{{ asset('template/adminlte/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
	<script src="{{ asset('template/adminlte/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
	<script src="{{ asset('template/adminlte/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
@endsection

@section('myJs')
<script>
        $('a#menu_userpelanggan').addClass('active');

        $("table#data_userpelanggan").DataTable({
	      "responsive": true, "lengthChange": true, "autoWidth": false,
		  "lengthMenu": [[5, 10, 25, 50, 100, -1], [5, 10, 25, 50, 100, "Semua"]],
	      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
	    }).buttons().container().appendTo('#data_userpelanggan_wrapper .col-md-6:eq(0)');

		function confirm_del(name, route) {
			if(!confirm('Anda yakin akan menghapus data '+name+'?')) return false;
			 $("form#form_delete").attr("action", route);
			 $("button#btn-hapus").trigger("click");
		}

		function confirm_resetpass(name, route) {
			if(!confirm('Reset password '+ name + 'dengan password default ?')) return false;
             $("form#form_reset").attr("action", route);
             $("button#btn-reset").trigger("click");
		}

    </script>
@endsection