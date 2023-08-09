@extends('layouts.user')

@section('title')
{{ MODULE_TITLE }}
@endsection

@section('content')
{{ BS::box_begin(MODULE_TITLE) }}
<p class="pull-right">
  @can(MODULE.'-add')
  {{ BS::button('Add New', route(MODULE.'.add')) }}
  @endcan
</p>
<br><br>
{{ DT::view() }}
{{ BS::box_end() }}
@endsection
