@extends('layouts.main')

@section('title')
Menu Edit Produk
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
            <h1 class="m-0">Data Edit Produk</h1>
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
                  <h3 class="card-title">Edit</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form method="POST" action="/menu-produk/{{ $produk->id }}" enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                    <div class="card-body">
                      <div class="card-body">
                        <div class="form-group">
                            <label for="gambar">Gambar <i>(Pilih untuk mengganti/menambahkan)</i></label>
                            <input id="gambar" type="file" placeholder="Gambar" class="form-control @error('gambar') is-invalid @enderror" name="gambar" value="{{ old('gambar') }}"  autofocus>
                            @error('gambar')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror                          
                        </div>                        
                        <div class="form-group">
                            <label for="nama">Nama Produk</label>
                            <input id="nama" value="{{ $produk->nama }}" type="text" placeholder="Nama Lengkap" class="form-control @error('nama') is-invalid @enderror" name="nama" value="{{ old('nama') }}" required autocomplete="nama" autofocus>
                            @error('nama')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="harga">Harga</label>
                            <input id="harga" type="number" value="{{ $produk->harga }}" placeholder="Harga" class="form-control @error('harga') is-invalid @enderror" name="harga" value="{{ old('harga') }}" required autocomplete="harga">
                            @error('harga')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="stok">Stok</label>
                            <input id="stok" type="number" value="{{ $produk->stok }}" placeholder="stok" class="form-control @error('stok') is-invalid @enderror" name="stok" value="{{ old('stok') }}" required autocomplete="stok">
                            @error('stok')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                          <label for="kadar_air">Kadar Air</label>
                          <select class="form-control" id="kadar_air" name="kadar_air">
                            <option {{ $produk->kadar_air == "" ? 'selected' : '' }}>-</option>
                                <option value="rendah" {{ $produk->kadar_air == "rendah" ? 'selected' : '' }}>Rendah</option>
                                <option value="sedang" {{ $produk->kadar_air == "sedang" ? 'selected' : '' }}>Sedang</option>
                                <option value="tinggi" {{ $produk->kadar_air == "tinggi" ? 'selected' : '' }}>Tinggi</option>
                            </select>
                            @error('kadar_air')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="tekstur">Tekstur</label>
                            <select class="form-control" id="tekstur" name="tekstur">
                                <option {{ $produk->tekstur == "" ? 'selected' : '' }}>-</option>
                                <option value="lembek" {{ $produk->tekstur == "lembek" ? 'selected' : '' }}>Lembek</option>
                                <option value="sedang" {{ $produk->tekstur == "sedang" ? 'selected' : '' }}>Sedang</option>
                                <option value="keras" {{ $produk->tekstur == "keras" ? 'selected' : '' }}>Keras</option>
                            </select>
                            @error('tekstur')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                          <label for="aroma">Aroma</label>
                          <select class="form-control" id="aroma" name="aroma">
                                <option {{ $produk->aroma == "" ? 'selected' : '' }}>-</option>
                                <option value="harum" {{ $produk->aroma == "harum" ? 'selected' : '' }}>Harum</option>
                                <option value="tidak berbau" {{ $produk->aroma == "tidak berbau" ? 'selected' : '' }}>Tidak Berbau</option>
                                <option value="busuk" {{ $produk->aroma == "busuk" ? 'selected' : '' }}>Busuk</option>
                            </select>
                            @error('aroma')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
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
        $('a#menu_produk').addClass('active');
    </script>
@endsection