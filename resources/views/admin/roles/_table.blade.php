@component('admin.components.table', [
        'model' => 'roles',
        'no_pagination' => ! empty($no_pagination),
    ])

    @slot('bulk_form_open')
        {!! Form::open(['route' => 'admin.roles.bulk', 'method' => 'PUT']) !!}
    @endslot

    @slot('bulk_form')
        @include('admin.roles._bulk')
    @endslot

    @slot('titles')
        <th data-sort-field="name">{{ __('Name') }} <i class="fa fa-{{ add_sort_class('name') }}"></i></th>
        <th data-sort-field="description">{{ __('Description') }} <i class="fa fa-{{ add_sort_class('description') }}"></i></th>
        <th class="w-1"></th>
    @endslot

    @slot('rows')
        @if($roles->isEmpty())
            <tr>
                <td colspan="4">{{ __('No matching roles found.') }}</td>
            </tr>
        @else
            @include('admin.roles._list')
        @endif
    @endslot

    @slot('pagination')
        {{ $roles->links('admin.components.paginator') }}
    @endslot
@endcomponent
