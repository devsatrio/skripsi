<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Imports\DatasetImport;
use DataTables;
use Session;
use Phpml\Classification\NaiveBayes;
use Excel;
use DB;

class DatasetController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    //=================================================================
    public function index()
    {
        return view('backend.dataset.index');
    }

    //=================================================================
    public function listdata(){
        return Datatables::of(DB::table('dataset')
        ->select(DB::raw('dataset.*,produk.nama,produk.kode'))
        ->leftjoin('produk','produk.id','=','dataset.produk_id')
        ->orderby('produk.id','desc')
        ->get())
        ->make(true);
    }

    //=================================================================
    public function create()
    {
        $databarang = DB::table('produk')->orderby('id','desc')->get();
        return view('backend.dataset.created',compact('databarang'));
    }

    //=================================================================
    public function store(Request $request)
    {
        // DB::table('dataset') --->dataset satu
        // ->insert([
        //     'produk_id'=>$request->caridata,
        //     'keterangan'=>$request->keterangan
        // ]);

        //---------------------------------------------------------------

        // if($request->hapusdata=='hapusdata'){ ---> dataset dua
        //     DB::table('dataset')->truncate();
        // }
        // try {
        //     if($request->hasFile('file_excel')){
        //         $error = Excel::import(new DatasetImport($request->parameternya), request()->file('file_excel'));
        //         return redirect('dataset')->with('status','Sukses import data');
        //      }else{
        //         Session::flash('errorexcel', 'error uploading data');
        //         return redirect('dataset/create');
        //      }
        // }catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
        //      $failures = $e->failures();
        //      Session::flash('errorexcel', $failures);
        //      return back();
        // }

        //---------------------------------------------------------------

        if($request->hapusdata=='hapusdata'){
            DB::table('dataset')->truncate();
        }
        try {
            if($request->hasFile('file_excel')){
                $error = Excel::import(new DatasetImport(300), request()->file('file_excel'));
                return redirect('dataset')->with('status','Sukses import data');
             }else{
                Session::flash('errorexcel', 'error uploading data');
                return redirect('dataset/create');
             }
        }catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
             $failures = $e->failures();
             Session::flash('errorexcel', $failures);
             return back();
        }
    }

    //=================================================================
    public function show($id)
    {
        $data = DB::table('produk')
        ->where('id',$id)
        ->get();
        return response()->json($data);
    }

    //=================================================================
    public function edit($id)
    {
        $databarang = DB::table('produk')->orderby('id','desc')->get();
        $datadataset = DB::table('dataset')->orderby('id','desc')->get();
        return view('backend.dataset.edit',compact('datadataset','databarang'));
    }

    //=================================================================
    public function update(Request $request, $id)
    {
        DB::table('dataset')
        ->where('id',$id)
        ->update([
            'produk_id'=>$request->caridata,
            'keterangan'=>$request->keterangan
        ]);
        return redirect('dataset')->with('status','Sukses memperbarui data');
    }

    //=================================================================
    public function destroy($id)
    {
        DB::table('dataset')->where('id',$id)->delete();
    }
}
