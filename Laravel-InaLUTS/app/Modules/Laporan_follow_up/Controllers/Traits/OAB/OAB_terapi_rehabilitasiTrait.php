<?php

namespace App\Modules\Laporan_follow_up\Controllers\Traits\OAB;

use FORMAT;
use SS;

trait OAB_terapi_rehabilitasiTrait {

    public function OAB_excel_column_terapi_rehabilitasi(
        &$sheet, $c = 0, $y, $data
    )
    {
        $c--;

        if (!$data) return $c + 14;

        $sheet->setCellValue(
            FORMAT::excel_column(++$c).$y, $data->terapi_rehabilitasi
        );
        if ($data->terapi_rehabilitasi == 'Ya') {
            $temp = [];
            try {
                $temp = unserialize($data->terapi_rehabilitasi_ya);
            } catch (Exception $exception) {
                $temp = [];
            }
            $temp_prefix = 'terapi_rehabilitasi_';
            $temp_date = '';
            if (
                isset($temp[$temp_prefix.'terapi_date'])
                && $temp[$temp_prefix.'terapi_date']
            ) {
                $temp_date = FORMAT::date(
                    $temp[$temp_prefix.'terapi_date']
                );
            }
            $sheet->setCellValue(FORMAT::excel_column(++$c).$y, $temp_date);
            $sheet->setCellValue(FORMAT::excel_column(++$c).$y, $temp[$temp_prefix.'penilaian_otot_dasar_panggul']);
            if ($temp[$temp_prefix.'penilaian_otot_dasar_panggul'] == 'Ya') {
                $sheet->setCellValue(FORMAT::excel_column(++$c).$y, $temp[$temp_prefix.'penilaian_otot_dasar_panggul_ya']);
            } else {
                $sheet->setCellValue(FORMAT::excel_column(++$c).$y, '');
            }
            $sheet->setCellValue(FORMAT::excel_column(++$c).$y, $temp[$temp_prefix.'biofeedback']);
            if ($temp[$temp_prefix.'biofeedback'] == 'Ya') {
                $sheet->setCellValue(FORMAT::excel_column(++$c).$y, $temp[$temp_prefix.'biofeedback_max_power']);
                $sheet->setCellValue(FORMAT::excel_column(++$c).$y, $temp[$temp_prefix.'biofeedback_durasi'].' detik');
            } else {
                $sheet->setCellValue(FORMAT::excel_column(++$c).$y, '');
                $sheet->setCellValue(FORMAT::excel_column(++$c).$y, '');
            }
            $sheet->setCellValue(FORMAT::excel_column(++$c).$y, $temp[$temp_prefix.'latihan_penguatan_otot_dasar_panggul']);
            $sheet->setCellValue(FORMAT::excel_column(++$c).$y, $temp[$temp_prefix.'latihan_relaksasi_otot_dasar_panggul']);
            $sheet->setCellValue(FORMAT::excel_column(++$c).$y, $temp[$temp_prefix.'kursi_magnetic']);
            $sheet->setCellValue(FORMAT::excel_column(++$c).$y, $temp[$temp_prefix.'ptns']);
            if ($temp[$temp_prefix.'ptns'] == 'Ya') {
                $sheet->setCellValue(FORMAT::excel_column(++$c).$y, $temp[$temp_prefix.'ptns_frekuensi'].' x/minggu');
                $sheet->setCellValue(FORMAT::excel_column(++$c).$y, $temp[$temp_prefix.'ptns_durasi'].' Menit');
            } else {
                $sheet->setCellValue(FORMAT::excel_column(++$c).$y, '');
                $sheet->setCellValue(FORMAT::excel_column(++$c).$y, '');
            }
            $sheet->setCellValue(FORMAT::excel_column(++$c).$y, $temp[$temp_prefix.'ttns']);
        } else {
            return $c + 13;
        }

        return $c;
    }

}
