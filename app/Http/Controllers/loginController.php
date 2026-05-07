<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Pembayaran;
use App\Models\Pendaftar; 
use Illuminate\Support\Facades\Hash;

class loginController extends Controller
{
    public function TU()
    {
        if (Auth::check()) {
            $user = Auth::user();
            if ($user->role === 'superadmin')
                return redirect('/superadmin/dashboard');
            if ($user->role === 'tu')
                return redirect('/tu/dashboard');
        }
        return view('auth.login_tu');
    }
    public function siswa()
    {
        if (Auth::check()) {
            $role = session('role');
            if ($role === 'siswa') {
                return redirect('/status_pendaftaran');
            } else if ($role === 'tu') {
                return redirect('/tu/dashboard');
            }
        }
        return view('auth.login_siswa');
    }
    public function login_process(Request $request)
    {
        $request->validate([
            'identifier' => 'required|string',
            'password' => 'required|string',
        ]);

        $identifier = $request->identifier;
        $inputPassword = $request->password;
        $role = null;
        $user_to_login = null;

        if (filter_var($identifier, FILTER_VALIDATE_EMAIL)) {
            if (Auth::attempt(['email' => $identifier, 'password' => $inputPassword])) {
                $user_to_login = Auth::user();

                $role = $user_to_login->role;
            }
        }
        if (!$role) {
            $pendaftar = Pendaftar::where('no_pendaftaran', $identifier)->first();
            if ($pendaftar && $inputPassword === $pendaftar->nisn) {
                $role = 'siswa';
                $user_to_login = $pendaftar;
            }
        }
        if ($role && $user_to_login) {
            if ($role === 'siswa') {
                Auth::guard('pendaftar')->login($user_to_login);
            } else {
                Auth::login($user_to_login);
            }
            $request->session()->regenerate();
            $request->session()->put('role', $role);

            $jumlahMenunggu = Pendaftar::where('status_berkas', 'Menunggu')->count();
            $jumlahBayar = pembayaran::where('status_bayar', 'Proses Verifikasi')->count();

            if ($role === 'superadmin') {
                return redirect('/superadmin/dashboard')->with('success', 'Selamat Datang Superadmin!');
            } elseif ($role === 'tu') {
                return redirect('/tu/dashboard')->with('success', 'Login berhasil sebagai TU!')
                ->with('info', 'Terdapat ' . $jumlahMenunggu . ' Peserta Yang Belum Di Verifikasi')
                ->with('warning', 'Terdapat ' . $jumlahBayar . ' Peserta Yang Belum Di Verifikasi Pembayaran');
            } else {
                $pembayaran = Pembayaran::where('id_pendaftar', $user_to_login->id)->first();
                if ($pembayaran && trim($pembayaran->status_hasil) != 'Menunggu') {
                    return redirect('/hasil_pendaftar');
                } else {
                    return redirect('/status_pendaftaran');
                }
            }
        }
        return back()->withInput()->withErrors([
            'identifier' => 'Nomor Pendaftaran/Email atau NISN/Password tidak valid.',
        ]);
    }
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();
        $request->session()->forget('role');

        return redirect('/login')->with('success', 'Anda telah berhasil keluar.');
    }
}