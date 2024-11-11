<?php

namespace App\Http\Controllers;

use App\Models\Skema;
use App\Models\DaftarUser;
use App\Models\Pendaftaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DaftarUserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $data['listJadwal'] = \App\Models\Jadwal::with('skema')->orderBy('tgl_ujian', 'asc')->get();
        $data['skema'] = \App\Models\Skema::with('skema')->orderBy('tgl_ujian', 'asc')->get();
        return view('daftar_user', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($skema_id)
    {
        $data['listJadwal'] = \App\Models\Jadwal::with('skema')->orderBy('tgl_ujian', 'asc')->get();
        return view('daftar_user', $data);

        // $user = Auth::user(); // Ambil data user yang sedang login
        // $existingPendaftaran = Pendaftaran::where('user_id', $user->id)->where('jadwal_id', $skema_id)->first();

        // // Ambil data skema untuk pre-fill data skema
        // $skema = Skema::findOrFail($skema_id);

        // if ($existingPendaftaran) {
        //     // Jika pendaftaran sudah ada, pre-fill dengan data pendaftaran yang ada
        //     return view('daftar_user', [
        //         'pendaftaran' => $existingPendaftaran,
        //         'skema' => $skema,
        //     ]);
        // } else {
        //     // Buat pendaftaran baru dan pre-fill dengan data user
        //     $pendaftaran = new Pendaftaran();
        //     $pendaftaran->nama = $user->name; // Isi dengan nama user

        //     return view('daftar_user', [
        //         'pendaftaran' => $pendaftaran,
        //         'skema' => $skema,
        //     ]);
        // }

        // $latestEntry = Pendaftaran::where('jadwal_id', $request->jadwal_id)->latest('id')->first();
        // $newKd = $latestEntry ? ((int)substr($latestEntry->kd_pendaftaran, -3)) + 1 : 1;
        // $kdPendaftaran = $skema->kd_jadwal . str_pad($newKd, 3, '0', STR_PAD_LEFT);

        // $pendaftaran = new Pendaftaran();
        // $pendaftaran->kd_pendaftaran = $kdPendaftaran;

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $requestData = $request->validate([
            'kd_pendaftaran' => 'required',
            'nama' => 'required',
            'jadwal_id' => 'required',
            'nik' => 'required|numeric|digits:16',
            'tmp_lahir' => 'required',
            'tgl_lahir' => 'required',
            'jns_kelamin' => 'required|in:laki-laki,perempuan',
            'kebangsaan' => 'required',
            'alamat' => 'required',
            'no_hp' => 'required|numeric|min:12',
            'pendidikan' => 'required',
        ]);
        

        $pendaftaran = new \App\Models\Pendaftaran(); 
        $pendaftaran->fill($requestData);
        $pendaftaran->user_id = '1'; 
        $pendaftaran->save(); 
        flash('Data sudah di simpan')->success();
        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(DaftarUser $daftarUser)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DaftarUser $daftarUser)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, DaftarUser $daftarUser)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DaftarUser $daftarUser)
    {
        //
    }
}
