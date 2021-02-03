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
                        <div class="font-weight-medium">{!! $user->admin_link !!}</div>
                        <div class="text-muted"><a href="#" class="text-reset">{{ $user->email }}</a></div>
                    </div>
                </div>
            </td>
            <td class="text-muted" data-label="Role">
                @if($role = $user->roles->first())
                    {!! $role->admin_link !!}
                @endif
            </td>
            <td>
                <div class="btn-group">
                    <a href="{{ route('admin.users.edit', $user) }}"><i class="fa fa-pencil fa-lg text-warning mx-1"></i></a>
                    <a href="{{ route('admin.users.show', $user) }}"><i class="fa fa-eye fa-lg text-success mx-1"></i></a>
                    <a href="#" class="delete-link"
                       data-request-url="{{ route('admin.users.destroy', $user) }}"
                       data-redirect-url="{{ Request::fullUrl() }}">
                        <i class="fa fa-trash fa-lg text-danger mx-1"></i>
                    </a>
                </div>
            </td>
        @endslot

    @endcomponent
@endforeach
