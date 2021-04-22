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
                <div class="card card-success">
                    <div class="card-header">
                        <h3 class="card-title">Tambah Data</h3>
                    </div>
                    @foreach($datadataset as $dtaset)
                    @php
                    $datadetailproduk = DB::table('produk')->where('id',$dtaset->produk_id)->first();
                    @endphp
                    <form method="POST" role="form" enctype="multipart/form-data" onsubmit="return validasi()"
                        action="{{url('/dataset/'.$dtaset->id)}}">
                        @csrf
                        <input type="hidden" name="_method" value="PUT">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Pilih Produk</label>
                                        <select class="form-control select2bs4" name="caridata" id="caridata">
                                            @foreach($databarang as $row)
                                            <option value="{{$row->id}}" @if($dtaset->produk_id==$row->id) selected @endif>{{$row->nama}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Keterangan</label>
                                        <select name="keterangan" class="form-control">
                                            <option value="Y" @if($dtaset->keterangan=='Y') selected @endif>Minat Tinggi</option>
                                            <option value="N" @if($dtaset->keterangan=='N') selected @endif>Minat Rendah</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Kode</label>
                                        <input type="text" class="form-control" id="kode" name="kode" value="{{$datadetailproduk->kode}}" required readonly>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Nama</label>
                                        <input type="text" class="form-control" id="nama" name="nama" value="{{$datadetailproduk->nama}}" required readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Model</label>
                                        <input type="text" class="form-control" id="model" name="model" value="{{$datadetailproduk->model}}" required
                                            readonly>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Corak</label>
                                        <input type="text" class="form-control" id="corak" name="corak" value="{{$datadetailproduk->corak}}" required
                                            readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Bahan</label>
                                        <input type="text" class="form-control" id="bahan" name="bahan" value="{{$datadetailproduk->bahan}}" required
                                            readonly>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Harga</label>
                                        <input type="text" class="form-control" id="harga" name="harga" value="{{$datadetailproduk->harga}}" required
                                            readonly>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="reset" onclick="history.go(-1)" class="btn btn-danger">Kembali</button>
                            <button type="submit" class="btn btn-primary float-right">Simpan</button>
                        </div>
                    </form>
                    @endforeach
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
$(function() {
    $('.select2bs4').select2({
        theme: 'bootstrap4'
    });

    //===============================================================================================
    $('#caridata').on('select2:select', function(e) {
        var kode = $(this).val();
        $.ajax({
            type: 'GET',
            url: '/dataset/' + kode,
            success: function(data) {
                return {
                    results: $.map(data, function(item) {
                        $("#nama").val(item.nama);
                        $("#kode").val(item.kode);
                        $("#model").val(item.model);
                        $("#corak").val(item.corak);
                        $("#bahan").val(item.bahan);
                        $("#harga").val(item.harga);
                    })
                }
            }
        });
    });
});
//===============================================================================================
function validasi() {
    if ($('#caridata').val() == null) {
        Swal.fire({
            title: 'Maaf',
            text: 'Harus memilih data produk'
        })
        return false;
    } else {
        return true;
    }
}
</script>
@endpush