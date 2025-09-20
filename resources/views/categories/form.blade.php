@extends('layouts.app')

@section('content')
    <h1>Kategori Surat >> {{ $mode === 'create' ? 'Tambah' : 'Edit' }}</h1>
    <p>Tambahkan atau edit data kategori. Jika sudah selesai, jangan lupa untuk mengklik tombol “Simpan”.</p>

    <div class="card">
        <form method="post" action="{{ $mode === 'create' ? route('categories.store') : route('categories.update', $category) }}">
            @csrf @if($mode === 'edit') @method('PUT') @endif

            <div style="margin-bottom:10px">
                <label>ID (Auto Increment)</label><br>
                <input type="text" value="{{ $category->id ?: '—' }}" disabled
                    style="width:120px;padding:8px;border:2px solid #cfd8e3;border-radius:8px;background:#e5e7eb">
            </div>

            <div style="margin-bottom:10px">
                <label>Nama Kategori</label><br>
                <input type="text" name="name" value="{{ old('name', $category->name) }}"
                    style="width:420px;padding:8px;border:2px solid #cfd8e3;border-radius:8px">
                @error('name') <div style="color:#ef4444">{{ $message }}</div> @enderror
            </div>

            <div style="margin-bottom:10px">
                <label>Judul/Keterangan</label><br>
                <textarea name="description" rows="4"
                    style="width:720px;padding:8px;border:2px solid #cfd8e3;border-radius:8px">{{ old('description', $category->description) }}</textarea>
            </div>

            <a class="btn" href="{{ route('categories.index') }}">&lt;&lt; Kembali</a>
            <button class="btn" type="submit">Simpan</button>
        </form>
    </div>
@endsection