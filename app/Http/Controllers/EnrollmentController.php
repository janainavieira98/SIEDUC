<?php

namespace App\Http\Controllers;

use App\Classroom;
use App\Enrollment;
use App\EnrollmentType;
use App\Http\Requests\Enrollment\DeleteRequest;
use App\Http\Requests\Enrollment\StoreRequest;
use App\Http\Requests\Enrollment\ViewAnyRequest;
use App\Repositories\EnrollmentRepository;
use App\User;
use Illuminate\Http\Request;

class EnrollmentController extends Controller
{
    /**
     * @var EnrollmentRepository
     */
    protected $enrollmentRepository;

    public function __construct(EnrollmentRepository $enrollmentRepository)
    {
        $this->enrollmentRepository = $enrollmentRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ViewAnyRequest $request)
    {
        $records = $this
            ->enrollmentRepository
            ->filteredQuery($request->query())
            ->with(['user', 'classroom', 'enrollmentType'])
            ->paginate(25);

        return view('pages.enrollment.index', compact('records'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $classrooms = Classroom::get();
        $users = User::student()->get();
        $enrollmentTypes = EnrollmentType::get();

        return view('pages.enrollment.create', compact('classrooms', 'users', 'enrollmentTypes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        $model = $this->enrollmentRepository->create($request->all());

        if ($request->ajax() || $request->wantsJson()) {
            return $model;
        }

        return redirect()->route('matriculas.index')->with([
            'message' => 'matricula cadastrada com sucesso'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Enrollment $enrollment
     * @return \Illuminate\Http\Response
     */
    public function show(Enrollment $enrollment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Enrollment $enrollment
     * @return \Illuminate\Http\Response
     */
    public function edit(Enrollment $enrollment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Enrollment $enrollment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Enrollment $enrollment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Enrollment $enrollment
     * @return \Illuminate\Http\Response
     */
    public function destroy(DeleteRequest $request, Enrollment $enrollment)
    {
        $this->enrollmentRepository->deleteModel($enrollment);

        return redirect()->route('matriculas.index')->with([
            'message' => 'Matricula apagada com sucesso'
        ]);
    }
}
