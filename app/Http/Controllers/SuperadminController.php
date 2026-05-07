<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Models\Pendaftar;
use App\Models\Pembayaran;

class SuperadminController extends Controller
{
    public function index()
    {
        $totaldtf = Pendaftar::count();

        $dataLulus = Pendaftar::whereHas('pembayaran', function ($query) {
            $query->where('status_hasil', 'Lulus');
        })->get();

        $jumlahLulus = $dataLulus->count();
        $jumlahMenunggu = Pendaftar::where('status_berkas', 'Menunggu')->count();
        $jumlahBayar = Pembayaran::where('status_bayar', 'Proses Verifikasi')->count();

        return view('superadmin.dashboard', compact('totaldtf', 'dataLulus', 'jumlahLulus', 'jumlahMenunggu', 'jumlahBayar'), ["title" => "Dashboard"]);
    }
    public function show()
    {
        $users = User::all();

        return view('superadmin.user', compact('users'), [
            "title" => "Daftar Pengguna"
        ]);
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'tu',
        ]);

        return redirect('/management_user')->with('success', 'Akun TU berhasil dibuat!');
    }
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->email = $request->email;

        if ($request->password) {
            $user->password = Hash::make($request->password);
        }

        $user->save();
        return redirect('/management_user')->with('success', 'User berhasil diupdate');
    }
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect('/management_user')->with('success', 'User berhasil dihapus');
    }
}