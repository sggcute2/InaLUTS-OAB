<?php

namespace App\Modules\Laporan\Controllers\Traits\OAB;

use FORMAT;
use SS;

trait OAB_penunjangTrait {

    public function OAB_excel_column_penunjang(&$sheet, $c = 0, $y, $data, $pasien)
    {
        $c--;

        if (!$data) return $c + 15;

        $sheet->setCellValue(FORMAT::excel_column(++$c).$y, $data->pvr.(trim($data->pvr)!=''?' ml':''));
        $sheet->setCellValue(FORMAT::excel_column(++$c).$y, $data->cara_mengukur_pvr);
        $sheet->setCellValue(FORMAT::excel_column(++$c).$y, $data->sistoskopi);
        if ($data->sistoskopi == 'Dikerjakan') {
            $sheet->setCellValue(FORMAT::excel_column(++$c).$y, $data->mukosa_buli);
            $sheet->setCellValue(FORMAT::excel_column(++$c).$y, $data->trabekulasi);
            $sheet->setCellValue(FORMAT::excel_column(++$c).$y, $data->sakulasi_divertikel);
            $sheet->setCellValue(FORMAT::excel_column(++$c).$y, $data->kapasitas_buli);
            $sheet->setCellValue(FORMAT::excel_column(++$c).$y, $data->batu);
            $sheet->setCellValue(FORMAT::excel_column(++$c).$y, $data->tumor);
            $sheet->setCellValue(FORMAT::excel_column(++$c).$y, $data->lobus_medius);

            if ($data->kissing_lobe == 'Ya') {
                $sheet->setCellValue(FORMAT::excel_column(++$c).$y, $data->kissing_lobe . ' : ' . $data->kissing_lobe_ya . ' cm');
            } else {
                $sheet->setCellValue(FORMAT::excel_column(++$c).$y, $data->kissing_lobe);
            }

            $sheet->setCellValue(FORMAT::excel_column(++$c).$y, $data->muara_ureter);
            $sheet->setCellValue(FORMAT::excel_column(++$c).$y, $data->urethra);
            $sheet->setCellValue(FORMAT::excel_column(++$c).$y, $data->mue);
            $sheet->setCellValue(FORMAT::excel_column(++$c).$y, $data->lichen_schlerosis);
        } else {
            $sheet->setCellValue(FORMAT::excel_column(++$c).$y, '');
            $sheet->setCellValue(FORMAT::excel_column(++$c).$y, '');
            $sheet->setCellValue(FORMAT::excel_column(++$c).$y, '');
            $sheet->setCellValue(FORMAT::excel_column(++$c).$y, '');
            $sheet->setCellValue(FORMAT::excel_column(++$c).$y, '');
            $sheet->setCellValue(FORMAT::excel_column(++$c).$y, '');
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
