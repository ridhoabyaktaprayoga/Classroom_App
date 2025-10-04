
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                <h1 class="text-2xl font-bold">Dashboard Guru</h1>
                <p>Selamat datang di dashboard guru, {{ Auth::user()->name }}!</p>

                <div class="mt-6 grid grid-cols-1 md:grid-cols-3 gap-6">
                    <!-- Statistik cards -->
                    <div class="bg-blue-50 p-6 rounded-lg shadow">
                        <h3 class="text-lg font-medium text-blue-800">Total Kelas</h3>
                        <p class="text-3xl font-bold mt-2">{{ $totalKelas }}</p>
                    </div>

                    <div class="bg-green-50 p-6 rounded-lg shadow">
                        <h3 class="text-lg font-medium text-green-800">Total Siswa</h3>
                        <p class="text-3xl font-bold mt-2">{{ $totalSiswa }}</p>
                    </div>

                    <div class="bg-yellow-50 p-6 rounded-lg shadow">
                        <h3 class="text-lg font-medium text-yellow-800">Tugas Belum Dinilai</h3>
                        <p class="text-3xl font-bold mt-2">0</p>
                    </div>
                </div>

                <!-- Announcements Section -->
                <div class="mt-8">
                    <h2 class="text-xl font-semibold mb-4">Pengumuman</h2>
                    @if($announcements->count() > 0)
                        @foreach($announcements as $announcement)
                            <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4 mb-4">
                                <div class="flex">
                                    <div class="flex-shrink-0">
                                        <svg class="h-5 w-5 text-yellow-400" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                    <div class="ml-3">
                                        <h3 class="text-sm font-medium text-yellow-800">{{ $announcement->title }}</h3>
                                        <div class="mt-2 text-sm text-yellow-700">
                                            <p>{{ $announcement->content }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <p class="text-gray-500">Tidak ada pengumuman saat ini.</p>
                    @endif
                </div>

                <div class="mt-8 space-x-4">
                    <a href="{{ route('guru.kelas.index') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 active:bg-blue-900 focus:outline-none focus:border-blue-900 focus:ring ring-blue-300 disabled:opacity-25 transition ease-in-out duration-150">
                        Daftar Kelas Saya
                    </a>
                    <a href="{{ route('guru.kelas.create') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:border-indigo-900 focus:ring ring-indigo-300 disabled:opacity-25 transition ease-in-out duration-150">
                        Buat Kelas Baru
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
