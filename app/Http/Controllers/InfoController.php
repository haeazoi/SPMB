<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Informasi;

class InfoController extends Controller
{
    public function index()
    {
        $info = Informasi::withCount('jml_siswa')->get();

        return view('superadmin.info', compact('info'), [
            "title" => 'Informasi Pendaftaran'
        ]);
    }
    public function store(Request $r)
    {
        Informasi::create([
            'jenis' => $r->jenis,
        ]);

        return redirect('superadmin/info')->with('success', 'Data informasi berhasil ditambahkan!');
    }
    public function update(Request $r, $id)
    {
        $info = Informasi::find($id);
        $info->jenis = $r->jenis;
        $info->save();

        return redirect('superadmin/info')->with('success', 'Data informasi berhasil diperbarui!');
    }
    public function destroy($id)
    {
        Informasi::findOrFail($id)->delete();

        return redirect('superadmin/info')->with('success', 'Data informasi berhasil dihapus!');
    }
    public function info()
    {
        $info = Informasi::withCount('jml_siswa')->get();

        return view('tu.info', compact('info'), [
            "title" => 'Informasi Pendaftaran'
        ]);
    }
}