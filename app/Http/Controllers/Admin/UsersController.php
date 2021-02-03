<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UsersRequest;
use App\Models\User;
use App\Support\Roles\Role;
use App\Support\Traits\HasOrderBys;
use Exception;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use phpDocumentor\Reflection\Types\Collection;

class UsersController extends Controller
{
    use HasOrderBys;

    public function __construct()
    {
        $this->authorizeResource(User::class);
    }

    /**
     * Init Order bys
     */
    protected static function initOrderbys()
    {
        static::$orderbys = ['name'];
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return Application|Factory|View|Response
     */
    public function index(Request $request)
    {
        $title = __('All Users');
        $orderby = $this->getOrderBy($request, 'id');
        $order =  $this->getOrder($request);
        $per_page = $this->getPerPage($request);

        $users = User::query()->orderBy($orderby, $order);

        $search = null;
        if ($search = $request->input('search')) {
            $users->search($search);
            $title = __('Users matching \':search\'', ['search' => $search]);
        }

        $users = $users->paginate($per_page)
            ->appends($request->except('page'));

        return view('admin.user-management.users.index', compact('users', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View|Response
     */
    public function create()
    {
        return view('admin.user-management.users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $user = new User($request->all());

        $user->password = $request->input('password');

        $user->save();

        $user->syncRoles($request->input('roles'));

        $this->flashSuccessMessage();

        return redirect()->action([self::class, 'edit'], $user);
    }

    /**
     * Display the specified resource.
     *
     * @param User $user
     * @return RedirectResponse
     */
    public function show(User $user): RedirectResponse
    {
        return redirect()->action([self::class, 'edit'], $user);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param User $user
     * @return Application|Factory|View|Response
     */
    public function edit(User $user)
    {
        return view('admin.user-management.users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param User $user
     * @return RedirectResponse
     */
    public function update(UsersRequest $request, User $user): RedirectResponse
    {
        $user->fill($request->all());

        if ($request->has('password')) {
            if ($password = $request->input('password')) {
                $user->password = Hash::make($password);
            }
        }

        $user->save();

        if ($role = $request->input('roles')) {
            $user->syncRoles($role);
        }

        $this->flashSuccessMessage();

        return redirect()->action([self::class, 'edit'], $user);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param User $user
     * @return JsonResponse|RedirectResponse
     * @throws Exception
     */
    public function destroy(User $user)
    {
        // Check if given user is currently logged in
        if ($user->id == Auth::user()->id) {
            if (request()->expectsJson()) {
                return response()->json("Hey! You can't delete yourself.. That's a big no no.", 500);
            }
        }

        if (! $user->delete()) {
            if (request()->expectsJson()) {
                return response()->json(false, 500);
            }
            abort(500);
        }

        if (request()->expectsJson()) {
            return response()->json(true);
        }

        return redirect()->action([self::class, 'index']);
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     * @throws AuthorizationException
     * @throws ValidationException
     * @throws Exception
     */
    public function bulk(Request $request)
    {
        $this->validate($request, [
            'action' => 'required|in:delete',
            'users' => 'required|array',
            'users.*' => 'exists:users,id',
        ]);

        $action = $request->input('action');
        $ids = $request->input('users', []);

        switch ($action) {
            case 'delete':
                //make sure allowed to delete
//                $this->authorize('delete_courses');

                User::query()->whereIn('id', $ids)
                    ->get()
                    ->each(function (User $user) {
                        $user->delete();
                    });

                $this->flashSuccessMessage(__('Deleted :count :plural.', [
                    'count' => count($ids), 'plural' => pluralize('user', count($ids))
                ]));

                break;
        }

        return redirect()->back();
    }

    public function userManagement()
    {
        $stats = [
            [
                'title' => __(':count Users', ['count' => User::count()]),
                'icon' => 'fa-users',
                'color' => 'success'
            ],
            [
                'title' => __(':count Roles', ['count' => Role::count()]),
                'icon' => 'fa-lock',
                'color' => 'danger'
            ]
        ];

        $stats = collect($stats);

        return view('admin.user-management.show', compact('stats'));
    }
}
