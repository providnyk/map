@foreach ($a_fields AS $s_field_name => $s_field_type)
@include('layouts._form_control', ['control' => $s_field_type, 'name' => $s_field_name])
@endforeach
