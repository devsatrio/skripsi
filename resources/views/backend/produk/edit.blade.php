@extends('layouts/base')

@section('content')
<div class="content-header">
    <div class="container">
        <div class="row mb-2">
            <div class="col-sm-12">
                <h1 class="m-0 text-dark"> Produk</h1>
            </div>
        </div>
    </div>
</div>
<div class="content">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card card-warning">
                    <div class="card-header">
                        <h3 class="card-title">Edit Data</h3>
                    </div>
                    @foreach($dataproduk as $row)
                    <form method="POST" role="form" enctype="multipart/form-data"
                        action="{{url('/produk/'.$row->id)}}">
                        @csrf
                        <input type="hidden" name="_method" value="PUT">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Kode</label>
                                        <input type="text" class="form-control" name="kode" value="{{$row->kode}}" required autofocus>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Nama</label>
                                        <input type="text" class="form-control" name="nama" value="{{$row->nama}}" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Model</label>
                                        <select name="model" class="form-control">
                                            <option value="Hoodie" @if($row->model=="Hoodie") selected @endif>Hoodie</option>
                                            <option value="Resleting" @if($row->model=="Resleting") selected @endif>Resleting</option>
                                            <option value="Parka" @if($row->model=="Parka") selected @endif>Parka</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Corak</label>
                                        <select name="corak" class="form-control">
                                            <option value="Polos" @if($row->corak=="Polos") selected @endif>Polos</option>
                                            <option value="Bordir" @if($row->corak=="Bordir") selected @endif>Bordir</option>
                                            <option value="Sablon" @if($row->corak=="Sablon") selected @endif>Sablon</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Bahan</label>
                                        <select name="bahan" class="form-control">
                                            <option value="Kanvas" @if($row->bahan=="Kanvas") selected @endif>Kanvas</option>
                                            <option value="Fleece" @if($row->bahan=="Fleece") selected @endif>Fleece</option>
                                            <option value="Fleece" @if($row->bahan=="Parasut") selected @endif>Parasut</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Harga</label>
                                        <input type="number" min="0" class="form-control" name="harga" value="{{$row->harga}}" required>
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