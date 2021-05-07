@extends('layouts/base')
@section('token')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('customcss')
<link rel="stylesheet" href="{{asset('assets/plugins/select2/css/select2.min.css')}}">
<link rel="stylesheet" href="{{asset('assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{asset('assets/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css')}}">
@endsection
@section('css')

@endsection
@section('content')
<div class="content-header">
    <div class="container">
        <div class="row mb-2">
            <div class="col-sm-12">
                <h1 class="m-0 text-dark"> Dataset</h1>
            </div>
        </div>
    </div>
</div>
<div class="content">
    <div class="container">
        <div class="row">
            <div class="col-12">
                @if(Session::get('errorexcel'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="alert-heading">Oops, error saving data</h4>
                    <strong>Error Logs :</strong>
                    <ul>
                        @foreach (Session::get('errorexcel') as $failure)
                        @foreach ($failure->errors() as $error)
                        <li><b>Field {{$failure->attribute()}} error</b> {{ $error }} ( in Line
                            {{$failure->row()}} ) </li>
                        @endforeach
                        @endforeach
                    </ul>
                    <hr>
                    <b>NB : Semua data tidak disimpan ketika error</b>
                </div>
                @endif
                <div class="card card-success">
                    <div class="card-header">
                        <h3 class="card-title">Tambah Data</h3>
                    </div>
                    <form method="POST" role="form" enctype="multipart/form-data" action="{{url('/dataset')}}">
                        @csrf
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Upload Data Transaksi</label>
                                        <input type="file" class="form-control" id="file_excel" name="file_excel"
                                        accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <input type="checkbox" id="hapusdata" value="hapusdata" name="hapusdata">
                                    <label for="hapusdata">Hapus Juga Dataset Sebelumnya</label>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="reset" onclick="history.go(-1)" class="btn btn-danger">Kembali</button>
                            <button type="submit" class="btn btn-primary float-right">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('customjs')
<script src="{{asset('assets/plugins/select2/js/select2.full.min.js')}}"></script>
<script src="{{asset('assets/plugins/sweetalert2/sweetalert2.min.js')}}"></script>
@endpush

@push('customscripts')
<script>
// $(function() {
//     $('.select2bs4').select2({
//         theme: 'bootstrap4'
//     });
//     $(".select2bs4").val(null).trigger('change');

//     //===============================================================================================
//     $('#caridata').on('select2:select', function(e) {
//         var kode = $(this).val();
//         $.ajax({
//             type: 'GET',
//             url: '/dataset/' + kode,
//             success: function(data) {
//                 return {
//                     results: $.map(data, function(item) {
//                         $("#nama").val(item.nama);
//                         $("#kode").val(item.kode);
//                         $("#model").val(item.model);
//                         $("#corak").val(item.corak);
//                         $("#bahan").val(item.bahan);
//                         $("#harga").val(item.harga);
//                     })
//                 }
//             }
//         });
//     });
// });
// //===============================================================================================
// function validasi() {
//     if ($('#caridata').val() == null) {
//         Swal.fire({
//             title: 'Maaf',
//             text: 'Harus memilih data produk'
//         })
//         return false;
//     } else {
//         return true;
//     }
// }
</script>
@endpush