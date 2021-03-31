<?php

namespace App\Http\Controllers;

use App\Models\Kriteria;
use App\Models\Alternatif;
use App\Models\Subkriteria;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $data['alternatif'] = Alternatif::all();
        $data['kriteria'] = Kriteria::all();
        $data['subkriteria'] = Subkriteria::all();
        return view('dashboard.index',$data);

    }
}