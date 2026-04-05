<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Lapcare - Sistem Pengaduan Sekolah')</title>

    <!-- Google Fonts - Poppins -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Custom CSS -->
    <style>
        :root {
            --primary-blue: #0000FF;
            --light-blue: #f0f8ff;
            --accent-blue: #4dabf7;
            --dark-blue: #1971c2;
            --light-yellow: #fff9e6;
            --accent-yellow: #ffd43b;
            --dark-yellow: #e67700;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: #ffffff;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
    </style>

    @stack('styles')  <!-- Landing.blade.php bakal push CSS ke sini -->
</head>
<body>
    @yield('body')  <!-- Landing.blade.php bakal isi konten di sini -->

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    @stack('scripts')  <!-- Landing.blade.php bakal push JS ke sini -->
</body>
</html>