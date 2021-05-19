@extends('layouts/base')
@section('content')
<div class="content-header">
    <div class="container">
        <div class="row mb-2">
            <div class="col-sm-12">
                <h1 class="m-0 text-dark"> Testing Performa Metode Naive Bayes</h1>
            </div>
        </div>
    </div>
</div>
<div class="content">
    <div class="container">
        <div class="row">
            <div class="col-12">
                @if(Session::get('errorbasicexcel'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <span class="alert-heading">Oops, {{ session('errorbasicexcel') }}</span>
                </div>
                
                @endif
                @if(Session::get('errorexcel'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="alert-heading">Oops, error while process data</h4>
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
                        <h3 class="card-title">Input Prediksi</h3>
                    </div>
                    <form method="POST" role="form" action="{{url('/testing-algoritma/testing')}}" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">File Excel</label>
                                        <input type="file" name="filenya" class="form-control"
                                            accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel"
                                            required>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="reset" onclick="history.go(-1)" class="btn btn-danger">Kembali</button>
                            <a href="{{asset('assets/template_testing.xlsx')}}"
                                class="btn btn-warning float-right ml-2">Download Template</a>
                            <button type="submit" class="btn btn-primary float-right">Test Performa</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection