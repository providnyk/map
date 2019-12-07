 <!-- Sidebar content -->
    <div class="sidebar-content">

        <!-- Main navigation -->
        <div class="card card-sidebar-mobile">
            <ul class="nav nav-sidebar" data-nav-type="accordion">

                <!-- Main -->
                <li class="nav-item-header"><div class="text-uppercase font-size-xs line-height-xs">{!! trans('menu.menu') !!}</div> <i class="icon-menu" title="Main"></i></li>

                @php
                $menu_title = 'entertainment';
                $menu_icon = 'fa fa-sign-language';
                $menu_list = ['festivals' => 'icon-music', 'partners' => 'fa fa-handshake-o', 'events' => 'icon-calendar', 'presses' => 'icon-newspaper', 'news' => 'fa fa-globe'];
                @endphp
                @include('admin.common._menu_group')

                @php
                $menu_title = 'materials';
                $menu_icon = 'fa fa-file-image-o';
                $menu_list = ['designs' => 'icon-books', 'books' => 'icon-books', 'galleries' => 'icon-images2', 'sliders' => 'fa fa-picture-o', 'media' => 'icon-youtube'];
                @endphp
                @include('admin.common._menu_group')

                @php
                $menu_title = 'people';
                $menu_icon = 'fa fa-address-book';
                $menu_list = ['users' => 'icon-users2', 'artists' => 'icon-mic2'];
                @endphp
                @include('admin.common._menu_group')

                @php
                $menu_title = 'lists';
                $menu_icon = 'fa fa-list';
                $menu_list = ['categories' => 'icon-list2', 'places' => 'icon-pin-alt', 'cities' => 'icon-city', 'vocations' => 'icon-headset', 'professions' => 'fa fa-briefcase'];
                @endphp
                @include('admin.common._menu_group')

                @php
                $menu_title = 'website';
                $menu_icon = 'fa fa-cogs';
				$menu_list = ['settings' => 'fa fa-cog', 'texts' => 'icon-file-text2', 'pages' => 'icon-versions'];
                @endphp
                @include('admin.common._menu_group')

                <!-- /main -->
            </ul>
        </div>
        <!-- /main navigation -->

    </div>
    <!-- /sidebar content -->