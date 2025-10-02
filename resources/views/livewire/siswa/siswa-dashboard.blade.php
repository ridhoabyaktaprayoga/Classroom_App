<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                <h1 class="text-2xl font-bold">Dashboard Siswa</h1>
                <p>Selamat datang di dashboard siswa, {{ Auth::user()->name }}!</p>

                <div class="mt-6 grid grid-cols-1 md:grid-cols-3 gap-6">
                    <!-- Statistik cards -->
                    <div class="bg-blue-50 p-6 rounded-lg shadow">
                        <h3 class="text-lg font-medium text-blue-800">Kelas Diikuti</h3>
                        <p class="text-3xl font-bold mt-2">{{ $kelasSiswa }}</p>
                    </div>

                    <div class="bg-green-50 p-6 rounded-lg shadow">
                        <h3 class="text-lg font-medium text-green-800">Tugas Pending</h3>
                        <p class="text-3xl font-bold mt-2">0</p>
                    </div>

                    <div class="bg-yellow-50 p-6 rounded-lg shadow">
                        <p class="text-lg font-medium text-yellow-800">Tugas Selesai</p>
                        <p class="text-3xl font-bold mt-2">0</p>
                    </div>
                </div>

                <div class="mt-8 space-x-4">
                    <a href="{{ route('siswa.kelas.index') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 active:bg-blue-900 focus:outline-none focus:border-blue-900 focus:ring ring-blue-300 disabled:opacity-25 transition ease-in-out duration-150">
                        Daftar Kelas Saya
                    </a>
                    <a href="{{ route('siswa.kelas.join') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:border-indigo-900 focus:ring ring-indigo-300 disabled:opacity-25 transition ease-in-out duration-150">
                        Bergabung ke Kelas
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

