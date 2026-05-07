<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;

class SiswaController extends Controller
{
    public function index()
    {
        $siswa = Student::with('jurusan')
        ->orderBy('id_jurusan', 'ASC')
        ->get();

        return view('tu.siswa', compact('siswa'), [
            "title" => "Daftar Siswa"
        ]);
    }
     public function show($id)
    {
        $siswa = Student::with('jurusan', 'baju')->findOrFail($id);
        return view(
            'tu.detail',
            compact('siswa'),
            ["title" => "Detail Siswa"]
        );
    }
    public function indexAdmin()
    {
        $siswa = Student::with('jurusan')
        ->orderBy('id_jurusan', 'ASC')
        ->get();

        return view('superadmin.siswa', compact('siswa'), [
            "title" => "Daftar Siswa"
        ]);
    }
     public function showAdmin($id)
    {
        $siswa = Student::with('jurusan', 'baju')->findOrFail($id);
        return view(
            'superadmin.detail',
            compact('siswa'),
            ["title" => "Detail Siswa"]
        );
    }
}
