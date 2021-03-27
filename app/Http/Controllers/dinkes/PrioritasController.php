<?php

namespace App\Http\Controllers\dinkes;

use App\Models\User;
use App\Models\Kriteria;
use App\Models\Prioritas;
use App\Models\Alternatif;
use Illuminate\Http\Request;
use App\Models\DataPuskesmas;
use App\Http\Controllers\Controller;

class PrioritasController extends Controller
{
    public function index()
    {
        $data['puskesmas'] = User::where('level', 'puskesmas')->get();
        return view('dinkes.prioritas.index',$data);
    }

    public function detail($id)
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

        return view('dinkes.prioritas.detail',$data);
    }
}