<?php

namespace App\Http\Controllers;
use App\Models\Guru;
use App\Models\Kelas;
use App\Models\Mapel;
use App\Models\Mengajar;
use Illuminate\Http\Request;

class MengajarController extends Controller
{
    public function index()
    {
        return view('mengajar.index', [
            'mengajar' => Mengajar::all()
        ]);
    }

    public function create()
    {
        return view('mengajar.create', [
            'guru' => Guru::all(),
            'kelas' => Kelas::all(),
            'mapel' => Mapel::all()
        ]);
    }

    public function store(Request $request)
    {
        $data_mengajar = $request->validate([
            'guru_id' => 'required',
            'kelas_id' => 'required',
            'mapel_id' => 'required'
        ]);
        Mengajar::create($data_mengajar);
        return redirect('/mengajar/index')->with('success', 'Data Mengajar Berhasil Ditambah');
    }

    public function show($id)
    {
        //
    }

    public function edit(Mengajar $mengajar)
    {
        return view('mengajar.edit', [
            'mengajar' => $mengajar,
            'guru' => Guru::all(),
            'kelas' => Kelas::all(),
            'mapel' => Mapel::all()
        ]);
    }

    public function update(Request $request, Mengajar $mengajar)
    {
        $data_mengajar = $request->validate([
            'guru_id' => 'required',
            'kelas_id' => 'required',
            'mapel_id' => 'required'
        ]); 
        $mengajar->update($data_mengajar);
        return redirect('/mengajar/index')->with('success', 'Data Mengajar Berhasil Diupdate');
    }

    public function destroy(Mengajar $mengajar)
    {
        $mengajar->delete();
        return back()->with('success', "Data Mengajar Berhasil Dihapus");
    }
}
