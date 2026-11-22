<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
use App\Models\Major;
use App\Models\Student;
use App\Models\Subject;
use App\Models\Teacher;

class DashboardController extends Controller
{
    public function index()
    {
        // Statistik siswa, guru, kelas, jurusan, mapel, siswa aktif
        $totalStudents = Student::count();
        $totalTeachers = Teacher::count();
        $totalClassrooms = Classroom::count();
        $totalMajors = Major::count();
        $totalSubjects = Subject::count();
        $activeStudents = Student::where('status', 'Active')->count();

        // Persentase siswa aktif
        $attendanceRate = $totalStudents === 0 ? 0 : round($activeStudents / $totalStudents * 100);

        // Mengirim semua statistik ke admin.dashboard
        return view('admin.dashboard', compact(
            'totalStudents',
            'totalTeachers',
            'totalClassrooms',
            'totalMajors',
            'totalSubjects',
            'activeStudents',
            'attendanceRate'
        ));
    }
}
