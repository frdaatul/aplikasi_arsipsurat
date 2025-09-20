@extends('layouts.app')

@section('content')
    <h1>About</h1>

    <div style="display:flex;gap:24px;align-items:flex-start">
        <div class="card" style="width:200px;height:200px;display:flex;align-items:center;justify-content:center">
            <img src="{{ asset('images/profile.jpg') }}" alt="Foto"
                style="max-width:100%;max-height:100%;object-fit:cover">
        </div>
        <div style="line-height:1.9">
            <div>Aplikasi ini dibuat oleh:</div>
            <div><b>Nama</b> : Faridatul Kasanah</div>
            <div><b>Prodi</b> : D3 - MI PSDKU Kediri</div>
            <div><b>NIM</b> : 2331730029</div>
            <div><b>Tanggal</b> : {{ now()->format('d F Y') }}</div>
        </div>
    </div>

@endsection