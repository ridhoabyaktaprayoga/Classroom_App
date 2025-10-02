<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                <div class="flex justify-between items-center mb-6">
                    <div>
                        <h1 class="text-2xl font-bold">{{ $kelas->nama_kelas }}</h1>
                        <p class="text-gray-600">Kode Kelas: {{ $kelas->kode_kelas }}</p>
                    </div>
                    <a href="{{ route('guru.kelas.index') }}" class="px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        Kembali
                    </a>
                </div>

                <div class="mb-6 p-4 bg-gray-50 rounded-lg">
                    <h2 class="text-lg font-medium text-gray-900">Deskripsi</h2>
                    <p class="mt-2 text-gray-600">{{ $kelas->deskripsi ?? 'Tidak ada deskripsi' }}</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                    <div class="bg-blue-50 p-4 rounded-lg">
                        <h3 class="font-medium text-blue-800">Jumlah Siswa</h3>
                        <p class="text-2xl font-bold">{{ $kelas->siswa->count() }}</p>
                    </div>
                    <div class="bg-green-50 p-4 rounded-lg">
                        <h3 class="font-medium text-green-800">Jumlah Materi</h3>
                        <p class="text-2xl font-bold">{{ $kelas->materi->count() }}</p>
                    </div>
                    <div class="bg-yellow-50 p-4 rounded-lg">
                        <h3 class="font-medium text-yellow-800">Jumlah Tugas</h3>
                        <p class="text-2xl font-bold">{{ $kelas->tugas->count() }}</p>
                    </div>
                </div>

                <!-- Tabs for Materi, Tugas, Siswa -->
                <div class="border-b border-gray-200">
                    <nav class="-mb-px flex space-x-8">
                        <button wire:click="setActiveTab('materi')"
                            class="{{ $activeTab === 'materi' ? 'border-indigo-500 text-indigo-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }} whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
                            Materi
                        </button>
                        <button wire:click="setActiveTab('tugas')"
                            class="{{ $activeTab === 'tugas' ? 'border-indigo-500 text-indigo-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }} whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
                            Tugas
                        </button>
                        <button wire:click="setActiveTab('siswa')"
                            class="{{ $activeTab === 'siswa' ? 'border-indigo-500 text-indigo-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }} whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
                            Siswa
                        </button>
                    </nav>
                </div>

                @if($activeTab === 'materi')
                <div class="mt-6">
                    <div class="flex justify-end mb-4">
                        <a href="{{ route('guru.materi.create', $kelas->id) }}" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Tambah Materi
                        </a>
                    </div>

                    <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 md:rounded-lg">
                        <table class="min-w-full divide-y divide-gray-300">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6">Judul</th>
                                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Deskripsi</th>
                                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Tanggal Upload</th>
                                    <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-6">
                                        <span class="sr-only">Aksi</span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 bg-white">
                                @forelse($kelas->materi as $materi)
                                    <tr>
                                        <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6">{{ $materi->judul }}</td>
                                        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ Str::limit($materi->deskripsi, 50) }}</td>
                                        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ $materi->created_at->format('d M Y') }}</td>
                                        <td class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-6">
                                            <a href="{{ route('materi.download', $materi->id) }}" class="text-indigo-600 hover:text-indigo-900">Download</a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6">Belum ada materi</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                @endif

                @if($activeTab === 'tugas')
                <div class="mt-6">
                    <div class="flex justify-end mb-4">
                        <a href="{{ route('guru.tugas.create', $kelas->id) }}" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Tambah Tugas
                        </a>
                    </div>

                    <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 md:rounded-lg">
                        <table class="min-w-full divide-y divide-gray-300">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6">Judul</th>
                                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Deskripsi</th>
                                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Deadline</th>
                                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 bg-white">
                                @forelse($tugas as $tugasItem)
                                    <tr>
                                        <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6">{{ $tugasItem->judul }}</td>
                                        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ Str::limit($tugasItem->deskripsi, 50) }}</td>
                                        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ $tugasItem->deadline ? $tugasItem->deadline->format('d M Y H:i') : 'Tidak ada' }}</td>
                                        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                            <div class="flex space-x-2">
                                                <a href="{{ route('guru.tugas.edit', ['kelasId' => $kelas->id, 'tugasId' => $tugasItem->id]) }}" class="text-blue-600 hover:text-blue-900">Edit</a>
                                                <button wire:click="deleteTugas({{ $tugasItem->id }})" onclick="return confirm('Yakin ingin menghapus tugas ini?')" class="text-red-600 hover:text-red-900">Hapus</button>
                                                <a href="{{ route('guru.tugas.pengumpulan', $tugasItem->id) }}" class="text-indigo-600 hover:text-indigo-900">Lihat Pengumpulan</a>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6">Belum ada tugas</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                @endif

                @if($activeTab === 'siswa')
                <div class="mt-6">
                    <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 md:rounded-lg">
                        <table class="min-w-full divide-y divide-gray-300">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6">Nama Siswa</th>
                                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Email</th>
                                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Tanggal Bergabung</th>
                                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 bg-white">
                                @forelse($siswa as $siswaItem)
                                    <tr>
                                        <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6">{{ $siswaItem->name }}</td>
                                        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ $siswaItem->email }}</td>
                                        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ $siswaItem->pivot?->joined_at ? $siswaItem->pivot->joined_at->format('d M Y') : 'N/A' }}</td>
                                        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                            <div class="flex space-x-2">
                                                <a href="{{ route('guru.siswa.nilai', ['kelasId' => $kelas->id, 'siswaId' => $siswaItem->id]) }}" class="text-indigo-600 hover:text-indigo-900">Lihat Nilai</a>
                                                <button wire:click="removeSiswa({{ $siswaItem->id }})" onclick="return confirm('Yakin ingin mengeluarkan siswa ini dari kelas?')" class="text-red-600 hover:text-red-900">Keluar</button>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6">Belum ada siswa</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
