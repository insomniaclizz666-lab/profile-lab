<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Wargalab SI - Universitas Trunojoyo Madura</title>
    <!-- Tailwind CSS: CDN Play (aktifkan custom colors) + compiled output -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#1E3A8A',        // Navy Blue (#1E3A8A) - Utama: header, navbar, judul
                        primaryLight: '#EFF6FF',   // Biru muda lembut
                        accent: '#F59E0B',         // Golden Yellow (#F59E0B) - Aksen CTA
                        accentHover: '#D97706',    // Amber (#D97706) - Aksen Hover/Tautan
                        dark: '#1E3A8A',           // Navy Blue untuk judul
                        lightbg: '#F3F4F6',        // Light Gray (#F3F4F6) - Background teks
                    },
                    fontFamily: {
                        sans: ['Segoe UI', 'Tahoma', 'Geneva', 'Verdana', 'sans-serif'],
                    },
                }
            }
        }
    </script>
    <style>
        /* Custom scrollbar & badge animations */
        ::-webkit-scrollbar {
            width: 8px;
        }
        ::-webkit-scrollbar-track {
            background: #F3F4F6;
        }
        ::-webkit-scrollbar-thumb {
            background: #CBD5E1;
            border-radius: 4px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: #1E3A8A;
        }
    </style>
    @stack('styles')
</head>
<body class="font-sans text-slate-800 leading-[1.6] bg-white antialiased selection:bg-amber-100 selection:text-amber-800">
    @include('components.navbar')

    @yield('content')

    @include('components.footer')

    @include('components.modals-scripts')
    @stack('scripts')
</body>
</html>
