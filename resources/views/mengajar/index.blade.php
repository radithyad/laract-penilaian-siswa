@extends ('main.layout')
@section ('content')
    <center>
        <br>
            <h2>LIST DATA MENGAJAR</h2>
            <a href="/mengajar/create" class="button-primary">TAMBAH DATA</a>
            @if (session('success'))
                <p class="text-success">{{ session('success') }}</p>
            @endif
            @if (session('error'))
                <p class="text-danger">{{ session('error') }}</p>
            @endif
            <table cellPadding="10">
                <tr>
                    <th>NO</th>
                    <th>GURU</th>
                    <th>MATA PELAJARAN</th>
                    <th>KELAS</th>
                    <th>ACTION</th>
                </tr>
                @foreach ($mengajar as $meng)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $meng ->guru->nama_guru }}</td>
                        <td>{{ $meng ->mapel->nama_mapel }}</td>
                        <td>{{ $meng ->kelas->nama_kelas }}</td>
                        <td>
                            <a href="/mengajar/edit/{{ $meng -> id }}" class="button-warning">Edit</a>
                            <a href="/mengajar/destroy/{{ $meng -> id }}" class="button-danger" onclick="return confirm('Yakin ingin dihapus?')">Hapus</a>
                        </td>
                    </tr>
                @endforeach
            </table>
    </center>
@endsection