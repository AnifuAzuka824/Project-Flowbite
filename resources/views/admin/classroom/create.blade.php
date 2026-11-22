<x-admin.layout title="Add Classroom">
    <div class="mb-4">
        <h1 class="text-2xl font-semibold tracking-tight text-gray-900 dark:text-white">Add Classroom</h1>
        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Tambahkan data kelas baru.</p>
    </div>

    <div
        class="max-w-2xl rounded-lg border border-gray-200 bg-white p-6 shadow-sm dark:border-gray-700 dark:bg-gray-800">
        <form action="{{ route('admin.classroom.store') }}" method="POST" class="space-y-4">
            @csrf

            <div>
                <label for="name" class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">Name</label>
                <input type="text" id="name" name="name" value="{{ old('name') }}" required
                    class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400"
                    placeholder="Contoh: X RPL 1">
                @error('name')
                    <p class="mt-1 text-xs text-red-600 dark:text-red-400">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="major_id" class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">Major</label>
                <select id="major_id" name="major_id" required
                    class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white">
                    <option value="" disabled {{ old('major_id') ? '' : 'selected' }}>Pilih jurusan</option>
                    @foreach ($majors as $major)
                        <option value="{{ $major->id }}" @selected(old('major_id') == $major->id)>
                            {{ $major->name }}
                        </option>
                    @endforeach
                </select>
                @error('major_id')
                    <p class="mt-1 text-xs text-red-600 dark:text-red-400">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="teacher_id" class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">Teacher</label>
                <select id="teacher_id" name="teacher_id"
                    class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white">
                    <option value="" {{ old('teacher_id') ? '' : 'selected' }}>Tanpa guru</option>
                    @foreach ($teachers as $teacher)
                        <option value="{{ $teacher->id }}" @selected(old('teacher_id') == $teacher->id)>
                            {{ $teacher->name }} - {{ $teacher->subject->name }} ({{ $teacher->subject->major->name }})
                        </option>
                    @endforeach
                </select>
                @error('teacher_id')
                    <p class="mt-1 text-xs text-red-600 dark:text-red-400">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex items-center gap-3 pt-2">
                <button type="submit"
                    class="inline-flex items-center rounded-lg bg-blue-600 px-4 py-2 text-sm font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-4 focus:ring-blue-300 dark:focus:ring-blue-800">
                    Save
                </button>
                <a href="{{ route('admin.classroom.index') }}"
                    class="inline-flex items-center rounded-lg border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-900 hover:bg-gray-100 focus:outline-none focus:ring-4 focus:ring-gray-200 dark:border-gray-600 dark:bg-gray-800 dark:text-white dark:hover:bg-gray-700">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</x-admin.layout>
