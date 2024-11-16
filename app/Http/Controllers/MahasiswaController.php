<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mahasiswa;

class MahasiswaController extends Controller
{
    //halaman data mahasiswa
    public function index(Request $request)
    {
        // Simpan input pencarian agar tetap muncul di form setelah submit
        $request->flash();

        // Mulai query Mahasiswa
        $mahasiswa = Mahasiswa::query();

        // Cek apakah keyword ada dan filter data jika ada
        if (isset($request->keyword)) {
            $mahasiswa = $mahasiswa->where('nama', 'LIKE', "%{$request->keyword}%")
                ->orWhere('npm', 'LIKE', "%{$request->keyword}%")
                ->orWhere('jurusan', 'LIKE', "%{$request->keyword}%");
        }

        // Ambil data mahasiswa
        $mahasiswa = $mahasiswa->get();

        // Return ke view
        return view('admin.mahasiswa.index', compact('mahasiswa'));
    }

    //halaman tambah data mahasiswa
    public function create()
    {
        return view('admin.mahasiswa.create');
    }

    //halaman simpan data mahasiswa
    public function store(request $request)
    {
        $input = $request->all();
        // proses upload
        if ($request->foto) {
            $input['foto'] = $request->foto->getClientOriginalName();
            $request->file('foto')->move('storage/mahasiswa', $input['foto']);
        }
        // proses simpan data
        Mahasiswa::create($input);
        return redirect()->route('mahasiswa.index');
    }

    //halaman edit data mahasiswa
    public function edit($id)
    {
        $mahasiswa  = Mahasiswa::findOrFail($id);
        return view('admin.mahasiswa.edit', compact('mahasiswa'));
    }

    //halaman update data mahasiswa
    public function update(request $request, $id)
    {
        $mahasiswa  = Mahasiswa::findOrFail($id);
        $input      =  $request->all();
        //proses upload file

        if ($request->foto) {
            $input['foto'] = $request->foto->getClientOriginalName();
            $request->file('foto')->move('storage/mahasiswa', $input['foto']);
        }

        //proses update data
        $mahasiswa->update($input);

        return redirect()->route('mahasiswa.index');
    }

    //halaman hapus data mahasiswa
    public function delete($id)
    {
        $mahasiswa  = Mahasiswa::find($id);
        $mahasiswa->delete();
        return redirect()->route('mahasiswa.index');
    }

    //print
    public function print()
    {
        $mahasiswa = Mahasiswa::all();
        return view('admin.mahasiswa.print', compact('mahasiswa'));
    }
}
