<?php

namespace App\Http\Controllers\Campus;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class CampusController extends Controller
{
    /**
     * List informasi kampus
     */
    public function index(Request $request)
    {
        $token = session('auth.token');

        /** @var Response $response */
        $response = Http::withToken($token)
            ->get(config('services.api.base_url') . '/mobile/information-campus', [
                'page' => $request->get('page', 1),
            ]);

        if ($response->failed()) {
            return redirect()
                ->route('dashboard.index')
                ->with('error', 'Gagal memuat informasi kampus.');
        }

        return view('pages.campus.campus-index', [
            'informations' => $response->json('data'),
            'meta'         => $response->json('meta'),
        ]);
    }

    /**
     * Detail informasi kampus
     */
    public function show($id)
    {
        $token = session('auth.token');

        /** @var Response $response */
        $response = Http::withToken($token)
            ->get(config('services.api.base_url') . "/mobile/information-campus/{$id}");

        if ($response->status() === 404) {
            return redirect()
                ->route('dashboard.index')
                ->with('error', 'Informasi kampus tidak ditemukan.');
        }

        if ($response->failed()) {
            return redirect()
                ->route('dashboard.index')
                ->with('error', 'Gagal memuat detail informasi kampus.');
        }

        return view('pages.campus.campus-detail', [
            'information' => $response->json(),
        ]);
    }
}
