<?php

namespace App\Modules\Laporan\Controllers\Traits\OAB;

use FORMAT;
use SS;

trait OAB_terapi_non_operatifTrait {

    public function OAB_excel_column_terapi_non_operatif(
        &$sheet, $c = 0, $y, 
        $terapi_by_pasien_id,
        $data,
        $pasien
    )
    {
        $c--;

        if (!$terapi_by_pasien_id || !$data) return $c + 6;

        $sheet->setCellValue(FORMAT::excel_column(++$c).$y, $data->tatalaksana_non_operatif);

        if (
            isset($data->tatalaksana_non_operatif)
            && $data->tatalaksana_non_operatif == 'Ya'
        ) {
            $sheet->setCellValue(FORMAT::excel_column(++$c).$y, $data->kateter_menetap);
            $sheet->setCellValue(FORMAT::excel_column(++$c).$y, $data->kateter_berkala);
            $sheet->setCellValue(FORMAT::excel_column(++$c).$y, $data->penggunaan_diapers);
            $sheet->setCellValue(FORMAT::excel_column(++$c).$y, $data->penile_clamp);
            $sheet->setCellValue(FORMAT::excel_column(++$c).$y, $data->kondom_kateter);
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
