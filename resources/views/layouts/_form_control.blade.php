@php
include(base_path().'/resources/views/layouts/_form_variables.php');
@endphp
@if (isset($filter) && $filter)
@include('user._filter_' . $control)
@else
@include($theme . '::' . $_env->s_utype . '._form_' . $control)
@endif
