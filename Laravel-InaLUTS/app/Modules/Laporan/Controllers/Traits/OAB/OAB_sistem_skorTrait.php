<?php

namespace App\Modules\Laporan\Controllers\Traits\OAB;

use FORMAT;
use SS;

trait OAB_sistem_skorTrait {

    public function OAB_excel_column_sistem_skor(&$sheet, $c = 0, $y, $data, $pasien)
    {
        $c--;

        $fields = [
            'oabss' => 'OABSS',
            'qol' => 'QOL',
            'iief' => 'IIEF',
            'ehs' => 'EHS',
            'bladder_diary' => 'Bladder Diary',
        ];
        foreach($fields as $field => $caption){
            if ($data->{'c_'.$field} != '0') $buffer[] = $caption;
        }

        if (count($buffer) > 0) {
            $sheet->setCellValue(FORMAT::excel_column(++$c).$y,
                implode(', ', $buffer)
            );
        } else {
            $sheet->setCellValue(FORMAT::excel_column(++$c).$y, '');
        }

        return $c;
    }

}
