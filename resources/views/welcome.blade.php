<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manufacture.Sys</title>
    <!-- Alpine.js CDN (letakkan di head atau sebelum closing </body>) -->
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-50 text-gray-800 font-sans antialiased">

    <!-- Navbar -->
    <nav class="bg-blue-600 shadow-lg">
        <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
            <div class="flex items-center space-x-3">
                <span class="bg-white text-blue-600 rounded-full w-10 h-10 flex items-center justify-center font-bold text-lg">
                    M
                </span>
                <span class="text-white font-bold text-2xl">Manufacture.Sys</span>
            </div>
            <div class="space-x-6">


            <!-- Login dropdown (Alpine) -->
            <div x-data="{ open: false }" class="relative inline-block text-left">
                <!-- Trigger -->
                <button @click="open = !open" type="button"
                    class="text-white px-3 py-2 rounded-md hover:text-gray-200 focus:outline-none focus:ring-2 focus:ring-white">
                    Login
                    <svg class="inline-block ml-1 -mr-1 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                    </svg>
                </button>

                <!-- Dropdown -->
                <div x-show="open" x-transition @click.away="open = false"
                    class="origin-top-right absolute right-0 mt-2 w-40 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 z-50">
                    <div class="py-1">
                        <!-- Option: Login as Staff -->
                        <a href="{{ route('staff.login') }}"
                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                        Login as Staff
                        </a>

                        <!-- Option: Login as Admin -->
                        <a href="{{ route('admin.login') }}"
                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                        Login as Admin
                        </a>
                    </div>
                </div>
            </div>

             <div x-data="{ open: false }" class="relative inline-block text-left">
                <!-- Trigger -->
                <button @click="open = !open" type="button"
                    class="bg-white text-blue-600 px-4 py-2 rounded-lg shadow hover:bg-gray-100">
                    Register
                    <svg class="inline-block ml-1 -mr-1 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                    </svg>
                </button>

                <!-- Dropdown -->
                <div x-show="open" x-transition @click.away="open = false"
                    class="origin-top-right absolute right-0 mt-2 w-40 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 z-50">
                    <div class="py-1">
                        <!-- Option: Login as Staff -->
                        <a href="{{ route('staff.register') }}"
                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                        Register as a Staff
                        </a>

                        <!-- Option: Login as Admin -->
                        <a href="{{ route('admin.register') }}"
                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                        Register as a Admin
                        </a>
                    </div>
                </div>
            </div>

                {{-- <a href="{{ route('register') }}" class="bg-white text-blue-600 px-4 py-2 rounded-lg shadow hover:bg-gray-100">
                    Register
                </a> --}}
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <header class="bg-gradient-to-r from-blue-600 to-blue-400 text-white">
        <div class="max-w-7xl mx-auto px-6 py-20 text-center">
            <h1 class="text-4xl md:text-6xl font-extrabold">Sistem Manufaktur Modern</h1>
            <p class="mt-6 text-lg md:text-xl text-blue-100 max-w-3xl mx-auto">
                Kelola produksi, stok material, hingga laporan dengan mudah dan efisien menggunakan <span class="font-semibold">Manufacture.Sys</span>.
            </p>
            <div class="mt-8 space-x-4">
                <a href="{{ route('login') }}" class="bg-white text-blue-600 px-6 py-3 rounded-lg font-bold shadow hover:bg-gray-100">
                    Mulai Sekarang
                </a>
                <a href="#features" class="border border-white px-6 py-3 rounded-lg font-bold hover:bg-white hover:text-blue-600">
                    Lihat Fitur
                </a>
            </div>
        </div>
    </header>

    <!-- Features Section -->
    <section id="features" class="max-w-7xl mx-auto px-6 py-20">
        <h2 class="text-3xl font-bold text-center text-gray-800">Workflow Manufacture.Sys</h2>
        <p class="text-center text-gray-600 mt-3 mb-12">Alur kerja sistem manufaktur yang terintegrasi</p>
        
        <div class="grid md:grid-cols-3 gap-10">
            <div class="bg-white p-6 rounded-2xl shadow hover:shadow-lg transition">
                <h3 class="text-xl font-semibold text-blue-600">📦 Manajemen Stok</h3>
                <p class="mt-3 text-gray-600">Pantau material masuk dan keluar secara real-time, hindari kekurangan atau penumpukan bahan.</p>
            </div>
            <div class="bg-white p-6 rounded-2xl shadow hover:shadow-lg transition">
                <h3 class="text-xl font-semibold text-blue-600">🏭 Produksi</h3>
                <p class="mt-3 text-gray-600">Catat hasil produksi, jumlah barang reject, dan perhitungan otomatis material yang digunakan.</p>
            </div>
            <div class="bg-white p-6 rounded-2xl shadow hover:shadow-lg transition">
                <h3 class="text-xl font-semibold text-blue-600">📊 Laporan</h3>
                <p class="mt-3 text-gray-600">Dapatkan laporan detail terkait stok, penggunaan material, dan produktivitas karyawan.</p>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="bg-blue-600 text-white py-16 text-center">
        <h2 class="text-3xl font-bold">Siap Tingkatkan Efisiensi Produksi?</h2>
        <p class="mt-4 text-blue-100">Gunakan <span class="font-semibold">Manufacture.Sys</span> untuk membantu proses manufaktur Anda menjadi lebih cepat, mudah, dan transparan.</p>
        <a href="{{ route('register') }}" class="mt-8 inline-block bg-white text-blue-600 px-6 py-3 rounded-lg font-bold shadow hover:bg-gray-100">
            Daftar Sekarang
        </a>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-900 text-gray-400 text-center py-6 mt-10">
        <p>&copy; {{ date('Y') }} Manufacture.Sys. All rights reserved.</p>
    </footer>

</body>
</html>
