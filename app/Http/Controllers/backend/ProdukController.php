<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DataTables;
use DB;

class ProdukController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    //=================================================================
    public function index()
    {
        return view('backend.produk.index');
    }

    //=================================================================
    public function listdata(){
        return Datatables::of(DB::table('produk')->orderby('id','desc')->get())->make(true);
    }

    //=================================================================
    public function create()
    {
        return view('backend.produk.create');
    }

    //=================================================================
    public function store(Request $request)
    {
        DB::table('produk')
        ->insert([
            'kode'=>$request->kode,
            'nama'=>$request->nama,
            'model'=>$request->model,
            'corak'=>$request->corak,
            'bahan'=>$request->bahan,
            'harga'=>$request->harga
        ]);

        return redirect('produk')->with('status','Sukses menyimpan data');
    }

    //=================================================================
    public function edit($id)
    {
        $dataproduk = DB::table('produk')->where('id',$id)->get();
        return view('backend.produk.edit',compact('dataproduk'));
    }

    //=================================================================
    public function update(Request $request, $id)
    {
        DB::table('produk')
        ->where('id',$id)
        ->update([
            'kode'=>$request->kode,
            'nama'=>$request->nama,
            'model'=>$request->model,
            'corak'=>$request->corak,
            'bahan'=>$request->bahan,
            'harga'=>$request->harga
        ]);

        return redirect('produk')->with('status','Sukses memperbarui data');
    }

    //=================================================================
    public function destroy($id)
    {
        DB::table('produk')->where('id',$id)->delete();
        DB::table('dataset')->where('produk_id',$id)->delete();
    }
}
