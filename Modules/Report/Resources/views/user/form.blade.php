@extends('user.form')

@section('script')
<script type="text/javascript">
let s_route = '{!! route('api.points.issues', ':point_id') !!}';

$(document).ready(function () {

	// reset dependent dropdown on page initialization
	$("#issue_id").select2({
//		placeholder: $('#point_id').data('placeholder'),
		data: {},
	});

	$('#point_id').change( function() {
		$(this).find(":selected").each(function () {
			var i_point_id = $(this).val();
/*
$("#issue_id").select2(settings({
	url: s_route.replace(':point_id', i_point_id),
	filter: 'title',
//    multiple: true,
//    vocation_id: $(e.currentTarget).closest('.vocation').attr('data-vocation-id'),
}));
*/

$("#issue_id").select2({
	ajax: {
		url: s_route.replace(':point_id', i_point_id),
		dataType: 'json',
		data: function (params) {
			var query = {
			search: params.term,
			point: i_point_id,
			}
			// Query parameters will be ?search=[term]&point=[id]
			return query;
		},
	},
});

		});
	});
});

</script>
@append

