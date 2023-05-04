@extends('layouts.main')

@section('title')
Menu Produk
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
            <h1 class="m-0">Data Produk</h1>
          </div>
          <!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item">
                <a href="#">Home</a>
              </li>
              <li class="breadcrumb-item active">
                Data Produk
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
                  <h3 class="card-title">Tambah Produk</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form method="POST" action="/menu-produk">
                  @csrf
                      <div class="card-body">
                        <div class="form-group">
                            <label for="name">Nama Produk</label>
                            <input id="nama" type="text" placeholder="Nama Produk" class="form-control @error('nama') is-invalid @enderror" name="nama" value="{{ old('nama') }}" required autocomplete="nama" autofocus>
                            @error('nama')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="harga">Harga</label>
                            <input id="harga" type="number" placeholder="harga" class="form-control @error('harga') is-invalid @enderror" name="harga" value="{{ old('harga') }}" required autocomplete="harga">
                            @error('harga')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                          <label for="kadar_air">Kadar Air</label>
                          <select class="form-control @error('kadar_air') is-invalid @enderror" name="kadar_air" value="{{ old('kadar_air') }}" required autocomplete="kadar_air" id="kadar_air" name="kadar_air">
                            <option>-</option>
                            <option value="rendah">Rendah</option>
                            <option value="sedang">Sedang</option>
                            <option value="tinggi">Tinggi</option>
                          </select>
                          <!-- <input id="kadar_air" type="text" placeholder="kadar_air" class="form-control @error('kadar_air') is-invalid @enderror" name="kadar_air" value="{{ old('kadar_air') }}" required autocomplete="kadar_air"> -->
                            @error('kadar_air')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                          <label for="tekstur">Tekstur</label>
                          <select class="form-control @error('tekstur') is-invalid @enderror" name="tekstur" value="{{ old('tekstur') }}" required autocomplete="tekstur" id="tekstur" name="tekstur">
                            <option>-</option>
                            <option value="lembek">Lembek</option>
                            <option value="sedang">Sedang</option>
                            <option value="keras">Keras</option>
                          </select>
                          <!-- <input id="tekstur" type="text" placeholder="tekstur" class="form-control @error('tekstur') is-invalid @enderror" name="tekstur" value="{{ old('tekstur') }}" required autocomplete="tekstur"> -->
                            @error('tekstur')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                          <label for="aroma">Aroma</label>
                          <select class="form-control @error('aroma') is-invalid @enderror" name="aroma" value="{{ old('aroma') }}" required autocomplete="aroma" id="aroma" name="aroma">
                            <option>-</option>
                            <option value="harum">Harum</option>
                            <option value="tidak berbau">Tidak Berbau</option>
                            <option value="busuk">Busuk</option>
                          </select>
                          <!-- <input id="aroma" type="text" placeholder="aroma" class="form-control @error('aroma') is-invalid @enderror" name="aroma" value="{{ old('aroma') }}" required autocomplete="aroma"> -->
                            @error('aroma')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                      </div>
                  <!-- /.card-body -->
                      <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <a href="{{ url('/menu-produk') }}" class="btn btn-danger">Batal</a>
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
        $('a#menu-produk').addClass('active');

    </script>
@endsection