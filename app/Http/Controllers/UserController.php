<?php


namespace App\Http\Controllers;


use App\Gender;
use App\Http\Requests\User\CreateRequest;
use App\Http\Requests\User\EditRequest;
use App\Http\Requests\User\StoreRequest;
use App\Http\Requests\User\UpdateRequest;
use App\Http\Requests\User\ViewAnyRequest;
use App\Http\Requests\User\ViewRequest;
use App\Repositories\UserRepository;
use App\Role;
use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * @var UserRepository
     */
    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;

        $this->middleware('auth');
    }

    public function index(ViewAnyRequest $request)
    {
        $users = $this
            ->userRepository
            ->filteredQuery($request->query())
            ->where('id', '!=', auth()->id())
            ->with('role')
            ->institutionMember()
            ->paginate(25);

        return view('pages.user.index', compact('users'));
    }

    public function show(ViewRequest $request, User $user, $data = [])
    {
        $user->load(['role', 'gender', 'address', 'phone']);

        return view('pages.user.view', $user, $data);
    }

    public function create(CreateRequest $request, $data = [])
    {
        $roles = Role::get();
        $genders = Gender::get();

        return view('pages.user.create', compact('roles', 'genders'), $data);
    }

    public function store(StoreRequest $request)
    {
        $user = $this->userRepository->store($request->all());

        if ($request->ajax() || $request->wantsJson()) {
            return $user;
        }

        return $this->stored($request, $user) ?: redirect()->route('usuarios.index')->with([
            'message' => __('successfully registered :entity', ['entity' => __('user')])
        ]);
    }

    protected function stored(Request $request, User $user)
    {
        // implement after stored
    }

    public function edit(EditRequest $request, User $user, $data = [])
    {
        $user->load(['role', 'gender', 'address', 'phone']);
        $roles = Role::get();
        $genders = Gender::get();

        return view('pages.user.edit', compact('user', 'roles', 'genders'), $data);
    }

    public function update(UpdateRequest $request, User $user)
    {
        $updatedUser = $this->userRepository->update($user, $request->all());

        if ($request->ajax() || $request->wantsJson()) {
            return $updatedUser;
        }

        return $this->updated($request, $updatedUser) ?: redirect()->route('usuarios.index')->with([
           'message' => __('successfully updated :entity', ['entity' => __('user')])
        ]);
    }

    protected function updated(Request $request, User $user)
    {
        // implement updated method
    }
}
