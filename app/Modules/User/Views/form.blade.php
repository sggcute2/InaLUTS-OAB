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
      'Username',
      BS::textbox([
        'name' => 'username',
        'required' => true,
      ], false)
    );
    FORM::row(
      'Password',
      BS::textbox([
        'name' => 'password',
      ], false)
      .(ADD?'':'Kosongkan jika tidak ada perubahan Password.')
    );
    FORM::row(
      'Full Name',
      BS::textbox([
        'name' => 'name',
        'required' => true,
      ], false)
    );
    FORM::row(
      'User Type',
      BS::select2([
        'name' => 'type',
        'data' => $user_type,
        'with_blank' => false,
      ], false)
    );
    FORM::row(
      'Rumah Sakit',
      BS::select2([
        'name' => 'rumah_sakit_id',
        'data' => $rumah_sakit,
        'with_blank' => false,
      ], false)
    );
    FORM::row(
      'Departemen',
      BS::select2([
        'name' => 'departemen_id',
        'data' => $departemen,
        'with_blank' => false,
      ], false)
    );

    FORM::show();
  @endphp
  {{ BS::box_end() }}
@endsection

@section('jquery_ready')
$('#type').on('change', function (e) {
  const v = $(this).val();
  if (v == UserType.NationalCoordinator) {
    $('#rumah_sakit_id').parent().hide();
    $('#departemen_id').parent().hide();
  } else {
    $('#rumah_sakit_id').parent().show();
    if (v == UserType.RegionalCoordinator) {
      $('#departemen_id').parent().show();
    } else {
      $('#departemen_id').parent().hide();
    }
  }
});

$('#type').trigger('change');
@endsection
