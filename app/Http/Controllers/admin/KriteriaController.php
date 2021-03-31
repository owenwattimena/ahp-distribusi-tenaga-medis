<?php

namespace App\Http\Controllers\admin;

use App\Models\Kriteria;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class KriteriaController extends Controller
{
    //
    public function index()
    {
        $data['kriteria'] = Kriteria::all();
        return view('admin.kriteria.index',$data);
    }

    public function create()
    {
        return view('admin.kriteria.create');
    }
    
    public function edit($id)
    {
        $data['kriteria'] = Kriteria::findOrFail($id);
        return view('admin.kriteria.edit',$data);
    }

    public function post(Request $request)
    {
        $request->validate(
            [
                'kode' => 'required|unique:kriteria',
                'nama' => 'required'
            ]
        );

        $kriteria = new Kriteria;
        $kriteria->kode = $request->kode;
        $kriteria->nama = $request->nama;
        
        if($kriteria->save())
        {
            $alert = [
                "tipe" => "alert-success",
                "pesan" => "Kriteria berhasil disimpan!"
            ];
            return redirect()->route("kriteria")->with($alert);
        }
        $alert = [
            "tipe" => "alert-danger",
            "pesan" => "Kriteria gagal disimpan!"
        ];
        return redirect()->back()->with($alert);
    }

    public function put(Request $request, $id)
    {
        $request->validate(
            ['nama' => 'required']
        );

        $kriteria = Kriteria::findOrFail($id);
        $kriteria->nama = $request->nama;
        
        if($kriteria->save())
        {
            $alert = [
                "tipe" => "alert-success",
                "pesan" => "Kriteria berhasil diubah!"
            ];
            return redirect()->route("kriteria")->with($alert);
        }
        $alert = [
            "tipe" => "alert-danger",
            "pesan" => "Kriteria gagal diubah!"
        ];
        return redirect()->back()->with($alert);
    }

    public function delete($id)
    {
        try {
            if(Kriteria::findOrFail($id)->delete())
            {
                $alert = [
                    "tipe" => "alert-success",
                    "pesan" => "Kriteria berhasil dihapus!"
                ];
                return redirect()->back()->with($alert);
            }
            $alert = [
                "tipe" => "alert-danger",
                "pesan" => "Kriteria gagal dihapus!"
            ];
            return redirect()->back()->with($alert);
            
        } catch(\Illuminate\Database\QueryException $e){
            $errorCode = $e->errorInfo[1];
            if($errorCode == '1451'){
                $alert = [
                    "tipe" => "alert-danger",
                    "pesan"  => "Data kriteria tidak dapat dihapus! data memiliki relasi dengan data lainnya."
                ];
                return redirect()->back()->with($alert);
            }
        }
        
        
    }
}