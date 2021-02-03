<div class="card mb-4">
    <div class="card-body">
        @component('admin.components.form.text-input')
        @endcomponent
        @component('admin.components.form.text-input', ['name' => 'description'])
        @endcomponent
    </div>
</div>

<div class="card">
    <div class="card-body">
        <h4 class="card-title">{{ __('Permissions') }}</h4>

        @php
            $permissions = $permissions->groupBy('model');
        @endphp
        @include('errors._list', ['error' => $errors->get('permissions')])
        @foreach($permissions as $model => $model_permissions)
        <div class="mb-4">
            <div class="form-label">{{ (new \Jawira\CaseConverter\Convert($model))->fromSnake()->toTitle() }}</div>
            @php
                $per_group = ceil($model_permissions->count() / 3);
            @endphp

            @foreach( $model_permissions->chunk(3) as $chunk)
                <div class="row">
                    @foreach($chunk as $permission)
                        @php
                            $checked = (isset($role) && $role->hasPermissionTo($permission)) || in_array($permission->id, old('permissions', [])) ? ' checked' : '';
                        @endphp
                        <div class="col-md-4">
                            <label class="form-check">
                                <input class="form-check-input" name="permissions[]" id="{{ '$permission-'.$permission->id }}" value="{{ $permission->id }}" type="checkbox" {{ $checked }} />
                                <span class="form-check-label">{{ $permission->description }}</span>
                            </label>
                        </div>
                    @endforeach
                </div>
            @endforeach
        </div>
        @endforeach
    </div>
</div>

<button class="btn btn-primary mt-3">
    {{ __('Save') }}
</button>
