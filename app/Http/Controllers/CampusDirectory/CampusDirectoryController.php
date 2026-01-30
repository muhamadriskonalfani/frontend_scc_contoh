<?php

namespace App\Http\Controllers\CampusDirectory;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class CampusDirectoryController extends Controller
{
    /**
     * Daftar direktori kampus + filter
     */
    public function index(Request $request)
    {
        $token = session('auth.token');

        if (!$token) {
            abort(401, 'Token tidak ditemukan');
        }

        // 🔹 Ambil data directory
        /** @var Response $response */
        $response = Http::withToken($token)
            ->get(config('services.api.base_url') . '/mobile/directory', [
                'type'             => $request->type,
                'faculty_id'       => $request->faculty_id,
                'study_program_id' => $request->study_program_id,
                'entry_year'       => $request->entry_year,
                'page'             => $request->page ?? 1,
            ]);

        if ($response->failed()) {
            abort($response->status(), 'Gagal mengambil data direktori');
        }

        // 🔹 Ambil meta fakultas & prodi
        /** @var Response $meta */
        $meta = Http::withToken($token)
            ->get(config('services.api.base_url') . '/mobile/register-meta');

        return view('pages.directory.directory-index', [
            'users'        => $response->json('data.data'),
            'pagination'   => $response->json('data'),
            'filters'      => $request->only([
                'type',
                'faculty_id',
                'study_program_id',
                'entry_year'
            ]),
            'faculties'    => $meta->json('faculties') ?? [],
            'studyPrograms'=> $meta->json('study_programs') ?? [],
        ]);
    }

    /**
     * Detail profil publik
     */
    public function show($id)
    {
        $token = session('auth.token');

        if (!$token) {
            abort(401, 'Token tidak ditemukan');
        }

        /** @var Response $response */
        $response = Http::withToken($token)
            ->get(config('services.api.base_url') . "/mobile/directory/{$id}");

        if ($response->failed()) {
            dd($response->status(), $response->body());
        }

        return view('pages.directory.directory-detail', [
            'user' => $response->json('data'),
        ]);
    }
}
