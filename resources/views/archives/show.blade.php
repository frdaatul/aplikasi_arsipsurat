@extends('layouts.app')

@section('content')
    <h1>Arsip Surat >> Lihat</h1>
    <div style="margin-bottom:12px">
        <div>Nomor: <b>{{ $archive->number }}</b></div>
        <div>Kategori: <b>{{ $archive->category->name }}</b></div>
        <div>Judul: <b>{{ $archive->title }}</b></div>
        <div>Waktu Unggah: <b>{{ optional($archive->archived_at)->format('Y-m-d H:i') }}</b></div>
    </div>

    <div class="card" style="height:70vh; overflow:hidden">
        <iframe src="{{ asset('storage/' . $archive->file_path) }}" title="PDF"
            style="width:100%;height:100%;border:none"></iframe>
    </div>

    <div style="margin-top:12px; display:flex; gap:8px">
        <a class="btn" href="{{ route('archives.index') }}">&lt;&lt; Kembali</a>
        <a class="btn" href="{{ route('archives.download', $archive) }}">Unduh</a>
        <a class="btn" href="{{ route('archives.edit', $archive) }}">Edit/Ganti File</a>
    </div>
@endsection