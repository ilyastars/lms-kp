<?php

namespace App\Http\Controllers;

use App\Models\Skema;
use App\Models\Pendaftaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PendaftaranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pendaftaran = \App\Models\Pendaftaran::with('jadwal.skema')->latest()->paginate(20);
        return view('pendaftaran_index', compact('pendaftaran'));
        // return view('pendaftaran_index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // $data['listUser'] = \App\Models\User::orderBy('nama', 'asc')->get();
        $data['listJadwal'] = \App\Models\Jadwal::with('skema')->orderBy('tgl_ujian', 'asc')->get();
        return view('pendaftaran_create', $data);
        

        //sampel buat user
        // $user = Auth::user();
        // $skema = Skema::all();

        // // Cek apakah user sudah pernah mendaftar
        // $pendaftaranSebelumnya = Pendaftaran::where('user_id', $user->id)->latest()->first();

        // return view('pendaftaran.create', compact('user', 'skema', 'pendaftaranSebelumnya'));
   
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
    public function show(Pendaftaran $pendaftaran)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pendaftaran $pendaftaran)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pendaftaran $pendaftaran)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pendaftaran $pendaftaran)
    {
        //
    }
}
