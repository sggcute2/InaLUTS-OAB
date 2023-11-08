<?php

namespace App\Modules\Laporan\Controllers\Traits\OAB;

use FORMAT;
use SS;

trait OAB_riwayat_operasi_urologiTrait {

    public function OAB_excel_column_riwayat_operasi_urologi(&$sheet, $c = 0, $y, $data, $pasien)
    {
        $c--;

        if (!$data) return $c + 15;

        $fields = [
            'tur_prostat',
            'radikal_prostat',
            'rekonstruksi_uretra',
            'tur_buli',
        ];
        foreach($fields as $field){
            $sheet->setCellValue(FORMAT::excel_column(++$c).$y,
                $data->{$field}
            );

            if ($data->{$field} == 'Ya') {
                $sheet->setCellValue(FORMAT::excel_column(++$c).$y,
                    FORMAT::date($data->{$field.'_ya_date'})
                );
            } else {
                $sheet->setCellValue(FORMAT::excel_column(++$c).$y, '');
            }
        }

        if ($data->operasi_anti_inkontinensia_urine == 'Ya') {
            $buffer = [];
            $fields = [
                'c_operasi_anti_inkontinensia_urine_sling' => 'Sling',
                'c_operasi_anti_inkontinensia_urine_burch_kolposuspensi' => 'Burch Kolposuspensi',
                'c_operasi_anti_inkontinensia_urine_aus' => 'AUS',
                'c_operasi_anti_inkontinensia_urine_bulking_agent' => 'Bulking Agent',
            ];
            foreach($fields as $field => $caption){
                if ($data->{$field} != '0') $buffer[] = $caption;
            }

            if (count($buffer) > 0) {
                $sheet->setCellValue(FORMAT::excel_column(++$c).$y,
                    implode(', ', $buffer)
                );
            } else {
                $sheet->setCellValue(FORMAT::excel_column(++$c).$y, '');
            }
        } else {
            $sheet->setCellValue(FORMAT::excel_column(++$c).$y, 'Tidak');
        }

        $fields = [
            'operasi_pop',
            'injeksi_botox',
            'sistoskopi',
        ];
        foreach($fields as $field){
            $sheet->setCellValue(FORMAT::excel_column(++$c).$y,
                $data->{$field}
            );

            if ($data->{$field} == 'Ya') {
                $sheet->setCellValue(FORMAT::excel_column(++$c).$y,
                    FORMAT::date($data->{$field.'_ya_date'})
                );
            } else {
                $sheet->setCellValue(FORMAT::excel_column(++$c).$y, '');
            }
        }

        return $c;
    }

}
