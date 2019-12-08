                @foreach($menu_title AS $i_idx => $menu_name)
                <li class="nav-item nav-item-submenu {!! in_array(request()->segment(2), $menu_list[$i_idx]) ? 'nav-item-open' : '' !!}">
                    <a href="#" class="nav-link"><i class="{{ $menu_icon[$i_idx] }}"></i><span>{!! trans('menu.' . $menu_name) !!}</span></a>
                    <ul class="nav nav-group-sub" data-submenu-title="Layouts">
                        @foreach($menu_list[$i_idx] AS $i_cnt => $menu_item)
                        <li class="nav-item">
                            <a href="{!! route('admin.' . $menu_item) !!}" class="nav-link {!! in_array(request()->segment(2), [$menu_item]) ? 'active' : '' !!}">
                                <i class="{!! trans('user/' . $menu_item . '.names.ico') !!}"></i><span>{!! trans('user/' . $menu_item . '.names.plr') !!}</span>
                            </a>
                        </li>
                        @endforeach
                    </ul>
                </li>
                @endforeach
