@php
    $menu_items = [
        [
            'name' => __('User Management'),
            'icon' => 'fa-users',
            'url' => route('admin.users.user-management'),
            'permission' => ['index_users', 'index_roles']
        ],
        [
            'name' => __('Bulk SMS'),
            'icon' => 'fa-comments',
            'controller' => 'BulkSms',
            'permission' => 'send_sms'
        ],
        [
            'name' => __('Setting'),
            'icon' => 'fa-cog',
            'items' => [
                ['name' => __('Users'), 'icon' => 'fa-users', 'permission' => 'index_users', 'url' => route('admin.users.index')],
                ['name' => __('Roles'), 'icon' => 'fa-user-lock', 'permission' => 'index_roles', 'url' => route('admin.roles.index')],
            ]
        ],
    ];
@endphp
<div class="navbar-expand-md">
    <div class="collapse navbar-collapse" id="navbar-menu">
        <div class="navbar navbar-light">
            <div class="container-xl">
                <ul class="navbar-nav">
                    <li class="nav-item {{ if_route('admin.dashboard') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('admin.dashboard') }}" >
                            <span class="nav-link-icon d-md-none d-lg-inline-block">
                                <i class="icon fa fa-home"></i>
                            </span>
                            <span class="nav-link-title">
                              {{ __('Dashboard') }}
                            </span>
                        </a>
                    </li>

                    @php
                        $curr_controller = \Illuminate\Support\Str::replaceFirst('Controller', '', class_basename(current_controller()));
                    @endphp
                    @foreach($menu_items as $menu_item)
                        @php
                            $children = collect($menu_item['items'] ?? []);

                            // get the permissions
                            $permissions = $menu_item['permission'] ?? null;

                            if (empty($permissions)) {
                                $permissions = $children->pluck('permission')->all();
                            }
                        @endphp

                        @if(auth()->user()->hasAnyPermission($permissions))
                        @php
                            $active = false;
                            $li_class = '';
                            $controller = $menu_item['controller'] ?? '';
                            $url = empty($controller) ? ($menu_item['url'] ?? '')
                                : action('App\\Http\\Controllers\\Admin\\'.$controller.'Controller@index');

                            if ($children->isNotEmpty()) {
                                $active = $children->pluck('controller')->contains($curr_controller) ||
                                    $children->reduce(function ($carry, $item) {
                                        return $carry || ($item['active'] ?? false);
                                    }, false);

                                $li_class .= 'dropdown';
                                if ($active) {
                                    $li_class .= ' active';
                                }

                            } else {
                                $active = $curr_controller == $controller || ($menu_item['active'] ?? false);
                                if ($active) {
                                    $li_class .= 'active';
                                }
                            }
                        @endphp
                        <li class="nav-item {{ $li_class ?? '' }}">
                            @if($children->isNotEmpty())
                            <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" role="button" aria-expanded="false" >
                            @else
                            <a class="nav-link" href="{{ $url }}" >
                            @endif
                                <span class="nav-link-icon d-md-none d-lg-inline-block">
                                    <i class="icon fa {{ $menu_item['icon'] }}"></i>
                                </span>
                                <span class="nav-link-title">
                                    {{ $menu_item['name'] }}
                                </span>
                            </a>
                            @if($children->isNotEmpty())
                                <div class="dropdown-menu">
                                    <div class="dropdown-menu-columns">
                                        @foreach($children->chunk(5) as $children_chunk)
                                            <div class="dropdown-menu-column">
                                                @foreach($children_chunk as $sub_item)
                                                    @if(auth()->user()->hasAnyPermission($sub_item['permission']))
                                                    @php
                                                    $controller = $sub_item['controller'] ?? '';
                                                    $sub_url = $sub_item['url'] ?? '';
                                                    $sub_active_class = 'dropdown-item';

                                                    if (empty($sub_url) && $controller) {
                                                        $sub_url = action('App\\Http\\Controllers\\Admin\\'.$controller.'Controller@index');
                                                    }

                                                    $sub_active = ($controller && $curr_controller == $controller) ||
                                                        ($sub_item['active'] ?? false);

                                                    if ($sub_active) {
                                                        $sub_active_class .= ' active';
                                                    }
                                                    @endphp

                                                    <a class="{{ $sub_active_class }}" href="{{ $sub_url }}" >
                                                        {{ $sub_item['name'] }}
                                                    </a>
                                                    @endif
                                                @endforeach
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                        </li>
                        @endif
                    @endforeach
                </ul>
                <div class="my-2 my-md-0 flex-grow-1 flex-md-grow-0 order-first order-md-last">
                    <form action="." method="get">
                        <div class="input-icon">
                    <span class="input-icon-addon">
                      <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><circle cx="10" cy="10" r="7" /><line x1="21" y1="21" x2="15" y2="15" /></svg>
                    </span>
                            <input type="text" class="form-control" placeholder="Search…" aria-label="Search in website">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
