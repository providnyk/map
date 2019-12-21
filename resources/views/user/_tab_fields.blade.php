@foreach ($a_fields AS $s_field_name => $s_field_type)
@include('user._form_'.$s_field_type, ['name' => $s_field_name,])
@endforeach
