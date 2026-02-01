<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class ProfileController extends Controller
{
    /**
     * Ambil data profile dari backend
     */
    private function fetchProfile(): array
    {
        $token = session('auth.token');

        if (!$token) {
            throw new \Exception('Token tidak ditemukan, silakan login ulang.');
        }

        /** @var Response $response */
        $response = Http::withToken($token)
            ->timeout(10)
            ->get(config('services.api.base_url') . '/mobile/profile');

        if ($response->unauthorized()) {
            Session::forget('auth');
            throw new \Exception('Sesi Anda telah berakhir, silakan login kembali.');
        }

        if (!$response->successful()) {
            throw new \Exception(
                $response->json('message') ?? 'Gagal mengambil data profile.'
            );
        }

        return $response->json();
    }

    /**
     * Profile Index
     */
    public function index()
    {
        try {
            $data = $this->fetchProfile();

            return view('pages.profile.profile-index', [
                'exists'  => $data['exists'],
                'profile' => $data['profile'],
            ]);

        } catch (\Exception $e) {
            return redirect()
                ->route('dashboard.index')
                ->with('error', $e->getMessage());
        }
    }

    /**
     * Form Create Profile
     */
    public function create()
    {
        return view('pages.profile.profile-create');
    }

    /**
     * Store Profile
     */
    public function store(Request $request)
    {
        $request->validate([
            'phone'        => 'nullable|string|max:20',
            'testimonial'  => 'nullable|string',
            'bio'          => 'nullable|string',
            'education'    => 'nullable|string',
            'skills'       => 'nullable|string',
            'experience'   => 'nullable|string',
            'linkedin_url' => 'nullable|url',
            'image'        => 'nullable|image|max:2048',
            'cv_file'      => 'nullable|mimes:pdf|max:5120',
        ]);

        try {
            $http = Http::withToken(session('auth.token'))->timeout(15);

            if ($request->hasFile('image')) {
                $http->attach(
                    'image',
                    $request->file('image')->get(),
                    $request->file('image')->getClientOriginalName()
                );
            }

            if ($request->hasFile('cv_file')) {
                $http->attach(
                    'cv_file',
                    $request->file('cv_file')->get(),
                    $request->file('cv_file')->getClientOriginalName()
                );
            }

            /** @var Response $response */
            $response = $http->post(
                config('services.api.base_url') . '/mobile/profile',
                $request->except(['image', 'cv_file', '_token'])
            );

            if ($response->status() === 409) {
                return redirect()
                    ->route('profile.index')
                    ->with('info', 'Profile sudah ada.');
            }

            if (!$response->successful()) {
                throw new \Exception(
                    $response->json('message') ?? 'Gagal menyimpan profile.'
                );
            }

            return redirect()
                ->route('profile.index')
                ->with('success', 'Profile berhasil dibuat.');

        } catch (\Exception $e) {
            return back()->withInput()->with('error', $e->getMessage());
        }
    }

    /**
     * Form Edit Profile
     */
    public function edit()
    {
        try {
            $data = $this->fetchProfile();

            if (!$data['exists']) {
                return redirect()
                    ->route('profile.create')
                    ->with('info', 'Silakan buat profile terlebih dahulu.');
            }

            return view('pages.profile.profile-update', [
                'profile' => $data['profile'],
            ]);

        } catch (\Exception $e) {
            return redirect()
                ->route('profile.index')
                ->with('error', $e->getMessage());
        }
    }

    /**
     * Update Profile
     */
    public function update(Request $request)
    {
        $request->validate([
            'phone'        => 'nullable|string|max:20',
            'testimonial'  => 'nullable|string',
            'bio'          => 'nullable|string',
            'education'    => 'nullable|string',
            'skills'       => 'nullable|string',
            'experience'   => 'nullable|string',
            'linkedin_url' => 'nullable|url',
            'image'        => 'nullable|image|max:2048',
            'cv_file'      => 'nullable|mimes:pdf|max:5120',
        ]);

        try {
            $http = Http::withToken(session('auth.token'))->timeout(15);

            if ($request->hasFile('image')) {
                $http->attach(
                    'image',
                    $request->file('image')->get(),
                    $request->file('image')->getClientOriginalName()
                );
            }

            if ($request->hasFile('cv_file')) {
                $http->attach(
                    'cv_file',
                    $request->file('cv_file')->get(),
                    $request->file('cv_file')->getClientOriginalName()
                );
            }

            /** @var Response $response */
            $response = $http->post(
                config('services.api.base_url') . '/mobile/profile?_method=PUT',
                $request->except(['image', 'cv_file', '_token'])
            );

            if (!$response->successful()) {
                throw new \Exception(
                    $response->json('message') ?? 'Gagal memperbarui profile.'
                );
            }

            return redirect()
                ->route('profile.index')
                ->with('success', 'Profile berhasil diperbarui.');

        } catch (\Exception $e) {
            return back()->withInput()->with('error', $e->getMessage());
        }
    }

    public function careerInfo()
    {
        return view('pages.profile.profile-career-info');
    }
}
