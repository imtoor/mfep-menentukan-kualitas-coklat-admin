@extends('layouts.main')

@section('title')
    Menu Transaksi
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
                    <h1 class="m-0">Transaksi</h1>
                </div>
                <!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">
                            <a href="#">Home</a>
                        </li>
                        <li class="breadcrumb-item active">
                            Transaksi
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
          
            <!-- Main row -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3>List Transaksi</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            @if ($message = Session::get('success'))
                                <div class="alert alert-success alert-block">
                                <button type="button" class="close" data-dismiss="alert">×</button>
                                <strong>{{ $message }}</strong>
                                </div>
                            @elseif($message = Session::get('errors'))
                                <div class="alert alert-danger alert-block">
                                <button type="button" class="close" data-dismiss="alert">×</button>
                                <strong>{{ $message }}</strong>
                                </div>
                            @endif
                        <div class="table-responsive">
                            
                            <table id="data_table" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Tanggal</th>
                                    <th>Nama</th>
                                    <th>Alamat</th>
                                    <th>No. HP</th>
                                    <th>Metode Bayar</th>
                                    <th>Bank</th>
                                    <th>Bank Holder</th>
                                    <th>Bank Norek</th>
                                    <th>Pengiriman</th>
                                    <th>Pengiriman Biaya</th>
                                    <th>Catatan</th>
                                    <th>Total</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1; ?>
                                    @foreach($orders as $data)
                                        @php
                                            $bg = '';
                                            switch($data->status) {
                                                case 0:
                                                    $bg = 'bg-warning';
                                                    break;
                                                case 1:
                                                    $bg = 'bg-info';
                                                    break;
                                                case 2:
                                                    $bg = 'bg-primary';
                                                    break;
                                                case 3:
                                                    $bg = 'bg-success';
                                                    break;
                                            }
                                        @endphp
                                    <tr class="{{ $bg }}">
                                        <td><?= $no++ ?></td>
                                        <td>{{ $data->created_at }}</td>
                                        <td>{{ ucwords($data->user != null ? $data->user->name:'NULL') }}</td>
                                        <td>{{ $data->address }}</td>
                                        <td>{{ $data->phone }}</td>
                                        <td>{{ strtoupper($data->payment_method) }}</td>
                                        <td>{{ strtoupper($data->bank) }}</td>
                                        <td>{{ ucwords($data->bank_holder) }}</td>
                                        <td>{{ $data->bank_number }}</td>
                                        <td>{{ strtoupper($data->delivery_name) }}</td>
                                        <td>Rp{{ number_format($data->delivery_price) }}</td>
                                        <td>{!! $data->note !!}</td>
                                        <td>Rp{{ number_format($data->total) }}</td>
                                        <td>
                                            @php
                                                if($data->status == 0) {
                                                    $title = "Sudah bayar";
                                                    $update = 1;
                                                    $status = "<i class='fa-icon fas fa-money-bill'></i>";
                                                    echo "Menunggu Pembayaran";
                                                }
                                                elseif($data->status == 1) {
                                                    $title = "Kirim Pesanan";
                                                    $update = 2;
                                                    $status = "<i class='fa-icon fas fa-paper-plane'></i>";
                                                    echo "Menunggu Pengiriman";
                                                }
                                                elseif($data->status == 2) {
                                                    $title = "Pesanan diterima";
                                                    $update = 3;
                                                    $status = "<i class='fa-icon fas fa-check'></i>";
                                                    echo "Pesanan dalam perjalanan";
                                                }
                                                elseif($data->status == 3) {
                                                    echo "Pesanan diterima";
                                                }
                                            @endphp
                                        </td>
                                        <td>
                                            @if(Auth::user()->level == 'admin' && $data->status != 3)
                                                <button type="button" title="{{ $title }}" onclick="updateStatus('{{ $data->id }}','{{ $update }}')" class="btn btn-sm btn-success">
                                                    {{ $title }} {!! $status !!}
                                                </button>
                                            @endif

                                            <button type="button" data-toggle="modal" data-target="#showDetails" onclick="getItems('{{ $data->id }}')" title="Lihat Item Pesanan" class="btn btn-sm btn-info">
                                               Lihat Pesanan <i class="fa-icon fas fa-eye"></i>
                                            </button>
                                            
                                            @if(Auth::user()->level == 'admin')
                                                <button
                                                    class="btn btn-sm btn-danger" title="Hapus" 
                                                    onclick="confirm_del('{{ route('menu-transaksi.destroy', $data->id) }}')">
                                                    Hapus Pesanan<i class="fa-icon fas fa-trash"></i>
                                                </button>
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                                <tfoot></tfoot>
                                </table>
                            </div>

                        </div>
                        <!-- /.card-body -->
                    </div>                  

                </div>
            </div>            
            <!-- /.row (main row) -->
        </div>
        <!-- /.container-fluid -->

