@extends('layouts.user')

@section('title')
{{ $page_title ?? '' }}
@endsection

@section('content')
{{ BS::box_begin($page_title ?? '') }}
<p class="pull-right">
  {{ BS::button('Add New', $add_action) }}
</p>
<br><br>
{{ DT::view() }}
{{ BS::box_end() }}
@endsection
