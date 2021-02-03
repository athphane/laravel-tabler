@component('admin.components.filter')
<div class="row">
    <div class="col-md-4">
        @component('admin.components.form.text-input', [
            'name' => 'search',
            'value' => isset($search) ? $search : old('search', Request::get('search')),
            'hide_errors_list' => true
        ])
        @endcomponent
    </div>

    <div class="col-md-2">
        @php
        $amounts = [10 => 10, 20 => 20, 50 => 50, 100 => 100, 500 => 500];
        $selected_per_page = $per_page ?? Request::input('per_page', 20);

        if (! in_array($selected_per_page, $amounts)) {
            $amounts[$selected_per_page] = $selected_per_page;
        }
        @endphp

        @component('admin.components.form.select2', [
            'name' => 'per_page',
            'values' => $amounts,
            'selected_value' => $selected_per_page
        ])
        @endcomponent
        </div>
</div>

<button class="btn btn-success" type="submit">
    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-search" width="44" height="44" viewBox="0 0 24 24" stroke-width="1.5" stroke="#ffffff" fill="none" stroke-linecap="round" stroke-linejoin="round">
        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
        <circle cx="10" cy="10" r="7" />
        <line x1="21" y1="21" x2="15" y2="15" />
    </svg>
    {{ __('Filter') }}
</button>

<a href="{{ route('admin.roles.index') }}" class="btn btn-secondary">
    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-square-x" width="44" height="44" viewBox="0 0 24 24" stroke-width="1.5" stroke="#ffffff" fill="none" stroke-linecap="round" stroke-linejoin="round">
        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
        <rect x="4" y="4" width="16" height="16" rx="2" />
        <path d="M10 10l4 4m0 -4l-4 4" />
    </svg>
    {{ __('Clear') }}
</a>
@endcomponent
