<?php

namespace App\Modules\Laporan\Controllers\Traits\OAB;

use FORMAT;
use SS;

trait OAB_keluhan_tambahanTrait {

    public function OAB_excel_column_keluhan_tambahan(&$sheet, $c = 0, $y, $data, $pasien)
    {
        $c--;

        if (!$data) return $c + 12;

        $sheet->setCellValue(FORMAT::excel_column(++$c).$y, $data->straining);
        $sheet->setCellValue(FORMAT::excel_column(++$c).$y, $data->intermittency);
        $sheet->setCellValue(FORMAT::excel_column(++$c).$y, $data->pancaran_lemah);
        $sheet->setCellValue(FORMAT::excel_column(++$c).$y, $data->tidak_lampias);
        $sheet->setCellValue(FORMAT::excel_column(++$c).$y, $data->hesitancy);
        $sheet->setCellValue(FORMAT::excel_column(++$c).$y, $data->hematuria);
        $sheet->setCellValue(FORMAT::excel_column(++$c).$y, $data->dysuria);
        $sheet->setCellValue(FORMAT::excel_column(++$c).$y, $data->terminal_dribbling);
        $sheet->setCellValue(FORMAT::excel_column(++$c).$y, $data->post_void_dribbling);
        $sheet->setCellValue(FORMAT::excel_column(++$c).$y, $data->urgensi);
        $sheet->setCellValue(FORMAT::excel_column(++$c).$y, $data->frekuensi);
        $sheet->setCellValue(FORMAT::excel_column(++$c).$y, $data->nokturia);

        return $c;
    }

}
