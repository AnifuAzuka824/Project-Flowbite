<?php

namespace App\Http\Controllers;

use App\Models\Major;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class SubjectController extends Controller
{
    // Cari nama/kode/jurusan, paginate 10
    public function index(Request $request)
    {
        $search = $request->input('search');
        // Eager load guru & jurusan
        $subjects = Subject::with(['teacher', 'major'])
            ->when($search, function ($query, $search) {
                $query->where('name', 'like', "%{$search}%")
                    ->orWhere('code', 'like', "%{$search}%")
                    ->orWhereHas('major', function ($majorQuery) use ($search) {
                        $majorQuery->where('name', 'like', "%{$search}%")
                            ->orWhere('code', 'like', "%{$search}%");
                    });
            })
            ->paginate(10)
            ->withQueryString();

        return view('admin.subject.index', compact('subjects', 'search'));
    }

    // Dropdown jurusan
    public function create()
    {
        $majors = Major::orderBy('name')->get();

        return view('admin.subject.create', compact('majors'));
    }

    // name & code unik, major_id wajib ada
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:subjects,name'],
            'code' => ['required', 'string', 'max:255', 'unique:subjects,code'],
            'major_id' => ['required', 'exists:majors,id'],
            'description' => ['nullable', 'string'],
        ]);

        Subject::create($validated);

        return redirect()->route('admin.subject.index')->with('success', 'Data mata pelajaran berhasil ditambahkan.');
    }

    // Data mapel + jurusan
    public function edit(Subject $subject)
    {
        $majors = Major::orderBy('name')->get();

        return view('admin.subject.edit', compact('subject', 'majors'));
    }

    // Aturan sama, unique abaikan id sendiri
    public function update(Request $request, Subject $subject)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255', Rule::unique('subjects', 'name')->ignore($subject->id)],
            'code' => ['required', 'string', 'max:255', Rule::unique('subjects', 'code')->ignore($subject->id)],
            'major_id' => ['required', 'exists:majors,id'],
            'description' => ['nullable', 'string'],
        ]);

        $subject->update($validated);

        return redirect()->route('admin.subject.index')->with('success', 'Data mata pelajaran berhasil diperbarui.');
    }

    public function destroy(Subject $subject)
    {
        // Tolak hapus bila sudah dipakai guru
        if ($subject->teacher()->exists()) {
            return redirect()->route('admin.subject.index')
                ->with('error', 'Mata pelajaran tidak dapat dihapus karena masih memiliki guru.');
        }

        $subject->delete();

        return redirect()->route('admin.subject.index')->with('success', 'Data mata pelajaran berhasil dihapus.');
    }
}
