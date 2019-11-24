<?php

namespace App\Http\Controllers;

use App\Classroom;
use App\Http\Requests\Classroom\CreateRequest;
use App\Http\Requests\Classroom\EditRequest;
use App\Http\Requests\Classroom\StoreRequest;
use App\Http\Requests\Classroom\UpdateRequest;
use App\Http\Requests\Classroom\ViewAnyRequest;
use App\Http\Requests\Classroom\ViewRequest;
use App\Period;
use App\Repositories\ClassroomRepository;
use App\Weekday;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ClassroomController extends Controller
{
    /**
     * @var ClassroomRepository
     */
    protected $classroomRepository;

    public function __construct(ClassroomRepository $classroomRepository)
    {
        $this->classroomRepository = $classroomRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param ViewAnyRequest $request
     * @return Response
     */
    public function index(ViewAnyRequest $request)
    {
        $classrooms = $this->classroomRepository
            ->filteredQuery($request->query())
            ->with(['period'])
            ->paginate(25);

        return view('pages.classrooms.index', compact('classrooms'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create(CreateRequest $request)
    {
        $periods = Period::get()->sortBy(function($period) {
            return $period->description;
        });
        $weekDays = sortWeekdays(Weekday::get())->values();

        return view('pages.classrooms.create', compact('periods', 'weekDays'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(StoreRequest $request)
    {
        $classroom = $this->classroomRepository->create($request->all());

        if ($request->ajax() || $request->wantsJson()) {
            return $classroom;
        }

        return redirect()->route('classes.index')->with([
            'message' => __('successfully registered :entity', ['entity' => __('classroom')])
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param Classroom $classroom
     * @param ViewRequest $request
     * @return void
     */
    public function show(Classroom $classroom, ViewRequest $request)
    {
        $classroom->load(['weekdays']);
        return view('pages.classrooms.view', compact('classroom'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Classroom $classroom
     * @return Response
     */
    public function edit(Classroom $classroom, EditRequest $request)
    {
        $periods = Period::get()->sortBy(function($period) {
            return $period->description;
        });
        $weekDays = Weekday::get()->sortBy(function($period) {
            $date = Carbon::createFromFormat('l', ucfirst($period['slug']))->weekday();
            return $date;
        })->values();

        return view('pages.classrooms.update', compact('periods', 'weekDays', 'classroom'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateRequest $request
     * @param Classroom $classroom
     * @return Response
     */
    public function update(UpdateRequest $request, Classroom $classroom)
    {
        $classroom = $this->classroomRepository->update($classroom,$request->all());

        if ($request->ajax() || $request->wantsJson()) {
            return $classroom;
        }

        return redirect()->route('classes.index')->with([
            'message' => __('successfully updated :entity', ['entity' => __('classroom')])
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Classroom $classroom
     * @return Response
     */
    public function destroy(Classroom $classroom)
    {
        //
    }
}
