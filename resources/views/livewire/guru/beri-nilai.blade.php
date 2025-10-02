<div class="py-12">
    <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                <h1 class="text-2xl font-bold mb-6">Beri Nilai: {{ $pengumpulan->siswa->name }}</h1>
                
                <div class="mb-6 p-4 bg-gray-50 rounded-lg">
                    <h2 class="text-lg font-medium text-gray-900">Tugas: {{ $pengumpulan->tugas->judul }}</h2>
                    <p class="mt-1 text-gray-600">Kelas: {{ $pengumpulan->tugas->kelas->nama_kelas }}</p>
                    <p class="mt-1 text-gray-600">Waktu Submit: {{ $pengumpulan->submitted_at->format('d M Y H:i') }}</p>
                    
                    @if($pengumpulan->file_path)
                        <p class="mt-1 text-gray-600">
                            File: 
                            <a href="{{ Storage::url($pengumpulan->file_path) }}" class="text-indigo-600 hover:text-indigo-900" target="_blank">
                                Download File
                            </a>
                        </p>
                    @endif
                </div>
                
                @if(session()->has('message'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
                        {{ session('message') }}
                    </div>
                @endif
                
                <form wire:submit="beriNilai">
                    <div class="mb-4">
                        <label for="nilai" class="block text-sm font-medium text-gray-700">Nilai (0-100)</label>
                        <input 
                            type="number" 
                            id="nilai" 
                            wire:model="nilai"
                            min="0"
                            max="100"
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm @error('nilai') border-red-500 @enderror">
                        @error('nilai')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div class="mb-4">
                        <label for="komentar" class="block text-sm font-medium text-gray-700">Komentar (Opsional)</label>
                        <textarea 
                            id="komentar" 
                            wire:model="komentar"
                            rows="4"
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm @error('komentar') border-red-500 @enderror">
                        </textarea>
                        @error('komentar')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div class="flex items-center justify-end space-x-4">
                        <a href="{{ url()->previous() ?: route('guru.kelas.index') }}" class="px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Batal
                        </a>
                        <button 
                            type="submit" 
                            class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Simpan Nilai
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>
