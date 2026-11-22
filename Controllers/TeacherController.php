<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class TeacherController extends Controller
{
    // Cari nama,NIP,Jurusan
    public function index(Request $request)
    {
        $search = $request->input('search');
        $teachers = Teacher::with('subject.major')
            ->when($search, function ($query, $search) {
                $query->where('name', 'like', "%{$search}%")
                    ->orWhere('nip', 'like', "%{$search}%")
                    ->orWhereHas('subject', function ($query) use ($search) {
                        $query->where('name', 'like', "%{$search}%")
                            ->orWhere('code', 'like', "%{$search}%")
                            ->orWhereHas('major', function ($majorQuery) use ($search) {
                                $majorQuery->where('name', 'like', "%{$search}%")
                                    ->orWhere('code', 'like', "%{$search}%");
                            });
                    });
            })
            ->paginate(10)
            ->withQueryString();

        return view('admin.teacher.index', compact('teachers', 'search'));
    }

    // Dropdown mapel + jurusan
    public function create()
    {
        $subjects = Subject::with('major')->orderBy('name')->get();

        return view('admin.teacher.create', compact('subjects'));
    }

    // NIP 10 digit, subject_id unik, start_date wajib
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'nip' => ['required', 'digits:10', 'regex:/^[1-9][0-9]{9}$/', 'unique:teachers,nip'],
            'subject_id' => ['required', 'exists:subjects,id', 'unique:teachers,subject_id'],
            'start_date' => ['required', 'date'],
            'phone' => ['nullable', 'string', 'max:255'],
            'address' => ['nullable', 'string'],
        ]);

        Teacher::create($validated);

        return redirect()->route('admin.teacher.index')->with('success', 'Data guru berhasil ditambahkan.');
    }

    // Data guru + mapel
    public function edit(Teacher $teacher)
    {
        $subjects = Subject::with('major')->orderBy('name')->get();

        return view('admin.teacher.edit', compact('teacher', 'subjects'));
    }

    public function update(Request $request, Teacher $teacher)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'nip' => ['required', 'digits:10', 'regex:/^[1-9][0-9]{9}$/', Rule::unique('teachers', 'nip')->ignore($teacher->id)],
            'subject_id' => [
                'required',
                'exists:subjects,id',
                Rule::unique('teachers', 'subject_id')->ignore($teacher->id),
            ],
            'start_date' => ['required', 'date'],
            'phone' => ['nullable', 'string', 'max:255'],
            'address' => ['nullable', 'string'],
        ]);

        $teacher->update($validated);

        return redirect()->route('admin.teacher.index')->with('success', 'Data guru berhasil diperbarui.');
    }

    // Hapus guru
    public function destroy(Teacher $teacher)
    {
        $teacher->delete();

        return redirect()->route('admin.teacher.index')->with('success', 'Data guru berhasil dihapus.');
    }
}
