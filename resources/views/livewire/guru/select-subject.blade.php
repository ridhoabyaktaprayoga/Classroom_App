<div>
    <div class="container mx-auto px-4 sm:px-8">
        <div class="py-8">
            <div>
                <h2 class="text-2xl font-semibold leading-tight">Select Subjects for {{ $kelas->nama_kelas }}</h2>
            </div>

            @if (session()->has('error'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mt-4" role="alert">
                    <span class="block sm:inline">{{ session('error') }}</span>
                </div>
            @endif

            @if (session()->has('message'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mt-4" role="alert">
                    <span class="block sm:inline">{{ session('message') }}</span>
                </div>
            @endif

            <div class="mt-8">
                <div class="max-w-md mx-auto bg-white p-6 rounded-lg shadow-md">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Available Subjects</h3>
                    <form wire:submit.prevent="saveSelection">
                        @if($subjects->isEmpty())
                            <p class="text-gray-600 mb-4">No subjects available in this class. Please contact the admin to add subjects.</p>
                        @else
                            <div class="mb-4">
                                @foreach($subjects as $subject)
                                    @php
                                        $isAssignedToOther = $kelas->teachers()->where('subject_id', $subject->id)->where('teacher_id', '!=', auth()->id())->exists();
                                    @endphp
                                    <label class="flex items-center mb-2 {{ $isAssignedToOther ? 'opacity-50' : '' }}">
                                        <input type="checkbox"
                                               wire:click="selectSubject({{ $subject->id }})"
                                               {{ in_array($subject->id, $selectedSubjects) ? 'checked' : '' }}
                                               {{ $isAssignedToOther ? 'disabled' : '' }}
                                               class="mr-2">
                                        {{ $subject->name }}
                                        @if($isAssignedToOther)
                                            <span class="text-sm text-gray-500">(Already assigned to another teacher)</span>
                                        @endif
                                    </label>
                                @endforeach
                            </div>
                            <button type="submit" class="w-full bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                Save Selection
                            </button>
                        @endif
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
