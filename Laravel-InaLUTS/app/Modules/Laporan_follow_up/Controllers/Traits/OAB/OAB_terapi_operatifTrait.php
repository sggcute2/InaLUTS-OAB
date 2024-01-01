<?php

namespace App\Modules\Laporan_follow_up\Controllers\Traits\OAB;

use FORMAT;
use SS;

trait OAB_terapi_operatifTrait {

    public function OAB_excel_column_terapi_operatif(
        &$sheet, $c = 0, $y, $data, $injeksi_botox
    )
    {
        //dd($data);
        //dd($injeksi_botox);
        $c--;
        $first_c = $c;
        $first_y = $y;

        if (!$data) return [
            'c' => $c + 6,
            'y' => 1
        ];

        $sheet->setCellValue(
            FORMAT::excel_column(++$c).$y, $data->terapi_operatif
        );
        if ($data['terapi_operatif'] == 'Ya') {
            $temp = [];
            try {
                $temp = unserialize($data['terapi_operatif_ya']);
            } catch (Exception $exception) {
                $temp = [];
            }
            $temp_prefix = 'terapi_operatif_';
            $sheet->setCellValue(FORMAT::excel_column(++$c).$y, $temp[$temp_prefix.'injeksi_botox']);

            ++$c;
            ++$c;

            if ($temp[$temp_prefix.'sns'] == 'Ya') {
                $sheet->setCellValue(FORMAT::excel_column(++$c).$y, $temp[$temp_prefix.'sns'].' : '.FORMAT::date($temp[$temp_prefix.'sns_ya_date']));
            } else {
                $sheet->setCellValue(FORMAT::excel_column(++$c).$y, $temp[$temp_prefix.'sns']);
            }

            if ($temp[$temp_prefix.'augmentasi_cystoplasty'] == 'Ya') {
                $sheet->setCellValue(FORMAT::excel_column(++$c).$y, $temp[$temp_prefix.'augmentasi_cystoplasty'].' : '.FORMAT::date($temp[$temp_prefix.'augmentasi_cystoplasty_ya_date']));
            } else {
                $sheet->setCellValue(FORMAT::excel_column(++$c).$y, $temp[$temp_prefix.'augmentasi_cystoplasty']);
            }

            if ($temp[$temp_prefix.'sns'] == 'Ya' && count($injeksi_botox) > 0) {
                // Injeksi Botox
                $y2 = $first_y;
                foreach($injeksi_botox as $v){
                    $c2 = $first_c + 2;
    
                    $sheet->setCellValue(FORMAT::excel_column(++$c2).$y2, FORMAT::date($v->injeksi_botox_date));
                    $sheet->setCellValue(FORMAT::excel_column(++$c2).$y2, $v->injeksi_botox_tindakan);
    
                    $y2++;
                }
            }
        } else {
            $sheet->setCellValue(FORMAT::excel_column(++$c).$y, '');
            $sheet->setCellValue(FORMAT::excel_column(++$c).$y, '');
            $sheet->setCellValue(FORMAT::excel_column(++$c).$y, '');
            $sheet->setCellValue(FORMAT::excel_column(++$c).$y, '');
            $sheet->setCellValue(FORMAT::excel_column(++$c).$y, '');
        }
        //======================================================================

        return [
            'c' => $c,
            'y' => (isset($injeksi_botox) && count($injeksi_botox) > 1) ? count($injeksi_botox) : 1
        ];
    }

}
