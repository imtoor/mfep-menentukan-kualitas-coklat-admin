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
            <h1 class="m-0">Edit Password User</h1>
          </div>
          <!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item">
                <a href="#">Home</a>
              </li>
              <li class="breadcrumb-item active">
                Edit Data User
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
            
            <!-- general form elements -->
              <div class="card card-primary">
                <div class="card-header">
                  <h3 class="card-title">Edit Password User</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form method="POST" action="/password/{{ $user->id }}">
                    @method('PUT')
                    @csrf
                    <div class="card-body">
                      <div class="card-body">
                        <div class="form-group">
                          <label for="password">Password</label>
                          <input id="password" type="password" placeholder="Password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                          <label for="password-confirm">Confirm Password</label>
                          <input id="password-confirm" type="password" placeholder="Confirm password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                        </div>
                      </div>
                  <!-- /.card-body -->
                      <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <a href="{{ url('/menu-userpelanggan') }}" class="btn btn-danger">Batal</a>
                      </div>
                      
                    </form>
              </div>			

          </div>

        </div>
      </div>
      <!-- /.container-fluid -->
    </section>
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
        // $('a#menu_userpelanggan').addClass('active');

        $("table#data_user").DataTable({
	      "responsive": true, "lengthChange": true, "autoWidth": false,
		  "lengthMenu": [[5, 10, 25, 50, 100, -1], [5, 10, 25, 50, 100, "Semua"]],
	      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
	    }).buttons().container().appendTo('#data_anggota_wrapper .col-md-6:eq(0)');

    </script>
@endsection