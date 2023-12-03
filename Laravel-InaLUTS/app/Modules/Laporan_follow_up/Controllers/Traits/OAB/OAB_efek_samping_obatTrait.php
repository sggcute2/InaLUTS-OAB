<?php

namespace App\Modules\Laporan_follow_up\Controllers\Traits\OAB;

use FORMAT;
use SS;

trait OAB_efek_samping_obatTrait {

    public function OAB_excel_column_efek_samping_obat(&$sheet, $c = 0, $y, $data)
    {
        $c--;

        if (!$data) return $c + 9;

        $sheet->setCellValue(FORMAT::excel_column(++$c).$y, $data->mulut_kering ?? '');
        $sheet->setCellValue(FORMAT::excel_column(++$c).$y, $data->mata_kering ?? '');
        $sheet->setCellValue(FORMAT::excel_column(++$c).$y, $data->konstipasi ?? '');
        $sheet->setCellValue(FORMAT::excel_column(++$c).$y, $data->gejala_voiding ?? '');
        $sheet->setCellValue(FORMAT::excel_column(++$c).$y, $data->gangguan_fungsi_kognitif ?? '');
        $sheet->setCellValue(FORMAT::excel_column(++$c).$y, $data->retensi_urine ?? '');
        $sheet->setCellValue(FORMAT::excel_column(++$c).$y, $data->hipertensi ?? '');
        $sheet->setCellValue(FORMAT::excel_column(++$c).$y, $data->gangguan_irama_jantung ?? '');
        $sheet->setCellValue(FORMAT::excel_column(++$c).$y, $data->alergi_obat_obatan_yang_dikonsumsi ?? '');

        return $c;
    }

}
