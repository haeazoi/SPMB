<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Baju;

class BajuController extends Controller
{
    public function index()
    {
        $baju = Baju::withCount('jml_siswa')->get();

        return view('superadmin.baju', compact('baju'), [
            "title" => "Daftar Ukuran Baju"
        ]);
    }

    public function store(Request $r)
    {
        Baju::create([
            'ukuran_baju' => $r->ukuran_baju,
        ]);

        return redirect('superadmin/baju')->with('success', 'Data ukuran baju berhasil ditambahkan!');
    }

    public function update(Request $r, $id)
    {
        $baju = Baju::find($id);
        $baju->ukuran_baju = $r->ukuran_baju;
        $baju->save();

        return redirect('superadmin/baju')->with('success', 'Data ukuran baju berhasil diperbarui!');
    }

    public function destroy($id)
    {
        Baju::findOrFail($id)->delete();

        return redirect('superadmin/baju')->with('success', 'Data ukuran baju berhasil dihapus!');
    }

    public function baju()
    {
        $baju = Baju::withCount('jml_siswa')->get();

        return view('tu.baju', compact('baju'), [
            "title" => "Daftar Ukuran Baju"
        ]);
    }
}