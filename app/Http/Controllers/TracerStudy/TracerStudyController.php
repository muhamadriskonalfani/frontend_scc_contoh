<?php

namespace App\Http\Controllers\TracerStudy;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class TracerStudyController extends Controller
{
    /**
     * Ambil data tracer study dari backend
     */
    protected function fetchTracerStudy()
    {
        $token = session('auth.token');

        if (!$token) {
            return [
                'status' => 'unauthenticated'
            ];
        }

        /** @var Response $response */
        $response = Http::withToken($token)
            ->get(config('services.api.base_url') . '/mobile/tracer-study');

        // Tracer study belum ada
        if ($response->status() === 404) {
            return [
                'status' => 'not_found',
                'data' => null
            ];
        }

        // Error lain
        if ($response->failed()) {
            return [
                'status' => 'error'
            ];
        }

        return [
            'status' => 'success',
            'data' => $response->json('data')
        ];
    }

    /**
     * Halaman index tracer study
     */
    public function index()
    {
        $result = $this->fetchTracerStudy();

        if ($result['status'] === 'unauthenticated') {
            return redirect()
                ->route('login')
                ->withErrors('Session login berakhir.');
        }

        return view('pages.tracer-study.tracer-study-index', [
            'tracerStudy' => $result['data'],
            'message' => $result['status'] === 'not_found'
                ? 'Tracer study belum diisi'
                : null
        ]);
    }

    /**
     * Halaman update tracer study
     */
    public function update()
    {
        $result = $this->fetchTracerStudy();

        if ($result['status'] === 'unauthenticated') {
            return redirect()
                ->route('login')
                ->withErrors('Session login berakhir.');
        }

        return view('pages.tracer-study.tracer-study-update', [
            'tracerStudy' => $result['data']
        ]);
    }

    /**
     * Simpan update tracer study
     */
    public function saveUpdate(Request $request)
    {
        $token = session('auth.token');

        if (!$token) {
            return redirect()
                ->route('login')
                ->withErrors('Session login berakhir.');
        }

        // Validasi FRONTEND (ringan, backend tetap sumber utama)
        $validated = $request->validate([
            'domicile' => 'required|string|max:100',
            'whatsapp_number' => 'required|string|max:20',

            'current_workplace' => 'nullable|string|max:150',
            'current_job_duration_months' => 'nullable|integer|min:0',
            'company_scale' => 'nullable|in:local,national,international',
            'job_title' => 'nullable|string|max:100',
        ]);

        /** @var \Illuminate\Http\Client\Response $response */
        $response = Http::withToken($token)
            ->put(config('services.api.base_url') . '/mobile/tracer-study', $validated);

        // Jika tracer study tidak ditemukan
        if ($response->status() === 404) {
            return redirect()
                ->route('tracer-study.index')
                ->withErrors('Tracer study tidak ditemukan.');
        }

        // Jika gagal validasi backend (422)
        if ($response->status() === 422) {
            return back()
                ->withErrors($response->json('errors'))
                ->withInput();
        }

        // Error lain
        if ($response->failed()) {
            return back()
                ->withErrors('Gagal memperbarui tracer study.')
                ->withInput();
        }

        return redirect()
            ->route('tracer_study.index')
            ->with('success', 'Tracer study berhasil diperbarui.');
    }
}
