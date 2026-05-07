<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OrangTua;

class OrangTuaController extends Controller
{
    public function index()
    {
        $OrangTua = OrangTua::all();

        return view('tu.ortu', compact('OrangTua'), [
            "title" => "Daftar OrangTua"
        ]);
    }
     public function show($id)
    {
       $OrangTua = OrangTua::with('siswa')->first();
        return view(
            'tu.detailOrtu',
            compact('OrangTua'),
            ["title" => "Detail OrangTua"]
        );
    }
    public function indexAdmin()
    {
       $OrangTua = OrangTua::all();

        return view('superadmin.ortu', compact('OrangTua'), [
            "title" => "Daftar OrangTua"
        ]);
    }
     public function showAdmin($id)
    {
        $OrangTua = OrangTua::with('siswa')->first();
        
        return view(
            'superadmin.detailOrtu',
            compact('OrangTua'),
            ["title" => "Detail OrangTua"]
        );
    }
}
