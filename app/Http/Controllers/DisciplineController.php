<?php

namespace App\Http\Controllers;

use App\Discipline;
use App\Http\Requests\Discipline\StoreRequest;
use App\Repositories\DisciplineRepository;
use Illuminate\Http\Request;

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
     * @return \Illuminate\Http\Response
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
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.disciplines.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        $discipline = $this->disciplineRepository->create($request->all());

        if ($request->ajax() || $request->wantsJson()) {
            return $discipline;
        }

        return redirect()->route('disciplinas.index', [
            'message' => __('successfully registered :entity', ['entity' => __('Discipline')])
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Discipline  $discipline
     * @return \Illuminate\Http\Response
     */
    public function show(Discipline $discipline)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Discipline  $discipline
     * @return \Illuminate\Http\Response
     */
    public function edit(Discipline $discipline)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Discipline  $discipline
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Discipline $discipline)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Discipline  $discipline
     * @return \Illuminate\Http\Response
     */
    public function destroy(Discipline $discipline)
    {
        //
    }
}
