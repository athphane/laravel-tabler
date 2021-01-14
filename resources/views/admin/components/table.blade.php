<div class="card">
    <div class="table-responsive">
        @if(empty($no_bulk))
            {{ $bulk_form_open ?? '' }}
            <div class="p-3">
                {{ $bulk_form ?? '' }}
            </div>
        @endif
        <table class="table table-hover table-vcenter table-mobile-md card-table" data-form-sortable="#{{ $filter_id ?? 'filter' }}">
            <thead>
            <tr>
                <th>
                    <input id="{{ ($model ?? '').'-select-all' }}" class="form-check-input"
                           data-all="{{ $model ?? '' }}" value="1" type="checkbox"/>
                </th>
                {{ $titles ?? '' }}
            </tr>
            </thead>
            <tbody>
            <tr>
                {{ $rows ?? '' }}
            </tr>
            </tbody>
        </table>
        @if(empty($no_bulk) )
            {{ $bulk_form_close ?? Form::close() }}
        @endif
    </div>

    @if( empty($no_pagination) )
        <div class="card-footer d-flex align-items-center">
            {{ $pagination ?? '' }}
        </div>
    @endif
</div>

