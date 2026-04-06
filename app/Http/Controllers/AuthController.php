<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;
use App\Models\Siswa;

class AuthController extends Controller
{
    public function showLogin()
    {
        if (session('logged_in')) {
            $role = session('role');
            return redirect()->route($role . '.dashboard');
        }
        
        return view('landing');
    }
    
    public function login(Request $request)
    {
        $request->validate([
            'role' => 'required|in:admin,siswa',
        ]);
        
        if ($request->role === 'admin') {
            return $this->loginAdmin($request);
        } else {
            return $this->loginSiswa($request);
        }
    }
    
    private function loginAdmin(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);
        
        $admin = Admin::where('username', $request->username)->first();
        
        if ($admin && Hash::check($request->password, $admin->password)) {
            session([
                'user_id' => $admin->id_admin,
                'username' => $admin->username,
                'role' => 'admin',
                'logged_in' => true
            ]);
            
            return redirect()->route('admin.dashboard');
        }
        
        return back()->withErrors(['login' => 'Username atau password salah!'])->withInput();
    }
    
    private function loginSiswa(Request $request)
    {
        $request->validate([
            'nisn' => 'required',
            'password' => 'required',
        ]);

        $siswa = Siswa::where('nisn', $request->nisn)->first();

        if ($siswa && Hash::check($request->password, $siswa->password)) {
            if (!$siswa->is_active) {
                return back()->withErrors(['login' => 'Akun Anda tidak aktif!'])->withInput();
            }

            session([
                'user_id' => $siswa->nisn,
                'nama' => $siswa->nama,
                'nisn' => $siswa->nisn,
                'kelas' => $siswa->kelas,
                'role' => 'siswa',
                'logged_in' => true
            ]);

            return redirect()->route('siswa.dashboard');
        }

        return back()->withErrors(['login' => 'NISN atau password salah!'])->withInput();
    }
    
    public function logout()
    {
        session()->flush();
        return redirect()->route('login');
    }
}