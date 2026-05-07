<?php

namespace App\Http\Controllers;

use App\Models\Jurusan;
use Illuminate\Http\Request;

class JurusanController extends Controller
{
    public function index()
    {
        $jurusan = Jurusan::withCount('jml_siswa')->get();

        return view('superadmin.jurusan', compact('jurusan'), [
            "title" => "Daftar Jurusan"
        ]);
    }
    public function store(Request $r)
    {
        Jurusan::create([
            'nama_jurusan' => $r->nama_jurusan,
        ]);

        return redirect('superadmin/jurusan')->with('success', 'Data jurusan berhasil ditambahkan!');
    }
    public function update(Request $r, $id)
    {
        $jurusan = Jurusan::find($id);
        $jurusan->nama_jurusan = $r->nama_jurusan;
        $jurusan->save();

        return redirect('superadmin/jurusan')->with('success', 'Data jurusan berhasil diperbarui!');
    }
    public function destroy($id)
    {
        Jurusan::findOrFail($id)->delete();

        return redirect('superadmin/jurusan')->with('success', 'Data jurusan berhasil dihapus!');
    }
    public function jurusan()
    {
        $jurusan = Jurusan::withCount('jml_siswa')->get();

        return view('tu.jurusan', compact('jurusan'), [
            "title" => "Daftar Jurusan"
        ]);
    }
}