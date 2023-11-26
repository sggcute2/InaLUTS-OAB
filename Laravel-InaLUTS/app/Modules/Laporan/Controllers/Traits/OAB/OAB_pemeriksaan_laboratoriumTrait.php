<?php

namespace App\Modules\Laporan\Controllers\Traits\OAB;

use FORMAT;
use SS;

trait OAB_pemeriksaan_laboratoriumTrait {

    public function OAB_excel_column_pemeriksaan_laboratorium(&$sheet, $c = 0, $y, $data, $pasien)
    {
        //dd($data);
        $c--;
        $first_c = $c;
        $first_y = $y;

        if (!$data) return [
            'c' => $c + 18,
            'y' => 1
        ];

        foreach($data as $v){
            $c = $first_c;

            $sheet->setCellValue(FORMAT::excel_column(++$c).$y, FORMAT::date($v->lab_date));
            $sheet->setCellValue(FORMAT::excel_column(++$c).$y, $v['hb']);
            $sheet->setCellValue(FORMAT::excel_column(++$c).$y, $v['leukosit']);
            $sheet->setCellValue(FORMAT::excel_column(++$c).$y, $v->trombosit);
            $sheet->setCellValue(FORMAT::excel_column(++$c).$y, $v->ureum);
            $sheet->setCellValue(FORMAT::excel_column(++$c).$y, $v->kreatinin);
            $sheet->setCellValue(FORMAT::excel_column(++$c).$y, $v->gds);
            $sheet->setCellValue(FORMAT::excel_column(++$c).$y, $v->ph);
            $sheet->setCellValue(FORMAT::excel_column(++$c).$y, $v->protein);
            $sheet->setCellValue(FORMAT::excel_column(++$c).$y, $v->glukosa);
            $sheet->setCellValue(FORMAT::excel_column(++$c).$y, $v->nitrit);
            $sheet->setCellValue(FORMAT::excel_column(++$c).$y, $v->leukosit_esterase);
            $sheet->setCellValue(FORMAT::excel_column(++$c).$y, $v->eritrosit);
            $sheet->setCellValue(FORMAT::excel_column(++$c).$y, $v->urinalisa_leukosit);
            $sheet->setCellValue(FORMAT::excel_column(++$c).$y, $v->kristal);
            $sheet->setCellValue(FORMAT::excel_column(++$c).$y, $v->bakteri);
            $sheet->setCellValue(FORMAT::excel_column(++$c).$y, $v->jamur);
            $sheet->setCellValue(FORMAT::excel_column(++$c).$y, $v->kultur_urin);

            $y++;
        }

        return [
            'c' => $c,
            'y' => count($data)
        ];
    }

}
