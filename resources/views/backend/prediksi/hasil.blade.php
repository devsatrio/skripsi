@extends('layouts/base')
@section('content')
<div class="content-header">
    <div class="container">
        <div class="row mb-2">
            <div class="col-sm-12">
                <h1 class="m-0 text-dark"> Hasil Prediksi Minat</h1>
            </div>
        </div>
    </div>
</div>
<div class="content">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card card-success">
                    <div class="card-body">
                        <div class="row text-center">
                            <div class="col-md-12">
                                @if($hasil=='N')
                                <div class="jumbotron">
                                <img src="{{asset('sad.png')}}" alt="..." width="30%">
                                    <h1 class="display-4">Maaf, ya</h1>
                                    <p class="lead">Kayak nya produk ini memiliki prediksi minat yang rendah nih.</p>
                                    <a href="{{url('home')}}" class="btn btn-lg btn-danger">Go Home</a> <a href="{{url('prediksi-minat')}}" class="btn btn-primary btn-lg">Prediksi Ulang</a>
                                </div>
                                @else
                                <div class="jumbotron">
                                <img src="{{asset('happy.png')}}" alt="..." width="30%">
                                    <h1 class="display-4">Ye, Selamat</h1>
                                    <p class="lead">Produk ini memiliki prediksi minat yang tinggi.</p>
                                    <a href="{{url('home')}}" class="btn btn-lg btn-danger">Go Home</a> <a href="{{url('prediksi-minat')}}" class="btn btn-primary btn-lg">Prediksi Ulang</a>
                                </div>
                                @endif
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection