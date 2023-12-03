<?php

namespace App\Modules\Laporan\Controllers\Traits\OAB;

use FORMAT;
use SS;

trait OAB_terapi_medikamentosaTrait {

    public function OAB_excel_column_terapi_medikamentosa(
        &$sheet, $c = 0, $y, 
        $terapi_by_pasien_id,
        $data,
        $pasien
    )
    {
        $c--;

        if (!$terapi_by_pasien_id || !$data) return $c + 7;

        if ($data->medikamentosa == 'Ya') {
            $sheet->setCellValue(FORMAT::excel_column(++$c).$y, $data->medikamentosa.' : '.$data->medikamentosa_ya);
        } else {
            $sheet->setCellValue(FORMAT::excel_column(++$c).$y, $data->medikamentosa);
        }

        if ($data->solifenacin == 'Ya') {
            $sheet->setCellValue(FORMAT::excel_column(++$c).$y, $data->solifenacin.' : '.$data->solifenacin_ya);
        } else {
            $sheet->setCellValue(FORMAT::excel_column(++$c).$y, $data->solifenacin);
        }

        $a = [
            'imidafenacin',
            'propiverine',
            'tolterodine',
        ];
        foreach($a as $v){
            if ($data->{$v} == 'Ya') {
                $sheet->setCellValue(FORMAT::excel_column(++$c).$y, $data->{$v}.' : '.$data->{$v.'_ya'}.' dosis');
            } else {
                $sheet->setCellValue(FORMAT::excel_column(++$c).$y, $data->{$v});
            }
        }

        $sheet->setCellValue(FORMAT::excel_column(++$c).$y, $data->flavoxate);

        if ($data->mirabegron == 'Ya') {
            $sheet->setCellValue(FORMAT::excel_column(++$c).$y, $data->mirabegron.' : '.$data->mirabegron_ya);
        } else {
            $sheet->setCellValue(FORMAT::excel_column(++$c).$y, $data->mirabegron);
        }

        return $c;
    }

}
