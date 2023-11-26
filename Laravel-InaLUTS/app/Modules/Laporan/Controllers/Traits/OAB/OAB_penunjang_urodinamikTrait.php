<?php

namespace App\Modules\Laporan\Controllers\Traits\OAB;

use FORMAT;
use SS;

trait OAB_penunjang_urodinamikTrait {

    public function OAB_excel_column_penunjang_urodinamik(&$sheet, $c = 0, $y, $data, $pasien)
    {
        $c--;

        if (!$data) return $c + 13;

        if ($data->pemeriksaan_urodinamik == 'Ya') {
            $sheet->setCellValue(FORMAT::excel_column(++$c).$y,
                    $data->pemeriksaan_urodinamik
            );
            $sheet->setCellValue(FORMAT::excel_column(++$c).$y,
                    FORMAT::date($data->pemeriksaan_urodinamik_ya_date)
            );
            $sheet->setCellValue(FORMAT::excel_column(++$c).$y,
                $data->kapasitas_kandung_kemih_1
                .' - '
                .$data->kapasitas_kandung_kemih_2
                .' ml'
            );
            $sheet->setCellValue(FORMAT::excel_column(++$c).$y, $data->compliance);
            $sheet->setCellValue(FORMAT::excel_column(++$c).$y, $data->detrusor_overactivity);
            $sheet->setCellValue(FORMAT::excel_column(++$c).$y, $data->detrusor_overactivity_incontinence);
            $sheet->setCellValue(FORMAT::excel_column(++$c).$y, $data->urodynamic_stress_urinary_incontinence);
            $sheet->setCellValue(FORMAT::excel_column(++$c).$y, $data->obstruksi_infravesical);
            $sheet->setCellValue(FORMAT::excel_column(++$c).$y, $data->detrusor_underactivity);
            $sheet->setCellValue(FORMAT::excel_column(++$c).$y, $data->disfunctional_voiding);
            $sheet->setCellValue(FORMAT::excel_column(++$c).$y, $data->dsd);
            $sheet->setCellValue(FORMAT::excel_column(++$c).$y, $data->neurogenic_bladder);
            $sheet->setCellValue(FORMAT::excel_column(++$c).$y,
                $data->pvr_1
                .' - '
                .$data->pvr_2
                .' ml'
            );
        } else {
            $sheet->setCellValue(FORMAT::excel_column(++$c).$y, $data->pemeriksaan_urodinamik);
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
