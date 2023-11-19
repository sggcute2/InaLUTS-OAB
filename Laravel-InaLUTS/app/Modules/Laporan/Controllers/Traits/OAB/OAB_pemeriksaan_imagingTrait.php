<?php

namespace App\Modules\Laporan\Controllers\Traits\OAB;

use FORMAT;
use SS;

trait OAB_pemeriksaan_imagingTrait {

    public function OAB_excel_column_pemeriksaan_imaging(&$sheet, $c = 0, $y, $data, $pasien)
    {
        $c--;

        if (!$data) return $c + 9;

        If($data->usg == 'Dilakukan') {
            $sheet->setCellValue(FORMAT::excel_column(++$c).$y, $data->usg.' : '.FORMAT::date($data->usg_date));
        } else {
            $sheet->setCellValue(FORMAT::excel_column(++$c).$y, $data->usg);
        }
        $sheet->setCellValue(FORMAT::excel_column(++$c).$y, $data->ct_urografi);
        $sheet->setCellValue(FORMAT::excel_column(++$c).$y, $data->ginjal__kanan__hidronefrosis);
        $sheet->setCellValue(FORMAT::excel_column(++$c).$y, $data->ginjal__kanan__batu);
        $sheet->setCellValue(FORMAT::excel_column(++$c).$y, $data->ginjal__kiri__hidronefrosis);
        $sheet->setCellValue(FORMAT::excel_column(++$c).$y, $data->ginjal__kiri__batu);
        $sheet->setCellValue(FORMAT::excel_column(++$c).$y, $data->buli__batu);
        $sheet->setCellValue(FORMAT::excel_column(++$c).$y, $data->buli__divertikel);
        $sheet->setCellValue(FORMAT::excel_column(++$c).$y, $data->buli__massa_intrabuli);

        return $c;
    }

}
