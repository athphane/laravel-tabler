<div class="btn-list">
    @if(isset($role))
        @can('delete', $role)
            <a class="btn btn-outline-danger btn-icon delete-link" href="#"
               data-request-url="{{ route('admin.roles.destroy', $role) }}"
               data-redirect-url="{{ route('admin.roles.index') }}" title="Delete">
                <i class="fa fa-trash"></i>
            </a>
        @endcan

        @can('viewLogs', $role)
            <a class="btn btn-outline-warning" href="{{ $role->log_url }}" target="_blank" title="View Logs">
                <i class="fa fa-clipboard"></i>
            </a>
        @endcan
    @endif

    @can('create', \App\Support\Roles\Role::class)
        <a href="{{ route('admin.roles.create') }}" class="btn btn-outline-primary btn-icon" title="Add New">
            <i class="fa fa-plus"></i>
        </a>
    @endcan

    @can('viewAny', \App\Support\Roles\Role::class)
        <a href="{{ route('admin.roles.index') }}" class="btn btn-outline-primary btn-icon" title="List All">
            <i class="fa fa-list"></i>
        </a>
    @endcan
</div>
