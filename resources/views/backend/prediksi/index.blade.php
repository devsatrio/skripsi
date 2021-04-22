@extends('layouts/base')
@section('content')
<div class="content-header">
    <div class="container">
        <div class="row mb-2">
            <div class="col-sm-12">
                <h1 class="m-0 text-dark"> Prediksi Minat</h1>
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
                        <h3 class="card-title">Input Prediksi</h3>
                    </div>
                    <form method="POST" role="form" action="{{url('/prediksi-minat')}}">
                        @csrf
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Nama</label>
                                        <input type="text" class="form-control" name="nama" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Corak</label>
                                        <select name="corak" class="form-control">
                                            <option value="Polos">Polos</option>
                                            <option value="Bordir">Bordir</option>
                                            <option value="Sablon">Sablon</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Model</label>
                                        <select name="model" class="form-control">
                                            <option value="Hoodie">Hoodie</option>
                                            <option value="Resleting">Resleting</option>
                                            <option value="Parka">Parka</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Bahan</label>
                                        <select name="bahan" class="form-control">
                                            <option value="Kanvas">Kanvas</option>
                                            <option value="Fleece">Fleece</option>
                                            <option value="Fleece">Parasut</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Harga</label>
                                        <input type="number" min="0" class="form-control" name="harga" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="reset" onclick="history.go(-1)" class="btn btn-danger">Kembali</button>
                            <button type="submit" class="btn btn-primary float-right">Prediksi</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection