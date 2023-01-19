<?php

namespace App\Http\Controllers;
use App\Models\Mapel;
use App\MOdels\Mengajar;
use Illuminate\Http\Request;

class MapelController extends Controller
{
    public function index()
    {
        return view('mapel.index', [
            'mapel' => Mapel::all()
        ]);
    }

    public function create()
    {
        return view('mapel.create');
    }

    public function store(Request $request)
    {
        $data_mapel = $request->validate([
            'nama_mapel' => 'required'
        ]);
        mapel::create($data_mapel);
        return redirect('/mapel/index')->with('success', 'Data Mata Pelajaran Berhasil Ditambah');
    }

    public function show($id)
    {
        //
    }

    public function edit(Mapel $mapel)
    {
        return view('mapel.edit', [
            'mapel' => $mapel
        ]);
    }

    public function update(Request $request, Mapel $mapel)
    {
        
        $data_mapel = $request->validate([
            'nama_mapel' => 'required'
        ]); 
        $mapel->update($data_mapel);
        return redirect('/mapel/index')->with('success', 'Data Mata Pelajaran Berhasil Diupdate');
    }

    public function destroy(Mapel $mapel)
    {
        $mengajar = Mengajar::where('mapel_id', $mapel->id)->first();

        if($mengajar) {
            return back()->with('error', "$mapel->nama_mapel masih digunakan di menu mengajar");
        }

        $mapel->delete();
        return redirect('/mapel/index')->with('success', 'Data mapel Berhasil Dihapus');
    }
}
