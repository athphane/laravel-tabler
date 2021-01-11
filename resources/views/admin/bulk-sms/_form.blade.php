<div class="card">
    <div class="card-body">
        @component('admin.components.form.text-input', [
            'name' => 'sender',
            'title' => __('Send As'),
            'placeholder' => auth()->user()->name,
        ])
        @endcomponent

        @component('admin.components.form.textarea-input', [
            'name' => 'to',
            'placeholder' => __('Enter each number on a new line...')
        ])
        @endcomponent

        @component('admin.components.form.textarea-input', [
            'name' => 'message',
            'placeholder' => __('How much wood would a woodchuck chuck if a woodchuck could chuck wood?')
        ])
        @endcomponent

        <div class="form-footer">
            <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
        </div>
    </div>
</div>
