                <li class="nav-item nav-item-submenu {!! in_array(request()->segment(2), array_keys($menu_list)) ? 'nav-item-open' : '' !!}">
                    <a href="#" class="nav-link"><i class="{{ $menu_icon }}"></i><span>{!! trans('menu.' . $menu_title) !!}</span></a>
                    <ul class="nav nav-group-sub" data-submenu-title="Layouts">
                        @foreach($menu_list as $menu_item => $menu_icon)
                        <li class="nav-item">
                            <a href="{!! route('admin.' . $menu_item) !!}" class="nav-link {!! in_array(request()->segment(2), [$menu_item]) ? 'active' : '' !!}">
                                <i class="{!! $menu_icon !!}"></i><span>{!! trans('menu.' . $menu_item) !!}</span>
                            </a>
                        </li>
                        @endforeach
                    </ul>
                </li>
