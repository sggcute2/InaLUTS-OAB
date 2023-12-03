<?php

namespace App\Modules\Laporan\Controllers\Traits\OAB;

use FORMAT;
use SS;

trait OAB_terapi_rehabilitasiTrait {

    public function OAB_excel_column_terapi_rehabilitasi(
        &$sheet, $c = 0, $y, 
        $terapi_by_pasien_id,
        $data,
        $pasien
    )
    {
        $c--;

        if (!$terapi_by_pasien_id || !$data) return $c + 13;

        if (
            isset($terapi_by_pasien_id->c_modifikasi_gaya_hidup)
            && $terapi_by_pasien_id->c_modifikasi_gaya_hidup != '0'
        ) {
            $sheet->setCellValue(FORMAT::excel_column(++$c).$y, FORMAT::date($data->terapi_date));

            $sheet->setCellValue(FORMAT::excel_column(++$c).$y, $data->penilaian_otot_dasar_panggul);
            if ($data->penilaian_otot_dasar_panggul == 'Ya') {
                $sheet->setCellValue(FORMAT::excel_column(++$c).$y, $data->penilaian_otot_dasar_panggul_ya);
            } else {
                $sheet->setCellValue(FORMAT::excel_column(++$c).$y, '');
            }

            $sheet->setCellValue(FORMAT::excel_column(++$c).$y, $data->biofeedback);
            if ($data->biofeedback == 'Ya') {
                $sheet->setCellValue(FORMAT::excel_column(++$c).$y, $data->biofeedback_max_power);
                $sheet->setCellValue(FORMAT::excel_column(++$c).$y, $data->biofeedback_durasi.' detik');
            } else {
                $sheet->setCellValue(FORMAT::excel_column(++$c).$y, '');
                $sheet->setCellValue(FORMAT::excel_column(++$c).$y, '');
            }

            $sheet->setCellValue(FORMAT::excel_column(++$c).$y, $data->latihan_penguatan_otot_dasar_panggul);
            $sheet->setCellValue(FORMAT::excel_column(++$c).$y, $data->latihan_relaksasi_otot_dasar_panggul);
            $sheet->setCellValue(FORMAT::excel_column(++$c).$y, $data->kursi_magnetic);

            $sheet->setCellValue(FORMAT::excel_column(++$c).$y, $data->ptns);
            if ($data->ptns == 'Ya') {
                $sheet->setCellValue(FORMAT::excel_column(++$c).$y, $data->ptns_frekuensi.' x/minggu');
                $sheet->setCellValue(FORMAT::excel_column(++$c).$y, $data->ptns_durasi.' Menit');
            } else {
                $sheet->setCellValue(FORMAT::excel_column(++$c).$y, '');
                $sheet->setCellValue(FORMAT::excel_column(++$c).$y, '');
            }

            $sheet->setCellValue(FORMAT::excel_column(++$c).$y, $data->ttns);
        } else {
            return $c + 13;
        }

        return $c;
    }

}
