<?php

namespace App\Modules\Pasien\Controllers\Traits;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Modules\Pasien\Controllers\Traits\OAB\{
    OAB_anamnesisTrait,
    OAB_keluhan_tambahanTrait,
    OAB_faktor_resikoTrait,
    OAB_riwayat_pengobatan_1_blnTrait,
    OAB_riwayat_pengobatan_lutsTrait,
    OAB_riwayat_operasi_urologiTrait,
    OAB_riwayat_operasi_non_urologiTrait,
    OAB_riwayat_radiasiTrait,
    OAB_sistem_skorTrait,
    OAB_kuesioner_oabssTrait,
    OAB_kuesioner_qolTrait,
    OAB_kuesioner_fsfiTrait,
    OAB_kuesioner_iiefTrait,
    OAB_kuesioner_ehsTrait,
    OAB_kuesioner_bladder_diaryTrait,
    OAB_pemeriksaan_fisikTrait,
    OAB_pemeriksaan_laboratoriumTrait,
    OAB_penunjang_uroflowmetriTrait,
    OAB_penunjang_urodinamikTrait,
    OAB_pemeriksaan_imagingTrait,
    OAB_penunjangTrait,
    OAB_terapiTrait,
    OAB_terapi_modifikasi_gaya_hidupTrait,
};
use BS;
use DT;
use FORMAT;

trait OABTrait {

    use OAB_anamnesisTrait;
    use OAB_keluhan_tambahanTrait;
    use OAB_faktor_resikoTrait;
    use OAB_riwayat_pengobatan_1_blnTrait;
    use OAB_riwayat_pengobatan_lutsTrait;
    use OAB_riwayat_operasi_urologiTrait;
    use OAB_riwayat_operasi_non_urologiTrait;
    use OAB_riwayat_radiasiTrait;
    use OAB_sistem_skorTrait;
    use OAB_kuesioner_oabssTrait;
    use OAB_kuesioner_qolTrait;
    use OAB_kuesioner_fsfiTrait;
    use OAB_kuesioner_iiefTrait;
    use OAB_kuesioner_ehsTrait;
    use OAB_kuesioner_bladder_diaryTrait;
    use OAB_pemeriksaan_fisikTrait;
    use OAB_pemeriksaan_laboratoriumTrait;
    use OAB_penunjang_uroflowmetriTrait;
    use OAB_penunjang_urodinamikTrait;
    use OAB_pemeriksaan_imagingTrait;
    use OAB_penunjangTrait;
    use OAB_terapiTrait;
    use OAB_terapi_modifikasi_gaya_hidupTrait;

}
