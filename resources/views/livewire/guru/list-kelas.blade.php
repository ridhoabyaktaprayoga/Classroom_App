<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                <div class="flex justify-between items-center mb-6">
                    <h1 class="text-2xl font-bold">Daftar Kelas Saya</h1>
                    <a href="{{ route('guru.kelas.join') }}" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                        Join Kelas
                    </a>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @forelse($kelasList as $kelas)
                        <div class="bg-white border border-gray-200 rounded-lg shadow overflow-hidden">
                            <div class="p-6">
                                <h2 class="text-lg font-medium text-gray-900">{{ $kelas->nama_kelas }}</h2>
                                <p class="mt-2 text-sm text-gray-500">Kode: {{ $kelas->class_code }}</p>
                                <p class="mt-2 text-sm text-gray-600">{{ Str::limit($kelas->deskripsi, 100) }}</p>

                                @if($kelas->teachers->where('id', auth()->id())->count() > 0)
                                    <div class="mt-2">
                                        <p class="text-sm text-gray-700 font-medium">Teaching:</p>
                                        <div class="flex flex-wrap gap-1 mt-1">
                                            @php
                                                $teacherSubjects = \DB::table('teacher_subject')
                                                    ->join('subjects', 'teacher_subject.subject_id', '=', 'subjects.id')
                                                    ->where('teacher_subject.teacher_id', auth()->id())
                                                    ->where('teacher_subject.class_id', $kelas->id)
                                                    ->pluck('subjects.name');
                                            @endphp
                                            @foreach($teacherSubjects as $subjectName)
                                                <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-blue-100 text-blue-800">
                                                    {{ $subjectName }}
                                                </span>
                                            @endforeach
                                        </div>
                                    </div>
                                @endif

                                <div class="mt-4 flex space-x-3">
                                    <a href="{{ route('guru.kelas.show', $kelas->id) }}" class="text-indigo-600 hover:text-indigo-900">
                                        Detail
                                    </a>

                                    <span class="text-gray-300">|</span>

                                    <button
                                        wire:click="confirmLeaveClass({{ $kelas->id }})"
                                        class="text-red-600 hover:text-red-900"
                                    >
                                        Leave Class
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
                            <p class="text-gray-500">You haven't joined any classes yet. <a href="{{ route('guru.kelas.join') }}" class="text-indigo-600 hover:text-indigo-500">Join your first class</a>.</p>
                        </div>
                    @endforelse
                </div>

                <!-- Leave Class Confirmation Modal -->
                @if($showLeaveModal)
                <div class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
                    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
                        <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                            <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                                <div class="sm:flex sm:items-start">
                                    <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left w-full">
                                        <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">
                                            Leave Class
                                        </h3>
                                        <div class="mt-2">
                                            <p class="text-sm text-gray-500">
                                                {{ $leaveWarning }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                                <button wire:click="leaveClass" type="button" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm">
                                    Leave Class
                                </button>
                                <button wire:click="cancelLeave" type="button" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                                    Cancel
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
