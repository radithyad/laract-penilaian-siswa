@extends('main.layout')
@section('content')
    <center>
        <br>
            <h2>EDIT DATA GURU</h2>
            <form method="POST" action="/guru/update/{{ $guru->id }}">
                @csrf
                <table width="50%">
                    <tr>
                        <td width ="25%">NIP</td>
                        <td width ="25%"><input type="text" name="nip" value="{{ $guru->nip }}"></td>
                    </tr>
                    <tr>
                        <td width ="25%">NAMA GURU</td>
                        <td width ="25%"><input type="text" name="nama_guru" value="{{ $guru->nama_guru }}"></td>
                    </tr>
                    <tr>
                        <td width ="25%">JENIS KELAMIN</td>
                        <td width ="25%">
                            <input type="radio" name="jk" value="L" {{ $guru->jk == 'L' ? 'checked' : '' }}>Laki-Laki
                            <input type="radio" name="jk" value="P" {{ $guru->jk == 'P' ? 'checked' : '' }}>Perempuan
                        </td>
                    </tr>
                    <tr>
                        <td width ="25%">ALAMAT</td>
                        <td width ="25%"><textarea name="alamat" cols="30" rows="5" value="{{ $guru->alamat }}"></textarea></td>
                    </tr>
                    <tr>
                        <td width ="25%">PASSWORD</td>
                        <td width ="25%"><input type="text" name="nama_guru" value="{{ $guru->password }}"></td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <center><button class="button-primary" type="submit">UBAH</button></center>
                        </td>
                    </tr>
                </table>
            </form>
    </center>
@endsection