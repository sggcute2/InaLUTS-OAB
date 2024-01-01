<?php

namespace App\Modules\Laporan_follow_up\Controllers\Traits\OAB;

use FORMAT;
use SS;

trait OAB_terapi_non_operatifTrait {

    public function OAB_excel_column_terapi_non_operatif(
        &$sheet, $c = 0, $y, $data
    )
    {
        $c--;

        if (!$data) return $c + 6;

        $sheet->setCellValue(
            FORMAT::excel_column(++$c).$y, $data['terapi_non_operatif']
        );
        if ($data['terapi_non_operatif'] == 'Ya') {
            $temp = [];
            try {
                $temp = unserialize($data['terapi_non_operatif_ya']);
            } catch (Exception $exception) {
                $temp = [];
            }
            $temp_prefix = 'terapi_non_operatif_';
            $sheet->setCellValue(FORMAT::excel_column(++$c).$y, $temp[$temp_prefix.'kateter_menetap']);
            $sheet->setCellValue(FORMAT::excel_column(++$c).$y, $temp[$temp_prefix.'kateter_berkala']);
            $sheet->setCellValue(FORMAT::excel_column(++$c).$y, $temp[$temp_prefix.'penggunaan_diapers']);
            $sheet->setCellValue(FORMAT::excel_column(++$c).$y, $temp[$temp_prefix.'penile_clamp']);
            $sheet->setCellValue(FORMAT::excel_column(++$c).$y, $temp[$temp_prefix.'kondom_kateter']);
        } else {
            $sheet->setCellValue(FORMAT::excel_column(++$c).$y, '');
            $sheet->setCellValue(FORMAT::excel_column(++$c).$y, '');
            $sheet->setCellValue(FORMAT::excel_column(++$c).$y, '');
            $sheet->setCellValue(FORMAT::excel_column(++$c).$y, '');
            $sheet->setCellValue(FORMAT::excel_column(++$c).$y, '');
        }

        return $c;
    }

}
