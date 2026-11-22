<x-admin.layout title="Subject">
    <div class="mb-4 flex flex-col items-start justify-between gap-3 sm:flex-row sm:items-center">
        <div>
            <h1 class="text-2xl font-semibold tracking-tight text-gray-900 dark:text-white">Subject</h1>
            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Kelola data mata pelajaran.</p>
        </div>
        <a href="{{ route('admin.subject.create') }}"
            class="inline-flex items-center rounded-lg bg-blue-600 px-4 py-2 text-sm font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-4 focus:ring-blue-300 dark:focus:ring-blue-800">
            <svg class="mr-2 h-4 w-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
            </svg>
            Add Subject
        </a>
    </div>

    <div class="relative overflow-hidden bg-white shadow-md sm:rounded-lg dark:bg-gray-800">
        <div
            class="flex flex-col items-center justify-between space-y-3 border-b border-gray-200 p-4 dark:border-gray-700 md:flex-row md:space-x-4 md:space-y-0">
            <div class="w-full md:w-1/2">
                <label for="subject-search" class="sr-only">Search subject</label>
                <form action="{{ route('admin.subject.index') }}" method="GET" class="relative">
                    <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                        <svg class="h-5 w-5 text-gray-500 dark:text-gray-400" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                        </svg>
                    </div>
                    <input type="text" id="subject-search" name="search" value="{{ $search }}"
                        class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2 pl-10 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400"
                        placeholder="Search subject...">
                </form>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm text-gray-500 dark:text-gray-400">
                <thead class="bg-gray-50 text-xs uppercase text-gray-700 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-4 py-3">No</th>
                        <th scope="col" class="px-4 py-3">Name</th>
                        <th scope="col" class="px-4 py-3">Code</th>
                        <th scope="col" class="px-4 py-3">Major</th>
                        <th scope="col" class="px-4 py-3">Teacher</th>
                        <th scope="col" class="px-4 py-3">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($subjects as $index => $subject)
                        <tr
                            class="border-b border-gray-200 bg-white hover:bg-gray-50 dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-600">
                            <td class="px-4 py-3">{{ $subjects->firstItem() + $index }}</td>
                            <td class="whitespace-nowrap px-4 py-3 font-medium text-gray-900 dark:text-white">
                                {{ $subject->name }}</td>
                            <td class="px-4 py-3">{{ $subject->code }}</td>
                            <td class="whitespace-nowrap px-4 py-3">{{ $subject->major->name }}</td>
                            <td class="whitespace-nowrap px-4 py-3">
                                {{ $subject->teacher?->name ?? '-' }}
                            </td>
                            <td class="px-4 py-3">
                                <div class="flex items-center gap-2">
                                    <a href="{{ route('admin.subject.edit', $subject) }}"
                                        class="rounded-lg bg-yellow-400 px-3 py-1.5 text-xs font-medium text-white hover:bg-yellow-500 focus:outline-none focus:ring-4 focus:ring-yellow-300 dark:focus:ring-yellow-900">
                                        Edit
                                    </a>
                                    <form action="{{ route('admin.subject.destroy', $subject) }}" method="POST"
                                        onsubmit="return confirm('Hapus data mata pelajaran ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="rounded-lg bg-red-600 px-3 py-1.5 text-xs font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-4 focus:ring-red-300 dark:focus:ring-red-900">
                                            Delete
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <nav class="flex flex-col items-start justify-between space-y-3 border-t border-gray-200 p-4 dark:border-gray-700 md:flex-row md:items-center md:space-y-0"
            aria-label="Navigasi tabel">
            <span class="text-sm font-normal text-gray-500 dark:text-gray-400">
                Showing <span class="font-semibold text-gray-900 dark:text-white">{{ $subjects->firstItem() ?? 0 }} - {{ $subjects->lastItem() ?? 0 }}</span>
                of <span class="font-semibold text-gray-900 dark:text-white">{{ $subjects->total() }}</span>
            </span>
            {{ $subjects->links('pagination::tailwind') }}
        </nav>
    </div>
</x-admin.layout>
