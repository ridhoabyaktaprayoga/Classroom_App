
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h1 class="text-2xl font-bold">Dashboard Guru</h1>
                    <p>Selamat datang di dashboard guru, {{ Auth::user()->name }}!</p>

                    <div class="mt-6 grid grid-cols-1 md:grid-cols-3 gap-6">
                        <!-- Statistik cards will go here -->
                        <div class="bg-blue-50 p-6 rounded-lg shadow">
                            <h3 class="text-lg font-medium text-blue-800">Total Kelas</h3>
                            <p class="text-3xl font-bold mt-2">0</p>
                        </div>

                        <div class="bg-green-50 p-6 rounded-lg shadow">
                            <h3 class="text-lg font-medium text-green-800">Total Siswa</h3>
                            <p class="text-3xl font-bold mt-2">0</p>
                        </div>

                        <div class="bg-yellow-50 p-6 rounded-lg shadow">
                            <h3 class="text-lg font-medium text-yellow-800">Tugas Belum Dinilai</h3>
                            <p class="text-3xl font-bold mt-2">0</p>
                        </div>
                    </div>

                    <div class="mt-8">
                        <a href="{{ route('guru.kelas.create') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:border-indigo-900 focus:ring ring-indigo-300 disabled:opacity-25 transition ease-in-out duration-150">
                            Buat Kelas Baru
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

