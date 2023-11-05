<?php

namespace App\Modules\Laporan\Controllers\Traits\OAB;

use FORMAT;
use SS;

trait OAB_anamnesisTrait {

    public function OAB_excel_column_anamnesis(&$sheet, $c = 0, $y, $data, $pasien)
    {
        $c--;

        $sheet->setCellValue(FORMAT::excel_column(++$c).$y, $data->keluhan_utama);

        return $c;
    }

}
