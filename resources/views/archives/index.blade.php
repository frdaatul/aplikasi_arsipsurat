@extends('layouts.app')

@section('content')
    <style>
        /* Container utama */
        .arsip-container {
            font-family: Arial, sans-serif;
            padding: 12px;
        }

        .arsip-container h1 {
            margin-bottom: 12px;
            font-size: 1.6rem;
        }

        /* Search bar */
        .search-form {
            margin: 16px 0;
            display: flex;
            gap: 8px;
            max-width: 500px;
        }

        .search-form input {
            flex: 1;
            padding: 6px 8px;
            border: 1px solid #000;
            border-radius: 4px;
        }

        .search-form button {
            padding: 6px 12px;
            border: 1px solid #000;
            background: #fff;
            cursor: pointer;
        }

        /* Table */
        .table-wrapper {
            overflow-x: auto; /* scroll horizontal kalau layar kecil */
        }

        table.arsip-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 16px;
            border: 2px solid #000; /* garis penutup atas & bawah tabel */
            font-size: 14px;
        }

        table.arsip-table th,
        table.arsip-table td {
            border: 1px solid #000;
            padding: 8px;
            white-space: nowrap; /* biar kolom nggak patah ke bawah */
        }

        table.arsip-table th {
            text-align: left;
            background: #f2f2f2; /* background abu-abu header */
        }

        /* Tombol aksi */
        .btn-action {
            display: inline-block;
            padding: 4px 10px;
            border-radius: 3px;
            text-decoration: none;
            font-size: 14px;
            text-align: center;
        }

        .btn-hapus {
            background: #e74c3c;
            color: white;
        }

        .btn-unduh {
            background: #f1c40f;
            color: black;
        }

        .btn-lihat {
            background: #3498db;
            color: white;
        }

        .btn-hapus:hover { background: #c0392b; }
        .btn-unduh:hover { background: #d4ac0d; }
        .btn-lihat:hover { background: #2e86c1; }

        /* Tombol Arsipkan Surat */
        .btn-arsipkan {
            display: inline-block;
            margin-top: 12px;
            padding: 6px 12px;
            border: 1px solid #000;
            background: #fff;
            text-decoration: none;
            border-radius: 3px;
        }

        /* --- RESPONSIVE --- */
        @media (max-width: 768px) {
            .search-form {
                flex-direction: column;
                max-width: 100%;
            }

            .search-form button {
                width: 100%;
            }

            table.arsip-table th,
            table.arsip-table td {
                font-size: 12px;
                padding: 6px;
            }

            td[style] {
                flex-wrap: wrap;
            }

            .btn-action {
                padding: 6px 8px;
                font-size: 12px;
            }
        }

        @media (max-width: 480px) {
            .arsip-container h1 {
                font-size: 1.3rem;
            }

            table.arsip-table {
                font-size: 11px;
            }

            .btn-action {
                display: block;
                width: 100%;
                margin-bottom: 4px;
            }

            td[style] {
                display: flex;
                flex-direction: column;
                gap: 4px !important;
            }
        }
    </style>

    <div class="arsip-container">
        <h1>Arsip Surat</h1>
        <p>Berikut ini adalah surat-surat yang telah terbit dan diarsipkan. Klik “Lihat” pada kolom aksi untuk menampilkan
        surat.</p>

        {{-- Search --}}
        <form action="{{ route('archives.index') }}" method="GET" class="search-form">
            <input type="text" name="q" placeholder="search" value="{{ request('q') }}">
            <button type="submit">Cari</button>
        </form>

        {{-- Table --}}
        <div class="table-wrapper">
            <table class="arsip-table">
                <thead>
                    <tr>
                        <th>Nomor Surat</th>
                        <th>Kategori</th>
                        <th>Judul</th>
                        <th>Waktu Pengarsipan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($archives as $archive)
                        <tr>
                            <td>{{ $archive->number }}</td>
                            <td>{{ $archive->category->name }}</td>
                            <td>{{ $archive->title }}</td>
                            <td>{{ optional($archive->archived_at)->format('Y-m-d H:i') }}</td>
                            <td style="display:flex; gap:6px;">
                                {{-- Hapus --}}
                                <form action="{{ route('archives.destroy', $archive) }}" method="POST" 
                                      onsubmit="return confirm('Yakin ingin hapus surat ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-action btn-hapus">Hapus</button>
                                </form>
                                {{-- Unduh --}}
                                <a href="{{ route('archives.download', $archive) }}" class="btn-action btn-unduh">Unduh</a>
                                {{-- Lihat --}}
                                <a href="{{ route('archives.show', $archive) }}" class="btn-action btn-lihat">Lihat &gt;&gt;</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" style="text-align:center; padding:12px;">Belum ada arsip surat</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Button Arsipkan Surat --}}
        <a href="{{ route('archives.create') }}" class="btn-arsipkan">Arsipkan Surat..</a>
    </div>
@endsection
