<?php

namespace App\Http\Controllers;

use App\Models\Jalur;
use Illuminate\Http\Request;

class JalurController extends Controller
{
    public function index()
    {
        $jalur = Jalur::all();
        return view('superadmin.jalur', compact('jalur'), [
            "title" => "Jalur Pendaftaran"
        ]);
    }
    public function jalur()
    {
        $jalur = Jalur::all();
        return view('siswa.jalur', compact('jalur'));
    }
    public function store(Request $r)
    {
        Jalur::create([
            'nama_jalur' => $r->nama_jalur,
            'biaya' => $r->biaya,
            'deskripsi' => $r->deskripsi,
        ]);

        return redirect('/superadmin/jalur')->with('success', 'Jalur pendaftaran berhasil ditambahkan!');
    }
    public function update(Request $r, $id)
    {
        $jalur = Jalur::find($id);
        $jalur->nama_jalur = $r->nama_jalur;
        $jalur->biaya = $r->biaya;
        $jalur->deskripsi = $r->deskripsi;
        $jalur->save();

        return redirect('/superadmin/jalur')->with('success', 'Jalur pendaftaran berhasil diperbarui!');
    }
    public function destroy($id)
    {
        Jalur::findOrFail($id)->delete();

        return redirect('/superadmin/jalur')->with('success', 'Jalur pendaftaran berhasil dihapus!');
    }
    public function jalurTU()
    {
        $jalur = Jalur::all();
        return view('tu.jalur', compact('jalur'), [
            "title" => "Jalur Pendaftaran"
        ]);
    }
}