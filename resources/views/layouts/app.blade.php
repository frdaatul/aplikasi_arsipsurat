<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Arsip Surat</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --bg: #f6f8fb;
            --line: #cfd8e3;
            --ink: #111827;
        }

        * {
            box-sizing: border-box
        }

        body {
            margin: 0;
            font-family: Inter, system-ui, -apple-system, Segoe UI, Roboto, Arial
        }

        .wrap {
            display: flex;
            min-height: 100vh
        }

        aside {
            width: 240px;
            background: #fff;
            border-right: 2px solid var(--line);
            padding: 24px
        }

        main {
            flex: 1;
            padding: 28px;
            background: var(--bg)
        }

        h1 {
            margin: 0 0 12px;
            font-size: 32px
        }

        .menu a {
            display: flex;
            gap: 8px;
            align-items: center;
            padding: 8px 10px;
            border-radius: 8px;
            text-decoration: none;
            color: var(--ink)
        }

        .menu a.active,
        .menu a:hover {
            background: #eef2ff
        }

        .card {
            background: #fff;
            border: 2px solid var(--line);
            border-radius: 12px;
            padding: 16px
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background: #fff;
            border: 2px solid var(--line);
            border-radius: 12px;
            overflow: hidden
        }

        th,
        td {
            border-bottom: 1px solid var(--line);
            padding: 10px 12px;
            text-align: left
        }

        th {
            background: #f1f5f9
        }

        .actions a,
        .actions button {
            border: none;
            border-radius: 8px;
            padding: 8px 10px;
            cursor: pointer;
            text-decoration: none;
            color: #fff;
            font-weight: 600
        }

        .btn-blue {
            background: #2563eb
        }

        .btn-red {
            background: #ef4444
        }

        .btn-yellow {
            background: #d97706
        }

        .btn {
            background: #111827;
            color: #fff;
            border: none;
            padding: 10px 14px;
            border-radius: 10px;
            cursor: pointer
        }

        .toolbar {
            display: flex;
            gap: 10px;
            align-items: center;
            margin: 14px 0
        }

        input[type=search] {
            width: 420px;
            max-width: 60vw;
            padding: 10px 12px;
            border: 2px solid var(--line);
            border-radius: 999px
        }

        .alert {
            padding: 12px 14px;
            border-radius: 10px;
            margin-bottom: 12px
        }

        .alert-success {
            background: #ecfdf5;
            border: 2px solid #10b981
        }

        dialog {
            border: none;
            border-radius: 16px;
            padding: 0;
            box-shadow: 0 20px 40px rgba(0, 0, 0, .25);
            width: 520px;
            max-width: 90vw
        }

        dialog .dlg {
            padding: 20px
        }

        dialog .footer {
            display: flex;
            gap: 12px;
            justify-content: flex-end;
            padding: 16px;
            border-top: 1px solid #e5e7eb
        }
    </style>
    @stack('head')
</head>

<body>
    <div class="wrap">
        <aside>
            <div style="font-weight:700;font-size:18px;margin-bottom:10px">Menu</div>
            <div style="color:#9ca3af;margin-bottom:10px">----------</div>
            <nav class="menu">
                <a href="{{ route('archives.index') }}" class="{{ request()->routeIs('archives.*') ? 'active' : '' }}">★
                    Arsip</a>
                <a href="{{ route('categories.index') }}" class="{{ request()->routeIs('categories.*') ? 'active' : '' }}">⚙
                    Kategori Surat</a>
                <a href="{{ route('about') }}" class="{{ request()->routeIs('about') ? 'active' : '' }}">ℹ About</a>
            </nav>
        </aside>
        <main>
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            @yield('content')
        </main>
    </div>

    @stack('scripts')
</body>

</html>