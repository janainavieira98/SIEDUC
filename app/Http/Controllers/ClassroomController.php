<?php

namespace App\Http\Controllers;

use App\Classroom;
use App\Http\Requests\Classroom\CreateRequest;
use App\Http\Requests\Classroom\ViewAnyRequest;
use App\Repositories\ClassroomRepository;
use Illuminate\Http\Request;

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
     * @return \Illuminate\Http\Response
     */
    public function index(ViewAnyRequest $request)
    {
        $classrooms = $this->classroomRepository
            ->filteredQuery($request->query())
            ->paginate(25);

        return view('pages.classrooms.index', compact('classrooms'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(CreateRequest $request)
    {
        return view('pages.classrooms.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
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
     * @param  \App\Classroom  $classroom
     * @return \Illuminate\Http\Response
     */
    public function show(Classroom $classroom)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Classroom  $classroom
     * @return \Illuminate\Http\Response
     */
    public function edit(Classroom $classroom)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Classroom  $classroom
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Classroom $classroom)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Classroom  $classroom
     * @return \Illuminate\Http\Response
     */
    public function destroy(Classroom $classroom)
    {
        //
    }
}
