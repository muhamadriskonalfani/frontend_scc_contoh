<?php

namespace App\Http\Controllers\Apprenticeship;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ApprenticeshipController extends Controller
{
    /**
     * List semua magang (student & alumni)
     */
    public function index(Request $request)
    {
        /** @var Response $response */
        $response = Http::withToken(session('auth.token'))
            ->get(config('services.api.base_url') . '/mobile/apprenticeships', [
                'page' => $request->page ?? 1,
            ]);

        return view('pages.apprenticeship.apprenticeship-index', [
            'apprenticeships' => $response->json('data.data'),
            'pagination'      => $response->json('data'),
        ]);
    }

    /**
     * Detail magang
     */
    public function show($id)
    {
        /** @var Response $response */
        $response = Http::withToken(session('auth.token'))
            ->get(config('services.api.base_url') . "/mobile/apprenticeships/{$id}");

        abort_if($response->failed(), 404);

        return view('pages.apprenticeship.apprenticeship-detail', [
            'apprenticeship' => $response->json('data'),
        ]);
    }

    /**
     * Alumni: list magang milik sendiri
     */
    public function myApprenticeships(Request $request)
    {
        /** @var Response $response */
        $response = Http::withToken(session('auth.token'))
            ->get(config('services.api.base_url') . '/mobile/my-apprenticeships', [
                'page' => $request->page ?? 1,
            ]);

        return view('pages.apprenticeship.apprenticeship-my', [
            'apprenticeships' => $response->json('data.data'),
            'pagination'      => $response->json('data'),
        ]);
    }

    /**
     * Alumni: form create
     */
    public function create()
    {
        return view('pages.apprenticeship.apprenticeship-create');
    }

    /**
     * Alumni: simpan magang
     */
    public function store(Request $request)
    {
        $request->validate([
            'title'        => 'required',
            'description'  => 'required',
            'company_name' => 'required',
            'location'     => 'required',
            'expired_at'   => 'nullable|date',
        ]);

        /** @var Response $response */
        $response = Http::withToken(session('auth.token'))
            ->post(config('services.api.base_url') . '/mobile/apprenticeships', $request->all());

        return redirect()
            ->route('apprenticeship.my')
            ->with('success', $response->json('message'));
    }

    /**
     * Alumni: form edit
     */
    public function edit($id)
    {
        /** @var Response $response */
        $response = Http::withToken(session('auth.token'))
            ->get(config('services.api.base_url') . "/mobile/apprenticeships/{$id}");

        abort_if($response->failed(), 404);

        return view('pages.apprenticeship.apprenticeship-update', [
            'apprenticeship' => $response->json('data'),
        ]);
    }

    /**
     * Alumni: update magang
     */
    public function update(Request $request, $id)
    {
        /** @var Response $response */
        $response = Http::withToken(session('auth.token'))
            ->put(
                config('services.api.base_url') . "/mobile/apprenticeships/{$id}",
                $request->all()
            );

        return redirect()
            ->route('apprenticeship.my')
            ->with('success', $response->json('message'));
    }
}
