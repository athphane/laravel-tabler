@php
    $actions = [];

    //if ( auth()->user()->can('delete_users') ) {
        $actions['delete'] = __('Delete');
    //}
@endphp

@include('admin.components.bulk', ['actions' => $actions, 'model' => 'roles'])
