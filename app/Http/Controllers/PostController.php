<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $mahasiswas = Mahasiswa::latest()->paginate(5);

        return view('mahasiswas.index', compact('mahasiswas'));
    }

    public function create()
    {
        return view('mahasiswas.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'nim' => 'required',
            'nama' => 'required',
            'alamat' => 'required',
            'nomorhp' => 'required',
            'motivasi' => 'required|min:5'
        ]);

        Mahasiswa::create([
            'nim' => $request->nim,
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'nomorhp' => $request->nomorhp,
            'motivasi' => $request->motivasi
        ]);

        return redirect()->route('mahasiswas.index')->with(['success' => 'Data Berhasil Disimpan!']);
    }

    public function show($id)
    {
        $mahasiswa = Mahasiswa::find($id);
        return view('mahasiswas.show', compact('mahasiswa'));
    }

    public function edit(Mahasiswa $mahasiswa)
    {
        return view('mahasiswas.edit', compact('mahasiswa'));
    }

    public function update(Request $request, Mahasiswa $mahasiswa)
    {
        $this->validate($request, [
            'nim' => 'required',
            'nama' => 'required',
            'alamat' => 'required',
            'nomorhp' => 'required',
            'motivasi' => 'required|min:5'
        ]);

        $mahasiswa->update([
            'nim' => $request->nim,
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'nomorhp' => $request->nomorhp,
            'motivasi' => $request->motivasi
        ]);

        return redirect()->route('mahasiswas.index')->with(['success' => 'Data Berhasil Diubah!']);
    }

    public function destroy(Mahasiswa $mahasiswa)
    {
        $mahasiswa->delete();

        return redirect()->route('mahasiswas.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }
}
