<div class="empty">
    <div class="empty-icon">
        <i class="fa {{ $icon ?? 'fa-file' }} fa-3x"></i>
    </div>
    <p class="empty-title">{{ __('Looks like there are no :model_type in here...', ['model_type' => $model_type ?? __('items')]) }}</p>
    <p class="empty-subtitle text-muted">
        {{ __('Let\'s create some new :model_type.', ['model_type' => $model_type ?? __('items') ]) }}
    </p>
    <div class="empty-action">
        <a href="{{ $create_action }}" class="btn btn-primary">
            <i class="icon fa fa-plus"></i>
            {{ __('Create') }}
        </a>
    </div>
</div>
