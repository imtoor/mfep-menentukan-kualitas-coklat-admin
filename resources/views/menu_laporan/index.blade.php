@extends('layouts.main')

@section('title')
    Menu Laporan
@endsection

@section('myCss')
  <!-- DataTables -->
  <link rel="stylesheet" href="{{ asset('template/adminlte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
  <link rel="stylesheet" href="{{ asset('template/adminlte/plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">
@endsection

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Laporan</h1>
                </div>
                <!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">
                            <a href="#">Home</a>
                        </li>
                        <li class="breadcrumb-item active">
                            Laporan
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
                <!-- right col (We are only adding the ID to make the widgets sortable)-->
                <div class="col-sm-12 col-md-12 col-lg-12">

                    <div class="card">
                        <div class="card-header">Laporan Transaksi</div>

                        <div class="card-body">

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
                            </tr>
                            </thead>
                                <tbody>
                                    <?php $no = 1; ?>
                                    @foreach($transactions as $data)
                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td>{{ $data->created_at }}</td>
                                        <td>{{ 'Nama' }}</td>
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
                                    </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr class="bg-gray">
                                        <td colspan="12" class="text-right"><h5>Total</h5></td>
                                        <td colspan="2"><h5 id="total">Rp0</h5></td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>                    
                     
                        </div>
                    </div>

                </div>
                <!-- right col -->
            </div>
            <!-- /.row (main row) -->
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
        $('a#menu_laporan').addClass('active');

        $("table#data_table").DataTable({
          "responsive": true, "lengthChange": true, "autoWidth": false,
          "lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "Semua"]],
          "buttons": [{extend: "excel", footer: true}, {extend: "print", footer: true}],
          "footerCallback": function(row, data, start, end, display) {
            let api = this.api();

            let total = 0;
            data.forEach((i) => {
                let currTotal = i[12].replace('Rp', '');
                currTotal = currTotal.replace(',', '');
                total += parseInt(currTotal);
            })

            $("h5#total").html('Rp' + new Intl.NumberFormat().format(total.toString()))

          }
        }).buttons().container().appendTo('#data_table_wrapper .col-md-6:eq(0)');        
    </script>
@endsection