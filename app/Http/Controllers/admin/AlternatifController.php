<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Models\Alternatif;
use App\Http\Controllers\Controller;

class AlternatifController extends Controller
{
    //
    public function index()
    {
        $data['alternatif'] = Alternatif::all();
        return view('admin.alternatif.index', $data);
    }

    public function create()
    {
        return view('admin.alternatif.create');
    }
    public function edit($id)
    {
        $data['alternatif'] = Alternatif::findOrFail($id);
        return view('admin.alternatif.edit',$data);
    }

    public function post(Request $request)
    {
        $request->validate(
            ['alternatif' => 'required']
        );
        $alternatif = new Alternatif;
        $alternatif->alternatif = $request->alternatif;

        if($alternatif->save())
        {
            $alert = [
                "tipe" => "alert-success",
                "pesan" => "Alternatif berhasil ditambahkan!"
            ];
            return redirect()->route("alternatif")->with($alert);
        }
        $alert = [
            "tipe" => "alert-danger",
            "pesan" => "Alternatif gagal ditambahkan!"
        ];
        return redirect()->back()->with($alert);

    }

    public function put(Request $request,$id)
    {
        $request->validate(
            ['alternatif' => 'required']
        );
        $alternatif = Alternatif::findOrFail($id);
        $alternatif->alternatif = $request->alternatif;

        if($alternatif->save())
        {
            $alert = [
                "tipe" => "alert-success",
                "pesan" => "Jenis tanaga medis berhasil diubah!"
            ];
            return redirect()->route("alternatif")->with($alert);
        }
        $alert = [
            "tipe" => "alert-danger",
            "pesan" => "Jenis tanaga medis gagal diubah!"
        ];
        return redirect()->back()->with($alert);

    }

    public function delete(Request $request,$id)
    {
        
        try {
            if(Alternatif::findOrFail($id)->delete())
            {
                $alert = [
                    "tipe" => "alert-success",
                    "pesan" => "Alternatif berhasil dihapus!"
                ];
                return redirect()->back()->with($alert);
            }
            $alert = [
                "tipe" => "alert-danger",
                "pesan" => "Alternatif gagal dihapus!"
            ];
            return redirect()->back()->with($alert);
            
        } catch(\Illuminate\Database\QueryException $e){
            $errorCode = $e->errorInfo[1];
            if($errorCode == '1451'){
                $alert = [
                    "tipe" => "alert-danger",
                    "pesan"  => "Data alternatif tidak dapat dihapus! data memiliki relasi dengan data lainnya."
                ];
                return redirect()->back()->with($alert);
            }
        }

    }
}