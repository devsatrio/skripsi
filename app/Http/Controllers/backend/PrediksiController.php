<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DataTables;
use Phpml\Classification\NaiveBayes;
use DB;

class PrediksiController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    //=================================================================
    public function index()
    {
        return view('backend.prediksi.index');
    }

    //=================================================================
    public function store(Request $request)
    {
        $samples = [
            ['Hoodie', 'Polos', 'Kanvas','Murah'], 
            ['Resleting', 'Bordir', 'Parasut','Mahal'],
        ];
        $labels = ['tinggi', 'rendah'];
        $dataset=[];
        $status=[];
        $datasetnya = DB::table('dataset')
        ->select(DB::raw('dataset.*,produk.kode,produk.nama,produk.model,produk.corak,produk.bahan,produk.harga'))
        ->leftjoin('produk','produk.id','=','dataset.produk_id')
        ->get();
        foreach($datasetnya as $row){
            if($row->harga>60000){
                $labelharga = 'mahal';
            }else{
                $labelharga = 'murah';
            }
            $dataset[] = [
                $row->model,
                $row->corak,
                $row->bahan,
                $labelharga,
            ];

            $status[] = $row->keterangan;
        }
        $classifier = new NaiveBayes();
        $classifier->train($dataset, $status);
        if($request->harga>6000){
            $labelhargabaru = 'mahal';
        }else{
            $labelhargabaru = 'murah';
        }
        $hasil = $classifier->predict([$request->model, $request->corak,$request->bahan,$labelhargabaru]);
        
        return view('backend.prediksi.hasil',compact('hasil'));
    }

    
}
