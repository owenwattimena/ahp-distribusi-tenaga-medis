<?php

namespace App\Http\Controllers\admin;

use App\Models\Kriteria;
use App\Models\Subkriteria;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SubKriteriaController extends Controller
{
    //
    public function index()
    {
        $data['subkriteria'] = Subkriteria::all();
        return view('admin.kriteria.subkriteria.index', $data);
    }
    public function create()
    {
        $data['kriteria'] = Kriteria::all();
        return view('admin.kriteria.subkriteria.create',$data);
    }

    public function post(Request $request)
    {
        $request->validate(
            [
                'id_kriteria' => 'required',
                'nama'  => 'required'
            ]
        );

        $subkriteria = new Subkriteria;
        $subkriteria->id_kriteria = $request->id_kriteria;
        $subkriteria->nama = $request->nama;

        if($subkriteria->save())
        {
            $alert = [
                "tipe" => "alert-success",
                "pesan" => "Sub kriteria berhasil disimpan!"
            ];
            return redirect()->route("sub-kriteria")->with($alert);
        }
        $alert = [
            "tipe" => "alert-danger",
            "pesan" => "Sub kriteria gagal disimpan!"
        ];
        return redirect()->back()->with($alert);
    }

    public function delete($id)
    {
        try {
            if(Subkriteria::findOrFail($id)->delete())
            {
                $alert = [
                    "tipe" => "alert-success",
                    "pesan" => "Sub kriteria berhasil dihapus!"
                ];
                return redirect()->back()->with($alert);
            }
            $alert = [
                "tipe" => "alert-danger",
                "pesan" => "Sub kriteria gagal dihapus!"
            ];
            return redirect()->back()->with($alert);
            
        } catch(\Illuminate\Database\QueryException $e){
            $errorCode = $e->errorInfo[1];
            if($errorCode == '1451'){
                $alert = [
                    "tipe" => "alert-danger",
                    "pesan"  => "Data sub kriteria tidak dapat dihapus! data memiliki relasi dengan data lainnya."
                ];
                return redirect()->back()->with($alert);
            }
        }
        
        
    }
}