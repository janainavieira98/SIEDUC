<?php

namespace App\Http\Controllers;

use App\Classroom;
use App\Repositories\ClassroomRepository;
use App\Repositories\DisciplineRepository;
use App\Repositories\GradeRepository;
use App\User;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    /**
     * @var GradeRepository
     */
    protected $gradeRepository;
    /**
     * @var ClassroomRepository
     */
    protected $classroomRepository;
    /**
     * @var DisciplineRepository
     */
    protected $disciplineRepository;

    public function __construct(GradeRepository $gradeRepository, ClassroomRepository $classroomRepository, DisciplineRepository $disciplineRepository)
    {
        $this->gradeRepository = $gradeRepository;
        $this->classroomRepository = $classroomRepository;
        $this->disciplineRepository = $disciplineRepository;
    }

    public function schoolReportClassrooms(Request $request)
    {
        $records = $this
            ->classroomRepository
            ->filteredQuery($request->query())
            ->paginate(25);

        return view('pages.school_report.classrooms', compact('records'));
    }

    public function schoolReportUsers(Request $request, Classroom $classroom)
    {
        $records = User::whereHas('enrollments', function ($query) use ($classroom) {
            $query->where('classroom_id', $classroom->id);
        })->paginate(25);

        return view('pages.school_report.users', compact('records', 'classroom'));
    }

    public function schoolReportUser(Request $request, Classroom $classroom, User $user, $part)
    {
        $enrollment = $user->enrollments()->where('classroom_id', $classroom->id)->first();
        $grade = $classroom->grades()->where('user_id', $user->id)->first();
        $classroom->load('disciplines');

        if (!$grade) {
            return redirect()->route('reports.schoolReportUsers', [$classroom, $user])->with([
                'message' => 'As notas e faltas deste usuário ainda não foram geradas'
            ]);
        }

        $pdf = PDF::loadView('pages.school_report.pdf', compact('classroom', 'user', 'part', 'grade', 'enrollment'));

        return $pdf->stream();
    }

    public function historicUsers(Request $request)
    {
        $records = User::student()->paginate(25);

        return view('pages.historic.users', compact('records'));
    }

    public function historicUser(Request $request, User $user)
    {
        $user->load(['grades.discipline', 'grades.classroom']);

        return $user;

        $pdf = PDF::loadView('pages.historic.pdf', compact('user'));

        return $pdf->stream();
    }
}
