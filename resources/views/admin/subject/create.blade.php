<x-admin.layout title="Add Subject">
    <div class="mb-4">
        <h1 class="text-2xl font-semibold tracking-tight text-gray-900 dark:text-white">Add Subject</h1>
        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Tambahkan data mata pelajaran baru.</p>
    </div>

    <div
        class="max-w-2xl rounded-lg border border-gray-200 bg-white p-6 shadow-sm dark:border-gray-700 dark:bg-gray-800">
        <form action="{{ route('admin.subject.store') }}" method="POST" class="space-y-4">
            @csrf

            <div>
                <label for="name" class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">Name</label>
                <input type="text" id="name" name="name" value="{{ old('name') }}" required
                    class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400"
                    placeholder="Nama mata pelajaran">
                @error('name')
                    <p class="mt-1 text-xs text-red-600 dark:text-red-400">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="code" class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">Code</label>
                <input type="text" id="code" name="code" value="{{ old('code') }}" required
                    class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400"
                    placeholder="Contoh: MTK">
                @error('code')
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
                <label for="description"
                    class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">Description</label>
                <textarea id="description" name="description" rows="3"
                    class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400"
                    placeholder="Deskripsi mata pelajaran (opsional)">{{ old('description') }}</textarea>
                @error('description')
                    <p class="mt-1 text-xs text-red-600 dark:text-red-400">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex items-center gap-3 pt-2">
                <button type="submit"
                    class="inline-flex items-center rounded-lg bg-blue-600 px-4 py-2 text-sm font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-4 focus:ring-blue-300 dark:focus:ring-blue-800">
                    Save
                </button>
                <a href="{{ route('admin.subject.index') }}"
                    class="inline-flex items-center rounded-lg border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-900 hover:bg-gray-100 focus:outline-none focus:ring-4 focus:ring-gray-200 dark:border-gray-600 dark:bg-gray-800 dark:text-white dark:hover:bg-gray-700">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</x-admin.layout>
