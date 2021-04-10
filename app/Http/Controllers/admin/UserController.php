<?php

namespace App\Http\Controllers\admin;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    //

    public function index()
    {
        $data['user'] = User::all();
        return view('admin.user.index', $data);
    }
    
    public function create()
    {
        return view('admin.user.create');
    }
    
    public function edit($id)
    {
        $data['user'] = User::findOrFail($id); 
        return view('admin.user.edit',$data);
    }

    public function post(Request $request)
    {
        // // dd($request->input());
        $request->validate([
            'nama'      => 'required',
            'alamat'    => 'required',
            'level'     => 'required',
            'username'  => 'required|unique:users',
            'password'  => 'required',
        ]);
        
        $user           = new User;
        $user->nama     = $request->nama;
        $user->alamat   = $request->alamat;
        $user->level    = $request->level;
        $user->username = $request->username;
        $user->password = Hash::make($request->password);

        if($user->save()){
            $alert = [
                "tipe" => "alert-success",
                "pesan" => "User berhasil disimpan!"
            ];
            return redirect()->route("user")->with($alert);
        }
        $alert = [
            "tipe" => "alert-danger",
            "pesan" => "User gagal disimpan!"
        ];
        return redirect()->back()->with($alert);
    }

    public function put(Request $request, $id)
    {
        $request->validate(
            ['nama'=> 'required',
           'alamat'=> 'required',
           'level'=> 'required',
           'username'=> 'required']
        );

        $user           = User::findOrFail($id);
        $user->nama     = $request->nama;
        $user->alamat   = $request->alamat;
        $user->level    = $request->level;
        $user->username = $request->username;

        try {
            if($user->save())
            {
                $alert = [
                    "tipe" => "alert-success",
                    "pesan"  => "Data user berhasil diubah!"
                ];
                return redirect()->route('user')->with($alert);
            }
            $alert = [
                "tipe" => "alert-danger",
                "pesan"  => "Data user gagal diubah!"
            ];
            return redirect()->back()->with($alert);
        } catch(\Illuminate\Database\QueryException $e){
            $errorCode = $e->errorInfo[1];
            if($errorCode == '1062'){
                return back()->withErrors(['username' => 'The username has already been taken.']);
            }
        }
    }

    public function password(Request $request, $id)
    {
        $request->validate([
            "password" => "required",
            "password_baru" => "required|confirmed"
        ]);

        if(Hash::check($request->password, \Auth::user()->password))
        {
            $user = User::findOrFail($id);
            $user->password = Hash::make($request->password_baru);
            if($user->save())
            {
                $alert = [
                    "tipe" => "alert-success",
                    "pesan"  => "Data user berhasil diubah!"
                ];
                return redirect()->back()->with($alert);
            }
            $alert = [
                "tipe" => "alert-danger",
                "pesan"  => "Data user gagal diubah!"
            ];
            return redirect()->back()->with($alert);
        }
        $alert = [
            "tipe" => "alert-danger",
            "pesan"  => "Password salah!"
        ];
        return redirect()->back()->with($alert);

    }

    public function delete(Request $request,$id)
    {
        
        try {
            if(User::findOrFail($id)->delete())
            {
                $alert = [
                    "tipe" => "alert-success",
                    "pesan" => "User berhasil dihapus!"
                ];
                return redirect()->back()->with($alert);
            }
            $alert = [
                "tipe" => "alert-danger",
                "pesan" => "User gagal dihapus!"
            ];
            return redirect()->back()->with($alert);
            
        } catch(\Illuminate\Database\QueryException $e){
            $errorCode = $e->errorInfo[1];
            if($errorCode == '1451'){
                $alert = [
                    "tipe" => "alert-danger",
                    "pesan"  => "Data user tidak dapat dihapus! data memiliki relasi dengan data lainnya."
                ];
                return redirect()->back()->with($alert);
            }
        }

    }
}