@extends('layouts.app')

@section('content')
    <h1>Arsip Surat >> {{ $mode === 'create' ? 'Unggah' : 'Ubah' }}</h1>
    <p>Unggah surat yang telah terbit pada form ini untuk diarsipkan.
        <br>Catatan: Gunakan file berformat PDF.
    </p>

    <div class="card">
        <form method="post" enctype="multipart/form-data"
            action="{{ $mode === 'create' ? route('archives.store') : route('archives.update', $archive) }}">
            @csrf
            @if($mode === 'edit') @method('PUT') @endif

            <div style="margin-bottom:10px">
                <label>Nomor Surat</label><br>
                <input type="text" name="number" value="{{ old('number', $archive->number) }}"
                    style="width:360px;padding:8px;border:2px solid #cfd8e3;border-radius:8px">
                @error('number') <div style="color:#ef4444">{{ $message }}</div> @enderror
            </div>

            <div style="margin-bottom:10px">
                <label>Kategori</label><br>
                <select name="category_id" style="width:360px;padding:8px;border:2px solid #cfd8e3;border-radius:8px">
                    <option value="">-- Pilih --</option>
                    @foreach($categories as $id => $name)
                        <option value="{{ $id }}" @selected(old('category_id', $archive->category_id) == $id)>{{ $name }}</option>
                    @endforeach
                </select>
                @error('category_id') <div style="color:#ef4444">{{ $message }}</div> @enderror
            </div>

            <div style="margin-bottom:10px">
                <label>Judul</label><br>
                <input type="text" name="title" value="{{ old('title', $archive->title) }}"
                    style="width:720px;padding:8px;border:2px solid #cfd8e3;border-radius:8px">
                @error('title') <div style="color:#ef4444">{{ $message }}</div> @enderror
            </div>

            <div style="margin-bottom:16px">
                <label>File Surat (PDF)</label><br>
                <input type="file" name="file" accept="application/pdf">
                @if($mode === 'edit' && $archive->file_path)
                    <div style="font-size:12px;color:#6b7280">Kosongkan jika tidak ingin mengganti file.</div>
                @endif
                @error('file') <div style="color:#ef4444">{{ $message }}</div> @enderror
            </div>

            <a class="btn" href="{{ route('archives.index') }}">&lt;&lt; Kembali</a>
            <button class="btn" type="submit">Simpan</button>
        </form>
    </div>
@endsection