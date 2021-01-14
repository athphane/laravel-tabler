<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Traits\HasOrderBys;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

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
     * @return Response
     */
    public function show(User $user): Response
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param User $user
     * @return Response
     */
    public function edit(User $user): Response
    {
        //
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
     * @return Response
     */
    public function destroy(User $user): Response
    {
        //
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
