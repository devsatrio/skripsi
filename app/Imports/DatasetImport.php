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
            $kproduk = $row['kode_produk'];
            $dataproduk = DB::table('produk')->where('kode',$kproduk)->get();
            foreach($dataproduk as $rowproduk){
                $idproduk=$rowproduk->id;
                
            }
            if($idproduk!='datanyakosong'){
                $totaljumlah = $row['bulan_kesatu']+$row['bulan_kedua']+$row['bulan_ketiga']+$row['bulan_keempat']+$row['bulan_kelima']+$row['bulan_keenam']+$row['bulan_ketujuh']+$row['bulan_kedelapan']+$row['bulan_kesembilan']+$row['bulan_kesepuluh']+$row['bulan_kesebelas']+$row['bulan_keduabelas'];
                if($totaljumlah>$parameternya){
                    $datafinal[] = [
                        'produk_id' => $idproduk,
                        'keterangan' => 'Y',
                    ];
                }else{
                    $datafinal[] = [
                        'produk_id' => $idproduk,
                        'keterangan' => 'N',
                    ];
                }
            }
        }
        DB::table('dataset')->insert($datafinal);
    }

    public function rules(): array
    {
        return [
            'kode_produk' => 'required|string',
            'bulan_kesatu' => 'required|numeric',
            'bulan_kedua' => 'required|numeric',
            'bulan_ketiga' => 'required|numeric',
            'bulan_keempat' => 'required|numeric',
            'bulan_kelima' => 'required|numeric',
            'bulan_keenam' => 'required|numeric',
            'bulan_ketujuh' => 'required|numeric',
            'bulan_kedelapan' => 'required|numeric',
            'bulan_kesembilan' => 'required|numeric',
            'bulan_kesepuluh' => 'required|numeric',
            'bulan_kesebelas' => 'required|numeric',
            'bulan_keduabelas' => 'required|numeric',
        ];
    }
}