<!-- Modal -->
<div class="modal fade" id="showDetails" tabindex="-1" role="dialog" aria-labelledby="showDetailsLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="showDetailsLabel">Detail Pesanan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12 table-responsive">        
                <table class="table" width="100%">
                    <thead>            
                        <tr>
                            <th>No.</th>
                            <th>Nama</th>
                            <th>Harga</th>
                            <th>Qty</th>
                            <th>Sub Total</th>
                        </tr>
                    </thead>
                    <tbody id="details"></tbody>
                </table>
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
      </div>
    </div>
  </div>
</div>        
    </section>
    <!-- /.content -->
    <form action="" method="POST" style="display:none" id="form_delete">
        @method('DELETE')
        @csrf
        <button class="btn btn-danger btn-sm" id='btn-hapus' type="submit">
        <i class="fa-icon fas fa-trash"></i></button>
    </form>    
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
        $('a#menu_transaksi').addClass('active');

        $("table#data_table").DataTable({
          "responsive": true, "lengthChange": true, "autoWidth": false,
          "lengthMenu": [[5, 10, 25, 50, 100, -1], [5, 10, 25, 50, 100, "Semua"]],
          "buttons": ["csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#data_table_wrapper .col-md-6:eq(0)');

        function confirm_del(route) {
            if(!confirm('Hapus transaksi ini ?')) return false;
             $("form").attr("action", route);
             $("button#btn-hapus").trigger("click");
        }

        function getItems(id) {
            $.ajax({
                url: `{{ url('api/orders/${id}') }}`,
                type: "GET",
                data: {},
                dataType: "json"
            }).done(function(res) {
                if (res.success) {
                    let data = res.data.order_item;
                    if (data.length == 0) {
                        $("tbody#details").html("<tr><td colspan='4' class='text-center'>Tidak ada pesanan</td></tr>");
                    } else {
                        let tbody = "";
                        for(var i = 0; i < data.length; i++) {                        
                            tbody += "<tr>";
                            tbody += "<td>" + (i+1) + ".</td>";
                            tbody += "<td>" + data[i].products.nama + "</td>";
                            tbody += "<td>Rp" + new Intl.NumberFormat().format(data[i].products.harga) + "</td>";
                            tbody += "<td>" + data[i].qty + "</td>";
                            tbody += "<td>Rp" + new Intl.NumberFormat().format(data[i].qty * data[i].products.harga) + "</td>";
                            tbody += "</tr>";
                        }
                        $("tbody#details").html(tbody);
                    }
                }
            }).fail(function(res) {
                console.log(res);
            });
        }

        function updateStatus(id, val) {
            if(!confirm('Update Status Transaksi ?')) return false;
            $.ajax({
                url: `{{ url('api/update-status') }}`,
                type: "POST",
                data: {id: id, status: val},
                dataType: "json"
            }).done(function(res) {
                alert(res.message);
                if (res.success) {
                    location.reload();
                }
            }).fail(function(res) {
                console.log(res);
            });
        }
    </script>
@endsection