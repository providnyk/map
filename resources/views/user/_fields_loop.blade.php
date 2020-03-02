@foreach ($a_fields AS $s_field_name => $s_field_type)
@if ($s_field_name != 'trans' && $s_field_name != 'published')
@include('layouts._form_control', ['control' => $s_field_type, 'name' => $s_field_name])
@endif
@endforeach
