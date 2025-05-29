@extends('layouts.user')

@section('title')
{{ MODULE_TITLE }}
@endsection

@section('content')
{{ BS::box_begin(MODULE_TITLE) }}
  @if(request()->get('not_existing'))
  {{
    BS::info(
      'NIK tidak ada/belum terdaftar. '
      .'<a href="'.route('pasien.add', ['nik' => request()->get('nik')]).'">Klik disini untuk mendaftarkan pasien baru</a>.'
    )
  }}
  <hr>
  @elseif($pasien !== null)
  {{
    BS::info(
      'NIK telah terdaftar atas nama '.($pasien->name ?? '').'. '
      .'<a href="'.route(MODULE.'.add', ['pasien_id' => $pasien->id]).'">Klik disini untuk tambah Follow Up</a>.'
    )
  }}
  {{ DT::view() }}
  <hr>
  @endif
  @php
    FORM::setup([
      'action' => $form_action,
      'submit' => 'Cari'
    ]);
    //FORM::set_var($default);

    FORM::row(
      'NIK',
      BS::textbox([
        'name' => 'nik',
        'required' => true,
      ], false)
    );

    FORM::show();
  @endphp
{{ BS::box_end() }}
@endsection
