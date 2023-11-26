<?php

namespace App\Modules\Laporan\Controllers\Traits\OAB;

use FORMAT;
use SS;

trait OAB_terapi_operatifTrait {

    public function OAB_excel_column_terapi_operatif(
        &$sheet, $c = 0, $y,
        $data,
        $injeksi_botox,
        $pasien
    )
    {
        //dd($data);
        //dd($injeksi_botox);
        $c--;
        $first_c = $c;
        $first_y = $y;

        if (!$data) return [
            'c' => $c + 5,
            'y' => 1
        ];

        $sheet->setCellValue(FORMAT::excel_column(++$c).$y, $data->injeksi_botox);

        ++$c;
        ++$c;

        if ($data->sns == 'Ya') {
            $sheet->setCellValue(FORMAT::excel_column(++$c).$y, $data->sns.' : '.FORMAT::date($data->sns_ya_date));
        } else {
            $sheet->setCellValue(FORMAT::excel_column(++$c).$y, $data->sns);
        }

        if ($data->augmentasi_cystoplasty == 'Ya') {
            $sheet->setCellValue(FORMAT::excel_column(++$c).$y, $data->augmentasi_cystoplasty.' : '.FORMAT::date($data->augmentasi_cystoplasty_ya_date));
        } else {
            $sheet->setCellValue(FORMAT::excel_column(++$c).$y, $data->augmentasi_cystoplasty);
        }

        if ($data->sns == 'Ya' && count($injeksi_botox) > 0) {
            // Injeksi Botox
            $y2 = $first_y;
            foreach($injeksi_botox as $v){
                $c2 = $first_c + 1;

                $sheet->setCellValue(FORMAT::excel_column(++$c2).$y2, FORMAT::date($v->injeksi_botox_date));
                $sheet->setCellValue(FORMAT::excel_column(++$c2).$y2, $v->injeksi_botox_tindakan);

                $y2++;
            }
        }

/*
        foreach($data as $v){
            $c = $first_c;

            //$sheet->setCellValue(FORMAT::excel_column(++$c).$y, FORMAT::date($v->lab_date));
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
*/

        return [
            'c' => $c,
            'y' => count($injeksi_botox) > 1 ? count($injeksi_botox) : 1
        ];
    }

}
