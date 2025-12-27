<?php

namespace App\Http\Controllers\JobVacancy;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class JobVacancyController extends Controller
{
    /**
     * List semua lowongan (student & alumni)
     */
    public function index(Request $request)
    {
        /** @var Response $response */
        $response = Http::withToken(session('auth.token'))
            ->get(config('services.api.base_url') . '/mobile/jobvacancy', [
                'page' => $request->page ?? 1,
            ]);

        return view('pages.job-vacancy.job-vacancy-index', [
            'jobVacancies' => $response->json('data.data'),
            'pagination'   => $response->json('data'),
        ]);
    }

    /**
     * Detail lowongan
     */
    public function show($id)
    {
        /** @var Response $response */
        $response = Http::withToken(session('auth.token'))
            ->get(config('services.api.base_url') . "/mobile/jobvacancy/{$id}");

        abort_if($response->failed(), 404);

        return view('pages.job-vacancy.job-vacancy-detail', [
            'jobVacancy' => $response->json('data'),
        ]);
    }

    /**
     * Alumni: list lowongan milik sendiri
     */
    public function myJobVacancies(Request $request)
    {
        /** @var Response $response */
        $response = Http::withToken(session('auth.token'))
            ->get(config('services.api.base_url') . '/mobile/my-jobvacancy', [
                'page' => $request->page ?? 1,
            ]);

        return view('pages.job-vacancy.job-vacancy-my', [
            'jobVacancies' => $response->json('data.data'),
            'pagination'   => $response->json('data'),
        ]);
    }

    /**
     * Alumni: form create
     */
    public function create()
    {
        return view('pages.job-vacancy.job-vacancy-create');
    }

    /**
     * Alumni: simpan lowongan
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
            ->post(
                config('services.api.base_url') . '/mobile/jobvacancy',
                $request->all()
            );

        return redirect()
            ->route('job_vacancy.my')
            ->with('success', $response->json('message'));
    }

    /**
     * Alumni: form edit
     */
    public function edit($id)
    {
        /** @var Response $response */
        $response = Http::withToken(session('auth.token'))
            ->get(config('services.api.base_url') . "/mobile/jobvacancy/{$id}");

        abort_if($response->failed(), 404);

        return view('pages.job-vacancy.job-vacancy-update', [
            'jobVacancy' => $response->json('data'),
        ]);
    }

    /**
     * Alumni: update lowongan
     */
    public function update(Request $request, $id)
    {
        /** @var Response $response */
        $response = Http::withToken(session('auth.token'))
            ->put(
                config('services.api.base_url') . "/mobile/jobvacancy/{$id}",
                $request->all()
            );

        return redirect()
            ->route('job_vacancy.my')
            ->with('success', $response->json('message'));
    }
}
