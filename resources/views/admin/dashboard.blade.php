@php
    $stats = [
        ['label' => 'Total Siswa', 'value' => (string) $totalStudents, 'trend' => $activeStudents . ' siswa aktif', 'color' => 'blue', 'icon' => '<path d="M18 18.72a9.094 9.094 0 0 0 3.741-.479 3 3 0 0 0-4.682-2.72m.94 3.198.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0 1 12 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 0 1 6 18.719m12 0a5.971 5.971 0 0 0-.941-3.197m0 0A5.995 5.995 0 0 0 12 12.75a5.995 5.995 0 0 0-5.058 2.772m0 0a3 3 0 0 0-4.681 2.72 8.986 8.986 0 0 0 3.74.477m.94-3.197a5.971 5.971 0 0 0-.94 3.197M15 6.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm6 3a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Zm-13.5 0a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Z" />'],
        ['label' => 'Total Guru', 'value' => (string) $totalTeachers, 'trend' => $totalSubjects . ' mata pelajaran', 'color' => 'green', 'icon' => '<path d="M4.26 10.147a60.436 60.436 0 0 0-.491 6.347A48.627 48.627 0 0 1 12 20.904a48.627 48.627 0 0 1 8.232-4.41 60.46 60.46 0 0 0-.491-6.347m-15.482 0a50.57 50.57 0 0 0-2.658-.813A59.905 59.905 0 0 1 12 3.493a59.902 59.902 0 0 1 10.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.697 50.697 0 0 1 12 13.489a50.702 50.702 0 0 1 7.74-3.342M6.75 15a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Zm0 0v-3.675A55.378 55.378 0 0 1 12 8.443m-7.007 11.55A5.981 5.981 0 0 0 6.75 15.75v-1.5" />'],
        ['label' => 'Total Kelas', 'value' => (string) $totalClassrooms, 'trend' => $totalMajors . ' jurusan', 'color' => 'purple', 'icon' => '<path d="M3 21V8.25a3 3 0 0 1 3-3h9a3 3 0 0 1 3 3V21m-12 0h12m-12 0H3m15 0h3M9 6.75V3.75A.75.75 0 0 1 9.75 3h4.5a.75.75 0 0 1 .75.75v3" />'],
        ['label' => 'Siswa Aktif', 'value' => $attendanceRate . '%', 'trend' => $activeStudents . ' dari ' . $totalStudents . ' siswa', 'color' => 'yellow', 'icon' => '<path d="M10.125 2.25h-4.5c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125v-9M10.125 2.25h.375a9 9 0 0 1 9 9v.375M10.125 2.25A3.375 3.375 0 0 1 13.5 5.625v1.5c0 .621.504 1.125 1.125 1.125h1.5a3.375 3.375 0 0 1 3.375 3.375M9 15l2.25 2.25L15 12" />'],
    ];

    $iconColors = [
        'blue' => 'bg-blue-100 text-blue-600 dark:bg-blue-900 dark:text-blue-300',
        'green' => 'bg-green-100 text-green-600 dark:bg-green-900 dark:text-green-300',
        'purple' => 'bg-purple-100 text-purple-600 dark:bg-purple-900 dark:text-purple-300',
        'yellow' => 'bg-yellow-100 text-yellow-600 dark:bg-yellow-900 dark:text-yellow-300',
    ];
@endphp

<x-admin.layout title="Dashboard">
    <div class="mb-6">
        <h1 class="text-2xl font-semibold tracking-tight text-gray-900 dark:text-white">Dashboard</h1>
        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Ringkasan data sekolah hari ini.</p>
    </div>

    <div class="mb-4 grid w-full grid-cols-1 gap-4 sm:grid-cols-2 xl:grid-cols-4">
        @foreach ($stats as $stat)
            <div
                class="rounded-lg border border-gray-200 bg-white p-4 shadow-sm dark:border-gray-700 dark:bg-gray-800">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-500 dark:text-gray-400">{{ $stat['label'] }}</p>
                        <p class="mt-1 text-2xl font-bold text-gray-900 dark:text-white">{{ $stat['value'] }}</p>
                        <p class="mt-1 text-xs text-gray-400 dark:text-gray-500">{{ $stat['trend'] }}</p>
                        
                    </div>
                    <div class="rounded-lg p-3 {{ $iconColors[$stat['color']] }}">
                        <svg class="h-6 w-6" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                            viewBox="0 0 24 24">
                            {!! $stat['icon'] !!}
                        </svg>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <div class="grid grid-cols-1 gap-4 lg:grid-cols-2">
        <div
            class="rounded-lg border border-gray-200 bg-white p-6 shadow-sm dark:border-gray-700 dark:bg-gray-800">
            <h2 class="mb-2 text-lg font-semibold text-gray-900 dark:text-white">Selamat datang kembali!</h2>
            <p class="text-sm leading-relaxed text-gray-500 dark:text-gray-400">
                Ini adalah panel administrasi sekolah. Gunakan menu di sisi kiri untuk mengelola data siswa,
                melihat informasi tentang aplikasi, dan memantau ringkasan data sekolah melalui dashboard ini.
            </p>
            <a href="{{ url('/admin/student') }}"
                class="mt-4 inline-flex items-center rounded-lg bg-blue-600 px-4 py-2 text-sm font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-4 focus:ring-blue-300 dark:focus:ring-blue-800">
                Kelola Data Siswa
                <svg class="ml-2 h-4 w-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                    <path
                    stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
                </svg>
            </a>
        </div>
        <div
            class="rounded-lg border border-gray-200 bg-white p-6 shadow-sm dark:border-gray-700 dark:bg-gray-800">
            <h2 class="mb-4 text-lg font-semibold text-gray-900 dark:text-white">Aktivitas Terbaru</h2>
            <ol class="relative ml-3 border-s border-gray-200 dark:border-gray-700">
                @foreach ([
            ['Jam 08:15', 'Ahmad Yasin (XI RPL 1) ditambahkan ke dalam data siswa.'],
            ['Jam 07:50', 'Kehadiran kelas X TKJ 1 telah dikonfirmasi oleh wali kelas.'],
            ['Kemarin', 'Data 3 siswa diperbarui melalui halaman Student.'],
            ] as [$time, $activity])
                    <li class="mb-6 ms-6 last:mb-0">
                        <span
                            class="absolute flex h-6 w-6 items-center justify-center rounded-full bg-blue-100 ring-8 ring-white dark:bg-blue-900 dark:ring-gray-800">
                            <svg class="h-3 w-3 text-blue-600 dark:text-blue-300" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                                <path fill-rule="evenodd"
                                    d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25ZM12.75 6a.75.75 0 0 0-1.5 0v6c0 .414.336.75.75.75h4.5a.75.75 0 0 0 0-1.5h-3.75V6Z"
                                    clip-rule="evenodd" />
                            </svg>
                        </span>
                        <time
                            class="mb-1 block text-xs font-normal leading-none text-gray-400 dark:text-gray-500">{{ $time }}</time>
                        <p class="text-sm text-gray-700 dark:text-gray-300">{{ $activity }}</p>
                    </li>
                @endforeach
            </ol>
        </div>
    </div>
</x-admin.layout>
