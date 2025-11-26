@extends('admin.template')

@section('content')
<h3>Daftar Pengajuan Toko</h3>

@if($tokoMenunggu > 0)
<div class="alert alert-warning">
    Ada <b>{{ $tokoMenunggu }}</b> toko yang menunggu persetujuan!
</div>
@endif

@if(session('success'))
<div class="alert alert-success">{{ session('success') }}</div>
@endif

@if(session('error'))
<div class="alert alert-danger">{{ session('error') }}</div>
@endif

<table class="table table-bordered">
    <thead>
        <tr>
            <th>Nama Toko</th>
            <th>Pemilik</th>
            <th>Alamat</th>
            <th>Kontak</th>
            <th>Aksi</th>
        </tr>
    </thead>

    <tbody>
        @foreach($toko as $t)
        <tr>
            <td>{{ $t->nama }}</td>
            <td>{{ $t->user->name }}</td>
            <td>{{ $t->alamat }}</td>
            <td>{{ $t->kontak }}</td>
            <td>
                <form method="POST" action="{{ route('admin.toko.setujui', $t->id) }}" style="display:inline-block;">
                    @csrf
                    <button class="btn btn-success btn-sm">Setujui</button>
                </form>

                <form method="POST" action="{{ route('admin.toko.tolak', $t->id) }}" style="display:inline-block;">
                    @csrf
                    <button class="btn btn-danger btn-sm">Tolak</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
