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

    FORM::row(':header', 'Penghambat alfa');
    $temp = '
        Tamsulosin
        Alfuzosin
        Doxazosin
        Terazosin
        Silodosin
    ';
    $x = explode("\n", $temp);
    foreach($x as $v){
        if (trim($v) != '') {
            $caption = trim($v);
            $field = strtolower(str_replace(array(' ', '-'), '_', $caption));

            FORM::row(
                $caption,
                BS::radio_ya_tidak([
                    'name' => $field,
                    'toggle_div' => true,
                ], false)
            );

            FORM::row(':merge',
                '<div id="div_'.$field.'_ya" class="indent1">'
                .'Lamanya : '
                .BS::number(
                    ['name' => $field.'_hari', 'inline' => true],
                    false
                )
                .' Hari &nbsp; &nbsp; '
                .BS::number(
                    ['name' => $field.'_bulan', 'inline' => true],
                    false
                )
                .' Bulan &nbsp; &nbsp; '
                .BS::number(
                    ['name' => $field.'_tahun', 'inline' => true],
                    false
                )
                .' Tahun'
                .'</div>'
            );
            if (isset($default[$field]) && $default[$field] == 'Ya') {
            } else {
                BS::jquery_ready("$('#div_{$field}_ya').hide();");
            }
        }
    }

    FORM::row(':header', '5 &mdash; ARI');
    $temp = '
        Finasteride
        Dutasteride
    ';
    $x = explode("\n", $temp);
    foreach($x as $v){
        if (trim($v) != '') {
            $caption = trim($v);
            $field = strtolower(str_replace(array(' ', '-'), '_', $caption));

            FORM::row(
                $caption,
                BS::radio_ya_tidak([
                    'name' => $field,
                    'toggle_div' => true,
                ], false)
            );
            FORM::row(':merge',
                '<div id="div_'.$field.'_ya" class="indent1">'
                .'Lamanya : '
                .BS::number(
                    ['name' => $field.'_bulan', 'inline' => true],
                    false
                )
                .' Bulan'
                .'</div>'
            );
            if (isset($default[$field]) && $default[$field] == 'Ya') {
            } else {
                BS::jquery_ready("$('#div_{$field}_ya').hide();");
            }
        }
    }

    FORM::row(':header', 'PDE-5 inhibitor');
    $temp = '
        PDE-5 inhibitor
    ';
    $x = explode("\n", $temp);
    foreach($x as $v){
        if (trim($v) != '') {
            $caption = trim($v);
            $field = strtolower(str_replace(array(' ', '-'), '_', $caption));

            FORM::row(
                $caption,
                BS::radio_ya_tidak([
                    'name' => $field,
                    'toggle_div' => true,
                ], false)
            );
            FORM::row(':merge',
                '<div id="div_'.$field.'_ya" class="indent1">'
                .'Tadalafil : '
                .BS::radio_ya_tidak([
                    'name' => 'tadalafil',
                    'toggle_div' => true,
                ], false)
                .'<div id="div_tadalafil_ya" class="indent1">'
                .'Lamanya : '
                .BS::number(
                    ['name' => 'tadalafil_bulan', 'inline' => true],
                    false
                )
                .' Bulan'
                .'</div>'
                .'</div>'
            );
            if (isset($default['tadalafil']) && $default['tadalafil'] == 'Ya') {
            } else {
                BS::jquery_ready("$('#div_tadalafil_ya').hide();");
            }

            if (isset($default[$field]) && $default[$field] == 'Ya') {
            } else {
                BS::jquery_ready("$('#div_{$field}_ya').hide();");
            }
        }
    }

    FORM::row(':header', 'Antimuskarinik');
    $temp = '
        Solifenacin
        Imidafenacin
        Tolterodine
        Propiverine
        Flavoxate
    ';
    $x = explode("\n", $temp);
    foreach($x as $v){
        if (trim($v) != '') {
            $caption = trim($v);
            $field = strtolower(str_replace(array(' ', '-'), '_', $caption));

            FORM::row(
                $caption,
                BS::radio_ya_tidak([
                    'name' => $field,
                    'toggle_div' => true,
                ], false)
            );
            FORM::row(':merge',
                '<div id="div_'.$field.'_ya" class="indent1">'
                .'Lamanya : '
                .BS::number(
                    ['name' => $field.'_bulan', 'inline' => true],
                    false
                )
                .' Bulan'
                .'</div>'
            );
            if (isset($default[$field]) && $default[$field] == 'Ya') {
            } else {
                BS::jquery_ready("$('#div_{$field}_ya').hide();");
            }
        }
    }

    FORM::row(':header', 'Beta 3 agonis');
    $temp = '
        Mirabegron
    ';
    $x = explode("\n", $temp);
    foreach($x as $v){
        if (trim($v) != '') {
            $caption = trim($v);
            $field = strtolower(str_replace(array(' ', '-'), '_', $caption));

            FORM::row(
                $caption,
                BS::radio_ya_tidak([
                    'name' => $field,
                    'toggle_div' => true,
                ], false)
            );
            FORM::row(':merge',
                '<div id="div_'.$field.'_ya" class="indent1">'
                .'Lamanya : '
                .BS::number(
                    ['name' => $field.'_bulan', 'inline' => true],
                    false
                )
                .' Bulan'
                .'</div>'
            );
            if (isset($default[$field]) && $default[$field] == 'Ya') {
            } else {
                BS::jquery_ready("$('#div_{$field}_ya').hide();");
            }
        }
    }

    FORM::show();
  @endphp
  {{ BS::box_end() }}
@endsection

@section('jquery_ready')
// Vars
const disable_all = {{ USER_IS_SUB ? 'false' : 'true' }};

// Init
if (disable_all) form_disable_all_fields('{{ MODULE }}');
@endsection
