<?php

namespace App\Http\Controllers;

use App\Discipline;
use App\Http\Requests\Discipline\EditRequest;
use App\Http\Requests\Discipline\StoreRequest;
use App\Http\Requests\Discipline\UpdateRequest;
use App\Http\Requests\Discipline\ViewRequest;
use App\Repositories\DisciplineRepository;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class DisciplineController extends Controller
{

    /**
     * @var DisciplineRepository
     */
    protected $disciplineRepository;

    public function __construct(DisciplineRepository $disciplineRepository)
    {
        $this->disciplineRepository = $disciplineRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $disciplines = $this
            ->disciplineRepository
            ->filteredQuery($request->query())
            ->paginate(25);

        return view('pages.disciplines.index', compact('disciplines'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('pages.disciplines.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return Response
     */
    public function store(StoreRequest $request)
    {
        $discipline = $this->disciplineRepository->create($request->all());

        if ($request->ajax() || $request->wantsJson()) {
            return $discipline;
        }

        return redirect()->route('disciplinas.index')->with([
            'message' => __('successfully registered :entity', ['entity' => __('Discipline')])
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param Discipline $discipline
     * @param ViewRequest $request
     * @return Response
     */
    public function show(Discipline $discipline, ViewRequest $request)
    {
        return view('pages.disciplines.view', compact('discipline'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Discipline $discipline
     * @param EditRequest $request
     * @return Response
     */
    public function edit(Discipline $discipline, EditRequest $request)
    {
        return view('pages.disciplines.edit', compact('discipline'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param Discipline $discipline
     * @return Response
     */
    public function update(UpdateRequest $request, Discipline $discipline)
    {
        $updatedDiscipline = $this->disciplineRepository->update($discipline, $request->all());

        if ($request->ajax() || $request->wantsJson()) {
            return $updatedDiscipline;
        }

        return redirect()->route('disciplinas.index')->with([
            'message' => __('successfully updated :entity', ['entity' => __('Discipline')])
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Discipline $discipline
     * @return Response
     */
    public function destroy(Discipline $discipline)
    {
        //
    }
}
