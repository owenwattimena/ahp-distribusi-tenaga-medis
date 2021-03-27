<?php

namespace App\Http\Controllers\admin;

use App\Helpers\AHP;
use App\Models\Matrix;
use App\Models\Kriteria;
use App\Models\Prioritas;
use App\Models\Alternatif;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MatrixController extends Controller
{
    //
    public function index()
    {
        $data['kriteria'] = Kriteria::all();
        return view('admin.matrix.index', $data);
    }
    
    public function show($id)
    {
        $data['kriteria'] = Kriteria::findOrFail($id);
        $data['alternatif'] = Alternatif::all();
        $data['matrices'] = Matrix::where('id_kriteria', $id)->get();
        $matrix = [];

        foreach ($data['alternatif'] as $key => $item1) {
            foreach ($data['alternatif'] as $item2) {
                $bobot = $data['matrices']->where('baris', $item1->id)->where('kolom', $item2->id)->first();
                $matrix[$key][] = $bobot == null ? 1 : $bobot->bobot;
            }
        }

        $data['matrix'] = $matrix;
        
        $data['total_matrix'] = AHP::getRowTotal($matrix);
        $data['nilai_eigen'] = AHP::eigen($matrix, [$data['total_matrix']]);
        $data['jumlah_eigen'] = AHP::getTotal($data['nilai_eigen']);
        $data['prioritas'] = AHP::getPriority($data['nilai_eigen']);
        $cm = AHP::getCm([$data['total_matrix']],[$data['prioritas']]);
        $data['konsistensi'] = AHP::getConsistency($cm);

        $result = [];

        foreach ($data['alternatif'] as $key => $value) {
            $result[$key]['id'] = $value->id;
            $result[$key]['alternatif'] = $value->alternatif;
            $result[$key]['prioritas'] = $data['prioritas'][$key];

            $prioritas = Prioritas::where([
                ['id_kriteria', '=', $id],
                ['id_alternatif', '=', $value->id],
            ])->get()->first();

            if($prioritas)
            {
                if($prioritas->prioritas != $data['prioritas'][$key])
                {
                    $prioritas->prioritas = $data['prioritas'][$key];
                    $prioritas->save();
                }
            }
            else{

                $newPrioritas = new Prioritas;
                $newPrioritas->id_kriteria = $id;
                $newPrioritas->id_alternatif = $value->id;
                $newPrioritas->prioritas = $data['prioritas'][$key];
                $newPrioritas->save();
            }
        }
        $result = collect($result);
        $data['sort'] = $result->sortBy([
            ['prioritas', 'desc'],
        ]);


        return view('admin.matrix.show', $data);
    }

    public function post(Request $request, $id)
    {

        $matrixBaris = Matrix::where([
            ['id_kriteria', '=', $id],
            ['baris', '=', $request->baris],
            ['kolom', '=', $request->kolom]
        ])->get()->first();

        if($matrixBaris)
        { 
            $matrixBaris->bobot = $request->bobot;
            $matrixBaris->save();

            $matrixKolom = Matrix::where([
                ['id_kriteria', '=', $id],
                ['baris', '=', $request->kolom],
                ['kolom', '=', $request->baris]
            ])->get()->first();
            if($matrixKolom)
            {
                $matrixKolom->bobot = 1 / $request->bobot;
                $matrixKolom->save();
            }
            return redirect()->back();
        }
        
        $newMatrixBaris = new Matrix;
        $newMatrixBaris->id_kriteria = $id;
        $newMatrixBaris->baris = $request->baris;
        $newMatrixBaris->kolom = $request->kolom;
        $newMatrixBaris->bobot = $request->bobot;
        $newMatrixBaris->save();

        $newMatrixKolom = new Matrix;
        $newMatrixKolom->id_kriteria = $id;
        $newMatrixKolom->baris = $request->kolom;
        $newMatrixKolom->kolom = $request->baris;
        $newMatrixKolom->bobot = 1/$request->bobot;
        $newMatrixKolom->save();
        return redirect()->back();
    }
}