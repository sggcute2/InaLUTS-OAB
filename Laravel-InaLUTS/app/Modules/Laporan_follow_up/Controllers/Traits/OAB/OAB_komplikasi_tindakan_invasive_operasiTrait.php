<?php

namespace App\Modules\Laporan_follow_up\Controllers\Traits\OAB;

use FORMAT;
use SS;

trait OAB_komplikasi_tindakan_invasive_operasiTrait {

    public function OAB_excel_column_komplikasi_tindakan_invasive_operasi(&$sheet, $c = 0, $y, $data)
    {
        $c--;

        if (!$data) return $c + 4;

        $sheet->setCellValue(FORMAT::excel_column(++$c).$y, $data->isk ?? '');
        $sheet->setCellValue(FORMAT::excel_column(++$c).$y, $data->hematuria ?? '');
        $sheet->setCellValue(FORMAT::excel_column(++$c).$y, $data->gejala_voiding2 ?? '');
        $sheet->setCellValue(FORMAT::excel_column(++$c).$y, $data->retensi_urine2 ?? '');

        return $c;
    }

}
