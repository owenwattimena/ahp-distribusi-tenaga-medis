<?php

namespace App\Http\Controllers\dinkes;

use App\Models\User;
use App\Models\Kriteria;
use App\Models\Prioritas;
use App\Models\Alternatif;
use App\Models\TenagaMedis;
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

    public function deleteRekap($id, $idRekap){
        try {
            DetailRekapDistribusi::where('id_rekap_distribusi', $idRekap)->delete();
            if(RekapDistribusi::findOrFail($idRekap)->delete())
            {
                $alert = [
                    "tipe" => "alert-success",
                    "pesan" => "Data rekap distribusi berhasil dihapus!"
                ];
                return redirect()->back()->with($alert);
            }
            $alert = [
                "tipe" => "alert-danger",
                "pesan" => "Data rekap distribusi gagal dihapus!"
            ];
            return redirect()->back()->with($alert);
            
        } catch(\Illuminate\Database\QueryException $e){
            $errorCode = $e->errorInfo[1];
            if($errorCode == '1451'){
                $alert = [
                    "tipe" => "alert-danger",
                    "pesan"  => "Data rekap distribusi tidak dapat dihapus! data memiliki relasi dengan data lainnya."
                ];
                return redirect()->back()->with($alert);
            }
        }
    }





    public function medis($id){
        $data['puskesmas'] = User::findOrFail($id);
        $data['tenagaMedis'] = TenagaMedis::where('id_puskesmas', $id)->with('alternatif')->get();
        return view('bkd.puskesmas.medis',$data);   
    }
    
    public function tambahMedis($id){
        $data['puskesmas'] = User::findOrFail($id);
        $data['alternatif'] = Alternatif::all();
        return view('bkd.puskesmas.tambahmedis',$data);   
    }
    public function ubahMedis($id, $idMedis){
        $data['puskesmas'] = User::findOrFail($id);
        $data['alternatif'] = Alternatif::all();
        $data['tenagaMedis'] = TenagaMedis::findOrFail($idMedis);
        return view('bkd.puskesmas.ubahmedis',$data);   
    }

    public function postMedis(Request $request, $id)
    {
        $request->validate([
            "nik" => "required",
            "nama" => "required",
            "nip" => "required",
            "tanggal_lahir" => "required",
            "status" => "required",
            "jenis_kelamin" => "required",
            "jenis_tenaga" => "required",
            "nomor_str" => "required",
            "tanggal_awal_str" => "required",
            "tanggal_akhir_str" => "required",
            "sip" => "required",
            "tanggal_sip" => "required"
        ]);
        try {
            $request->merge(["id_puskesmas" => $id]);
            // dd($request->all());
            TenagaMedis::create( $request->except('_token'));
            $alert = [
                "tipe" => "alert-success",
                "pesan"  => "Data medis berhasil disimpan!"
            ];
            return redirect()->route('puskesmas.medis',['id' => $id])->with($alert);
        } catch (Exception $e) {
            $alert = [
                "tipe" => "alert-danger",
                "pesan"  => "Data medis gagal disimpan!" . $e->getMessage()
            ];
            return redirect()->back()->with($alert);
        }
    }
    public function putMedis(Request $request, $id, $idMedis)
    {
        $tenagaMedis = TenagaMedis::findOrFail($idMedis);
        $request->validate([
            "nik" => "required",
            "nama" => "required",
            "nip" => "required",
            "tanggal_lahir" => "required",
            "status" => "required",
            "jenis_kelamin" => "required",
            "jenis_tenaga" => "required",
            "nomor_str" => "required",
            "tanggal_awal_str" => "required",
            "tanggal_akhir_str" => "required",
            "sip" => "required",
            "tanggal_sip" => "required"
        ]);
        try {
            $request->merge(["id_puskesmas" => $id]);
            // dd($request->all());
            $tenagaMedis->update( $request->except('_token'));
            $alert = [
                "tipe" => "alert-success",
                "pesan"  => "Data medis berhasil diubah!"
            ];
            return redirect()->route('puskesmas.medis',['id' => $id])->with($alert);
        } catch (Exception $e) {
            $alert = [
                "tipe" => "alert-danger",
                "pesan"  => "Data medis gagal diubah!" . $e->getMessage()
            ];
            return redirect()->back()->with($alert);
        }
    }

    public function deleteMedis($id, $idMedis){
        try {
            if(TenagaMedis::findOrFail($idMedis)->delete())
            {
                $alert = [
                    "tipe" => "alert-success",
                    "pesan" => "Data tenaga medis berhasil dihapus!"
                ];
                return redirect()->back()->with($alert);
            }
            $alert = [
                "tipe" => "alert-danger",
                "pesan" => "Data tenaga medis gagal dihapus!"
            ];
            return redirect()->back()->with($alert);
            
        } catch(\Illuminate\Database\QueryException $e){
            $errorCode = $e->errorInfo[1];
            if($errorCode == '1451'){
                $alert = [
                    "tipe" => "alert-danger",
                    "pesan"  => "Data tenaga medis tidak dapat dihapus! data memiliki relasi dengan data lainnya."
                ];
                return redirect()->back()->with($alert);
            }
        }
    }
}