<div class="py-12">
    <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                <h1 class="text-2xl font-bold mb-6">Kumpulkan Tugas: {{ $tugas->judul }}</h1>
                
                <div class="mb-6 p-4 bg-gray-50 rounded-lg">
                    <h2 class="text-lg font-medium text-gray-900">Deskripsi Tugas</h2>
                    <p class="mt-2 text-gray-600">{{ $tugas->deskripsi ?? 'Tidak ada deskripsi' }}</p>
                    <p class="mt-2 text-gray-600">Deadline: {{ $tugas->deadline->format('d M Y H:i') }}</p>
                    
                    @if($tugas->deadline->isPast())
                        <div class="mt-2 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
                            Deadline telah berlalu. Tidak dapat mengumpulkan tugas.
                        </div>
                    @endif
                </div>
                
                @if(session()->has('message'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
                        {{ session('message') }}
                    </div>
                @elseif(session()->has('error'))
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">
                        {{ session('error') }}
                    </div>
                @endif
                
                @if(!$tugas->deadline->isPast())
                    <form wire:submit="submitTugas">
                        <div class="mb-4">
                            <label for="teks_jawaban" class="block text-sm font-medium text-gray-700">Jawaban Teks (Opsional)</label>
                            <textarea 
                                id="teks_jawaban" 
                                wire:model="teks_jawaban"
                                rows="6"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm @error('teks_jawaban') border-red-500 @enderror"
                                placeholder="Tulis jawaban Anda di sini...">
                            </textarea>
                            @error('teks_jawaban')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div class="mb-4">
                            <label for="file" class="block text-sm font-medium text-gray-700">File Jawaban (Opsional)</label>
                            <input 
                                type="file" 
                                id="file" 
                                wire:model="file"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm @error('file') border-red-500 @enderror">
                            @error('file')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                            <p class="mt-1 text-sm text-gray-500">Format yang diperbolehkan: PDF, DOC, DOCX, ZIP. Maksimal 5MB.</p>
                            @if($file)
                                <div class="mt-2 text-sm text-gray-500">
                                    File dipilih: {{ $file->getClientOriginalName() }}
                                </div>
                            @endif
                        </div>
                        
                        <div class="flex items-center justify-end space-x-4">
                            <a href="{{ url()->previous() ?: route('siswa.kelas.index') }}" class="px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                Batal
                            </a>
                            <button 
                                type="submit" 
                                class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                Kumpulkan Tugas
                            </button>
                        </div>
                    </form>
                @endif
                
                @if($existingSubmission)
                    <div class="mt-8">
                        <h2 class="text-xl font-bold mb-4">Status Pengumpulan</h2>
                        <div class="border border-gray-200 rounded-lg p-4">
                            <p class="text-gray-600">Tugas ini telah dikumpulkan pada: {{ $existingSubmission->submitted_at->format('d M Y H:i') }}</p>
                            
                            @if($existingSubmission->nilai !== null)
                                <p class="text-gray-600 mt-2">Nilai: <span class="font-bold">{{ $existingSubmission->nilai }}</span></p>
                                @if($existingSubmission->komentar)
                                    <p class="text-gray-600 mt-2">Komentar: {{ $existingSubmission->komentar }}</p>
                                @endif
                            @else
                                <p class="text-yellow-600 mt-2">Status: Belum dinilai</p>
                            @endif
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
