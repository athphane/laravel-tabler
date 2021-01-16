@foreach($roles as $role)
    @component('admin.components.table-row', [
        'model' => 'roles',
        'model_id' => $role->id,
        'no_checkbox' => ! empty($no_checkbox),
    ])

        @slot('columns')
            <td data-label="Name" class="font-weight-medium">
                {{ $role->name }}
            </td>
            <td data-label="Description">
                {{ $role->description }}
            </td>
            <td>
                <div class="btn-group">
                    <a href="{{ route('admin.roles.edit', $role) }}"><i class="fa fa-pencil fa-lg text-warning mx-1"></i></a>
                    <a href="{{ route('admin.roles.show', $role) }}"><i class="fa fa-eye fa-lg text-success mx-1"></i></a>
                    <a href="#" class="delete-link"
                       data-request-url="{{ route('admin.roles.destroy', $role) }}"
                       data-redirect-url="{{ Request::fullUrl() }}">
                        <i class="fa fa-trash fa-lg text-danger mx-1"></i>
                    </a>
                </div>
            </td>
        @endslot

    @endcomponent
@endforeach
