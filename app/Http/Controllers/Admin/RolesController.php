<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
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
use Illuminate\Validation\ValidationException;
use Spatie\Permission\Models\Permission;

class RolesController extends Controller
{
    use HasOrderBys;

    public function __construct()
    {
        $this->authorizeResource(Role::class);
    }

    /**
     * Init Order bys
     */
    protected static function initOrderbys()
    {
        static::$orderbys = ['name', 'description'];
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return Application|Factory|View|Response
     */
    public function index(Request $request)
    {
        $title = __('All Roles');
        $orderby = $this->getOrderBy($request, 'id');
        $order =  $this->getOrder($request);
        $per_page = $this->getPerPage($request);

        $roles = Role::query()->orderBy($orderby, $order);

        $search = null;
        if ($search = $request->input('search')) {
            $roles->search($search);
            $title = __('Roles matching \':search\'', ['search' => $search]);
        }

        $roles = $roles->paginate($per_page)
            ->appends($request->except('page'));

        return view('admin.roles.index', compact('roles', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View|Response
     */
    public function create()
    {
        $permissions = Permission::orderBy('model', 'ASC')
            ->orderBy('description', 'ASC')
            ->get();

        return view('admin.roles.create', compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $role = new \App\Support\Roles\Role($request->only(['name', 'description']));
        $role->guard_name = 'web_admin';
        $role->save();

        //add the permissions
        $permissions = $request->input('permissions', []);
        $role->permissions()->sync($permissions);

        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        $this->flashSuccessMessage();

        return redirect()->action([RolesController::class, 'edit'], $role);
    }

    /**
     * Display the specified resource.
     *
     * @param Role $role
     * @return RedirectResponse
     */
    public function show(Role $role): RedirectResponse
    {
        return redirect()->action([self::class, 'edit'], $role);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Role $role
     * @return Application|Factory|View|Response
     */
    public function edit(Role $role)
    {
        $permissions = Permission::orderBy('model', 'ASC')
            ->orderBy('description', 'ASC')
            ->get();

        return view('admin.roles.edit', compact('role', 'permissions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Role $role
     * @return RedirectResponse
     */
    public function update(Request $request, Role $role): RedirectResponse
    {
        $role->fill($request->only(['name', 'description']));

        $permissions = $request->input('permissions', []);
        $role->syncPermissionIds($permissions);

        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        $role->save();

        $this->flashSuccessMessage();

        if ( $request->user()->hasRole($role) && !$role->hasPermissionTo('edit_roles') ) {
            return redirect()->to( url('/') );
        } else {
            return redirect()->action([self::class, 'edit'], $role);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Role $role
     * @return JsonResponse|RedirectResponse
     * @throws Exception
     */
    public function destroy(Role $role)
    {
        if (! $role->delete()) {
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
     * @throws ValidationException
     * @throws Exception
     */
    public function bulk(Request $request)
    {
        $this->validate($request, [
            'action' => 'required|in:delete',
            'roles' => 'required|array',
            'roles.*' => 'exists:roles,id',
        ]);

        $action = $request->input('action');
        $ids = $request->input('roles', []);

        switch ($action) {
            case 'delete':
                //make sure allowed to delete
//                $this->authorize('delete_courses');

                Role::query()->whereIn('id', $ids)
                    ->get()
                    ->each(function (Role $role) {
                        $role->delete();
                    });

                $this->flashSuccessMessage(__('Deleted :count :plural.', [
                    'count' => count($ids), 'plural' => pluralize('role', count($ids))
                ]));

                break;
        }

        return redirect()->back();
    }
}
