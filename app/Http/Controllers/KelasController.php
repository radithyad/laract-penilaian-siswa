<?php

namespace App\Http\Controllers;
use App\Models\Kelas;
use App\Models\Jurusan;
use App\Models\Mengajar;
use App\Models\Siswa;
use Illuminate\Http\Request;

class KelasController extends Controller
{

    public function index()
    {
        return view('kelas.index', [
            'kelas' => Kelas::all()
        ]);
    }

    public function create()
    {
        return view('kelas.create', [
            'jurusan' => Jurusan::all()
        ]);
    }

    public function store(Request $request)
    {
        $data_kelas = $request->validate([
            'nama_kelas' => 'required',
            'jurusan_id' => 'required'
        ]);
        Kelas::create($data_kelas);
        return redirect('/kelas/index')->with('success', 'Data Kelas Berhasil Ditambah');
    }

    public function show($id)
    {
        //
    }

    public function edit(Kelas $kelas)
    {
        return view('kelas.edit', [
            'kelas' => $kelas,
            'jurusan' => Jurusan::all()
        ]);
    }

    public function update(Request $request, Kelas $kelas)
    {
        $data_kelas = $request->validate([
            'nama_kelas' => 'required',
            'jurusan_id' => 'required'
        ]); 
        $kelas->update($data_kelas);
        return redirect('/kelas/index')->with('success', 'Data Kelas Berhasil Diupdate');
    }

    public function destroy(Kelas $kelas)
    {
        $siswa = Siswa::where('kelas_id', $kelas->id)->first();
        $mengajar = Mengajar::where('kelas_id', $kelas->id)->first();

        if($siswa) {
            return back()->with('error', "$kelas->nama_kelas masih digunakan di menu siswa");
        }

        if($mengajar) {
            return back()->with('error', "$kelas->nama_kelas masih digunakan di menu mengajar");
        }

        $kelas->delete();
        return back()->with('success', 'Data Kelas Berhasil Dihapus');
    }
}
