<?php

namespace App\Modules\Laporan\Controllers\Traits\OAB;

use FORMAT;
use SS;

trait OAB_riwayat_operasi_non_urologiTrait {

    public function OAB_excel_column_riwayat_operasi_non_urologi(&$sheet, $c = 0, $y, $data, $pasien)
    {
        $c--;

        if (!$data) return $c + 4;

        $fields = [
            'operasi_tulang_belakang',
            'operasi_area_pelvik',
        ];
        foreach($fields as $field){
            $sheet->setCellValue(FORMAT::excel_column(++$c).$y,
                $data->{$field}
            );
        }

        if ($data->operasi_di_daerah_pelvis == 'Ya') {
            $buffer = [];
            $fields = [
                'c_operasi_di_daerah_pelvis_histrektomi' => 'Histrektomi',
                'c_operasi_di_daerah_pelvis_miomektomi' => 'Miomektomi',
                'c_operasi_di_daerah_pelvis_kistektomi' => 'Kistektomi',
                'c_operasi_di_daerah_pelvis_salfingo_ovorektomi' => 'Salfingo-ovorektomi',
                'c_operasi_di_daerah_pelvis_operasi_ca_colorektal' => 'Operasi Ca colorektal',
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
            $sheet->setCellValue(FORMAT::excel_column(++$c).$y, $data->operasi_di_daerah_pelvis);
        }

        $fields = [
            'operasi_kraniotomi',
        ];
        foreach($fields as $field){
            $sheet->setCellValue(FORMAT::excel_column(++$c).$y,
                $data->{$field}
            );
        }

        return $c;
    }

}
