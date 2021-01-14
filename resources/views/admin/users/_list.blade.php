@foreach($users as $user)
    @component('admin.components.table-row', [
        'model' => 'users',
        'model_id' => $user->id,
        'no_checkbox' => ! empty($no_checkbox),
    ])

        @slot('columns')
            <td data-label="Name">
                <div class="d-flex py-1 align-items-center">
                    <span class="avatar me-2">{{ $user->initials }}</span>
                    <div class="flex-fill">
                        <div class="font-weight-medium">{{ $user->name }}</div>
                        <div class="text-muted"><a href="#" class="text-reset">{{ $user->email }}</a></div>
                    </div>
                </div>
            </td>
            <td data-label="Title">
                <div>VP Sales</div>
                <div class="text-muted">Business Development</div>
            </td>
            <td class="text-muted" data-label="Role">
                User
            </td>
            <td>
                <div class="btn-list flex-nowrap">
                    <a href="#" class="btn btn-white">
                        Edit
                    </a>
                    <div class="dropdown">
                        <button class="btn dropdown-toggle align-text-top" data-bs-boundary="viewport"
                                data-bs-toggle="dropdown">
                            Actions
                        </button>
                        <div class="dropdown-menu dropdown-menu-end">
                            <a class="dropdown-item" href="#">
                                Action
                            </a>
                            <a class="dropdown-item" href="#">
                                Another action
                            </a>
                        </div>
                    </div>
                </div>
            </td>
        @endslot

    @endcomponent
@endforeach
