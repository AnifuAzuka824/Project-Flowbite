<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
use App\Models\Major;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class ClassroomController extends Controller
{
    // Cari nama kelas/jurusan/guru, paginate 10
    public function index(Request $request)
    {
        $search = $request->input('search');

        // Eager load 3 relasi
        $classrooms = Classroom::with(['major', 'teacher', 'students'])
            ->when($search, function ($query, $search) {
                $query->where('name', 'like', "%{$search}%")
                    // Cari lewat relasi major & teacher
                    ->orWhereHas('major', function ($majorQuery) use ($search) {
                        $majorQuery->where('name', 'like', "%{$search}%")
                            ->orWhere('code', 'like', "%{$search}%");
                    })
                    ->orWhereHas('teacher', function ($teacherQuery) use ($search) {
                        $teacherQuery->where('name', 'like', "%{$search}%");
                    });
            })
            ->paginate(10)
            ->withQueryString();

        return view('admin.classroom.index', compact('classrooms', 'search'));
    }

    // Dropdown jurusan + guru (ikut subject.major)
    public function create()
    {
        $majors = Major::orderBy('name')->get();
        $teachers = Teacher::with('subject.major')->orderBy('name')->get();

        return view('admin.classroom.create', compact('majors', 'teachers'));
    }

    // Nama kelas unik, jurusan wajib, guru opsional
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:classrooms,name'],
            'major_id' => ['required', 'exists:majors,id'],
            'teacher_id' => ['nullable', 'exists:teachers,id'],
        ]);

        // Tolak guru yang beda jurusan
        $this->ensureTeacherMatchesMajor($validated);

        Classroom::create($validated);

        return redirect()->route('admin.classroom.index')->with('success', 'Data kelas berhasil ditambahkan.');
    }

    // Data untuk form edit
    public function edit(Classroom $classroom)
    {
        $majors = Major::orderBy('name')->get();
        $teachers = Teacher::with('subject.major')->orderBy('name')->get();

        return view('admin.classroom.edit', compact('classroom', 'majors', 'teachers'));
    }

    // Unique abaikan id sendiri + guard jurusan
    public function update(Request $request, Classroom $classroom)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255', Rule::unique('classrooms', 'name')->ignore($classroom->id)],
            'major_id' => ['required', 'exists:majors,id'],
            'teacher_id' => ['nullable', 'exists:teachers,id'],
        ]);

        $this->ensureTeacherMatchesMajor($validated);

        $classroom->update($validated);

        return redirect()->route('admin.classroom.index')->with('success', 'Data kelas berhasil diperbarui.');
    }

    public function destroy(Classroom $classroom)
    {
        // Tolak hapus bila masih punya siswa
        if ($classroom->students()->exists()) {
            return redirect()->route('admin.classroom.index')
                ->with('error', 'Kelas tidak dapat dihapus karena masih memiliki siswa.');
        }

        $classroom->delete();

        return redirect()->route('admin.classroom.index')->with('success', 'Data kelas berhasil dihapus.');
    }

    // Bandingkan subject.major_id guru dengan major_id kelas
    private function ensureTeacherMatchesMajor(array $validated): void
    {
        if (empty($validated['teacher_id'])) {
            return;
        }

        $teacher = Teacher::with('subject')->find($validated['teacher_id']);

        if ($teacher === null || $teacher->subject === null || (int) $teacher->subject->major_id !== (int) $validated['major_id']) {
            throw ValidationException::withMessages([
                'teacher_id' => 'Guru harus mengajar mata pelajaran pada jurusan yang sama dengan kelas.',
            ]);
        }
    }
}
