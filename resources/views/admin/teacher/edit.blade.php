<x-admin.layout title="Edit Teacher">
    <div class="mb-4">
        <h1 class="text-2xl font-semibold tracking-tight text-gray-900 dark:text-white">Edit Teacher</h1>
        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Perbarui data guru.</p>
    </div>

    <div
        class="max-w-2xl rounded-lg border border-gray-200 bg-white p-6 shadow-sm dark:border-gray-700 dark:bg-gray-800">
        <form action="{{ route('admin.teacher.update', $teacher) }}" method="POST" class="space-y-4">
            @csrf
            @method('PUT')

            <div>
                <label for="name" class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">Name</label>
                <input type="text" id="name" name="name" value="{{ old('name', $teacher->name) }}" required
                    class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400"
                    placeholder="Nama lengkap guru">
                @error('name')
                    <p class="mt-1 text-xs text-red-600 dark:text-red-400">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="nip" class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">NIP</label>
                <input type="text" id="nip" name="nip" value="{{ old('nip', $teacher->nip) }}" required
                    inputmode="numeric" maxlength="10"
                    class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400"
                    placeholder="10 digit angka">
                @error('nip')
                    <p class="mt-1 text-xs text-red-600 dark:text-red-400">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="start_date"
                    class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">Start Date</label>
                <input type="date" id="start_date" name="start_date"
                    value="{{ old('start_date', $teacher->start_date) }}" required
                    class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white">
                @error('start_date')
                    <p class="mt-1 text-xs text-red-600 dark:text-red-400">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="subject_id" class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">Subject</label>
                <select id="subject_id" name="subject_id" required
                    class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white">
                    @foreach ($subjects as $subject)
                        <option value="{{ $subject->id }}" @selected(old('subject_id', $teacher->subject_id) == $subject->id)>
                            {{ $subject->name }} ({{ $subject->code }}) - {{ $subject->major->name }}
                        </option>
                    @endforeach
                </select>
                @error('subject_id')
                    <p class="mt-1 text-xs text-red-600 dark:text-red-400">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="phone" class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">Phone</label>
                <input type="text" id="phone" name="phone" value="{{ old('phone', $teacher->phone) }}"
                    class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400"
                    placeholder="Nomor telepon (opsional)">
                @error('phone')
                    <p class="mt-1 text-xs text-red-600 dark:text-red-400">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="address"
                    class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">Address</label>
                <textarea id="address" name="address" rows="3"
                    class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400"
                    placeholder="Alamat guru (opsional)">{{ old('address', $teacher->address) }}</textarea>
                @error('address')
                    <p class="mt-1 text-xs text-red-600 dark:text-red-400">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex items-center gap-3 pt-2">
                <button type="submit"
                    class="inline-flex items-center rounded-lg bg-blue-600 px-4 py-2 text-sm font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-4 focus:ring-blue-300 dark:focus:ring-blue-800">
                    Update
                </button>
                <a href="{{ route('admin.teacher.index') }}"
                    class="inline-flex items-center rounded-lg border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-900 hover:bg-gray-100 focus:outline-none focus:ring-4 focus:ring-gray-200 dark:border-gray-600 dark:bg-gray-800 dark:text-white dark:hover:bg-gray-700">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</x-admin.layout>
