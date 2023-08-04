@extends('layouts.user')

@section('title')
  {{ $page_title ?? '' }}
@endsection

@section('content')
  {{ BS::box_begin($page_title ?? '') }}
  @php
    FORM::setup([
      'action' => $form_action
    ]);
    FORM::set_var($default);

    FORM::row(
      'Nama '.MODULE_TITLE,
      BS::textbox([
        'name' => 'name',
        'required' => true,
      ], false)
    );

    FORM::show();
  @endphp
  {{ BS::box_end() }}
@endsection
