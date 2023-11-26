<?php

namespace App\Modules\Laporan\Controllers\Traits\OAB;

use FORMAT;
use SS;

trait OAB_penunjang_uroflowmetriTrait {

    public function OAB_excel_column_penunjang_uroflowmetri(&$sheet, $c = 0, $y, $data, $pasien)
    {
        $c--;

        if (!$data) return $c + 6;

        $sheet->setCellValue(FORMAT::excel_column(++$c).$y,
            FORMAT::date($data->tgl_date)
        );

        $fields = [
            'voided_volume',
            'q_max',
            'q_ave',
            'pvr',
            'voiding_time',
        ];
        $uom = [
            'ml',
            'ml / detik',
            'ml',
            'ml',
            'detik',
        ];
        foreach($fields as $idx => $field){
            if ($data->{$field} == 'Ya') {
                $sheet->setCellValue(FORMAT::excel_column(++$c).$y,
                        $data->{$field}.' : '.$data->{$field.'_ya'}.' '.$uom[$idx]
                );
            } else {
                $sheet->setCellValue(FORMAT::excel_column(++$c).$y, $data->{$field});
            }
        }

        return $c;
    }

}
