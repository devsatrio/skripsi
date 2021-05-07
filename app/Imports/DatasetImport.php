<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithValidation;
use Validator;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use App\models\DatasetModels;
use DB;
class DatasetImport implements ToCollection,WithHeadingRow,WithValidation
{

    use Importable;
    public function __construct($parameternya)
    {
        $this->parameternya = $parameternya;
    }

    public function collection(Collection $collection)
    {
        $datafinal=[];
        $parameternya=$this->parameternya;
        foreach ($collection as $row){
            $idproduk='datanyakosong';
            $jumlahlama = 0;
            $kproduk = $row['produk_kode'];

            $dataproduk = DB::table('produk')->where('kode',$kproduk)->get();
            foreach($dataproduk as $rowproduk){
                $idproduk=$rowproduk->id;
            }
            if($idproduk!='datanyakosong'){
                $datasetlama = DB::table('dataset')->where('produk_id',$idproduk)->get();
                foreach($datasetlama as $rowolddata){
                    $jumlahlama=$rowolddata->terjual;
                }
                $total = $row['jumlah'] + $jumlahlama;
                if($total>$parameternya){
                    $data = DatasetModels::firstOrNew(['produk_id' => $idproduk]);
                    $data->terjual = $total;
                    $data->keterangan = 'Y';
                    $data->save();
                }else{
                    $data = DatasetModels::firstOrNew(['produk_id' => $idproduk]);
                    $data->terjual = $total;
                    $data->keterangan = 'N';
                    $data->save();
                }
            }
        }
    }

    public function rules(): array
    {
        return [
            'produk_kode' => 'required',
            'jumlah' => 'required|numeric',
        ];
    }
}