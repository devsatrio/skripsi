<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Phpml\Classification\NaiveBayes;
use App\Imports\TestingBayesImport;
use Phpml\Metric\ConfusionMatrix;
use Session;
use Excel;
use DB;

class TestingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    //=================================================================
    public function index()
    {
        return view('backend.testing.index');
    }

    //=================================================================
    public function store(Request $request)
    {
        try {
            if($request->hasFile('filenya')){
                $data = Excel::toArray(new TestingBayesImport(), request()->file('filenya'));
               //dd($data);
               $datahasil=[];
               $dataprediksi=[];
               for ($i=0; $i < count($data) ; $i++) { 
                for ($j=1; $j < count($data[$i]) ; $j++) { 
                    $datahasil[]=$data[$i][$j][5];
                    if($data[$i][$j][4]>60000){
                        $labelharga = 'murah';
                    }else{
                        $labelharga = 'mahal';
                    }
                    $dataprediksi[] = [
                        $data[$i][$j][1],
                        $data[$i][$j][2],
                        $data[$i][$j][3],
                        $labelharga,
                    ];
                }
               }
               $hasilakhir = $this->prediksi($dataprediksi,$datahasil);
               return view('backend.testing.hasil',compact('hasilakhir'));
             }else{
                Session::flash('errorbasicexcel', 'error uploading file');
                return redirect('/testing-algoritma');
             }
        }catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
             $failures = $e->failures();
             Session::flash('errorexcel', $failures);
             return redirect('/testing-algoritma');
        }
    }

    //==================================================================================
    public function prediksi($dataprediksi,$datahasil)
    {
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
        $hasil = $classifier->predict($dataprediksi);
        $predictedTargets = [];

        for ($i=0; $i < count($hasil); $i++) { 
            $predictedTargets[] = $hasil[$i];
        }
        $actualTargets = $datahasil;
        $confusionMatrix = ConfusionMatrix::compute($actualTargets, $predictedTargets, ['Y', 'N']);
        return $confusionMatrix;
        
    }
}