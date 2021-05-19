@extends('layouts/base')
@section('content')
<div class="content-header">
    <div class="container">
        <div class="row mb-2">
            <div class="col-sm-12">
                <h1 class="m-0 text-dark"> Hasil Testing Performa Metode Naive Bayes</h1>
            </div>
        </div>
    </div>
</div>
<div class="content">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="row">
                    <div class="col-6">
                        <!-- small box -->
                        <div class="small-box bg-info">
                            <div class="inner">
                                <h3>{{$hasilakhir[0][0]}}</h3>

                                <p>True Positive</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-check"></i>
                            </div>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-6">
                        <!-- small box -->
                        <div class="small-box bg-success">
                            <div class="inner">
                                <h3>{{$hasilakhir[0][1]}}</h3>

                                <p>False Positive</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-check-square"></i>
                            </div>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-6">
                        <!-- small box -->
                        <div class="small-box bg-warning">
                            <div class="inner">
                                <h3>{{$hasilakhir[1][0]}}</h3>

                                <p>False Negative</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-times"></i>
                            </div>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-6">
                        <!-- small box -->
                        <div class="small-box bg-danger">
                            <div class="inner">
                                <h3>{{$hasilakhir[1][1]}}</h3>

                                <p>True Negative</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-window-close"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card card-widget widget-user-2">
                    <div class="widget-user-header bg-warning">
                        <h3>Output</h3>
                    </div>
                    <div class="card-footer p-0">
                        <ul class="nav flex-column">
                            <li class="nav-item">
                                <a class="nav-link">
                                    Accuracy
                                    <span class="float-right badge bg-primary">
                                        {{(round(($hasilakhir[0][0]+$hasilakhir[1][1])/($hasilakhir[0][0]+$hasilakhir[0][1]+$hasilakhir[1][0]+$hasilakhir[1][1]),1))*100}}
                                    </span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link">
                                    Precision 
                                    <span class="float-right badge bg-info">
                                    {{(round($hasilakhir[0][0]/($hasilakhir[0][0]+$hasilakhir[0][1]),1))*100}}
                                    </span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link">
                                    Recall 
                                    <span class="float-right badge bg-danger">
                                    
                                    {{(round($hasilakhir[0][0]/($hasilakhir[0][0]+$hasilakhir[1][0]),1))*100}}
                                    </span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection