<div class="py-12">
    <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                <h1 class="text-2xl font-bold mb-6">Buat Kelas Baru</h1>
                
                @if(session()->has('message'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
                        {{ session('message') }}
                    </div>
                @endif
                
                <form wire:submit="createKelas">
                    <div class="mb-4">
                        <label for="nama_kelas" class="block text-sm font-medium text-gray-700">Nama Kelas</label>
                        <input 
                            type="text" 
                            id="nama_kelas" 
                            wire:model="nama_kelas"
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm @error('nama_kelas') border-red-500 @enderror">
                        @error('nama_kelas')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div class="mb-4">
                        <label for="deskripsi" class="block text-sm font-medium text-gray-700">Deskripsi</label>
                        <textarea 
                            id="deskripsi" 
                            wire:model="deskripsi"
                            rows="4"
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm @error('deskripsi') border-red-500 @enderror">
                        </textarea>
                        @error('deskripsi')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div class="flex items-center justify-end space-x-4">
                        <a href="{{ route('guru.kelas.index') }}" class="px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Batal
                        </a>
                        <button 
                            type="submit" 
                            class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Buat Kelas
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
