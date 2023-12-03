<?php

namespace App\Modules\Laporan_follow_up\Controllers\Traits\OAB;

use FORMAT;
use SS;

trait OAB_follow_upTrait {

    public function OAB_excel_column_follow_up(&$sheet, $c = 0, $y, $data)
    {
        $c--;

        if (!$data) return $c + 2;

        $sheet->setCellValue(FORMAT::excel_column(++$c).$y, FORMAT::date($data->pemeriksaan_date));
        $sheet->setCellValue(FORMAT::excel_column(++$c).$y, $data->rumah_sakit->name ?? '');

        return $c;
    }

}
