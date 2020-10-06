@section('script')
	<script type="text/javascript">
		a_order = [ 6, "desc" ];
	</script>
@append
@php
$a_columns = [
				'user_name' => 'name'
			];
$a_buttons = [
				'download' => 'xls'
			];
@endphp
@extends('user.list')
