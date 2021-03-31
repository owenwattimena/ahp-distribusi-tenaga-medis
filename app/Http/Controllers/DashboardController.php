<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Kriteria;
use App\Models\Alternatif;
use App\Models\Subkriteria;
use App\Models\TenagaMedis;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $data['alternatif'] = Alternatif::all();
        $data['kriteria'] = Kriteria::all();
        $data['subkriteria'] = Subkriteria::all();
        $data['pukesmas'] = User::where('level', 'puskesmas')->get();
        if (\Auth::user()->level == 'puskesmas') {   
            $data['tenagaMedis'] = TenagaMedis::where('id_puskesmas', \Auth::user()->id)->get();
        }
        return view('dashboard.index',$data);

    }
}