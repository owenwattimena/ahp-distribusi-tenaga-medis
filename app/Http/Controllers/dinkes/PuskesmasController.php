<?php

namespace App\Http\Controllers\dinkes;

use App\Models\User;
use App\Models\Kriteria;
use App\Models\Prioritas;
use App\Models\Alternatif;
use Illuminate\Http\Request;
use App\Models\DataPuskesmas;
use App\Models\RekapDistribusi;
use App\Http\Controllers\Controller;
use App\Models\DetailRekapDistribusi;

class PuskesmasController extends Controller
{
    public function index()
    {
        $data['puskesmas'] = User::where('level', 'puskesmas')->get();
        return view('dinkes.puskesmas.index',$data);
    }
    public function rekap($id)
    {
        $data['alternatif'] = Alternatif::all();
        $data['puskesmas'] = User::findOrFail($id);
        $data['rekap'] = RekapDistribusi::where('id_puskesmas', $id)->get();
        $data['detailRekap'] = DetailRekapDistribusi::all();
        return view('dinkes.puskesmas.rekap',$data);
    }

    public function rangking($id)
    {
        $data['puskesmas'] = User::findOrFail($id);
        $data['dataPkm'] = DataPuskesmas::where('id_puskesmas', $id)->with('subkriteria')->get();
        $data['kriteria'] = Kriteria::all();
        $data['alternatif'] = Alternatif::all();
        $data['prioritas'] = Prioritas::all();

        $data['totalDataPkm'] = [];

        foreach ($data['kriteria'] as $key1 => $value1) {
            foreach ($data['dataPkm'] as $key2 => $value2) {
                if($value1->id == $value2->subkriteria->id_kriteria){
                    $data['totalDataPkm'][$key1] = (!isset($data['totalDataPkm'][$key1]) ? 0 : $data['totalDataPkm'][$key1]) + $value2->nilai;
                }
            }
        }
        $data['totalDataPkm'] = collect($data['totalDataPkm']);
        $data['sumDataPkm'] = $data['totalDataPkm']->sum();

        $data['prioritasKriteria'] = [];
        
        foreach ($data['totalDataPkm'] as $key => $value) {
            $data['prioritasKriteria'][$key] = $value/$data['sumDataPkm'];
        }
        
        $data['kaliRanking'] = [];

        foreach ($data['alternatif'] as $key1 => $value1) {
            foreach ($data['kriteria'] as $key2 => $value2) {
                $prioritas = isset($data['prioritas']->where('id_alternatif', $value1->id)->where('id_kriteria', $value2->id)->first()->prioritas) ? $data['prioritas']->where('id_alternatif', $value1->id)->where('id_kriteria', $value2->id)->first()->prioritas : 0;
                $prioritasKriteria = isset($data['prioritasKriteria'][$key2]) ? $data['prioritasKriteria'][$key2] : 0;
                $data['kaliRanking'][$key1][] =  $prioritasKriteria * $prioritas ;
            }
        }

        $data['ranking'] = [];

        foreach ($data['kaliRanking'] as $key => $value) {
            $data['ranking'][$key] = collect($value)->sum();
        }

        $data['result'] = [];
        foreach ($data['ranking'] as $key => $value) {
            $data['result'][$key]['alternatif'] =  $data['alternatif'][$key]->alternatif;
            $data['result'][$key]['rank'] =  $value;
        }
        $data['result'] = collect($data['result'])->sortBy([
            ['rank', 'desc']
        ]);

        return view('dinkes.puskesmas.ranking',$data);
    }

    public function tambahRekap($id)
    {
        $data['puskesmas'] = User::findOrFail($id);
        $data['alternatif'] = Alternatif::all();
        return view('dinkes.puskesmas.tambahrekap',$data);
    }

    public function postRekap(Request $request, $id)
    {
        $request->validate([
            "tahun" => "required|unique:rekap_distribusi"
        ]);

        $rekap = new RekapDistribusi;
        $rekap->id_puskesmas = $id;
        $rekap->tahun = $request->tahun;
        if($rekap->save())
        {
            foreach ($request->except(['_token', 'tahun']) as $key => $value) {
                $detailRekap =  new DetailRekapDistribusi;
                $detailRekap->id_rekap_distribusi = $rekap->id;
                $detailRekap->id_alternatif = $key;
                $detailRekap->jumlah = $value;
                $detailRekap->save();
            }
            $alert = [
                "tipe" => "alert-success",
                "pesan"  => "Data rekap berhasil disimpan!"
            ];
            return redirect()->route('dinkes.puskesmas.rekap',['id' => $id])->with($alert);
        }
        $alert = [
            "tipe" => "alert-danger",
            "pesan"  => "Data rekap gagal disimpan!"
        ];
        return redirect()->back()->with($alert);

    }
}