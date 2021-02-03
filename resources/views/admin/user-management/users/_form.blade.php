<div class="row">
    <div class="col-md-8">
        <div class="card mb-4">
            <div class="card-body">
                @component('admin.components.form.text-input')
                @endcomponent

                @component('admin.components.form.email-input')
                @endcomponent

                @component('admin.components.form.select2', [
                    'name' => 'roles',
                    'multiple' => true,
                    'values' => App\Support\Roles\Role::pluck('description', 'id'),
                    'selected_value' => isset($user) ? $user->roles : old('roles'),
                ])
                @endcomponent
            </div>
        </div>

        <div class="card">
            <div class="card-body card-padding">
                <h4 class="card-title">{{ __('Update Password') }}</h4>
                <div class="row">
                    <div class="col-md-4">
                        @component('admin.components.form.password-input', [
                            'name' => 'password',
                        ])
                        @endcomponent
                    </div>
                    <div class="col-md-4">
                        @component('admin.components.form.password-input', [
                            'name' => 'password_confirmation',
                        ])
                        @endcomponent
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card">
            <div class="card-body">
                Profile photo upload here
            </div>
        </div>
    </div>
</div>

<button class="btn btn-primary mt-3">
    {{ __('Save') }}
</button>
