@foreach($data as $item)
    <h4 class="mb-3 text-muted">{{ $item['heading'] }}</h4>
    @php
        $links = collect($item['links']);
    @endphp
    <ul class="list-unstyled">
        @foreach($links as $link)
            @if(auth()->user()->can($link['permission']))
                @php
                    $class = 'secondary';

                    if (URL::current() == $link['url']) {
                        $class = 'primary';
                    }
                @endphp
            <a class="btn btn-pill btn-{{ $class }} btn-block w-100 mb-2"
               href="{{ $link['url'] }}"><i class="fa fa-lock"></i> {{ $link['name'] }}</a>
            @endif
        @endforeach
    </ul>
@endforeach
