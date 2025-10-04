<div>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h2 class="text-2xl font-semibold leading-tight">Admin Dashboard</h2>

                    <!-- Key Statistic Cards -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mt-6">
                        <div class="bg-white overflow-hidden shadow rounded-lg">
                            <div class="p-5">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0">
                                        <!-- Heroicon name: outline/users -->
                                        <svg class="h-6 w-6 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M15 21a6 6 0 00-9-5.197m0 0A6.995 6.995 0 0112 12.75a6.995 6.995 0 016-5.197M15 21a6 6 0 00-9-5.197" />
                                        </svg>
                                    </div>
                                    <div class="ml-5 w-0 flex-1">
                                        <dl>
                                            <dt class="text-sm font-medium text-gray-500 truncate">Total Users</dt>
                                            <dd class="text-3xl font-semibold text-gray-900">{{ $totalUsers }}</dd>
                                        </dl>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="bg-white overflow-hidden shadow rounded-lg">
                            <div class="p-5">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0">
                                        <!-- Heroicon name: outline/academic-cap -->
                                        <svg class="h-6 w-6 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                            <path d="M12 14l9-5-9-5-9 5 9 5z" />
                                            <path d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-5.998 12.078 12.078 0 01.665-6.479L12 14z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-5.998 12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5l4-2.222 4 2.222V20" />
                                        </svg>
                                    </div>
                                    <div class="ml-5 w-0 flex-1">
                                        <dl>
                                            <dt class="text-sm font-medium text-gray-500 truncate">Total Teachers</dt>
                                            <dd class="text-3xl font-semibold text-gray-900">{{ $totalTeachers }}</dd>
                                        </dl>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="bg-white overflow-hidden shadow rounded-lg">
                            <div class="p-5">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0">
                                        <!-- Heroicon name: outline/user-group -->
                                        <svg class="h-6 w-6 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.653-.281-1.264-.743-1.679M12 12a3 3 0 100-6 3 3 0 000 6zm-4 8a4 4 0 100-8 4 4 0 000 8z" />
                                        </svg>
                                    </div>
                                    <div class="ml-5 w-0 flex-1">
                                        <dl>
                                            <dt class="text-sm font-medium text-gray-500 truncate">Total Students</dt>
                                            <dd class="text-3xl font-semibold text-gray-900">{{ $totalStudents }}</dd>
                                        </dl>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="bg-white overflow-hidden shadow rounded-lg">
                            <div class="p-5">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0">
                                        <!-- Heroicon name: outline/library -->
                                        <svg class="h-6 w-6 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 14v3m4-3v3m4-3v3M3 21h18M3 10h18M3 7l9-4 9 4M4 10h16v11H4V10z" />
                                        </svg>
                                    </div>
                                    <div class="ml-5 w-0 flex-1">
                                        <dl>
                                            <dt class="text-sm font-medium text-gray-500 truncate">Total Classes</dt>
                                            <dd class="text-3xl font-semibold text-gray-900">{{ $totalClasses }}</dd>
                                        </dl>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Registration Chart -->
                    <div class="mt-8">
                        <div class="bg-white overflow-hidden shadow rounded-lg">
                            <div class="p-5">
                                <h3 class="text-lg leading-6 font-medium text-gray-900">New User Registrations (Last 7 Days)</h3>
                                <div class="mt-4">
                                    <canvas id="userRegistrationChart"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mt-8">
                        <!-- Recent Activity Widget -->
                        <div>
                            <div class="bg-white overflow-hidden shadow rounded-lg">
                                <div class="p-5">
                                    <h3 class="text-lg leading-6 font-medium text-gray-900">Recent Activity</h3>
                                    <div class="mt-4">
                                        <h4 class="text-md font-medium text-gray-700">Recently Registered Users</h4>
                                        <ul class="divide-y divide-gray-200">
                                            @foreach($recentUsers as $user)
                                                <li class="py-3 flex justify-between items-center">
                                                    <p class="text-sm font-medium text-gray-900">{{ $user->name }}</p>
                                                    <p class="text-sm text-gray-500">{{ $user->created_at->diffForHumans() }}</p>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                    <div class="mt-4">
                                        <h4 class="text-md font-medium text-gray-700">Recently Created Classes</h4>
                                        <ul class="divide-y divide-gray-200">
                                            @foreach($recentClasses as $class)
                                                <li class="py-3 flex justify-between items-center">
                                                    <p class="text-sm font-medium text-gray-900">{{ $class->nama }}</p>
                                                    <p class="text-sm text-gray-500">{{ $class->created_at->diffForHumans() }}</p>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Quick Actions Widget -->
                        <div>
                            <div class="bg-white overflow-hidden shadow rounded-lg">
                                <div class="p-5">
                                    <h3 class="text-lg leading-6 font-medium text-gray-900">Quick Actions</h3>
                                    <div class="mt-4 flex flex-col space-y-4">
                                        <a href="{{ route('admin.users') }}" class="w-full bg-indigo-600 text-white text-center py-2 rounded-md hover:bg-indigo-700">View All Users</a>
                                        <a href="{{ route('admin.classes') }}" class="w-full bg-indigo-600 text-white text-center py-2 rounded-md hover:bg-indigo-700">View All Classes</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('livewire:load', function () {
            const ctx = document.getElementById('userRegistrationChart');
            if (ctx) {
                const userRegistrationChart = new Chart(ctx.getContext('2d'), {
                    type: 'bar',
                    data: {
                        labels: @json($userRegistrationData->pluck('date')),
                        datasets: [{
                            label: 'New Users',
                            data: @json($userRegistrationData->pluck('count')),
                            backgroundColor: 'rgba(79, 70, 229, 0.5)',
                            borderColor: 'rgba(79, 70, 229, 1)',
                            borderWidth: 1
                        }]
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });
            }
        });
    </script>
</div>
