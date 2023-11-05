<?php

namespace App\Modules\Laporan\Controllers\Traits\OAB;

use App\Modules\Aktivitas_seksual\Models\Aktivitas_seksual;
use App\Modules\Datang\Models\Datang;
use App\Modules\Jaminan_kesehatan\Models\Jaminan_kesehatan;
use App\Modules\Jenis_kelamin\Models\Jenis_kelamin;
use App\Modules\Kabupaten\Models\Kabupaten;
use App\Modules\Pendidikan\Models\Pendidikan;
use App\Modules\Pekerjaan\Models\Pekerjaan;
use App\Modules\Propinsi\Models\Propinsi;
use App\Modules\Rumah_sakit\Models\Rumah_sakit;
use App\Modules\Status_pernikahan\Models\Status_pernikahan;
use App\Modules\Suku\Models\Suku;
use App\Modules\Unit_pelayanan\Models\Unit_pelayanan;
use FORMAT;
use SS;

trait OAB_pasienTrait {

    public function OAB_excel_column_pasien(&$sheet, $c = 0, $y, $pasien)
    {
        $c--;

        $the_id = $pasien->rumah_sakit_id;
        $temp = SS::get('m_rumah_sakit__'.$the_id);
        if ($temp) {
            $rumah_sakit = $temp;
        } else {
            $temp = Rumah_sakit::find($the_id)->name ?? '';
            SS::set('m_rumah_sakit__'.$the_id, $temp);
            $rumah_sakit = $temp;
        }

        $the_id = $pasien->unit_pelayanan_id;
        $temp = SS::get('m_unit_pelayanan__'.$the_id);
        if ($temp) {
            $unit_pelayanan = $temp;
        } else {
            $temp = Unit_pelayanan::find($the_id)->name ?? '';
            SS::set('m_unit_pelayanan__'.$the_id, $temp);
            $unit_pelayanan = $temp;
        }

        $the_id = $pasien->jenis_kelamin_id;
        $temp = SS::get('m_jenis_kelamin__'.$the_id);
        if ($temp) {
            $jenis_kelamin = $temp;
        } else {
            $temp = Jenis_kelamin::find($the_id)->name ?? '';
            SS::set('m_jenis_kelamin__'.$the_id, $temp);
            $jenis_kelamin = $temp;
        }

        $the_id = $pasien->propinsi_id;
        $temp = SS::get('m_propinsi__'.$the_id);
        if ($temp) {
            $propinsi = $temp;
        } else {
            $temp = Propinsi::find($the_id)->name ?? '';
            SS::set('m_propinsi__'.$the_id, $temp);
            $propinsi = $temp;
        }

        $the_id = $pasien->kabupaten_id;
        $temp = SS::get('m_kabupaten__'.$the_id);
        if ($temp) {
            $kabupaten = $temp;
        } else {
            $temp = Kabupaten::find($the_id)->name ?? '';
            SS::set('m_kabupaten__'.$the_id, $temp);
            $kabupaten = $temp;
        }

        $the_id = $pasien->pendidikan_id;
        $temp = SS::get('m_pendidikan__'.$the_id);
        if ($temp) {
            $pendidikan = $temp;
        } else {
            $temp = Pendidikan::find($the_id)->name ?? '';
            SS::set('m_pendidikan__'.$the_id, $temp);
            $pendidikan = $temp;
        }

        $the_id = $pasien->pekerjaan_id;
        $temp = SS::get('m_pekerjaan__'.$the_id);
        if ($temp) {
            $pekerjaan = $temp;
        } else {
            $temp = Pekerjaan::find($the_id)->name ?? '';
            SS::set('m_pekerjaan__'.$the_id, $temp);
            $pekerjaan = $temp;
        }

        $the_id = $pasien->status_pernikahan_id;
        $temp = SS::get('m_status_pernikahan__'.$the_id);
        if ($temp) {
            $status_pernikahan = $temp;
        } else {
            $temp = Status_pernikahan::find($the_id)->name ?? '';
            SS::set('m_status_pernikahan__'.$the_id, $temp);
            $status_pernikahan = $temp;
        }

        $the_id = $pasien->aktivitas_seksual_id;
        $temp = SS::get('m_aktivitas_seksual__'.$the_id);
        if ($temp) {
            $aktivitas_seksual = $temp;
        } else {
            $temp = Aktivitas_seksual::find($the_id)->name ?? '';
            SS::set('m_aktivitas_seksual__'.$the_id, $temp);
            $aktivitas_seksual = $temp;
        }

        $the_id = $pasien->suku_id;
        $temp = SS::get('m_suku__'.$the_id);
        if ($temp) {
            $suku = $temp;
        } else {
            $temp = Suku::find($the_id)->name ?? '';
            SS::set('m_suku__'.$the_id, $temp);
            $suku = $temp;
        }

        $the_id = $pasien->datang_id;
        $temp = SS::get('m_datang__'.$the_id);
        if ($temp) {
            $datang = $temp;
        } else {
            $temp = Datang::find($the_id)->name ?? '';
            SS::set('m_datang__'.$the_id, $temp);
            $datang = $temp;
        }

        $the_id = $pasien->jaminan_kesehatan_id;
        $temp = SS::get('m_jaminan_kesehatan__'.$the_id);
        if ($temp) {
            $jaminan_kesehatan = $temp;
        } else {
            $temp = Jaminan_kesehatan::find($the_id)->name ?? '';
            SS::set('m_jaminan_kesehatan__'.$the_id, $temp);
            $jaminan_kesehatan = $temp;
        }

        $sheet->setCellValue(FORMAT::excel_column(++$c).$y, $pasien->code);
        $sheet->setCellValue(FORMAT::excel_column(++$c).$y, $rumah_sakit);
        $sheet->setCellValue(FORMAT::excel_column(++$c).$y, $unit_pelayanan);
        $sheet->setCellValue(FORMAT::excel_column(++$c).$y, $pasien->nik);
        $sheet->setCellValue(FORMAT::excel_column(++$c).$y, $pasien->name);
        $sheet->setCellValue(FORMAT::excel_column(++$c).$y, $jenis_kelamin);
        $sheet->setCellValue(FORMAT::excel_column(++$c).$y, FORMAT::date($pasien->lahir_date));
        $sheet->setCellValue(FORMAT::excel_column(++$c).$y, $propinsi);
        $sheet->setCellValue(FORMAT::excel_column(++$c).$y, $kabupaten);
        $sheet->setCellValue(FORMAT::excel_column(++$c).$y, $pasien->address);
        $sheet->setCellValue(FORMAT::excel_column(++$c).$y, $pasien->dokter_pemeriksa);
        $sheet->setCellValue(FORMAT::excel_column(++$c).$y, FORMAT::date($pasien->pemeriksaan_date));
        $sheet->setCellValue(FORMAT::excel_column(++$c).$y, FORMAT::date($pasien->input_date));
        $sheet->setCellValue(FORMAT::excel_column(++$c).$y, $pasien->tb);
        $sheet->setCellValue(FORMAT::excel_column(++$c).$y, $pasien->bb);
        $sheet->setCellValue(FORMAT::excel_column(++$c).$y, $pasien->imt);
        $sheet->setCellValue(FORMAT::excel_column(++$c).$y, $pendidikan);
        $sheet->setCellValue(FORMAT::excel_column(++$c).$y, $pekerjaan);
        $sheet->setCellValue(FORMAT::excel_column(++$c).$y, $status_pernikahan);
        $sheet->setCellValue(FORMAT::excel_column(++$c).$y, $aktivitas_seksual);
        $sheet->setCellValue(FORMAT::excel_column(++$c).$y, $suku);
        $sheet->setCellValue(FORMAT::excel_column(++$c).$y, $datang);
        $sheet->setCellValue(FORMAT::excel_column(++$c).$y, $jaminan_kesehatan);

        return $c;
    }

}
