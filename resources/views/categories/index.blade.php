@extends('layouts.app')

@section('content')
    <style>
        /* Container */
        .kategori-container {
            font-family: Arial, sans-serif;
            padding: 12px;
        }

        .kategori-container h1 {
            margin-bottom: 8px;
            font-size: 1.6rem;
        }

        .kategori-container p {
            margin-bottom: 16px;
            color: #333;
        }

        /* Toolbar */
        .toolbar {
            margin: 16px 0;
            display: flex;
            gap: 8px;
            max-width: 700px;
        }

        .toolbar input[type="search"] {
            flex: 1;
            padding: 6px 8px;
            border: 1px solid #000;
            border-radius: 4px;
        }

        .toolbar button,
        .toolbar a {
            padding: 6px 12px;
            border: 1px solid #000;
            border-radius: 3px;
            text-decoration: none;
            background: #fff;
            cursor: pointer;
            font-size: 14px;
        }

        /* Table */
        .table-wrapper {
            overflow-x: auto;
        }

        table.kategori-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 16px;
            border: 2px solid #000; /* border atas dan bawah */
            font-size: 14px;
        }

        table.kategori-table th,
        table.kategori-table td {
            border: 1px solid #000;
            padding: 8px;
            white-space: nowrap;
        }

        table.kategori-table th {
            text-align: left;
            background: #f2f2f2;
        }

        /* Tombol aksi */
        .btn-red {
            background: #e74c3c;
            color: white;
            padding: 4px 10px;
            border-radius: 3px;
            text-decoration: none;
            border: none;
            cursor: pointer;
            font-size: 14px;
        }

        .btn-blue {
            background: #3498db;
            color: white;
            padding: 4px 10px;
            border-radius: 3px;
            text-decoration: none;
            cursor: pointer;
            font-size: 14px;
        }

        .btn-red:hover { background: #c0392b; }
        .btn-blue:hover { background: #2e86c1; }

        /* --- RESPONSIVE --- */
        @media (max-width: 768px) {
            .toolbar {
                flex-direction: column;
                max-width: 100%;
            }

            .toolbar button,
            .toolbar a {
                width: 100%;
                text-align: center;
            }

            table.kategori-table th,
            table.kategori-table td {
                font-size: 12px;
                padding: 6px;
            }
        }

        @media (max-width: 480px) {
            .kategori-container h1 {
                font-size: 1.3rem;
            }

            table.kategori-table {
                font-size: 11px;
            }

            td[style] {
                display: flex;
                flex-direction: column;
                gap: 4px !important;
            }

            .btn-red,
            .btn-blue {
                width: 100%;
                margin-bottom: 4px;
                font-size: 12px;
            }
        }
    </style>

    <div class="kategori-container">
        <h1>Kategori Surat</h1>
        <p>Berikut ini adalah kategori yang bisa digunakan untuk melabeli surat. 
           Klik “Tambah” pada kolom aksi untuk menambahkan kategori baru.</p>

        {{-- Toolbar --}}
        <form class="toolbar" method="get">
            <input type="search" name="q" value="{{ $q }}" placeholder="search">
            <button type="submit">Cari</button>
            <a href="{{ route('categories.create') }}" style="margin-left:auto">[ + ] Tambah Kategori Baru…</a>
        </form>

        {{-- Table --}}
        <div class="table-wrapper">
            <table class="kategori-table">
                <thead>
                    <tr>
                        <th>ID Kategori</th>
                        <th>Nama Kategori</th>
                        <th>Keterangan</th>
                        <th style="width:220px">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($categories as $c)
                        <tr>
                            <td>{{ $c->id }}</td>
                            <td>{{ $c->name }}</td>
                            <td>{{ $c->description }}</td>
                            <td style="display:flex; gap:6px;">
                                {{-- Hapus --}}
                                <form action="{{ route('categories.destroy', $c) }}" method="post" style="display:inline"
                                      onsubmit="return confirm('Hapus kategori ini?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn-red">Hapus</button>
                                </form>
                                {{-- Edit --}}
                                <a href="{{ route('categories.edit', $c) }}" class="btn-blue">Edit</a>
                            </td>
                        </tr>
                    @endforeach

                    @if(!$categories->count())
                        <tr>
                            <td colspan="4" style="text-align:center; padding:20px;">Tidak ada data.</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        <div style="margin-top:12px">{{ $categories->links() }}</div>
    </div>
@endsection
