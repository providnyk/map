<style>
.card_group {
	width:200px; height:200px; display:block; float:left;
}
.card_group li {
	list-style: none;
}
.card_group .top_level {
	display: block;
}
.card_group .sub_level {
	display: none;
}
.card_group:hover>div.top_level {
	display: none;
}
.card_group:hover>div.sub_level {
	display: block;
}
.top_level {
	padding-top:20%;text-align: center;
}
.sub_level {
	text-align: left; padding-left: 20px;
}
.sub_level a {
	color: white
}
.sub_level i {
	padding-right: 10px;
}
</style>

<div class="card_group" style="background-color:{{ $menu_color }};">
	<div class="top_level" style="">
		<i style="font-size:6em" class="{{ $menu_icon }}"></i>
		<br />
		<font style="font-size:2em">{!! trans('menu.' . $menu_title) !!}</font>
	</div>
	<div class="sub_level" style="">
		@foreach($menu_list as $menu_item => $menu_icon)
		<a href="{!! route('admin.' . $menu_item) !!}" class="nav-link">
		<i class="{!! $menu_icon !!}"></i><span>{!! trans('menu.' . $menu_item) !!}</span>
		</a>
		@endforeach
	</div>
</div>