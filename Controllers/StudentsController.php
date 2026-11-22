<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class StudentsController extends Controller
{
    // Cari nama/NIS, paginate 10, pertahankan query
    public function index(Request $request)
    {
        $search = $request->input('search');

        // Eager load kelas, hindari N+1
        $students = Student::with('classroom')
            ->when($search, function ($query, $search) {
                $query->where('name', 'like', "%{$search}%")
                    ->orWhere('nis', 'like', "%{$search}%");
            })
            ->paginate(10)
            ->withQueryString();

        return view('admin.student.index', compact('students', 'search'));
    }

    // Kirim daftar kelas untuk dropdown
    public function create()
    {
        $classrooms = Classroom::orderBy('name')->get();

        return view('admin.student.create', compact('classrooms'));
    }

    // Validasi (NIS unik, kelas ada) lalu simpan
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'nis' => ['required', 'string', 'max:255', 'unique:students,nis'],
            'classroom_id' => ['required', 'exists:classrooms,id'],
            'address' => ['nullable', 'string'],
        ]);

        Student::create($validated);

        return redirect()->route('admin.student.index')->with('success', 'Data siswa berhasil ditambahkan.');
    }

    // Kirim siswa + daftar kelas ke form edit
    public function edit(Student $student)
    {
        $classrooms = Classroom::orderBy('name')->get();

        return view('admin.student.edit', compact('student', 'classrooms'));
    }

    // Sama seperti store; NIS unik diabaikan untuk diri sendiri
    public function update(Request $request, Student $student)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'nis' => ['required', 'string', 'max:255', Rule::unique('students', 'nis')->ignore($student->id)],
            'classroom_id' => ['required', 'exists:classrooms,id'],
            'address' => ['nullable', 'string'],
        ]);

        $student->update($validated);

        return redirect()->route('admin.student.index')->with('success', 'Data siswa berhasil diperbarui.');
    }

    // Hapus siswa lalu redirect
    public function destroy(Student $student)
    {
        $student->delete();

        return redirect()->route('admin.student.index')->with('success', 'Data siswa berhasil dihapus.');
    }
}
