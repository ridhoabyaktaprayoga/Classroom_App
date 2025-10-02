<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                <div class="flex justify-between items-center mb-6">
                    <h1 class="text-2xl font-bold">Daftar Kelas Saya</h1>
                    <a href="{{ route('guru.kelas.create') }}" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        Buat Kelas Baru
                    </a>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @forelse($kelasList as $kelas)
                        <div class="bg-white border border-gray-200 rounded-lg shadow overflow-hidden">
                            <div class="p-6">
                                <h2 class="text-lg font-medium text-gray-900">{{ $kelas->nama_kelas }}</h2>
                                <p class="mt-2 text-sm text-gray-500">Kode: {{ $kelas->kode_kelas }}</p>
                                <p class="mt-2 text-sm text-gray-600">{{ Str::limit($kelas->deskripsi, 100) }}</p>
                                
                                <div class="mt-4 flex space-x-3">
                                    <a href="{{ route('guru.kelas.show', $kelas->id) }}" class="text-indigo-600 hover:text-indigo-900">
                                        Detail
                                    </a>
                                    
                                    <span class="text-gray-300">|</span>
                                    
                                    <button 
                                        wire:click="deleteKelas({{ $kelas->id }})"
                                        wire:confirm="Apakah Anda yakin ingin menghapus kelas ini?"
                                        class="text-red-600 hover:text-red-900"
                                    >
                                        Hapus
                                    </button>
                                </div>
                                
                                <div class="mt-4 pt-4 border-t border-gray-200">
                                    <div class="flex justify-between text-sm text-gray-500">
                                        <span>Siswa: {{ $kelas->siswa->count() }}</span>
                                        <span>Materi: {{ $kelas->materi->count() }}</span>
                                        <span>Tugas: {{ $kelas->tugas->count() }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-span-3 text-center py-12">
                            <p class="text-gray-500">Belum ada kelas yang dibuat. <a href="{{ route('guru.kelas.create') }}" class="text-indigo-600 hover:text-indigo-500">Buat kelas pertama Anda</a>.</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>
