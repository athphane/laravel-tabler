<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Traits\HasOrderBys;
use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{
    use HasOrderBys;

    /**
     * Init Order bys
     */
    protected static function initOrderbys()
    {
        static::$orderbys = ['name', 'email', 'role'];
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

        return view('admin.users.index', compact('users', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create(): Response
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request): Response
    {
        //
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
     * @return Response
     */
    public function edit(User $user): Response
    {
        dd($user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param User $user
     * @return Response
     */
    public function update(Request $request, User $user): Response
    {
        //
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

    public function bulk(Request $request)
    {
        $ids = $request->input('users', []);

        // Implement bulk actions here

        $this->flashSuccessMessage(__('Modified :count :plural.', [
            'count' => count($ids), 'plural' => pluralize('user', count($ids))
        ]));

        return redirect()->back();
    }
}