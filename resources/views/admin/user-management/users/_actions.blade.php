<div class="btn-list">
    @if(isset($user))
        @can('delete', $user)
            <a class="btn btn-outline-danger btn-icon delete-link" href="#"
               data-request-url="{{ route('admin.users.destroy', $user) }}"
               data-redirect-url="{{ route('admin.users.index') }}" title="Delete">
                <i class="fa fa-trash"></i>
            </a>
        @endcan

        @can('viewLogs', $user)
            <a class="btn btn-outline-warning" href="{{ $user->log_url }}" target="_blank" title="View Logs">
                <i class="fa fa-clipboard"></i>
            </a>
        @endcan
    @endif

    @can('create', App\Models\User::class)
        <a href="{{ route('admin.users.create') }}" class="btn btn-outline-primary btn-icon" title="Add New">
            <i class="fa fa-plus"></i>
        </a>
    @endcan

    @can('viewAny', App\Models\User::class)
        <a href="{{ route('admin.users.index') }}" class="btn btn-outline-primary btn-icon" title="List All">
            <i class="fa fa-list"></i>
        </a>
    @endcan
</div>
