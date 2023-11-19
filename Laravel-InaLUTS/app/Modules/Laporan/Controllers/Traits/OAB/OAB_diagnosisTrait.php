<?php

namespace App\Modules\Laporan\Controllers\Traits\OAB;

use FORMAT;
use SS;

trait OAB_diagnosisTrait {

    public function OAB_excel_column_diagnosis(&$sheet, $c = 0, $y, $data, $pasien)
    {
        $c--;

        if (!$data) return $c + 1;

        $sheet->setCellValue(FORMAT::excel_column(++$c).$y, $data->diagnosis);

        return $c;
    }

}
