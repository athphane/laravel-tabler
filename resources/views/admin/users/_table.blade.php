@component('admin.components.table', [
        'model' => 'users',
        'no_pagination' => ! empty($no_pagination),
    ])

    @slot('bulk_form_open')
        {!! Form::open(['route' => 'admin.users.bulk', 'method' => 'PUT']) !!}
    @endslot

    @slot('bulk_form')
        @include('admin.users._bulk')
    @endslot

    @slot('titles')
        <th data-sort-field="name">{{ __('Name') }} <i class="fa fa-{{ add_sort_class('name') }}"></i></th>
        <th data-sort-field="email">{{ __('Email') }} <i class="fa fa-{{ add_sort_class('email') }}"></i></th>
        <th data-sort-field="role">{{ __('Role') }} <i class="fa fa-{{ add_sort_class('role') }}"></i></th>
        <th class="w-1"></th>
    @endslot

    @slot('rows')
        @if($users->isEmpty())
            <tr>
                <td colspan="4">{{ __('No matching users found.') }}</td>
            </tr>
        @else
            @include('admin.users._list')
        @endif
    @endslot

    @slot('pagination')
        {{ $users->links('admin.components.paginator') }}
    @endslot
@endcomponent
