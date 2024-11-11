<?php

namespace App\Http\Controllers;

use App\Models\Pasien;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PasienController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['pasien'] = \App\Models\Pasien::latest()->paginate(10);
        return view('pasien_index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pasien_create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $requestData = $request->validate([
            'no_pasien' => 'required|unique:pasiens,no_pasien',
            'nama' => 'required|min:3',
            'umur' => 'required|numeric',
            'jenis_kelamin' => 'required|in:laki-laki,perempuan',
            'alamat' => 'nullable', //alamat boleh kosong
            'foto' => 'required|image|mimes:jpeg,png,jpg|max:5000',
        ]);
        $pasien = new \App\Models\Pasien(); //membuat objjek kosong di variable model
        $pasien->fill($requestData); //mengisi var model dgn data yg sudah di validasi request
        // dd($request->file());
        $pasien->foto = $request->file('foto')->store('public');
        // dd($pasien);
        $pasien->save(); //menyimpan data ke database
        flash('Data sudah di simpan')->success();
        return back();
        // return back()->with('pesan', 'Horee.. Data sudah di simpan'); //tanpa laracasts/flash
            //mengarahkan user ke url sebelumya yaitu /pasien/create dgn membawa variabel pesan
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data['pasien'] = \App\Models\Pasien::findOrFail($id);
        return view('pasien_edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $requestData = $request->validate([
            'no_pasien' => 'required|unique:pasiens,no_pasien,' . $id,
            'nama' => 'required|min:3',
            'umur' => 'required|numeric',
            'jenis_kelamin' => 'required|in:laki-laki,perempuan',
            'alamat' => 'nullable', //alamat boleh kosong
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:5000',
        ]);
        $pasien = \App\Models\Pasien::findOrFail($id); //mengedit objjek kosong di variable model
        $pasien->fill($requestData); //mengisi var model dgn data yg sudah di validasi request
        //karena di validasi foto boleh ull, maka perlu pengecekan apakah ada file foto yg di uploud
        //jika ada maka file foto lamaa di hapus dan di ganti file foto yg baru
        if ($request->hasFile('foto')){
            Storage::delete($pasien->foto);
            $pasien->foto = $request->file('foto')->store('public');
        }
        $pasien->save(); //menyimpan data ke database
        flash('Data sudah di update')->success();
        return redirect('/pasien');
        // return back()->with('pesan', 'Horee.. Data sudah di simpan'); //tanpa laracasts/flash
            //mengarahkan user ke url sebelumya yaitu /pasien/create dgn membawa variabel pesan
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $pasien = \App\Models\Pasien::findOrFail($id);
        if ($pasien->foto != null && Storage::exists($pasien->foto)) {
            Storage::delete($pasien->foto);
        }
        $pasien->delete();
        flash('Data sudah di hapus')->success();
        return back();
    }
}
