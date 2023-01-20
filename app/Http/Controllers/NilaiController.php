<?php

namespace App\Http\Controllers;
use App\Models\Mengajar;
use App\Models\Siswa;
use App\Models\Nilai;
use Illuminate\Http\Request;

class NilaiController extends Controller
{
    public function index()
    {
        if (session('user')->role == 'guru'){
            $nilai = Nilai::whereHas('mengajar', function ($query) {
                $query->where('guru_id', session('user')->id);
            })->get();
        } else {
            $nilai = Nilai::where('siswa_id', session('user')->id)->get();
        }
        return view('nilai.index', ['nilai' => $nilai]);
    }

    public function create()
    {
        $mengajar = Mengajar::where('guru_id', session('user')->id);
        return view('nilai.create', [
            'mengajar' => Mengajar::all(),
            'siswa' => Siswa::all()
        ]);
    }

    public function store(Request $request)
    {
        $data_nilai = $request->validate([
            'mengajar_id' => 'required',
            'siswa_id' => 'required',
            'uh' => 'required|numeric',
            'uts' => 'required|numeric',
            'uas' => 'required|numeric'
        ]);

        $data_nilai['na'] = round(($request->uh + $request->uts + $request->uas) /3);
        Nilai::create($data_nilai);
        return redirect('/nilai/index')->with('success', 'Data Nilai Berhasil Ditambah');
    }

    public function show($id)
    {
        //
    }

    public function edit(Nilai $nilai)
    {
        $mengajar = Mengajar::where('guru_id', session('user')->id);
        return view('nilai.edit', [
            'nilai' => $nilai,
            'mengajar' => $mengajar->get(),
            'siswa' => Siswa::whereIn('kelas_id', $mengajar->get('kelas_id'))->get()
        ]);
    }

    public function update(Request $request, Nilai $nilai)
    {
        $data_nilai = $request -> validate([
            'mengajar_id' => 'required',
            'siswa_id' => 'required',
            'uh' => 'required|numeric',
            'uts' => 'required|numeric',
            'uas' => 'required|numeric',
        ]);

        $data_nilai['na'] = round(($request->uh + $request->uts + $request->uas) / 3);
        $nilai->update($data_nilai);
        return redirect('/nilai/index')->with('success', 'Data Nilai Berhasil Diupdate');
    }

    public function destroy(Nilai $nilai)
    {
        $nilai->delete();
        return back()->with('success', 'Data Nilai Berhasil Dihapus');
    }
}
