@extends('layouts/base')
@section('content')
<div class="content-header">
    <div class="container">
        <div class="row mb-2">

            <div class="col-sm-12">
                <h1 class="m-0 text-dark"> Dashboard</h1>
            </div>
        </div>
    </div>
</div>
<div class="content">
    <div class="container">
        <div class="row">
            @if (session('status'))
            <div class="col-sm-12">
                <div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h4>Info!</h4>
                    {{ session('status') }}
                </div>
            </div>
            @endif
            <div class="col-4">
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3>{{$jumlahadmin}}</h3>
                        <p>Jumlah Admin</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <a href="{{url('admin')}}" class="small-box-footer">More info <i
                            class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="col-4">
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3>{{$jumlahproduk}}</h3>
                        <p>Jumlah Produks</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-th-large"></i>
                    </div>
                    <a href="{{url('produk')}}" class="small-box-footer">More info <i
                            class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="col-4">
                <div class="small-box bg-danger">
                    <div class="inner">
                        <h3>44</h3>
                        <p>Log Prediksi Minat</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-vial"></i>
                    </div>
                    <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="col-12">
                <div class="alert alert-primary alert-dismissible">
                    <h5><i class="icon fas fa-check"></i> Welcome, {{Auth::user()->level}} {{Auth::user()->username}}</h5>
                    <a href="#"><button class="btn btn-default" type="button">Tambah Dataset</button></a> <a href="#" class="ml-2"><button class="btn btn-default" type="button">Prediksi Minat</button></a>
                </div>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</div>
@endsection