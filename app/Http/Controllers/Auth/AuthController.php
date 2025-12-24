<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    /**
     * Halaman register + ambil fakultas & prodi
     */
    public function registerMeta()
    {
        $apiUrl = config('services.api.base_url') . '/mobile/register-meta';

        $response = Http::get($apiUrl);

        if (!$response->successful()) {
            abort(500, 'Gagal mengambil data register');
        }

        return view('auth.register', [
            'faculties' => $response->json('faculties'),
            'studyPrograms' => $response->json('study_programs'),
        ]);
    }

    /**
     * Submit register ke API
     */
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email',
            'password' => 'required|min:6|confirmed',

            'role' => 'required|in:student,alumni',
            'student_id_number' => 'required|string',
            'faculty_id' => 'required',
            'study_program_id' => 'required',
            'entry_year' => 'required|digits:4',
            'graduation_year' => 'nullable|digits:4',
        ]);

        $apiUrl = config('services.api.base_url') . '/mobile/register';

        $response = Http::post($apiUrl, $request->all());

        if ($response->failed()) {
            return back()
                ->withErrors([
                    'message' => $response->json('message') ?? 'Registrasi gagal'
                ])
                ->withInput();
        }

        return redirect()
            ->route('index')
            ->with('success', 'Registrasi berhasil. Menunggu persetujuan admin.');
    }

    /**
     * Submit login ke API
     */
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $apiUrl = config('services.api.base_url') . '/mobile/login';

        $response = Http::post($apiUrl, [
            'email' => $request->email,
            'password' => $request->password,
        ]);

        if ($response->failed()) {
            return back()
                ->withErrors([
                    'message' => $response->json('message') ?? 'Login gagal'
                ])
                ->withInput();
        }

        // Simpan token & user ke session
        session([
            'auth' => [
                'token' => $response->json('token'),
                'user'  => $response->json('user'),
            ]
        ]);

        return redirect()->route('dashboard');
    }
}
