<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'App Pegawai')</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
    <header>
        <div class="header-container">
            <div class="logo">🏢 App Pegawai</div>
            <nav>
                <ul>
                    <li><a href="{{ url('/employees') }}" class="{{ Request::is('employees*') ? 'active' : '' }}">Pegawai</a></li>
                    <li><a href="{{ url('/departments') }}" class="{{ Request::is('departments*') ? 'active' : '' }}">Departemen</a></li>
                    <li><a href="{{ url('/positions') }}" class="{{ Request::is('positions*') ? 'active' : '' }}">Jabatan</a></li>
                    <li><a href="{{ url('/attendances') }}" class="{{ Request::is('attendances*') ? 'active' : '' }}">Absensi</a></li>
                </ul>
            </nav>
        </div>
    </header>
    
    <main>
        @yield('content')
    </main>
    
    <footer>
        <p>&copy; {{ date('Y') }} App Pegawai - Sistem Manajemen Kepegawaian</p>
    </footer>
</body>
</html>