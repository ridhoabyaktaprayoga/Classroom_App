<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                <div class="flex justify-between items-center mb-6">
                    <div>
                        <h1 class="text-2xl font-bold">Nilai {{ $siswa->name }}</h1>
                        <p class="text-gray-600">Kelas: {{ $kelas->nama_kelas }}</p>
                    </div>
                    <a href="{{ route('guru.kelas.show', $kelas->id) }}" class="px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        Kembali ke Kelas
                    </a>
                </div>

                @if($pengumpulans->isEmpty())
                    <div class="text-center py-12">
                        <p class="text-gray-500 text-lg">Belum ada pengumpulan tugas dari siswa ini.</p>
                    </div>
                @else
                    <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 md:rounded-lg">
                        <table class="min-w-full divide-y divide-gray-300">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6">Tugas</th>
                                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Deskripsi</th>
                                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Nilai</th>
                                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Komentar</th>
                                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Tanggal Submit</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 bg-white">
                                @forelse($pengumpulans as $pengumpulan)
                                    <tr>
                                        <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6">{{ $pengumpulan->tugas->judul }}</td>
                                        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ Str::limit($pengumpulan->tugas->deskripsi, 50) }}</td>
                                        <td class="whitespace-nowrap px-3 py-4 text-sm {{ $pengumpulan->nilai ? 'text-green-600 font-medium' : 'text-gray-400' }}">{{ $pengumpulan->nilai ?? 'Belum dinilai' }}</td>
                                        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ Str::limit($pengumpulan->komentar ?? 'Tidak ada komentar', 50) }}</td>
                                        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ $pengumpulan->submitted_at ? $pengumpulan->submitted_at->format('d M Y H:i') : 'N/A' }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6">Belum ada pengumpulan tugas</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
