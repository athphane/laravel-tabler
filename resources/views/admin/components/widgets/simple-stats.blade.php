<div class="card card-sm">
    <div class="card-body">
        <div class="row align-items-center">
            <div class="col-auto">
                <span class="bg-{{ $stat['color'] ?? 'primary' }} text-white avatar">
                    <i class="fa {{ $stat['icon'] ?? '' }} fa-lg"></i>
                </span>
            </div>
            <div class="col">
                <div class="font-weight-medium">
                    {{ $stat['title'] ?? '' }}
                </div>
            </div>
        </div>
    </div>
</div>
