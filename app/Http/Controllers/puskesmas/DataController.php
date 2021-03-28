<?php

namespace App\Http\Controllers\puskesmas;

use App\Models\User;
use App\Models\Kriteria;
use Illuminate\Http\Request;
use App\Models\DataPuskesmas;
use App\Http\Controllers\Controller;

class DataController extends Controller
{
    //
    public function index()
    {
        $data['kriteria'] = Kriteria::with('subkriteria')->get();
        $data['dataPkm'] = DataPuskesmas::where('id_puskesmas', \Auth::user()->id)->get();
        return view('puskesmas.data.index',$data);
    }

    public function post(Request $request)
    {

        foreach ($request->except('_token') as $key => $value) {

            $dataPkm              = DataPuskesmas::where([
                ['id_puskesmas', '=', \Auth::user()->id],
                ['id_subkriteria', '=', $key]
            ])->first();
            if($dataPkm){
                if($dataPkm->nilai != $value){
                    $dataPkm->nilai          = $value;
                    $dataPkm->save(); 
                }
            }
            else
            {
                $data                 = new DataPuskesmas;
                $data->id_puskesmas   = \Auth::user()->id;
                $data->id_subkriteria = $key;
                $data->nilai          = $value;
                $data->save();   
            }
        }
        $alert = [
            "tipe" => "alert-success",
            "pesan"  => "Data berhasil diubah!"
        ];
        return redirect()->back()->with($alert);
    }

    // public function puskesmas()
    // {
    //     $data['puskesmas'] = User::where('level', 'puskesmas')->get();
    //     return view('bkd.puskesmas.index',$data);
    // }
}