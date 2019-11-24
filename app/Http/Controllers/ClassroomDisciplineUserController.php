<?php

namespace App\Http\Controllers;

use App\ClassroomDisciplineUser;
use App\Http\Requests\ClassroomDisciplineUser\CreateRequest;
use App\Http\Requests\ClassroomDisciplineUser\DeleteRequest;
use App\Http\Requests\ClassroomDisciplineUser\StoreRequest;
use App\Http\Requests\ClassroomDisciplineUser\ViewAnyRequest;
use App\Repositories\ClassroomDisciplineUserRepository;
use App\Repositories\ClassroomRepository;
use App\Repositories\DisciplineRepository;
use App\Repositories\UserRepository;
use App\Weekday;
use Illuminate\Http\Request;

class ClassroomDisciplineUserController extends Controller
{
    /**
     * @var ClassroomDisciplineUserRepository
     */
    protected $classroomDisciplineUserRepository;
    /**
     * @var ClassroomRepository
     */
    protected $classroomRepository;
    /**
     * @var DisciplineRepository
     */
    protected $disciplineRepository;
    /**
     * @var UserRepository
     */
    protected $userRepository;

    public function __construct(ClassroomDisciplineUserRepository $classroomDisciplineUserRepository, ClassroomRepository $classroomRepository, DisciplineRepository $disciplineRepository, UserRepository $userRepository)
    {
        $this->classroomDisciplineUserRepository = $classroomDisciplineUserRepository;
        $this->classroomRepository = $classroomRepository;
        $this->disciplineRepository = $disciplineRepository;
        $this->userRepository = $userRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param ViewAnyRequest $request
     * @return \Illuminate\Http\Response
     */
    public function index(ViewAnyRequest $request)
    {
        $records = $this
            ->classroomDisciplineUserRepository
            ->filteredQuery($request->query())
            ->with(['classroom', 'discipline', 'user', 'weekday'])
            ->paginate(25);

        return view('pages.classroom_discipline_user.index', compact('records'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param CreateRequest $request
     * @return void
     */
    public function create(CreateRequest $request)
    {
        $classrooms = $this->classroomRepository->getInstance()->newQuery()->get();
        $disciplines = $this->disciplineRepository->getInstance()->newQuery()->get();
        $teachers = $this->userRepository->getInstance()->newQuery()->teachers()->get();
        $weekdays = sortWeekdays(Weekday::get())->values();
        return view('pages.classroom_discipline_user.create', compact('classrooms', 'disciplines', 'teachers', 'weekdays'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        $relation = $this->classroomDisciplineUserRepository->create($request->all());

        if ($request->ajax() || $request->wantsJson()) {
            return $relation;
        }

        return redirect()->route('vincular-disciplinas.index')->with([
            'message' => 'aula atribuida com sucesso!'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\ClassroomDisciplineUser $classroomDisciplineUser
     * @return \Illuminate\Http\Response
     */
    public function show(ClassroomDisciplineUser $classroomDisciplineUser)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\ClassroomDisciplineUser $classroomDisciplineUser
     * @return \Illuminate\Http\Response
     */
    public function edit(ClassroomDisciplineUser $classroomDisciplineUser)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\ClassroomDisciplineUser $classroomDisciplineUser
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ClassroomDisciplineUser $classroomDisciplineUser)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param DeleteRequest $request
     * @param \App\ClassroomDisciplineUser $classroomDisciplineUser
     * @return \Illuminate\Http\Response
     */
    public function destroy(DeleteRequest $request, ClassroomDisciplineUser $classroomDisciplineUser)
    {
        $this->classroomDisciplineUserRepository->deleteModel($classroomDisciplineUser);

        return redirect()->route('vincular-disciplinas.index')->with([
            'message' => 'Vinculo apagado com sucesso!'
        ]);
    }
}
