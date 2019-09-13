<?php


namespace App\Http\Controllers;


use App\Gender;
use App\Http\Requests\User\StoreRequest;
use App\Repositories\UserRepository;
use App\Role;
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

    public function index()
    {
        $roles = Role::get();
        $genders = Gender::get();

        return view('user.register', compact('roles', 'genders'));
    }

    public function store(StoreRequest $request)
    {
        $user = $this->userRepository->store($request->all());

        if ($request->ajax() || $request->wantsJson()) {
            return $user;
        }

        return redirect()->route('user.form')->with([
            'message' => __('successfully registered user')
        ]);
    }
}
