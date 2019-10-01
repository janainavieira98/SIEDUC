<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\CreateRequest;
use App\Http\Requests\User\EditRequest;
use App\Http\Requests\User\StoreRequest;
use App\Http\Requests\User\UpdateRequest;
use App\Http\Requests\User\ViewAnyRequest;
use App\Http\Requests\User\ViewRequest;
use App\Role;
use App\User;
use Illuminate\Http\Request;

class StudentController extends UserController
{
    /**
     * Display a listing of the resource.
     *
     * @param ViewAnyRequest $request
     * @return \Illuminate\Http\Response
     */
    public function index(ViewAnyRequest $request)
    {
        $users = $this
            ->userRepository
            ->filteredQuery($request->query())
            ->where('id', '!=', auth()->id())
            ->with('role')
            ->student()
            ->paginate(25);

        return view('pages.student.index', compact('users'), [
            'page_title' => __('students'),
            'new_label' => __('New :entity', ['entity' => __('student')])
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param CreateRequest $request
     * @param array $data
     * @return \Illuminate\Http\Response
     */
    public function create(CreateRequest $request, $data = [])
    {
        return parent::create($request, [
            'role' => Role::student()->first()->id,
            'page_title' => __('Create :entity', ['entity' => __('student')]),
            'back_route' => 'alunos.index',
            'form_route' => 'alunos.store',
            'roles' => []
        ]);
    }

    protected function stored(Request $request, User $user)
    {
        return redirect()->route('alunos.index')->with([
            'message' => __('successfully registered :entity', ['entity' => __('user')])
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param ViewRequest $request
     * @param \App\User $user
     * @param array $data
     * @return \Illuminate\Http\Response
     */
    public function show(ViewRequest $request, User $user, $data = [])
    {
        return parent::show($request, $user, [
            'page_title' => __('View :entity', ['entity' => __('student')]),
            'back_route' => 'alunos.index'
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param EditRequest $request
     * @param \App\User $user
     * @param array $data
     * @return \Illuminate\Http\Response
     */
    public function edit(EditRequest $request, User $user, $data = [])
    {
        return parent::edit($request, $user, [
            'page_title' => __('Edit :entity', ['entity' => __('student')]),
            'role' => Role::student()->first()->id,
            'back_route' => 'alunos.index',
            'form_route' => 'alunos.update',
            'roles' => []
        ]);
    }

    protected function updated(Request $request, User $user)
    {
        return redirect()->route('alunos.index')->with([
            'message' => __('successfully updated :entity', ['entity' => __('user')])
        ]);
    }
}
