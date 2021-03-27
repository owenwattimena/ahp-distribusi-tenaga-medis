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
}