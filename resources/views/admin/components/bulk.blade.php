@unless( empty($actions) )
    <div class="row">
        <div class="col-lg-3 col-md-8">
            <div class="form-group">
                {!! Form::select('action', ['' => ''] + $actions, '', [
                'class' => add_error_class($errors->has('action') || $errors->has($model), 'select2-basic form-control'),
                'data-placeholder' => __('Bulk Action'),
                'data-allow-clear' => 'true',
                'required' => 'required']) !!}
                @include('errors._list', ['error' => $errors->get('action')])
                @include('errors._list', ['error' => $errors->get($model)])
            </div>
        </div>
        <div class="col-lg-6 col-md-4">
            <div class="button-group">
                <button class="btn btn-danger" type="submit">
                    <i class="fa fa-check"></i> {{ __('Apply') }}
                </button>
            </div>
        </div>
    </div>
    {!! Form::hidden('redirect', Request::fullUrl()) !!}
@endunless
