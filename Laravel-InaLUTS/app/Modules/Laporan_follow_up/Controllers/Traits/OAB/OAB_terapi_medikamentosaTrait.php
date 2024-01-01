<?php

namespace App\Modules\Laporan_follow_up\Controllers\Traits\OAB;

use FORMAT;
use SS;

trait OAB_terapi_medikamentosaTrait {

    public function OAB_excel_column_terapi_medikamentosa(
        &$sheet, $c = 0, $y, $data
    )
    {
        $c--;

        if (!$data) return $c + 7;

        $sheet->setCellValue(FORMAT::excel_column(++$c).$y, $data->terapi_medikamentosa);

        if ($data->terapi_medikamentosa == 'Ya') {
            $temp_prefix = 'terapi_medikamentosa_';
            $temp = [];
            try {
                $temp = unserialize($data['terapi_medikamentosa_ya']);
            } catch (Exception $exception) {
                $temp = [];
            }
            if ($temp[$temp_prefix.'solifenacin'] == 'Ya') {
                $sheet->setCellValue(FORMAT::excel_column(++$c).$y, $temp[$temp_prefix.'solifenacin'].' : '.$temp[$temp_prefix.'solifenacin_ya']);
            } else {
                $sheet->setCellValue(FORMAT::excel_column(++$c).$y, $temp[$temp_prefix.'solifenacin']);
            }
            $a = [
                'imidafenacin',
                'propiverine',
                'tolterodine',
            ];
            foreach($a as $v){
                if ($temp[$temp_prefix.$v] == 'Ya') {
                    $sheet->setCellValue(FORMAT::excel_column(++$c).$y, $temp[$temp_prefix.$v].' : '.$temp[$temp_prefix.$v.'_ya'].' dosis');
                } else {
                    $sheet->setCellValue(FORMAT::excel_column(++$c).$y, $temp[$temp_prefix.$v]);
                }
            }
            $sheet->setCellValue(FORMAT::excel_column(++$c).$y, $temp[$temp_prefix.'flavoxate']);
            if ($temp[$temp_prefix.'mirabegron'] == 'Ya') {
                $sheet->setCellValue(FORMAT::excel_column(++$c).$y, $temp[$temp_prefix.'mirabegron'].' : '.$temp[$temp_prefix.'mirabegron_ya']);
            } else {
                $sheet->setCellValue(FORMAT::excel_column(++$c).$y, $temp[$temp_prefix.'mirabegron']);
            }
        } else {
            $sheet->setCellValue(FORMAT::excel_column(++$c).$y, '');
            $sheet->setCellValue(FORMAT::excel_column(++$c).$y, '');
            $sheet->setCellValue(FORMAT::excel_column(++$c).$y, '');
            $sheet->setCellValue(FORMAT::excel_column(++$c).$y, '');
            $sheet->setCellValue(FORMAT::excel_column(++$c).$y, '');
            $sheet->setCellValue(FORMAT::excel_column(++$c).$y, '');
        }

        return $c;
    }

}
