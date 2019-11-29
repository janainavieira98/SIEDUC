<?php

namespace App\Http\Controllers;

use App\Classroom;
use App\Discipline;
use App\Grade;
use App\Http\Requests\Grade\CreateRequest;
use App\Http\Requests\Grade\EditRequest;
use App\Http\Requests\Grade\StoreRequest;
use App\Http\Requests\Grade\UpdateRequest;
use App\Http\Requests\Grade\ViewAnyRequest;
use App\Repositories\ClassroomRepository;
use App\Repositories\DisciplineRepository;
use App\Repositories\GradeRepository;
use App\User;

class GradeController extends Controller
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

    /**
     * Display a listing of the resource.
     *
     * @param ViewAnyRequest $request
     * @return \Illuminate\Http\Response
     */
    public function classrooms(ViewAnyRequest $request)
    {
        $records = $this
            ->classroomRepository
            ->filteredQuery($request->query())
            ->paginate(25);

        return view('pages.grades.classrooms', compact('records'));
    }

    /**
     * @param ViewAnyRequest $request
     * @param Classroom $classroom
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function disciplines(ViewAnyRequest $request, Classroom $classroom)
    {
        $records = $this
            ->disciplineRepository
            ->filteredQuery($request->query())
            ->whereHas('classrooms', function ($query) use ($classroom) {
                $query->where('classroom_id', $classroom->id);
            })
            ->paginate(25);
        return view('pages.grades.disciplines', compact('records', 'classroom'));
    }

    /**
     * @param ViewAnyRequest $request
     * @param Classroom $classroom
     * @param Discipline $discipline
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function grades(ViewAnyRequest $request, Classroom $classroom, Discipline $discipline)
    {
        $records = $this
            ->gradeRepository
            ->filteredQuery($request->query())
            ->where('classroom_id', $classroom->id)
            ->where('discipline_id', $discipline->id)
            ->with(['user'])
            ->paginate(25);

        return view('pages.grades.grades', compact('records', 'classroom', 'discipline'));
    }

    public function create(CreateRequest $request, Classroom $classroom, Discipline $discipline)
    {
        $users = User::whereHas('enrollments', function ($query) use ($classroom, $discipline) {
            $query->fromDisciplineAndClassroom($discipline, $classroom);
        })->paginate(25);

        return view('pages.grades.create', compact('users', 'classroom', 'discipline'));
    }

    public function store(StoreRequest $request, Classroom $classroom, Discipline $discipline)
    {
        $grade = $this->gradeRepository->create(array_merge($request->all(), [
            'classroom_id' => $classroom->id,
            'discipline_id' => $discipline->id
        ]));

        if ($request->ajax() || $request->wantsJson()) {
            return $grade;
        }

        return redirect()->route('grades.grades', [$classroom, $discipline])->with([
            'message' => 'Notas e faltas cadastradas com sucesso!'
        ]);
    }

    public function edit(EditRequest $request, Classroom $classroom, Discipline $discipline, User $user)
    {
        $grade = Grade::fromDisciplineAndClassroom($discipline, $classroom)->where('user_id', $user->id)->firstOrFail();

        return view('pages.grades.edit', compact('classroom', 'discipline', 'user', 'grade'));
    }

    public function update(UpdateRequest $request, Classroom $classroom, Discipline $discipline, User $user)
    {
        $grade = Grade::fromDisciplineAndClassroom($discipline, $classroom)->where('user_id', $user->id)->firstOrFail();

        $updatedUser = $this->gradeRepository->updateModel($grade, array_merge(
            $request->all(),
            [
                'classroom_id' => $classroom->id,
                'discipline_id' => $discipline->id
            ]
        ));

        if ($request->ajax() || $request->wantsJson()) {
            return $updatedUser;
        }

        return redirect()->route('grades.grades', [$classroom, $discipline])->with([
           'message' => 'Notas e faltas atualizadas com sucesso!'
        ]);
    }

}
