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
      'Kode Pasien',
      $default['code']
    );
    FORM::row(
      'NIK',
      BS::textbox([
        'name' => 'nik',
        'required' => true,
      ], false)
      .'<button type="button" id="check_nik" class="btn btn-success" style="margin-top:8px">Check NIK</button>'
    );
    FORM::row(
      'Nama '.MODULE_TITLE,
      BS::textbox([
        'name' => 'name',
        'required' => true,
      ], false)
    );
    FORM::row(
      'Jenis kelamin',
      BS::radio_array([
        'name' => 'jenis_kelamin_id',
        'data' => array(
          array(
            'value' => '1',
            'text' => 'Laki-laki',
          ),
          array(
            'value' => '2',
            'text' => 'Perempuan',
          ),
        ),
      ], false)
    );
    FORM::row(
      'Tanggal Lahir',
      BS::datepicker([
        'name' => 'lahir_date',
        'required' => true,
      ], false)
    );
    FORM::row(
      'Propinsi',
      BS::select2([
        'name' => 'propinsi_id',
        'data' => $m_propinsi,
        'required' => true,
      ], false)
    );
    FORM::row(
      'Kabupaten/Kota',
      BS::select2([
        'name' => 'kabupaten_id',
        'data' => $m_kabupaten,
        'required' => true,
      ], false)
    );
    FORM::row(
      'Alamat',
      BS::textarea([
        'name' => 'address',
      ], false)
    );
    FORM::row(
      'Dokter Pemeriksa',
      BS::textbox([
        'name' => 'dokter_pemeriksa',
      ], false)
    );
    FORM::row(
      'Tanggal pemeriksaan',
      BS::datepicker([
        'name' => 'pemeriksaan_date',
      ], false)
    );
    FORM::row(
      'Tanggal pengisian data oleh Data Collector',
      BS::datepicker([
        'name' => 'input_date',
      ], false)
    );

    FORM::row2(
      'Rumah Sakit',
      USER_RUMAH_SAKIT_NAME
    );
    FORM::row2(
      'Unit Pelayanan',
      BS::select2([
        'name' => 'unit_pelayanan_id',
        'data' => $m_unit_pelayanan,
        'with_blank' => true,
      ], false)
    );
    FORM::row2(
      'Tinggi Badan (cm)',
      BS::textbox([
        'name' => 'tb',
        'required' => true,
      ], false)
    );
    FORM::row2(
      'Berat Badan (kg)',
      BS::textbox([
        'name' => 'bb',
        'required' => true,
      ], false)
    );
    FORM::row2(
      'IMT',
      BS::textbox([
        'name' => 'imt',
        'required' => true,
      ], false)
    );
    FORM::row2(
      'Pendidikan',
      BS::select2([
        'name' => 'pendidikan_id',
        'data' => $m_pendidikan,
        'with_blank' => true,
      ], false)
    );
    FORM::row2(
      'Pekerjaan',
      BS::select2([
        'name' => 'pekerjaan_id',
        'data' => $m_pekerjaan,
        'with_blank' => true,
      ], false)
    );
    FORM::row2(
      'Status Pernikahan',
      BS::select2([
        'name' => 'status_pernikahan_id',
        'data' => $m_status_pernikahan,
        'with_blank' => true,
      ], false)
    );
    FORM::row2(
      'Aktivitas Seksual',
      BS::select2([
        'name' => 'aktivitas_seksual_id',
        'data' => $m_aktivitas_seksual,
        'with_blank' => true,
      ], false)
    );
    FORM::row2(
      'Suku',
      BS::select2([
        'name' => 'suku_id',
        'data' => $m_suku,
        'with_blank' => true,
      ], false)
    );
    FORM::row2(
      'Status Rujukan',
      BS::select2([
        'name' => 'datang_id',
        'data' => $m_datang,
        'with_blank' => true,
      ], false)
    );
    FORM::row2(
      'Jaminan Kesehatan',
      BS::select2([
        'name' => 'jaminan_kesehatan_id',
        'data' => $m_jaminan_kesehatan,
        'with_blank' => true,
      ], false)
    );

    FORM::show();
  @endphp
  {{ BS::box_end() }}
@endsection

@section('jquery_ready')
// Vars
const disable_all = {{ (USER_IS_SUB && $mode != 'detail') ? 'false' : 'true' }};

// Data
const m_propinsi = {!! $m_propinsi !!};
const m_kabupaten = {!! $m_kabupaten !!};

// Functions
function calculate_imt(){
  const bb = $('#bb').val() * 1;
  const tb = $('#tb').val() * 1;
  let imt = 0;
  if (tb) imt = (bb / ((tb / 100) * (tb / 100))).toFixed(2);
  if (isNaN(imt)) imt = 0;
  $('#imt').val(imt);
}

// Behaviour
$('#check_nik').click(function(e) {
  e.preventDefault();
  var nik = $.trim($('#nik').val());

  if (nik != '') {
    $.ajax({
      type: 'POST',
      url: "{{ route('pasien.ajax_check_nik') }}",
      data: {
        nik: nik
      },
      success: function(data) {
        alert(data.success);
      }
    });
  } else {
    alert('NIK Kosong');
  }
});
$('#bb').keyup(function(){
  calculate_imt();
});
$('#tb').keyup(function(){
  calculate_imt();
});
$('#propinsi_id').on('change', function (e) {
  const propinsi_id = $(this).val();
  const filtered = m_kabupaten.filter(v => v.propinsi_id == propinsi_id);
  let new_kabupaten = [];
  for(var i = 0; i < filtered.length; i++) {
    new_kabupaten.push({'id': filtered[i].id, 'text': filtered[i].name});
  }

  $('#kabupaten_id').empty().trigger('change');
  $('#kabupaten_id').select2({data: new_kabupaten}).trigger('change');
});

// Init
calculate_imt();
$('#propinsi_id').change();
@if($default['kabupaten_id'] ?? 0)
  $('#kabupaten_id').val('{{ $default['kabupaten_id'] }}').trigger('change');
@endif
if (disable_all) form_disable_all_fields('{{ MODULE }}');
@endsection
